document.addEventListener('DOMContentLoaded', () => {
  // Navbar toggle
  const navbarLinks = document.getElementById('navbarLinks');
  // The toggleNavbar function will be called by the onclick attribute in navbar.php
  // Ensure it's globally accessible or refactor to use event listeners here.

  // Dropdown toggle for mobile
  const dropdowns = document.querySelectorAll('.navbar .dropdown');

  dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('a'); // The main dropdown link
    link.addEventListener('click', function(event) {
      // Prevent link navigation for the main dropdown link on mobile if it has a submenu
      if (window.innerWidth <= 768 && dropdown.querySelector('.dropdown-content')) {
        event.preventDefault();
        // Toggle 'open' class on the parent .dropdown element
        dropdown.classList.toggle('open');
        
        // Optional: Close other open dropdowns
        dropdowns.forEach(otherDropdown => {
          if (otherDropdown !== dropdown) {
            otherDropdown.classList.remove('open');
          }
        });
      }
    });
  });

  // Carousel functionality (existing code)
  const carousel = document.getElementById('carousel'); // Make sure an element with ID 'carousel' exists
  if (carousel) {
    let scrollAmount = 0;
    const scrollStep = 1;

    function autoScroll() {
      if (carousel) { // Check if carousel still exists
        scrollAmount += scrollStep;
        if (scrollAmount >= carousel.scrollWidth - carousel.clientWidth) {
          scrollAmount = 0;
        }
        carousel.scrollLeft = scrollAmount;
      }
    }
    // Only set interval if carousel exists
    setInterval(autoScroll, 50); // Adjusted interval for smoother/slower scroll
  }

  // Success message handling for form (will be used later)
  const form = document.getElementById('contact-form');
  const successMessage = document.getElementById('success-message'); // For later use with PHP response

  if (form) {
    form.addEventListener('submit', function(event) {
      let isValid = true;

      // Clear previous error messages
      document.getElementById('dob-error').style.display = 'none';
      document.getElementById('appointment-date-error').style.display = 'none';
      // You can add more specific error message elements for other fields if desired

      // --- Field retrieval ---
      const firstName = form.first_name.value.trim();
      const lastName = form.last_name.value.trim();
      const email = form.email.value.trim();
      const phone = form.phone.value.trim();
      const dobString = form.dob.value;
      const appointmentDateString = form.appointment_date.value;

      // --- Basic required field check (HTML 'required' attribute already handles this, but good for JS fallback) ---
      if (!firstName || !lastName || !email || !phone || !dobString || !appointmentDateString) {
        // This alert is a fallback; 'required' attribute is primary for this.
        // alert('Please fill in all required fields.');
        // isValid = false; 
      }

      // --- Email validation (basic) ---
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email && !emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        isValid = false;
      }

      // --- Phone validation (very basic: checks for at least 7 digits, allows + and spaces) ---
      const phonePattern = /^[+\d\s]{7,}$/; // Allows plus, digits, spaces, min 7 chars
      if (phone && !phonePattern.test(phone.replace(/\s/g, ''))) { // Remove spaces for digit count check
          alert('Please enter a valid phone number (at least 7 digits).');
          isValid = false;
      }
      
      // --- Date of Birth (DOB) validation: Must be 18+ ---
      if (dobString) {
        const dob = new Date(dobString);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
          age--;
        }
        if (age < 18) {
          document.getElementById('dob-error').style.display = 'block';
          isValid = false;
        }
      }

      // --- Appointment Date validation: Cannot be in the past ---
      if (appointmentDateString) {
        const appointmentDate = new Date(appointmentDateString);
        const today = new Date();
        // Set hours to 0 to compare dates only, not time
        today.setHours(0, 0, 0, 0); 
        appointmentDate.setHours(0,0,0,0); // Also normalize appointment date if it includes time

        if (appointmentDate < today) {
          document.getElementById('appointment-date-error').style.display = 'block';
          isValid = false;
        }
      }

      if (!isValid) {
        event.preventDefault(); // Prevent form submission if validation fails
      } else {
        // If using AJAX, you would handle submission here.
        // For direct PHP submission, this 'else' block might not be strictly necessary
        // unless you want to show a loading spinner or similar.
        // The successMessage display will be handled by PHP redirecting or AJAX response.
      }
    });
  }
});

// Needs to be a global function because it's called by onclick attribute
function toggleNavbar() {
  const navbarLinks = document.getElementById('navbarLinks');
  if (navbarLinks) {
    navbarLinks.classList.toggle('active');
  }
}

