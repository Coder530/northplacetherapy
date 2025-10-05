<?php
session_start();

// Basic authentication - replace with a proper user authentication system
$valid_username = "admin";
$valid_password_hash = password_hash("password123", PASSWORD_DEFAULT); // Replace "password123" with a strong password

$is_logged_in = false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $is_logged_in = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && password_verify($password, $valid_password_hash)) {
        $_SESSION['loggedin'] = true;
        $is_logged_in = true;
        header("Location: admin.php"); // Redirect to avoid form resubmission
        exit;
    } else {
        $login_error = "Invalid username or password.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Database connection
$db_host = 'localhost';
$db_user = 'thecoder530';
$db_pass = 'Jsckike123@gmail.com';
$db_name = 'contact_data'; // Corrected database name

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
$db_connection_error = null; // Initialize error variable

if ($conn->connect_error) {
    $db_connection_error = "Database connection failed: " . $conn->connect_error;
    // For critical connection failure, we might want to log and show a generic error,
    // but for now, we'll let parts of the page try to use $conn and handle failure there.
}


// --- Blog Post Handling ---
$blog_message = ''; // For create/update messages
$edit_post_data = null; // To store data for the post being edited
$current_action = $_GET['action'] ?? null;
$post_id_to_edit = $_GET['id'] ?? null;

// Function to handle image upload (used for both create and update)
function handle_blog_image_upload($file_input_name, &$error_message, $existing_image_path = null) {
    if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
        $target_dir = "images/blog_uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $image_name_original = basename($_FILES[$file_input_name]["name"]);
        $safe_image_name = preg_replace("/[^A-Za-z0-9\._-]/", "", $image_name_original);
        $image_unique_id = uniqid() . '_' . $safe_image_name;
        $target_file = $target_dir . $image_unique_id;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES[$file_input_name]["tmp_name"]);
        if ($check !== false) {
            if (in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                if (move_uploaded_file($_FILES[$file_input_name]["tmp_name"], $target_file)) {
                    // If replacing an old image, try to delete it
                    if ($existing_image_path && file_exists($existing_image_path) && $existing_image_path !== $target_file) {
                        // Basic check to prevent deleting default/placeholder if it was somehow set as existing
                        if (strpos($existing_image_path, 'blog_uploads/') !== false) {
                           unlink($existing_image_path);
                        }
                    }
                    return $target_file;
                } else {
                    $error_message = "Error: Sorry, there was an error uploading your file to $target_file. Check directory permissions.";
                    return $existing_image_path; // Return old path on failure
                }
            } else {
                $error_message = "Error: Only JPG, JPEG, PNG & GIF files are allowed. You uploaded a $imageFileType.";
                return $existing_image_path;
            }
        } else {
            $error_message = "Error: File is not a valid image.";
            return $existing_image_path;
        }
    } elseif (isset($_POST['remove_current_image']) && $_POST['remove_current_image'] == '1' && $existing_image_path) {
        // Handle image removal if checkbox is checked
        if (file_exists($existing_image_path) && strpos($existing_image_path, 'blog_uploads/') !== false) {
            unlink($existing_image_path);
        }
        return null; // Image removed
    }
    return $existing_image_path; // No new file uploaded or keep existing
}


