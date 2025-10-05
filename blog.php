<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$db_host = 'localhost';
$db_user = 'thecoder530';
$db_pass = 'Jsckike123@gmail.com';
$db_name = 'contact_data';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
$db_connection_error = null;

if ($conn->connect_error) {
    $db_connection_error = "Database connection failed: " . $conn->connect_error;
    error_log($db_connection_error); // Log the actual error for the admin
}

$post_slug = $_GET['post'] ?? null;
$current_post = null;
$all_posts = [];

if ($conn && !$conn->connect_error) {
    if ($post_slug) {
        // Fetch a single post by its slug
        $stmt = $conn->prepare("SELECT title, slug, content, author, image_path, created_at FROM blog_posts WHERE slug = ? ORDER BY created_at DESC LIMIT 1");
        if ($stmt) {
            $stmt->bind_param("s", $post_slug);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $current_post = $result->fetch_assoc();
            }
            $stmt->close();
        } else {
            error_log("Error preparing statement to fetch single post: " . $conn->error);
            $db_connection_error = "An error occurred while fetching blog data."; // Generic error for user
        }
    } else {
        // Fetch all posts for the listing page
        // Consider adding pagination here if you expect many posts
        $result = $conn->query("SELECT title, slug, content, author, image_path, created_at FROM blog_posts ORDER BY created_at DESC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Create a short excerpt for the listing page
                $content_text = strip_tags($row['content']);
                $excerpt = mb_substr($content_text, 0, 150);
                if (mb_strlen($content_text) > 150) {
                    $excerpt .= "...";
                }
                $row['excerpt'] = $excerpt;
                $all_posts[] = $row;
            }
            $result->free();
        } else {
            error_log("Error fetching all posts: " . $conn->error);
            $db_connection_error = "An error occurred while fetching blog data."; // Generic error for user
        }
    }
} elseif (!$conn) { // $conn object itself is null/false
    $db_connection_error = "Database connection object not created.";
    error_log($db_connection_error);
}
// If $conn->connect_error was set, $db_connection_error already holds that message.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $current_post ? htmlspecialchars($current_post['title']) : 'Blog'; ?> - Therapist for Professionals</title>
    <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
</head>
<body>
    <?php include("navbar.php"); ?>

    <main class="page-content blog-page">
        <?php if ($db_connection_error && !$current_post && empty($all_posts)): ?>
            <p class="error-message" style="text-align: center; padding: 2rem;">
                We are currently experiencing technical difficulties retrieving blog posts. Please try again later.
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { /* Show detailed error only if admin is logged in */ echo "<br><small>Error: " . $db_connection_error . "</small>"; } ?>
            </p>
        <?php elseif ($post_slug && $current_post): // Displaying a single post ?>
            <article class="blog-post-full">
                <header class="blog-post-header">
                    <h1><?php echo htmlspecialchars($current_post['title']); ?></h1>
                    <p class="post-meta">
                        Published on <time datetime="<?php echo date('Y-m-d', strtotime($current_post['created_at'])); ?>"><?php echo htmlspecialchars(date('F j, Y', strtotime($current_post['created_at']))); ?></time>
                        <?php if (!empty($current_post['author'])): ?>
                            by <?php echo htmlspecialchars($current_post['author']); ?>
                        <?php endif; ?>
                    </p>
                </header>
                <?php if (!empty($current_post['image_path']) && file_exists($current_post['image_path'])): ?>
                    <img src="<?php echo htmlspecialchars($current_post['image_path']); ?>" alt="<?php echo htmlspecialchars($current_post['title']); ?> banner" class="blog-post-banner-image">
                <?php elseif (!empty($current_post['image_path'])): ?>
                     <p class="error-message"><small>Featured image not found at: <?php echo htmlspecialchars($current_post['image_path']); ?></small></p>
                <?php endif; ?>
                <div class="blog-post-body">
                    <?php echo nl2br($current_post['content']); // Display HTML content, converting newlines to <br> ?>
                </div>
                <div class="back-to-blog" style="padding-top: 25px;">
                    <a href="blog.php" class="btn btn-secondary">&laquo; Back to Blog List</a>
                </div>
            </article>
        <?php elseif ($post_slug && !$current_post && !$db_connection_error): // Post slug given but post not found, and no DB error ?>
             <header class="blog-listing-header">
                <h1>Post Not Found</h1>
                <p>Sorry, the blog post you are looking for does not exist or has been moved.</p>
                <div class="back-to-blog" style="margin-top: 2rem;">
                    <a href="blog.php" class="btn">Return to Blog</a>
                </div>
            </header>
        <?php else: // Blog listing page ?>
            <header class="blog-listing-header">
                <h1>Our Blog</h1>
                <p class="blog-subtitle">Insights and advice for professionals seeking balance and growth.</p>
            </header>
        
            <section class="blog-listing">
                <?php if (empty($all_posts) && !$db_connection_error): ?>
                    <p class="no-posts-message">No blog posts yet. Check back soon!</p>
                <?php elseif (!empty($all_posts)): ?>
                    <div class="blog-grid">
                        <?php foreach ($all_posts as $p): ?>
                            <div class="blog-post-card">
                                <?php
                                $thumbnail_path = 'images/placeholder_thumbnail.jpg';
                                if (!empty($p['image_path']) && file_exists($p['image_path'])) {
                                    $thumbnail_path = htmlspecialchars($p['image_path']);
                                } elseif (!empty($p['image_path'])) {
                                    $thumbnail_path = 'images/placeholder_image_not_found.jpg';
                                }
                                ?>
                                <img src="<?php echo $thumbnail_path; ?>" alt="<?php echo htmlspecialchars($p['title']); ?> thumbnail" class="blog-post-thumbnail">
        
                                <div class="blog-post-content">
                                    <h3><?php echo htmlspecialchars($p['title']); ?></h3>
                                    <p class="post-meta-listing">
                                        <time datetime="<?php echo date('Y-m-d', strtotime($p['created_at'])); ?>">
                                            <?php echo htmlspecialchars(date('F j, Y', strtotime($p['created_at']))); ?>
                                        </time>
                                    </p>
                                    <p class="blog-post-excerpt"><?php echo htmlspecialchars($p['excerpt']); ?></p>
                                    <a href="blog.php?post=<?php echo urlencode($p['slug']); ?>" class="btn btn-tertiary">Read More</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="back-to-home" style="text-align: center; margin-top: 3rem;">
                    <a href="index.php" class="btn btn-secondary">← Back to Homepage</a>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php include("footer.php"); ?>
    <script src="js/script.js"></script> <!-- General site scripts -->
</body>
</html>