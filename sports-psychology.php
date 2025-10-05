<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Psychology - NorthPlace Therapy</title>
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
            <h1>Sports Psychology</h1>
            <div class="section">
                <p>Sports psychology focuses on the mental and emotional aspects of athletic performance, helping athletes of all levels achieve their potential while maintaining balance and wellbeing.</p>
            </div>
            <div class="section">
                <h2>Why Mental Training Matters</h2>
                <p>Athletic performance is influenced not only by physical skill and fitness but also by mindset, focus, and emotional regulation. Pressure, fear of failure, self-doubt, and performance anxiety can affect even the most talented athletes. Sports psychology addresses these mental challenges to improve consistency, confidence, and enjoyment of the sport.</p>
            </div>
            <div class="section">
                <h2>How Therapy and Coaching Can Help</h2>
                <p>Support in sports psychology may include:</p>
                <ul>
                    <li>Developing concentration, focus, and mental resilience under pressure.</li>
                    <li>Managing performance anxiety, stress, and pre-competition nerves.</li>
                    <li>Building confidence and a positive mindset to enhance performance.</li>
                    <li>Improving motivation, goal-setting, and commitment.</li>
                    <li>Coping with injury, recovery, and setbacks.</li>
                    <li>Maintaining a healthy balance between sport, personal life, and mental wellbeing.</li>
                </ul>
                <p>Therapy provides a space to explore the psychological factors influencing performance, while coaching techniques can translate insights into practical strategies on and off the field.</p>
                <p>Whether you are a professional athlete, amateur competitor, or someone seeking to improve mental fitness for sport, sports psychology can support your growth and help you perform at your best.</p>
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