// CREATE NEW BLOG POST
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_blog_post'])) {
    $title = trim($_POST['blog_title'] ?? '');
    $content = trim($_POST['blog_content'] ?? '');
    $author = trim($_POST['blog_author'] ?? 'Admin');
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    if(empty($slug)) $slug = 'post-' . uniqid(); // Ensure slug is never empty

    $image_path_db = null;

    if (empty($title) || empty($content)) {
        $blog_message = "Error: Blog title and content are required.";
    } elseif ($conn && !$conn->connect_error) {
        $image_path_db = handle_blog_image_upload('blog_image', $blog_message);

        if (empty($blog_message)) { // Proceed if no image upload error
            $stmt_check_slug = $conn->prepare("SELECT id FROM blog_posts WHERE slug = ?");
            $stmt_check_slug->bind_param("s", $slug);
            $stmt_check_slug->execute();
            $result_slug = $stmt_check_slug->get_result();
            if ($result_slug->num_rows > 0) {
                $slug .= '-' . uniqid(); // Append unique ID if slug exists
            }
            $stmt_check_slug->close();

            $stmt = $conn->prepare("INSERT INTO blog_posts (title, slug, content, author, image_path) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssss", $title, $slug, $content, $author, $image_path_db);
                if ($stmt->execute()) {
                    $blog_message = "Blog post submitted successfully! <a href='blog.php?post=" . urlencode($slug) . "' target='_blank'>View Post</a>";
                    $_POST['blog_title'] = $_POST['blog_content'] = $_POST['blog_author'] = ''; // Clear form
                } else {
                    $blog_message = "Error: Could not submit blog post. " . $stmt->error;
                }
                $stmt->close();
            } else {
                $blog_message = "Error preparing statement for blog post: " . $conn->error;
            }
        }
    } elseif ($db_connection_error) {
        $blog_message = "Error: " . $db_connection_error . ". Cannot save blog post.";
    }
}

// DELETE BLOG POST
if ($is_logged_in && $current_action === 'delete_post' && !empty($post_id_to_edit)) { // Re-using $post_id_to_edit for ID
    if ($conn && !$conn->connect_error) {
        // First, get the image path to delete the file
        $stmt_img = $conn->prepare("SELECT image_path FROM blog_posts WHERE id = ?");
        $image_to_delete = null;
        if($stmt_img){
            $stmt_img->bind_param("i", $post_id_to_edit);
            $stmt_img->execute();
            $result_img = $stmt_img->get_result();
            if($row_img = $result_img->fetch_assoc()){
                $image_to_delete = $row_img['image_path'];
            }
            $stmt_img->close();
        } else {
            $blog_message = "Error preparing to fetch image path for deletion: " . $conn->error;
        }

        if(empty($blog_message)) { // Proceed if no error fetching image path
            $stmt = $conn->prepare("DELETE FROM blog_posts WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $post_id_to_edit);
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $blog_message = "Blog post deleted successfully.";
                        // Try to delete the image file
                        if ($image_to_delete && file_exists($image_to_delete)) {
                             // Basic check to prevent deleting default/placeholder
                            if (strpos($image_to_delete, 'blog_uploads/') !== false) {
                                if (unlink($image_to_delete)) {
                                    $blog_message .= " Image file also deleted.";
                                } else {
                                    $blog_message .= " Could not delete image file (permission issue or file locked).";
                                }
                            } else {
                                 $blog_message .= " Image file was not in expected uploads directory, so not deleted.";
                            }
                        }
                    } else {
                        $blog_message = "Error: Post not found or already deleted.";
                    }
                } else {
                    $blog_message = "Error: Could not delete blog post. " . $stmt->error;
                }
                $stmt->close();
            } else {
                $blog_message = "Error preparing statement for blog post deletion: " . $conn->error;
            }
        }
    } elseif ($db_connection_error) {
        $blog_message = "Database connection error: " . $db_connection_error;
    }
    // Set session message and redirect to clean URL and show message on the blog manager page
    $_SESSION['admin_blog_message'] = $blog_message;
    header("Location: admin.php#blog-manager");
    exit;
}


