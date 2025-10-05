<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Therapist for Professionals</title>
  <link rel="icon" type="image/x-icon" href="/images/favicon/favicon.ico">
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php
    include("navbar.php");
    ?>

    <header class="hero">
      <video autoplay muted loop playsinline class="hero-video">
        <source src="images/NorthPlace.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Professional Therapy for Busy Lives</h1>
        <p>Confidential, flexible, tailored to you.</p>
        <a href="#contact" class="btn">Book a Consultation</a>
      </div>
    </header>
    <section class="about">
        <h1>Nick Perkins</h1>
        <h2>About Me</h2>
        <img src="your-photo.jpg" alt="Therapist Portrait" class="profile-photo">
        <p>
            I'm a licensed therapist specializing in supporting working professionals. My approach is empathetic, practical, and confidential.
        </p>
    </section>

    <section class="services">
      <h2>Services</h2>
      <div class="service-cards" id="carousel">
        <div class="card">
          <h3>Stress & Anxiety</h3>
          <p>Learn tools to manage and reduce stress in your demanding career.</p>
        </div>
        <div class="card">
          <h3>Career Counseling</h3>
          <p>Navigate transitions, burnout, or career goals with clarity and support.</p>
        </div>
        <div class="card">
          <h3>Relationship Therapy</h3>
          <p>Strengthen communication and connection in personal relationships.</p>
        </div>
      </div>
    </section>


    <section class="testimonials">
        <h2>What Clients Say</h2>
        <div class="testimonial">
          <blockquote>"I finally feel understood and supported in managing work stress."</blockquote>
          <cite>— Anonymous Client</cite>
        </div>
        <div class="testimonial">
          <blockquote>"Practical, empathetic, and highly professional. Highly recommend."</blockquote>
          <cite>— Anonymous Client</cite>
        </div>
    </section>

    <section id="contact" class="contact">
        <h2>Contact Me</h2>
        <p id="success-message" class="success-message" style="display:none;">
          Thank you! We'll be in touch soon.
        </p>
        <form id="contact-form">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required>
        
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="5" required></textarea>
        
          <button type="submit">Send Message</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 NorthPlace Therapy. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
