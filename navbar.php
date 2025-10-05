<?php
// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="css/navbar.css" />

<nav class="navbar">
  <div class="navbar-logo">
    <a href="index.php" class="home-link">
        <img src="images/NPlogosimple.png" alt="Your Logo" style="border-radius: 25%;" />
    </a>
  </div>
  <a href="javascript:void(0);" class="icon" onclick="toggleNavbar()" aria-label="Toggle navigation menu">
    &#9776;
  </a>
  <ul class="navbar-links" id="navbarLinks">
    <li><strong><a href="index.php">Home</a></strong></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="faq.php">FAQ</a></li>
    <li><a href="resources.php">Resources</a></li>
    <li class="dropdown">
      <a href="#" onclick="toggleDropdown(event)" aria-haspopup="true" aria-expanded="false">Issues ▾</a>
      <ul class="dropdown-content" role="menu">
        <li><a href="anxiety.php" role="menuitem">Anxiety (including GAD)</a></li>
        <li><a href="depression.php" role="menuitem">Depression & Low Mood</a></li>
        <li><a href="stress.php" role="menuitem">Stress Management</a></li>
        <li><a href="trauma.php" role="menuitem">Trauma & PTSD</a></li>
        <li><a href="ocd.php" role="menuitem">Obsessive-Compulsive Disorder (OCD)</a></li>
        <li><a href="phobias.php" role="menuitem">Phobias</a></li>
        <li><a href="hoarding.php" role="menuitem">Hoarding</a></li>
        <li><a href="addiction.php" role="menuitem">Addictions</a></li>
        <li><a href="berevement.php" role="menuitem">Berevement & Loss</a></li>
        <li><a href="life-decisions.php" role="menuitem">Making Major Life Decisions</a></li>
        <li><a href="career-coaching.php" role="menuitem">Career Coaching</a></li>
        <li><a href="executive-leadership.php" role="menuitem">Executive Leadership Challenges</a></li>
        <li><a href="relationships.php" role="menuitem">Relationship Issues (Personal & Professional)</a></li>
        <li><a href="bullying.php" role="menuitem">Bullying</a></li>
        <li><a href="domestic-abuse.php" role="menuitem">Domestic Abuse / Violence</a></li>
        <li><a href="boarding-school.php" role="menuitem">Boarding School Syndrome</a></li>
        <li><a href="confidence.php" role="menuitem">Confidence & Self-Esteem</a></li>
        <li><a href="performance-anxiety.php" role="menuitem">Performance Anxiety</a></li>
        <li><a href="public-speaking.php" role="menuitem">Public Speaking Difficulties</a></li>
        <li><a href="social-anxiety.php" role="menuitem">Social Anxiety</a></li>
        <li><a href="sports-psychology.php" role="menuitem">Sports Psychology</a></li>
        <li><a href="motivation.php" role="menuitem">Motivation and Goal Achievement</a></li>
        
        <li><a href="life-fulfilment.php" role="menuitem">Seeking Fulfillment in Life</a></li>
        <li><a href="blog.php" role="menuitem">Blog</a></li>
      </ul>
    </li>
    <li><a class="btn-appointment" href="contact.php" style="background-color: #4C6E81 !important; color: #FFFFFF !important;">Contact Me</a></li>
  </ul>
</nav>

<script src="js/script.js"></script>