// UPDATE EXISTING BLOG POST
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_blog_post'])) {
    $post_id = $_POST['post_id'] ?? null;
    $title = trim($_POST['edit_blog_title'] ?? '');
    $content = trim($_POST['edit_blog_content'] ?? '');
    $author = trim($_POST['edit_blog_author'] ?? 'Admin');
    $new_slug_base = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    if(empty($new_slug_base)) $new_slug_base = 'post-' . $post_id;


    $current_image_path = $_POST['current_blog_image_path'] ?? null; // Get current image path from hidden field

    if (empty($post_id) || empty($title) || empty($content)) {
        $blog_message = "Error: Post ID, title, and content are required for updating.";
         // To repopulate form correctly on error, fetch the data again or use POSTed data
        $edit_post_data = $_POST; // This might not be ideal as field names differ, handle carefully
        $edit_post_data['title'] = $title; // map to expected keys for the form
        $edit_post_data['content'] = $content;
        $edit_post_data['author'] = $author;
        $edit_post_data['image_path'] = $current_image_path;


    } elseif ($conn && !$conn->connect_error) {
        $image_path_db = handle_blog_image_upload('edit_blog_image', $blog_message, $current_image_path);

        if (empty($blog_message)) { // Proceed if no image upload error
            // Check if slug needs to be updated and if the new one is unique
            $stmt_old_slug = $conn->prepare("SELECT slug FROM blog_posts WHERE id = ?");
            $stmt_old_slug->bind_param("i", $post_id);
            $stmt_old_slug->execute();
            $result_old_slug = $stmt_old_slug->get_result();
            $old_post_data = $result_old_slug->fetch_assoc();
            $old_slug = $old_post_data['slug'] ?? '';
            $stmt_old_slug->close();

            $final_slug = $old_slug;
            // Only change slug if the base derived from new title is different from base of old slug
            // This logic prevents changing slug if only minor chars were changed in title but base is same
            // Or if title is same, slug shouldn't change.
            $old_slug_base_parts = explode('-', $old_slug);
            if (count($old_slug_base_parts) > 1 && preg_match('/^[a-f0-9]{13}$/', end($old_slug_base_parts))) {
                array_pop($old_slug_base_parts); // Remove unique ID if present
            }
            $old_slug_base = implode('-', $old_slug_base_parts);

            if ($new_slug_base !== $old_slug_base) {
                $final_slug = $new_slug_base;
                $stmt_check_slug = $conn->prepare("SELECT id FROM blog_posts WHERE slug = ? AND id != ?");
                $stmt_check_slug->bind_param("si", $final_slug, $post_id);
                $stmt_check_slug->execute();
                $result_slug = $stmt_check_slug->get_result();
                if ($result_slug->num_rows > 0) {
                    $final_slug .= '-' . uniqid(); // Append unique ID if new slug exists for another post
                }
                $stmt_check_slug->close();
            }


            $stmt = $conn->prepare("UPDATE blog_posts SET title = ?, slug = ?, content = ?, author = ?, image_path = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("sssssi", $title, $final_slug, $content, $author, $image_path_db, $post_id);
                if ($stmt->execute()) {
                    $blog_message = "Blog post updated successfully! <a href='blog.php?post=" . urlencode($final_slug) . "' target='_blank'>View Post</a>";
                    // Optionally redirect or clear form: header("Location: admin.php#blog-manager"); exit;
                } else {
                    $blog_message = "Error: Could not update blog post. " . $stmt->error;
                }
                $stmt->close();
            } else {
                $blog_message = "Error preparing statement for blog post update: " . $conn->error;
            }
        }
         // If there was an error (e.g. image upload), make sure to repopulate edit_post_data
        if (!empty($blog_message) && strpos(strtolower($blog_message), 'error') !== false) {
            $stmt_fetch = $conn->prepare("SELECT id, title, content, author, image_path, slug FROM blog_posts WHERE id = ?");
            if ($stmt_fetch) {
                $stmt_fetch->bind_param("i", $post_id);
                $stmt_fetch->execute();
                $result_fetch = $stmt_fetch->get_result();
                $edit_post_data = $result_fetch->fetch_assoc();
                $stmt_fetch->close();
                 // Override with values from POST if they exist, as they are more current
                if(isset($_POST['edit_blog_title'])) $edit_post_data['title'] = $_POST['edit_blog_title'];
                if(isset($_POST['edit_blog_content'])) $edit_post_data['content'] = $_POST['edit_blog_content'];
                if(isset($_POST['edit_blog_author'])) $edit_post_data['author'] = $_POST['edit_blog_author'];
                $edit_post_data['image_path'] = $image_path_db; // Use the path determined by handle_blog_image_upload
            }
        }


    } elseif ($db_connection_error) {
        $blog_message = "Error: " . $db_connection_error . ". Cannot update blog post.";
    }
}


