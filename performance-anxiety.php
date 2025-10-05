<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Anxiety - NorthPlace Therapy</title>
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
        .cta-buttons { display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap; }
        .btn { display: inline-block; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: 700; transition: all 0.3s ease; }
        .btn-primary { background-color: #2c5f7c; color: white; }
        .btn-primary:hover { background-color: #1e4257; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-secondary:hover { background-color: #545b62; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
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
            <h1>Performance Anxiety</h1>
            <div class="section">
                <p>Performance anxiety can affect anyone, whether in professional, academic, or personal contexts. It often involves feelings of intense worry, fear of failure, or self-doubt before or during situations where you are being evaluated or observed.</p>
            </div>
            <div class="section">
                <h2>Understanding Performance Anxiety</h2>
                <p>Performance anxiety is usually linked to a combination of factors, including past experiences, personality traits, and the pressure you place on yourself to succeed. Physical symptoms—such as a racing heart, sweating, shaking, or difficulty concentrating—can amplify the sense of worry, making it harder to perform at your best.</p>
            </div>
            <div class="section">
                <h2>How Therapy Can Help</h2>
                <p>Therapy provides a safe space to explore and understand the causes of your anxiety. Approaches may include:</p>
                <ul>
                    <li>Identifying and challenging negative self-talk and unrealistic expectations.</li>
                    <li>Developing practical strategies to manage anxiety in high-pressure situations.</li>
                    <li>Practising relaxation and grounding techniques to reduce physical symptoms.</li>
                    <li>Building confidence through preparation, rehearsal, and mindset shifts.</li>
                </ul>
                <p>Whether you experience anxiety in public speaking, exams, sports, or other performance situations, therapy can help you manage your nerves and perform with greater ease and confidence.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Contact NorthPlace today</a>
                    <a href="index.php#issues" class="btn btn-secondary">Back to Issues</a>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
    <script src="js/script.js"></script>
</body>
</html>