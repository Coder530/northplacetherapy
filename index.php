<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Therapist for Professionals</title>
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="css/style.css" />
  <!-- Swiper.js CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body>
    <?php
    // Ensure session is started for form messages, ideally at the very top of scripts that might use sessions.
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include("navbar.php");
    ?>

    <header class="hero" id="hero">
      <video autoplay muted loop playsinline class="hero-video">
        <source src="images/northplacebg.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>NorthPlace Therapy</h1>
        <p>Confidential, flexible, tailored to you.</p>
        <a href="contact.php" class="btn" style="size: 15px;">CONTACT ME</a>
      </div>
    </header>


    <section id="nextSection" class="flip-wrapper">
      <div class="flip-inner" id="flipInner">

        <!-- Front (original content) -->
        <div class="flip-face front">
          <!-- Keep your original front section content here -->
          <h1>NorthPlace Therapy</h1>
          <h3>PSYCHOTHERAPY – COACHING – COUNSELLING</h3>
          <p><em>Marlow & Bisham</em>, and <em>Online</em></p>
          <p>Helping you gain clarity, confidence, and control.</p>
          <button class="btn" id="contact-me-btn-hero">CONTACT ME</button>
        </div>

        <style>
          /* Making Buttons Shimmery */
          #contact-me-btn-hero {
            background: linear-gradient(135deg, var(--compass-blue), var(--slate-blue));
            color: var(--white);
            border: none;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-family: var(--font-family-body);
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.02em;
            margin-top: 0.5rem;
            position: relative;
            overflow: hidden;
          }

          #contact-me-btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
          }

          #contact-me-btn-hero:hover::before {
            left: 100%;
          }

          #contact-me-btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(var(--rgb-accent-primary), 0.3);
          }
        </style>
      </div>
    </section>


    <div class="services-highlight" style="text-align:center; padding:2rem 1rem;"><h2>PSYCHOTHERAPY-COACHING-COUNSELLING</h2></div>

    <section class="fade-in-section">
        <div class="grid-container">
            <div class="text-container">
                <h2>Nick Perkins</h2>
                <h3>Psychotherapist –Coach -Counsellor </h3>
                <p><i>BSc (Hons), J.D. (Juris Doctor), PGDip Integrative Counselling & Coaching (Dist.), MBACP</i></p>
                <p>
                    Based in <b>Marlow & Bisham</b>, I work with clients across <b>Berkshire, Buckinghamshire, and surrounding areas</b>, and offer <b>online</b> therapy to clients throughout the UK and internationally.<br><br>

                    My work is grounded in a <b>Personal Consultancy</b> approach — a professional and confidential service that integrates <b>psychotherapy, coaching, and counselling</b>: a flexible, integrated model that adapts to your individual needs. Whether you’re facing emotional challenges, navigating life transitions, or seeking clarity and direction, this approach meets you where you are. My training spans both in-depth psychological work and practical, goal-oriented strategies.<br><br>

                    Clinically, my approach is <b>Integrative</b>, drawing on a range of modalities — including <b>CBT, ACT, Person-Centred Therapy, Existential, Psychodynamic, and Transactional Analysis</b> — while also incorporating <b>Coaching</b> techniques. This enables me to support clients in making deep, lasting change, while also helping them move forward in focused, practical ways that build on their strengths.<br><br>

                    This combined approach empowers clients to realise their full potential. It helps make the most of the therapy process — one that is often challenging and courageous, as it involves confronting fears and working through some of life’s most difficult experiences.<br><br>

                    I lived in New York City for over twenty years and have firsthand experience of managing life in high-pressure environments. My interest lies in helping people fulfil their potential and navigate difficult times, and I know from my own experience how valuable therapy and coaching can be. I’m registered with the British Association for Counselling and Psychotherapy (BACP).<br><br>
                </p>
            </div>
            <div class="image-container">
                <img src="images/nick_perkins.jpg" alt="Nick Perkins">
            </div>
        </div>
    </section>

    <section class="fade-in-section">
        <div class="grid-container">
            <div class="image-container">
                <img src="images/forest.jpg" alt="Forest">
            </div>
            <div class="text-container">
                <h2>Working Together</h2>
                <p>
                  Life brings its share of challenges and demands. Most of the time, we respond to them effectively, but there are moments when we feel disconnected from ourselves and unable to access the inner resources we’ve relied on before.<br><br>

                  Therapy can support you if you want to:<br>

                  <ul>
                    <li>feel less weighed down by anxiety or depression</li>
                    <li>manage overwhelming emotions with more ease</li>
                    <li>move beyond past abuse or trauma</li>
                    <li>let go of self-doubt, guilt, or shame</li>
                    <li>build healthier, more fulfilling relationships</li>
                    <li>make sense of your past and life experiences</li>
                    <li>feel clearer and more confident when facing tough decisions</li>
                    <li>navigate life or career changes and perform at your best</li>
                    <li>live with greater passion, confidence, and contentment</li>
                    <li>break free from anything that holds you back</li>
                  </ul><br>

                  I offer a confidential, non-judgmental space to explore your situation and deepen your understanding of it. Some people come to therapy with clear goals; others arrive feeling overwhelmed or as a last resort. Some feel stuck in old patterns — and that’s okay too. Therapy can still help.<br>

                  Our work together may open new perspectives and insights, fostering a deeper awareness of how you think, feel, and behave. I provide support and, when appropriate, gentle challenge to help you step beyond your comfort zone and move towards where you want to be.
                </p>
            </div>
        </div>
    </section>

    <section class="fade-in-section">
        <div class="grid-container">
            <div class="text-container">
                <h2>Meeting</h2>
                <p>5 Bisham Court, Marlow & Bisham, SL7 1SD</p>
                <p>
                  Reaching out for help can sometimes feel uncomfortable, but it is an important act of self-care — an investment in yourself and the first step forward. <br>

                  A consultation offers us the opportunity to talk and decide if we’re a good fit to work together. I’ll do my best to answer any questions you may have. If I believe someone else might better meet your needs or has specialist expertise that could help, I will be honest about that. <br>

                  <b><h3>Marlow & Bisham</h3></b>

                  My office is located at 5 Bisham Court, SL7 1SD — a short, flat 10–15-minute walk from Marlow Bridge and the High Street. As a therapist in Marlow & Bisham, I’m committed to offering high-quality, affordable therapy. My practice is easily accessible from surrounding areas including Maidenhead, Henley, Windsor, High Wycombe, Bourne End, and the Cookhams. I offer weekday, early morning, and some evening and weekend appointments. <br>

                  <b><h3>Online Therapy</h3></b><br>

                  I also offer therapy to clients throughout the UK and internationally. More details can be found <a href="online.php">here.</a><br>

                  <i>Email</i>: <a href="mailto:nick@northplacetherapy.com">nick@northplacetherapy.com</a> - <i>Text/Whatsapp</i>: <i><a href="tel:+4407507790423">+44 (0) 7507 790423</a><i>
                </p>
            </div>
            <div class="image-container">
                <img src="images/officeimage.jpg" alt="Office Image">
            </div>
        </div>
    </section>

    <br><br><br><br>
    
    <section class="fade-in-section" id="issues">
        <div class="grid-container">
            <div class="text-container">
                <h2>Issues</h2>
                I support clients with a broad range of concerns, including: 

                Emotional & Mental Health 
                
                <ul>
                    <a href="anxiety.php"><li>Anxiety (GAD) </li></a>
                    <a href="depression.php"><li>Depression and low mood </li></a>
                    <a href="stress.php"><li>Stress management </li></a>
                    <a href="trauma.php"><li>Trauma and PTSD </li></a>
                    <a href="ocd.php"><li>OCD (Obsessive-Compulsive Disorder) </li></a>
                    <a href="phobias.php"><li>Phobias </li></a>
                    <a href="hoarding.php"><li>Hoarding </li></a>
                    <a href="addiction.php"><li>Addictions </li></a>
                </ul>    
                    
                Life Transitions & Challenges
                
                <ul>
                    <a href="bereavement.php"><li>Bereavement and loss </li></a>
                    <a href="life-decisions.php"><li>Making major life decisions </li></a>
                    <a href="career.php"><li>Career coaching </li></a>
                    <a href="executive-leadership.php"><li>Executive leadership challenges </li></a>
                </ul>
                
                
                Relationships & Social Wellbeing 
                
                <ul>
                    <a href="relationships.php"><li>Relationship issues, both personal and professional </li></a>
                    <a href="bullying.php"><li>Bullying </li></a>
                    <a href="boarding-school.php"><li>Boarding school syndrome </li></a>
                </ul>
                
                
                Performance & Personal Growth 
                
                <ul>
                    <a href="confidence.php"><li>Confidence and self-esteem </li></a>
                    <a href="performance-anxiety.php"><li>Performance anxiety </li></a>
                    <a href="public-speaking.php"><li>Public speaking difficulties </li></a>
                    <a href="sports-psychology.php"><li>Sports psychology </li></a>
                    <a href="life-fulfilment.php"><li>Seeking deeper enjoyment and fulfillment in life </li></a>
                </ul>
                </p>
            </div>
            <div class="image-container">
                <img src="images/issuesimage.jpg" alt="Issues Image">
            </div>
        </div>
    </section>
    
    <br><br>

    <!-- Therapy Information Section -->
    <section class="therapy-info fade-in-section">
      <div class="container">
        <h2 class="section-title">THERAPY INFORMATION</h2>
        <div class="info-grid">
          <!-- Psychotherapy and Counselling Column -->
          <div class="info-column">
            <h3 class="info-title">Psychotherapy and Counselling</h3>
            <p class="info-text">
              The terms <em>counselling</em> and <em>psychotherapy</em> are often used interchangeably, but there are some distinctions. Counselling typically refers to a process where clients explore a specific problem or situation. Psychotherapy tends to focus more deeply on the client’s inner world, emotions, and long-term patterns.
            </p>
          </div>
          <!-- What is Coaching Column -->
          <div class="info-column">
            <h3 class="info-title">What is Coaching?</h3>
            <p class="info-text">
              If counselling and psychotherapy are seen as ‘reparative’—helping to heal and understand past or present difficulties—then coaching is more ‘generative.’ It’s about developing yourself to your fullest potential: setting goals, creating strategies, and taking action to achieve them. Often, coaching works best when combined with the foundational insights gained through counselling/psychotherapy.
            </p>
          </div>
          <!-- Integrative Approach Column -->
          <div class="info-column">
            <h3 class="info-title">Integrative Approach</h3>
            <p class="info-text">
              An integrative approach draws from multiple therapy modalities. It reflects the belief that no single psychological theory has all the answers. Instead, it embraces different ways to explore and understand problems, using techniques from various therapies to help clients.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Fees Section -->
    <section class="fees fade-in-section">
      <div class="container">
        <h2 class="section-title">FEES (2025)</h2>
        <div class="fees-grid">
          <!-- Left Side - Psychotherapy, Coaching, Counselling -->
          <div class="fees-box fees-box-left">
            <div class="fees-overlay-wood"></div>
            <div class="fees-deco-orchid-1"></div>
            <div class="fees-deco-orchid-2"></div>
            <div class="fees-content">
              <h3>Psychotherapy, Coaching, Counselling</h3>
              <div>
                <h4>Personal Consultancy (50 minutes per session)</h4>
                <ul>
                  <li>• Individuals: £85</li>
                  <li>• Couples: £115</li>
                </ul>
                <b>
                    <p>
                        Packages (pre-paid blocks) are available.<br><br>
                        This reflects my belief that offering effective therapy should remain accessible without compromising professionalism or care.
                    </p>
                </b>
              </div>
            </div>
          </div>
          <!-- Right Side - Clinical Supervision -->
          <div class="fees-box fees-box-right">
            <div class="fees-deco-circle-1"></div>
            <div class="fees-deco-circle-2"></div>
            <div class="fees-deco-circle-3"></div>
            <div class="fees-content">
              <div>
                  <p>
                      Based in Marlow & Bisham, I offer a balance of integrative counselling and coaching in a warm, confidential environment — all at a competitive rate that respects your investment in wellbeing.
                  </p>
                  <b>
                      <p>
                          Your wellbeing is worth the investment — and I'm here to support you every step of the way.
                      </p>
                  </b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="services fade-in-section">
        <h2>NorthPlace Services</h2>
        <!-- Swiper -->
        <div class="swiper-container service-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide card">
              <h3>Stress & Anxiety</h3>
              <p>Learn tools to manage and reduce stress in your demanding career.</p>
            </div>
            <div class="swiper-slide card">
              <h3>Career Counselling</h3>
              <p>Navigate transitions, burnout, or career goals with clarity and support.</p>
            </div>
            <div class="swiper-slide card">
              <h3>Relationship Therapy</h3>
              <p>Strengthen communication and connection in personal relationships.</p>
            </div>
            <div class="swiper-slide card">
              <h3>Online Sessions</h3>
              <p>Flexible, secure video therapy for busy professionals on the go.</p>
            </div>
            <!-- Add more services as needed here -->
            <div class="swiper-slide card">
              <h3>Depression Support</h3>
              <p>Guidance and therapy for understanding and managing depression.</p>
            </div>
            <div class="swiper-slide card">
              <h3>Confidence Building</h3>
              <p>Develop self-esteem and assertiveness for personal and professional growth.</p>
            </div>
          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination"></div>
          <!-- Add Navigation -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
    </section>


    <section class="testimonials fade-in-section">
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


    <!-- Location Section with Google Maps -->
    <section class="location-map fade-in-section" style="padding: 4rem 2rem; background: #f8f9fa;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">

          <!-- Location Details -->
          <div class="location-details">
            <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; color: #333; font-weight: 400;">NorthPlace Location</h3>
            <div style="margin-bottom: 2rem;">
              <p style="font-size: 1.1rem; margin-bottom: 0.5rem; color: #555; font-weight: 500;">5 Bisham Court, Bisham, Marlow, SL7 1SD</p>
              <p style="font-size: 1.1rem; margin-bottom: 0.5rem; color: #555;">Marlow & Bisham, Buckinghamshire</p>
              <p style="font-size: 1.1rem; margin-bottom: 1.5rem; color: #555;">SL7 3EE, United Kingdom</p>
            </div>

            <div style="margin-bottom: 2rem;">
              <h4 style="font-size: 1.2rem; margin-bottom: 1rem; color: #333;">Contact Information</h4>
              <p style="margin-bottom: 0.5rem; color: #666;">
                <strong>Email:</strong> <a href="mailto:nick@northplacetherapy.com" style="color: #8B4513; text-decoration: none;">nick@northplacetherapy.com</a>
              </p>
              <p style="margin-bottom: 1rem; color: #666;">
                <strong>Text/WhatsApp:</strong> <a href="tel:+4407507790423" style="color: #8B4513; text-decoration: none;">+44 (0) 7507 790423</a>
              </p>
            </div>

            <div>
              <h4 style="font-size: 1.2rem; margin-bottom: 1rem; color: #333;">Getting Here</h4>
              <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                My office is located at 5 Bisham Court, SL7 1SD — a short, flat 10–15-minute walk from Marlow Bridge and the High Street. My practice is easily accessible from surrounding areas including Maidenhead, Henley, Windsor, High Wycombe, Bourne End, and the Cookhams. I offer weekday, early morning, and some evening and weekend appointments. <br>
              </p>
              <p style="color: #666; line-height: 1.6;">
                Limited parking is available nearby. Please allow extra time for parking during busy periods.
              </p>
            </div>
          </div>

          <!-- Google Maps Embed -->
          <div class="map-container" style="position: relative; height: 400px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2486.8234567890!2d-0.7741234567890123!3d51.5582345678901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487679abcdef1234%3A0xabcdef1234567890!2s5%20Bisham%20Court%2C%20Bisham%2C%20Marlow%20SL7%201SD%2C%20UK!5e0!3m2!1sen!2suk!4v1693123456789!5m2!1sen!2suk"
              width="100%"
              height="400"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Location - 5 Bisham Court, Bisham, Marlow">
            </iframe>

            <!-- Fallback for when maps don't load -->
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #666; display: none;" id="map-fallback">
              <p>Map unable to load</p>
              <a href="https://www.google.com/maps/place/5+Bisham+Ct,+Bisham,+Marlow+SL7+1SD/" target="_blank" style="color: #8B4513; text-decoration: none;">
                View on Google Maps →
              </a>
            </div>
          </div>

        </div>

        <!-- Additional Map Link for Mobile -->
        <div style="text-align: center; margin-top: 2rem;">
          <a href="https://www.google.com/maps/place/5+Bisham+Ct,+Bisham,+Marlow+SL7+1SD/"
             target="_blank"
             style="display: inline-block; padding: 12px 24px; background: #8B4513; color: white; text-decoration: none; border-radius: 5px; font-weight: 500; transition: background-color 0.3s ease;">
            Open in Google Maps
          </a>
        </div>

      </div>
    </section>
    
    <div class="commitment-section">
        <h2>NorthPlace Commitment to You – Ethical Practice</h2> <br>
        <p>Work is conducted in accordance with the BACP Ethical Framework for Good Practice (here). In line with BACP requirements, I work under the guidance of a supervisor to discuss clinical work. Confidentiality is always maintained, and your identity will not be disclosed. </p><br>
    
        I also undertake regular professional training to ensure my approach is informed by the latest research and to develop additional areas of specialism, so that I can provide the best possible support to my clients. <br>
        
        Privacy Policy <br><br>
        For full details, please click <a href="privacy-policy.php">here</a>.
    </div>

    <!-- Responsive Styles for Location Section -->
    <style>
    @media (max-width: 768px) {
      .location-map .container > div:first-of-type {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
      }

      .map-container {
        height: 300px !important;
        margin-bottom: 1rem;
      }

      .location-details {
        order: 2;
      }
    }

    /* Map error handling */
    .map-container iframe {
      transition: opacity 0.3s ease;
    }

    .map-container iframe:not([src]) + #map-fallback {
      display: block !important;
    }


    /* Flip container setup */
    .flip-wrapper {
      perspective: 1000px;
      width: 100%;
      height: auto;
      min-height: 80vh;
      margin: 0 auto;
      position: relative;
      overflow: hidden;
    }

    .flip-inner {
      transition: transform 0.8s ease-in-out;
      transform-style: preserve-3d;
      width: 100%;
      height: 100%;
      position: relative;
    }

    .flip-wrapper.flipped .flip-inner {
      transform: rotateY(180deg);
    }

    .flip-face {
      backface-visibility: hidden;
      position: absolute;
      top: 0;
      left: 0;
      padding: 40px 5%;
      box-sizing: border-box;
      width: 100%;
      min-height: 100%;
      background: white;
    }

    .front {
      z-index: 2;
    }

    .back {
      transform: rotateY(180deg);
    }

    /* Contact form adjustments for fullscreen feel */
    .contact-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
      max-width: 900px;
      margin: 0 auto;
      padding-top: 20px;
    }
    .contact-form input,
    .contact-form textarea {
      padding: 16px;
      font-size: 18px;
      border-radius: 10px;
      border: 1px solid #ccc;
      width: 100%;
    }
    .contact-form textarea {
      resize: vertical;
      min-height: 120px;
    }
    .contact-form h2 {
      font-size: 32px;
      margin-bottom: 10px;
    }
    .form-buttons {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .contact-form button {
      padding: 14px 28px;
      font-size: 16px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      color: white;
    }
    .contact-form button[type="submit"] {
      background-color: #2e7d32;
    }
    .contact-form button[type="submit"]:hover {
      background-color: #1b5e20;
    }
    #backBtn {
      background-color: #b71c1c;
    }
    #backBtn:hover {
      background-color: #c62828;
    }

    </style>

    <script>
    // Handle map loading errors
    document.addEventListener('DOMContentLoaded', function() {
      const iframe = document.querySelector('.map-container iframe');
      const fallback = document.getElementById('map-fallback');

      iframe.addEventListener('error', function() {
        iframe.style.display = 'none';
        fallback.style.display = 'block';
      });
    });



    const contactBtn = document.getElementById("contactBtn");
    const backBtn = document.getElementById("backBtn");
    const flipWrapper = document.getElementById("nextSection");

    contactBtn.addEventListener("click", () => {
        flipWrapper.classList.add("flipped");
    });

    backBtn.addEventListener("click", () => {
        flipWrapper.classList.remove("flipped");
    });

    </script>

    <?php
    include("footer.php");
    ?>

    <!-- Swiper.js JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
