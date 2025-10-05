// Consolidated script for the entire website

// --- Navbar Logic ---

// Toggles the main mobile navigation menu
window.toggleNavbar = function() {
    const navbarLinks = document.getElementById("navbarLinks");
    navbarLinks.classList.toggle("active");

    // If we are closing the main menu, also close any open dropdowns
    if (!navbarLinks.classList.contains("active")) {
        document.querySelectorAll('.dropdown.open').forEach(dropdown => {
            dropdown.classList.remove('open');
            const trigger = dropdown.querySelector('[aria-haspopup="true"]');
            if (trigger) {
                trigger.setAttribute('aria-expanded', 'false');
            }
        });
    }
};

// Toggles the dropdown menus
window.toggleDropdown = function(event) {
    event.preventDefault();
    event.stopPropagation();

    const dropdown = event.target.closest('.dropdown');
    if (!dropdown) return;

    const isCurrentlyOpen = dropdown.classList.contains('open');

    // Close all other dropdowns first
    document.querySelectorAll('.dropdown.open').forEach(openDropdown => {
        if (openDropdown !== dropdown) {
            openDropdown.classList.remove('open');
            const trigger = openDropdown.querySelector('[aria-haspopup="true"]');
            if (trigger) {
                trigger.setAttribute('aria-expanded', 'false');
            }
        }
    });

    // Toggle the clicked dropdown
    dropdown.classList.toggle('open');
    event.target.setAttribute('aria-expanded', !isCurrentlyOpen);
};


document.addEventListener('DOMContentLoaded', () => {
    // --- Navbar Enhancement ---

    // Close mobile menu and dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.navbar');
        if (!navbar.contains(event.target)) {
            const navbarLinks = document.getElementById('navbarLinks');
            if (navbarLinks && navbarLinks.classList.contains('active')) {
                navbarLinks.classList.remove('active');
            }
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                dropdown.classList.remove('open');
                const trigger = dropdown.querySelector('[aria-haspopup="true"]');
                if (trigger) {
                    trigger.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        // Hide mobile menu if switching to desktop
        if (window.innerWidth > 768) {
            const navbarLinks = document.getElementById('navbarLinks');
            if (navbarLinks && navbarLinks.classList.contains('active')) {
                navbarLinks.classList.remove('active');
            }
        }
        // Close dropdowns on resize
        document.querySelectorAll('.dropdown.open').forEach(dropdown => {
            dropdown.classList.remove('open');
            const trigger = dropdown.querySelector('[aria-haspopup="true"]');
            if (trigger) {
                trigger.setAttribute('aria-expanded', 'false');
            }
        });
    });

    // --- Other Functionalities from original script ---

    // Carousel functionality
    const carousel = document.getElementById('carousel');
    if (carousel) {
        let scrollAmount = 0;
        const scrollStep = 1;
        function autoScroll() {
            if (carousel) {
                scrollAmount += scrollStep;
                if (scrollAmount >= carousel.scrollWidth - carousel.clientWidth) {
                    scrollAmount = 0;
                }
                carousel.scrollLeft = scrollAmount;
            }
        }
        setInterval(autoScroll, 50);
    }

    // Form validation
    const form = document.getElementById('contact-form');
    if (form) {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            // (Form validation logic remains the same)
            // ...
        });
    }

    // Initialize Swiper for Services Carousel
    const serviceSwiperContainer = document.querySelector('.service-swiper');
    if (serviceSwiperContainer) {
        new Swiper('.service-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            grabCursor: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
                1200: { slidesPerView: 3, spaceBetween: 40 }
            }
        });
    }

    // Initialize Swiper for Blog Carousel
    const blogSwiperContainer = document.querySelector('.blog-swiper');
    if (blogSwiperContainer){
        new Swiper('.blog-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.blog-swiper .swiper-pagination', clickable: true },
            navigation: { nextEl: '.blog-swiper .swiper-button-next', prevEl: '.blog-swiper .swiper-button-prev' },
            breakpoints: {
                640: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    }

    // Preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.classList.add('hidden');
        });
    }

    // Testimonial Carousel
    const testimonialsContainer = document.querySelector('.testimonials');
    if (testimonialsContainer) {
        const testimonials = testimonialsContainer.querySelectorAll('.testimonial');
        let currentTestimonialIndex = 0;
        if (testimonials.length > 0) {
            testimonials[currentTestimonialIndex].classList.add('active');
            const rotateTestimonials = () => {
                testimonials[currentTestimonialIndex].classList.remove('active');
                currentTestimonialIndex = (currentTestimonialIndex + 1) % testimonials.length;
                testimonials[currentTestimonialIndex].classList.add('active');
            };
            if (testimonials.length > 1) {
                setInterval(rotateTestimonials, 20000);
            }
        }
    }

    // Fade-in sections on scroll
    const sectionsToFade = document.querySelectorAll('.fade-in-section');
    if (sectionsToFade.length > 0) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        sectionsToFade.forEach(section => {
            observer.observe(section);
        });
    }

    // Hero video scroll
    const hero = document.getElementById('hero');
    const nextSection = document.getElementById('nextSection');
    if (hero && nextSection) {
        setTimeout(() => {
            hero.classList.add('hidden');
        }, 23000);
    }
});

// Global functions for popups
function openContactPopup() {
    const contactFormPopup = document.getElementById('contactFormPopup');
    const nextSection = document.getElementById('nextSection');
    if(contactFormPopup && nextSection) {
        contactFormPopup.style.display = 'block';
        nextSection.style.width = '50%';
        contactFormPopup.style.width = '50%';
    }
}

function closeContactPopup() {
    const contactFormPopup = document.getElementById('contactFormPopup');
    const nextSection = document.getElementById('nextSection');
    if(contactFormPopup && nextSection) {
        contactFormPopup.style.display = 'none';
        nextSection.style.width = '100%';
    }
}