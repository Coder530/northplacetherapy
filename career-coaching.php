<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Coaching - NorthPlace Therapy</title>
    <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Lato', sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { font-family: 'Playfair Display', serif; color: #2c5f7c; font-size: 2.5em; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 3px solid #2c5f7c; text-align: center; }
        p { margin-bottom: 15px; text-align: justify; }
        strong { color: #2c5f7c; font-weight: 700; }
        .section { margin-bottom: 40px; }
        .cta-buttons { display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap; }
        .btn { display: inline-block; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: 700; transition: all 0.3s ease; }
        .btn-primary { background-color: #2c5f7c; color: white; }
        .btn-primary:hover { background-color: #1e4257; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-secondary:hover { background-color: #545b62; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        @media (max-width: 768px) {
            h1 { font-size: 2em; }
            .container { padding: 20px 15px; }
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>
    <main>
        <div class="container">
            <h1>Career Coaching</h1>
            <div class="section">
                <p>Your career can play a central role in your sense of purpose, identity, and wellbeing. Yet, navigating career choices—whether changing jobs, aiming for promotion, switching fields, or managing workplace challenges—can feel stressful and uncertain.</p>
                <p>Career coaching in a therapeutic context provides a space to explore your strengths, values, and long-term goals. Together, we can clarify what you want from your career, identify obstacles that may be holding you back, and develop practical strategies to achieve your objectives. This process often involves reflecting on past experiences, understanding your motivations, and building confidence in your decision-making.</p>
                <p>Career coaching is not just about planning next steps—it's also about supporting your emotional wellbeing as you make changes. Anxiety, self-doubt, or fear of failure are common, and therapy can help you manage these feelings while taking proactive steps toward a fulfilling career.</p>
                <p>Whether you are seeking direction, growth, or transition, career coaching can help you move forward with clarity, confidence, and purpose.</p>
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