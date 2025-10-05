<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Psychotherapy, Coaching, and Counselling - NorthPlace Therapy</title>
    <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Lato', sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { font-family: 'Playfair Display', serif; color: #2c5f7c; font-size: 2.5em; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 3px solid #2c5f7c; text-align: center; }
        h2 { font-family: 'Playfair Display', serif; color: #2c5f7c; font-size: 1.8em; margin: 30px 0 20px 0; }
        p { margin-bottom: 15px; text-align: justify; }
        strong { color: #2c5f7c; font-weight: 700; }
        ul { margin: 15px 0 15px 30px; list-style-type: disc; }
        li { margin-bottom: 10px; }
        .section { margin-bottom: 40px; }
        .highlight-box { background-color: #e8f4f8; padding: 20px; border-radius: 5px; margin: 20px 0; }
        .contact-info { background-color: #f8f9fa; padding: 20px; border-left: 4px solid #2c5f7c; margin: 30px 0; }
        .contact-info p { text-align: left; }
        a { color: #2c5f7c; text-decoration: none; font-weight: 600; }
        a:hover { text-decoration: underline; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #2c5f7c; }
        input[type="text"],
        input[type="email"],
        textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Lato', sans-serif; font-size: 1em; }
        textarea { min-height: 150px; resize: vertical; }
        .required { color: #d9534f; }
        .btn { display: inline-block; padding: 12px 30px; background-color: #2c5f7c; color: white; border: none; border-radius: 5px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; }
        .btn:hover { background-color: #1e4257; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .recaptcha-notice { font-size: 0.9em; color: #666; margin-top: 10px; text-align: left; }
        @media (max-width: 768px) {
            h1 { font-size: 2em; }
            h2 { font-size: 1.5em; }
            .container { padding: 20px 15px; }
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>
    <main>
        <div class="container">
            <h1>Online Psychotherapy, Coaching, and Counselling</h1>
            
            <div class="section">
                <p>Online therapy can be a convenient option if you'd like to work with me but find distance or scheduling a challenge. It's also a great way to access support if you live in an area with limited local options. Online therapy is highly effective, and I encourage you to consider whether it might be a good fit for you.</p>
                <p>Because it differs slightly from meeting face-to-face (especially at the start), I've outlined a few things below that you may find helpful.</p>
            </div>

            <div class="section">
                <h2>Things to Consider</h2>
                <p>Online therapy can be just as effective as in-person sessions, though the experience is not always identical. For example, certain types of counselling may be more challenging to conduct over video. Also, natural pauses or silences that feel comfortable in person can sometimes feel different on a screen.</p>
                <p>We can discuss these points further during your consultation. If possible, I recommend meeting once or twice in person before moving fully online—but this is not essential. If you're unsure whether online therapy is right for you, my advice is to give it a try and see how it feels.</p>
            </div>

            <div class="section">
                <h2>Available Platforms</h2>
                <ul>
                    <li><strong>WhatsApp Video</strong> – preferred option</li>
                    <li><strong>Microsoft Teams</strong> – available</li>
                    <li><strong>Zoom</strong> – available</li>
                </ul>
            </div>

            <div class="highlight-box">
                <h2>Who Calls Who?</h2>
                <p>I do not initiate online sessions - so you would need to call me at appointment time. This ensures consistency, clarity about who begins each session, and allows you to feel fully in control of when we start (without any sense of being "chased").</p>
            </div>

            <div class="section">
                <h2>Contact NorthPlace</h2>
                
                <?php
                session_start();
                if (isset($_SESSION['contact_success'])) {
                    echo '<p class="success-message" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">' . htmlspecialchars($_SESSION['contact_success']) . '</p>';
                    unset($_SESSION['contact_success']);
                }
                if (isset($_SESSION['contact_error'])) {
                    echo '<p class="error-message" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">' . htmlspecialchars($_SESSION['contact_error']) . '</p>';
                    unset($_SESSION['contact_error']);
                }
                ?>
                
                <p>Please fill in the form below:</p>
                
                <form action="process-online-contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name<span class="required">*</span></label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email<span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message (online enquiry)<span class="required">*</span></label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Send</button>
                    
                    <p class="recaptcha-notice">This site is protected by reCAPTCHA, and the Google <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</p>
                </form>
            </div>

            <div class="contact-info">
                <p><strong>NorthPlace Therapy</strong><br>
                5 Bisham Court, Bisham, Marlow, SL7 1SD, United Kingdom</p>
                <p>📧 Email: <a href="mailto:nick@northplacetherapy.com">nick@northplacetherapy.com</a><br>
                📱 Text / WhatsApp: 07570 790423</p>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
    <script src="js/script.js"></script>
</body>
</html>