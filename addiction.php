<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addictions - NorthPlace Therapy</title>
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
        h3 { font-family: 'Playfair Display', serif; color: #2c5f7c; font-size: 1.4em; margin: 25px 0 15px 0; }
        p { margin-bottom: 15px; text-align: justify; }
        strong { color: #2c5f7c; font-weight: 700; }
        ul { margin: 15px 0 15px 30px; list-style-type: disc; }
        li { margin-bottom: 10px; }
        .section { margin-bottom: 40px; }
        hr { border: none; height: 2px; background: linear-gradient(to right, #2c5f7c, transparent); margin: 40px 0; }
        .cta-buttons { display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap; }
        .btn { display: inline-block; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: 700; transition: all 0.3s ease; }
        .btn-primary { background-color: #2c5f7c; color: white; }
        .btn-primary:hover { background-color: #1e4257; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-secondary:hover { background-color: #545b62; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        @media (max-width: 768px) {
            h1 { font-size: 2em; }
            h2 { font-size: 1.5em; }
            h3 { font-size: 1.3em; }
            .container { padding: 20px 15px; }
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>
    <main>
        <div class="container">
            <h1>Addictions - Psychotherapy</h1>
            <div class="section">
                <p>Addictions can develop in many areas of life. Common examples include alcohol, drugs, nicotine, gambling, social media and technology, sex, self-harm, food, and exercise. Addiction is characterised by a compulsive engagement in rewarding behaviors or substances, even when they lead to negative consequences.</p>
                <p>Working with addiction is a highly individual process, as many different factors contribute to it. Therapy may focus on developing new ways of thinking to help manage impulses and reduce the urge to engage in the addictive behavior. It can also provide a safe space to explore difficult emotions and life situations that reinforce the habit, and to build practical strategies for coping.</p>
                <p>Group therapy or structured support programmes, such as NA or AA, can also be very helpful. These programmes offer guidance, routine, and peer support, which many people find essential when starting a new life free from active addiction.</p>
                <p>Addiction can take an enormous emotional and financial toll on both individuals and their families. Seeking help is vital, and if you are struggling with an addiction, reaching out to someone is the first and most important step.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Contact NorthPlace today</a>
                    <a href="index.php#issues" class="btn btn-secondary">Back to Issues</a>
                </div>
            </div>
            <hr>
            <div class="section">
                <h2>Addictions</h2>
                <p>Addiction is a condition where a person becomes dependent on a substance, activity, or behavior, despite negative consequences. Common addictions include alcohol, drugs, gambling, gaming, shopping, and even certain patterns of work or eating. Addiction can affect anyone, regardless of age, background, or circumstances.</p>
                <p>Addiction often develops as a way to cope with stress, emotional pain, or difficult life situations. Over time, the substance or behavior can take on a central role in a person's life, impacting relationships, work, and physical or mental health. People struggling with addiction may feel trapped, ashamed, or unable to stop, even when they want to.</p>
                <p>The good news is that help is available. Therapy can support recovery by:</p>
                <ul>
                    <li>Exploring the underlying causes of the addiction.</li>
                    <li>Developing strategies to manage cravings and triggers.</li>
                    <li>Building healthier coping mechanisms for stress and emotional challenges.</li>
                    <li>Restoring a sense of control, purpose, and wellbeing.</li>
                </ul>
                <p>Addiction often requires a combination of support, including therapy, peer groups, and sometimes medical interventions. Recovery is possible, and it's important to remember that seeking help is a sign of strength, not weakness.</p>
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