// FETCH DATA FOR EDITING A POST
if ($is_logged_in && $current_action === 'edit_post' && !empty($post_id_to_edit) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($conn && !$conn->connect_error) {
        $stmt = $conn->prepare("SELECT id, title, content, author, image_path, slug FROM blog_posts WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $post_id_to_edit);
            $stmt->execute();
            $result = $stmt->get_result();
            $edit_post_data = $result->fetch_assoc();
            if (!$edit_post_data) {
                $blog_message = "Error: Post not found for editing.";
                $current_action = null; // Reset action if post not found
            }
            $stmt->close();
        } else {
            $blog_message = "Error preparing to fetch post for editing: " . $conn->error;
            $current_action = null;
        }
    } elseif ($db_connection_error) {
        $blog_message = "Database connection error: " . $db_connection_error;
        $current_action = null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        .client-reschedule-msg {
            background-color: #fff3cd; /* Light yellow */
            padding: 5px;
            border-radius: 3px;
            margin-top: 5px;
            border: 1px solid #ffeeba;
        }
        .admin-comments {
            background-color: #e2e3e5; /* Light gray */
            padding: 5px;
            border-radius: 3px;
            margin-top: 5px;
            display: block; /* Make it block to take full width of cell if needed */
            border: 1px solid #d6d8db;
        }
        /* Add some basic styling for the plain textarea */
        textarea#blog_content {
            width: 100%;
            min-height: 300px; /* Adjust as needed */
            padding: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1>Admin Panel</h1>
        <?php if ($is_logged_in): ?>
            <a href="?logout=true" class="btn btn-secondary">Logout</a>
        <?php endif; ?>
    </header>

    <main class="admin-container">
        <?php
        // Check for default password after login
        if ($is_logged_in && password_verify("password123", $valid_password_hash)):
        ?>
            <p class="warning-message" style="text-align: center; padding: 10px; background-color: #fff3cd; border: 1px solid #ffeeba; color: #856404;">
                <strong>Security Warning:</strong> You are using the default password. Please change it as soon as possible!
                You'll need to manually edit the <code>$valid_password_hash</code> in <code>admin.php</code> with a new hash generated from a strong password.
            </p>
        <?php endif; ?>

        <?php if (!$is_logged_in): ?>
            <section class="login-section">
                <h2>Login</h2>
                <?php if (isset($login_error)): ?>
                    <p class="error-message"><?php echo $login_error; ?></p>
                <?php endif; ?>
                <form method="POST" action="admin.php">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn">Login</button>
                </form>
            </section>
        <?php else: ?>
            <nav class="admin-nav">
                <ul>
                    <li><a href="#blog-manager">Blog Manager</a></li>
                    <li><a href="#blog-poster">Create New Post</a></li>
                </ul>
            </nav>

            <section id="blog-poster" class="admin-section">
                <h2>Create New Blog Post</h2>
                <?php if ($blog_message): ?>
                    <p class="<?php echo strpos($blog_message, 'Error:') === 0 ? 'error-message' : 'success-message'; ?>">
                        <?php echo $blog_message; ?>
                    </p>
                <?php endif; ?>
                 <?php if ($db_connection_error && strpos($blog_message, $db_connection_error) === false): // Show DB error if not already part of blog_message ?>
                     <p class="error-message"><?php echo $db_connection_error; ?>. Please ensure the 'blog_posts' table exists and is correctly configured.</p>
                <?php endif; ?>

                <form method="POST" action="admin.php#blog-poster" enctype="multipart/form-data">
                    <div>
                        <label for="blog_title">Title:</label>
                        <input type="text" id="blog_title" name="blog_title" required value="<?php echo htmlspecialchars($_POST['blog_title'] ?? ''); ?>">
                    </div>
                    <div>
                        <label for="blog_author">Author (optional):</label>
                        <input type="text" id="blog_author" name="blog_author" placeholder="Admin" value="<?php echo htmlspecialchars($_POST['blog_author'] ?? 'Admin'); ?>">
                    </div>
                    <div>
                        <label for="blog_image">Featured Image (optional):</label>
                        <input type="file" id="blog_image" name="blog_image" accept="image/*">
                    </div>
                    <div>
                        <label for="blog_content">Content:</label>
                        <textarea id="blog_content" name="blog_content" rows="15"><?php echo htmlspecialchars($_POST['blog_content'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" name="submit_blog_post" class="btn">Publish Post</button>
                </form>
            </section>

            <section id="blog-manager" class="admin-section">
                <h2>Manage Blog Posts</h2>
                <?php
                // Display messages from delete/update actions if redirected
                if (isset($_SESSION['admin_blog_message'])) {
                    $message_type_class = (strpos(strtolower($_SESSION['admin_blog_message']), 'error') !== false || strpos(strtolower($_SESSION['admin_blog_message']), 'could not') !== false) ? 'error-message' : 'success-message';
                    echo '<p class="' . $message_type_class . '">' . htmlspecialchars($_SESSION['admin_blog_message']) . '</p>';
                    unset($_SESSION['admin_blog_message']);
                }

                // Display general $blog_message if set from other operations on this page load (e.g. update error without redirect)
                if ($blog_message && (!isset($_SESSION['admin_blog_message']) || htmlspecialchars($_SESSION['admin_blog_message']) !== $blog_message ) && $current_action !== 'edit_post') {
                     $message_type_class = (strpos(strtolower($blog_message), 'error') !== false || strpos(strtolower($blog_message), 'could not') !== false) ? 'error-message' : 'success-message';
                     echo '<p class="' . $message_type_class . '">' . $blog_message . '</p>';
                }


                // Fetch all blog posts
                $blog_posts_list = [];
                $blog_list_error = null;
                if ($conn && !$conn->connect_error) {
                    $sql_posts = "SELECT id, title, slug, author, created_at, updated_at FROM blog_posts ORDER BY created_at DESC";
                    $result_posts = $conn->query($sql_posts);
                    if ($result_posts) {
                        while ($row = $result_posts->fetch_assoc()) {
                            $blog_posts_list[] = $row;
                        }
                        $result_posts->free();
                    } else {
                        $blog_list_error = "Error fetching blog posts: " . $conn->error;
                    }
                } elseif ($db_connection_error) {
                    $blog_list_error = $db_connection_error;
                }

                if ($blog_list_error) {
                    echo '<p class="error-message">' . htmlspecialchars($blog_list_error) . '</p>';
                } elseif (empty($blog_posts_list)) {
                    echo '<p>No blog posts found. <a href="#blog-poster">Create one now!</a></p>';
                } else {
                ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($blog_posts_list as $post): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($post['id']); ?></td>
                                <td><?php echo htmlspecialchars($post['title']); ?></td>
                                <td><?php echo htmlspecialchars($post['slug']); ?></td>
                                <td><?php echo htmlspecialchars($post['author']); ?></td>
                                <td><?php echo htmlspecialchars(date('M j, Y H:i', strtotime($post['created_at']))); ?></td>
                                <td><?php echo htmlspecialchars(date('M j, Y H:i', strtotime($post['updated_at']))); ?></td>
                                <td>
                                    <a href="admin.php?action=edit_post&id=<?php echo $post['id']; ?>#blog-editor" class="btn btn-small btn-primary">Edit</a>
                                    <a href="admin.php?action=delete_post&id=<?php echo $post['id']; ?>#blog-manager" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">Delete</a>
                                    <a href="blog.php?post=<?php echo urlencode($post['slug']); ?>" class="btn btn-small btn-secondary" target="_blank">View</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                } // end else for displaying table
                ?>
            </section>

            <?php // Section for Editing a Blog Post - only shown if action=edit_post and data is loaded ?>
            <?php if ($is_logged_in && $current_action === 'edit_post' && $edit_post_data): ?>
            <section id="blog-editor" class="admin-section active-section">
                <h2>Edit Blog Post: <?php echo htmlspecialchars($edit_post_data['title']); ?></h2>
                <p><a href="admin.php#blog-manager" class="btn btn-secondary btn-small">&laquo; Back to Manage Posts</a></p>

                <?php if ($blog_message && strpos(strtolower($blog_message), 'updated successfully') === false): // Show error/info messages here if not success ?>
                    <p class="<?php echo strpos(strtolower($blog_message), 'error') !== false ? 'error-message' : 'info-message'; ?>">
                        <?php echo $blog_message; ?>
                    </p>
                <?php endif; ?>

                <form method="POST" action="admin.php?action=edit_post&id=<?php echo $edit_post_data['id']; ?>#blog-editor" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($edit_post_data['id']); ?>">
                    <input type="hidden" name="current_blog_image_path" value="<?php echo htmlspecialchars($edit_post_data['image_path'] ?? ''); ?>">

                    <div>
                        <label for="edit_blog_title">Title:</label>
                        <input type="text" id="edit_blog_title" name="edit_blog_title" required value="<?php echo htmlspecialchars($edit_post_data['title'] ?? ''); ?>">
                    </div>
                    <div>
                        <label for="edit_blog_author">Author:</label>
                        <input type="text" id="edit_blog_author" name="edit_blog_author" value="<?php echo htmlspecialchars($edit_post_data['author'] ?? 'Admin'); ?>">
                    </div>
                    <div>
                        <label for="edit_blog_image">Featured Image:</label>
                        <?php if (!empty($edit_post_data['image_path']) && file_exists($edit_post_data['image_path'])): ?>
                            <div style="margin-bottom: 10px;">
                                <img src="<?php echo htmlspecialchars($edit_post_data['image_path']); ?>" alt="Current image" style="max-width: 200px; max-height: 150px; display:block; margin-bottom:5px;">
                                <label><input type="checkbox" name="remove_current_image" value="1"> Remove current image</label>
                            </div>
                        <?php elseif (!empty($edit_post_data['image_path'])): ?>
                            <p class="error-message"><small>Current image not found at: <?php echo htmlspecialchars($edit_post_data['image_path']); ?>. You can upload a new one.</small></p>
                        <?php endif; ?>
                        <input type="file" id="edit_blog_image" name="edit_blog_image" accept="image/*">
                        <small>Upload a new image to replace the current one. If no new image is selected and "Remove current image" is unchecked, the current image will be kept.</small>
                    </div>
                    <div>
                        <label for="edit_blog_content">Content:</label>
                        <textarea id="edit_blog_content" name="edit_blog_content" rows="15"><?php echo htmlspecialchars($edit_post_data['content'] ?? ''); ?></textarea>
                    </div>
                     <div>
                        <label for="edit_blog_slug">Slug:</label>
                        <input type="text" id="edit_blog_slug" name="edit_blog_slug" readonly value="<?php echo htmlspecialchars($edit_post_data['slug'] ?? ''); ?>" style="background-color: #eee;">
                        <small>Slug is auto-generated based on the title. It will be updated if the title changes significantly. Current: <?php echo htmlspecialchars($edit_post_data['slug'] ?? ''); ?></small>
                    </div>
                    <button type="submit" name="update_blog_post" class="btn">Update Post</button>
                </form>
            </section>
            <?php elseif ($is_logged_in && $current_action === 'edit_post' && !$edit_post_data): ?>
                 <section id="blog-editor" class="admin-section active-section">
                    <h2>Edit Blog Post</h2>
                    <p class="error-message"><?php echo $blog_message ?: "Could not load post data for editing."; ?></p>
                    <p><a href="admin.php#blog-manager" class="btn btn-secondary btn-small">&laquo; Back to Manage Posts</a></p>
                 </section>
            <?php endif; ?>

            <section id="data-management" class="admin-section">
                <h2>Data Management</h2>
                <p>Use the following tools for managing application data. Please use with caution.</p>

                <div style="margin-top: 20px; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9;">
                    <h3>Delete Old Contact Submissions</h3>
                    <p>
                        This action will permanently delete contact form submissions (appointment requests) that are older than one year.
                        This is based on the original submission timestamp. This action cannot be undone.
                    </p>
                    <form action="cron_delete_old_submissions.php" method="get" target="_blank" onsubmit="return confirm('Are you sure you want to delete all contact form submissions older than one year? This action cannot be undone.');">
                        <button type="submit" class="btn btn-danger">Delete Submissions Older Than 1 Year</button>
                    </form>
                    <p style="margin-top:10px;"><small>Note: The script will open in a new tab and display the number of records deleted or any errors encountered.</small></p>
                </div>
            </section>


        <?php endif; ?>
    </main>

    <footer class="admin-footer">
        <p>&copy; <?php echo date("Y"); ?> Admin Panel</p>
    </footer>

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <?php if ($is_logged_in): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Calendar Initialization
            var calendarEl = document.getElementById('appointment-calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: <?php echo json_encode($calendar_events); ?>,
                    eventClick: function(info) {
                        // Optional: Handle event click, e.g., show details or open manage panel
                        // alert('Event: ' + info.event.title + '\nStatus: ' + info.event.extendedProps.status);

                        // Attempt to find and trigger the manage button for this submission_id
                        const submissionId = info.event.extendedProps.submission_id;
                        const manageButton = document.querySelector(`.manage-appointment-btn[data-id='${submissionId}']`);
                        if (manageButton) {
                            manageButton.click(); // Simulate click to open the panel
                            // Scroll to the manage panel if it's opened elsewhere on the page
                             const actionsPanel = document.getElementById('appointment-actions-panel');
                             if(actionsPanel && actionsPanel.style.display !== 'none') {
                                actionsPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });
                             }
                        } else {
                            alert('Details for Submission ID ' + submissionId + ':\n' + info.event.title + '\nStatus: ' + info.event.extendedProps.status);
                        }
                    },
                    editable: false, // True if you want to allow drag-and-drop rescheduling (would need backend update)
                    selectable: true, // True if you want to allow selecting dates (e.g. for creating new appointment)
                    select: function(info) {
                        // Optional: Handle date selection, e.g. for creating a new appointment
                        // alert('Selected ' + info.startStr + ' to ' + info.endStr);
                        // You could pre-fill a "new appointment" form here.
                    }
                });
                calendar.render();
            }

            const navLinks = document.querySelectorAll('.admin-nav a');
            const sections = document.querySelectorAll('.admin-section');
            const defaultSectionId = 'appointments'; // Default section

            function showSection(targetId) {
                let sectionFound = false;
                sections.forEach(section => {
                    if (section.id === targetId) {
                        section.classList.add('active-section');
                        sectionFound = true;
                    } else {
                        section.classList.remove('active-section');
                    }
                });

                navLinks.forEach(link => {
                    if (link.getAttribute('href') === '#' + targetId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
                // If targetId was not found, default to the first one or a predefined default
                if (!sectionFound && sections.length > 0) {
                    const firstSectionId = sections[0].id;
                    showSection(firstSectionId); // Fallback to the actual first section
                }
            }

            let currentHash = window.location.hash.substring(1);
            if (!currentHash || !document.getElementById(currentHash)) {
                currentHash = defaultSectionId;
            }
            showSection(currentHash);


            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    showSection(targetId);
                    window.location.hash = targetId;
                });
            });
             // Ensure correct section is shown if hash changes (e.g. form submission with hash)
            window.addEventListener('hashchange', () => {
                const hash = window.location.hash.substring(1);
                if(hash){
                    showSection(hash);
                } else {
                    showSection(defaultSectionId);
                }
            });

            // --- Appointment Actions Panel Logic ---
            const actionsPanel = document.getElementById('appointment-actions-panel');
            const panelAppointmentName = document.getElementById('panel-appointment-name');
            const panelAppointmentEmail = document.getElementById('panel-appointment-email');
            const panelAppointmentCurrentDate = document.getElementById('panel-appointment-current-date');
            const panelAppointmentStatus = document.getElementById('panel-appointment-status');

            // Form sections
            const approveFormSection = document.getElementById('approve-form-section');
            const proposeNewDateFormSection = document.getElementById('propose-new-date-form-section');
            const denyFormSection = document.getElementById('deny-form-section');
            const hrAfterApprove = document.getElementById('hr-after-approve');
            const hrAfterPropose = document.getElementById('hr-after-propose');


            // Hidden input fields for IDs
            const panelApproveId = document.getElementById('panel-approve-id');
            const panelDenyId = document.getElementById('panel-deny-id');
            const panelRescheduleId = document.getElementById('panel-reschedule-id');

            // Input fields
            const panelRescheduleDateInput = document.getElementById('panel-reschedule-date');
            const panelDenyCommentsTextarea = document.getElementById('panel-deny-comments'); // Corrected ID from panel-deny-comments
            const panelRescheduleCommentsTextarea = document.getElementById('panel-reschedule-comments'); // Corrected ID from panel-reschedule-comments

            const closeActionsPanelBtn = document.getElementById('close-actions-panel-btn');

            document.querySelectorAll('.manage-appointment-btn').forEach(button => {
                button.classList.add('btn-primary');
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const appointmentId = this.dataset.id;
                    const appointmentName = this.dataset.name;
                    const appointmentEmail = this.dataset.email;
                    const appointmentCurrentDateDisplay = this.dataset.currentDateDisplay;
                    const appointmentCurrentDateValue = this.dataset.currentDate; // YYYY-MM-DDTHH:MM format
                    const appointmentStatus = this.dataset.status;

                    // Populate panel info
                    panelAppointmentName.textContent = appointmentName;
                    panelAppointmentEmail.textContent = appointmentEmail;
                    panelAppointmentCurrentDate.textContent = appointmentCurrentDateDisplay;
                    panelAppointmentStatus.textContent = appointmentStatus ? appointmentStatus.replace(/_/g, ' ') : 'N/A';


                    // Populate form hidden IDs
                    panelApproveId.value = appointmentId;
                    panelDenyId.value = appointmentId;
                    panelRescheduleId.value = appointmentId;

                    // Clear previous comments/dates
                    panelDenyCommentsTextarea.value = '';
                    panelRescheduleCommentsTextarea.value = '';
                    panelRescheduleDateInput.value = appointmentCurrentDateValue;

                    // Control visibility of form sections based on status
                    const statusLower = appointmentStatus ? appointmentStatus.toLowerCase() : '';

                    if (statusLower === 'pending_admin_action' || statusLower === 'rescheduled_by_client' || statusLower === 'pending' || statusLower === 'rescheduled_by_clien') { // Legacy 'pending'
                        approveFormSection.style.display = 'block';
                        hrAfterApprove.style.display = 'block';
                    } else {
                        approveFormSection.style.display = 'none';
                        hrAfterApprove.style.display = 'none';
                    }

                    // Propose new date and Deny/Cancel forms are generally always available for manageable statuses
                    proposeNewDateFormSection.style.display = 'block';
                    denyFormSection.style.display = 'block';
                    hrAfterPropose.style.display = 'block';


                    if (actionsPanel) {
                        actionsPanel.style.display = 'block';
                        actionsPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            if (closeActionsPanelBtn && actionsPanel) {
                closeActionsPanelBtn.addEventListener('click', function() {
                    actionsPanel.style.display = 'none';
                });
            }
        });
    </script>
    <?php endif; ?>
</body>
</html>