// Initialize Swiper for Services Carousel
document.addEventListener('DOMContentLoaded', () => {
  // Only initialize Swiper if the container exists
  const serviceSwiperContainer = document.querySelector('.service-swiper');
  if (serviceSwiperContainer) {
    const serviceSwiper = new Swiper('.service-swiper', {
      // Optional parameters
      loop: true,
      slidesPerView: 1, // Default for mobile
      spaceBetween: 30, // Space between slides
      grabCursor: true,
      
      autoplay: {
        delay: 4000, // Delay between transitions (in ms)
        disableOnInteraction: false, // Autoplay will not be disabled after user interactions (swipes)
      },

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      // Responsive breakpoints
      breakpoints: {
        // when window width is >= 640px
        640: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        // when window width is >= 768px (tablet)
        768: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        // when window width is >= 1024px (desktop)
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        },
        // when window width is >= 1200px
        1200: {
            slidesPerView: 3, // Or 4 if cards are narrower
            spaceBetween: 40
        }
      }
    });
  }
  // ... other DOMContentLoaded code from previous steps ...

  // Fade-in sections on scroll
  // Preloader functionality
  const preloader = document.getElementById('preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      // Add 'hidden' class that triggers CSS fade-out transition
      preloader.classList.add('hidden');
      // Optional: completely remove from DOM after transition
      // setTimeout(() => {
      //   preloader.style.display = 'none';
      // }, 500); // Match CSS transition duration
    });
  }

  // Testimonial Carousel
  const testimonialsContainer = document.querySelector('.testimonials'); // Assuming this is the section container
  if (testimonialsContainer) {
    const testimonials = testimonialsContainer.querySelectorAll('.testimonial');
    let currentTestimonialIndex = 0;
    const testimonialTime = 20000; // 20 seconds

    if (testimonials.length > 0) {
      // Initially show the first testimonial
      testimonials[currentTestimonialIndex].classList.add('active');
      // testimonials[currentTestimonialIndex].style.display = 'block'; // Already handled by .active
      // requestAnimationFrame(() => { // Ensure display:block is applied before opacity transition
      //   testimonials[currentTestimonialIndex].style.opacity = 1;
      // });


      const rotateTestimonials = () => {
        // Fade out current testimonial
        testimonials[currentTestimonialIndex].classList.remove('active');
        // testimonials[currentTestimonialIndex].style.opacity = 0;

        // After fade out transition, change to next testimonial
        // setTimeout(() => { // This timeout should match CSS transition duration
          // testimonials[currentTestimonialIndex].style.display = 'none';

          currentTestimonialIndex = (currentTestimonialIndex + 1) % testimonials.length;

          // Fade in next testimonial
          testimonials[currentTestimonialIndex].classList.add('active');
          // testimonials[currentTestimonialIndex].style.display = 'block';
          // requestAnimationFrame(() => {
          //   testimonials[currentTestimonialIndex].style.opacity = 1;
          // });
        // }, 750); // Must match opacity transition time (0.75s)
      };

      if (testimonials.length > 1) { // Only rotate if there's more than one
        setInterval(rotateTestimonials, testimonialTime);
      }
    }
  }

  const sectionsToFade = document.querySelectorAll('.fade-in-section');
  if (sectionsToFade.length > 0) {
    const observerOptions = {
      root: null, // relative to document viewport
      rootMargin: '0px',
      threshold: 0.1 //
    };

    const observerCallback = (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target); // Stop observing once visible
        }
      });
    };

    const intersectionObserver = new IntersectionObserver(observerCallback, observerOptions);
    sectionsToFade.forEach(section => {
      intersectionObserver.observe(section);
    });
  }
});

const blogSwiper = new Swiper('.blog-swiper', {
  slidesPerView: 1,
  spaceBetween: 20,
  loop: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.blog-swiper .swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.blog-swiper .swiper-button-next',
    prevEl: '.blog-swiper .swiper-button-prev',
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    }
  }
});

//scrolls through hero video after 23 seconds
setTimeout(() => {
  const hero = document.getElementById('hero');
  const nextSection = document.getElementById('nextSection');

  hero.classList.add('hidden');
  
  // Show nextSection and remove any hidden class if present
  nextSection.classList.remove('hidden');

  // Optional: initially hide nextSection opacity for smooth entry
  nextSection.style.opacity = 0;
  nextSection.style.transform = 'translateY(30px) scale(0.95)';

  // Trigger reflow and then animate to visible state
  requestAnimationFrame(() => {
    nextSection.style.transition = 'opacity 1.2s ease, transform 1.2s ease';
    nextSection.style.opacity = 1;
    nextSection.style.transform = 'translateY(0) scale(1)';
  });
}, 23000);

function openContactPopup() {
  document.getElementById('contactFormPopup').style.display = 'block';
  document.getElementById('nextSection').style.width = '50%';
  document.getElementById('contactFormPopup').style.width = '50%';
}

function closeContactPopup() {
  document.getElementById('contactFormPopup').style.display = 'none';
  document.getElementById('nextSection').style.width = '100%';
}
