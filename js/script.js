// Consolidated script for the entire website

// Needs to be a global function because it's called by onclick attribute in navbar.php
window.toggleNavbar = function() {
    const navbarLinks = document.getElementById("navbarLinks");
    if (navbarLinks.classList.contains("active")) {
        navbarLinks.classList.remove("active");
        // Close all dropdowns when navbar is closed
        document.querySelectorAll('.dropdown.open').forEach(dropdown => {
            dropdown.classList.remove('open');
            const dropdownLink = dropdown.querySelector('a[aria-haspopup="true"]');
            if (dropdownLink) {
                dropdownLink.setAttribute('aria-expanded', 'false');
            }
        });
    } else {
        navbarLinks.classList.add("active");
    }
};

// Needs to be a global function because it's called by onclick attribute in navbar.php
window.toggleDropdown = function(event) {
    event.preventDefault(); // Prevent the default link behavior
    event.stopPropagation(); // Stop event from bubbling up

    const dropdown = event.target.closest('.dropdown');
    if (!dropdown) return;

    const isCurrentlyOpen = dropdown.classList.contains('open');
    const dropdownLink = dropdown.querySelector('a[aria-haspopup="true"]');

    // Close any currently open dropdowns, unless it's the one being clicked
    document.querySelectorAll('.dropdown.open').forEach(openDropdown => {
        if (openDropdown !== dropdown) {
            openDropdown.classList.remove('open');
            const otherLink = openDropdown.querySelector('a[aria-haspopup="true"]');
            if (otherLink) {
                otherLink.setAttribute('aria-expanded', 'false');
            }
        }
    });

    // Toggle the 'open' class on the clicked dropdown
    if (isCurrentlyOpen) {
        dropdown.classList.remove('open');
        if (dropdownLink) {
            dropdownLink.setAttribute('aria-expanded', 'false');
        }
    } else {
        dropdown.classList.add('open');
        if (dropdownLink) {
            dropdownLink.setAttribute('aria-expanded', 'true');
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    // --- Navbar Enhancement ---

    // Enhanced click outside handling for mobile
    document.addEventListener('click', function(event) {
        const navbarLinks = document.getElementById('navbarLinks');
        const hamburgerIcon = document.querySelector('.navbar .icon');

        // Close dropdowns when clicking outside
        if (navbarLinks && !event.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                dropdown.classList.remove('open');
                const dropdownLink = dropdown.querySelector('a[aria-haspopup="true"]');
                if (dropdownLink) {
                    dropdownLink.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // Close mobile menu when clicking outside
        if (navbarLinks && navbarLinks.classList.contains('active')) {
            if (!navbarLinks.contains(event.target) &&
                hamburgerIcon && !hamburgerIcon.contains(event.target)) {
                navbarLinks.classList.remove('active');
                // Also close all dropdowns
                document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                    dropdown.classList.remove('open');
                    const dropdownLink = dropdown.querySelector('a[aria-haspopup="true"]');
                    if (dropdownLink) {
                        dropdownLink.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        }
    });

    // Close dropdowns when the navbar itself is toggled closed
    const navbarLinks = document.getElementById('navbarLinks');
    if (navbarLinks) {
        const observer = new MutationObserver(function(mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (!navbarLinks.classList.contains('active')) {
                        // If navbar is no longer active (i.e., closed on mobile), close all dropdowns
                        document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                            dropdown.classList.remove('open');
                            const dropdownLink = dropdown.querySelector('a[aria-haspopup="true"]');
                            if (dropdownLink) {
                                dropdownLink.setAttribute('aria-expanded', 'false');
                            }
                        });
                    }
                }
            }
        });
        observer.observe(navbarLinks, { attributes: true });
    }

    // Handle window resize to close mobile menu if switching to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            const navbarLinks = document.getElementById('navbarLinks');
            if (navbarLinks) {
                navbarLinks.classList.remove('active');
            }
            // Close all dropdowns when switching to desktop
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                dropdown.classList.remove('open');
                const dropdownLink = dropdown.querySelector('a[aria-haspopup="true"]');
                if (dropdownLink) {
                    dropdownLink.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });

    // --- Other Functionalities ---

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

            // Clear previous error messages
            document.getElementById('dob-error').style.display = 'none';
            document.getElementById('appointment-date-error').style.display = 'none';

            const firstName = form.first_name.value.trim();
            const lastName = form.last_name.value.trim();
            const email = form.email.value.trim();
            const phone = form.phone.value.trim();
            const dobString = form.dob.value;
            const appointmentDateString = form.appointment_date.value;

            if (!firstName || !lastName || !email || !phone || !dobString || !appointmentDateString) {
                // Handled by 'required' attribute
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                isValid = false;
            }

            const phonePattern = /^[+\d\s]{7,}$/;
            if (phone && !phonePattern.test(phone.replace(/\s/g, ''))) {
                alert('Please enter a valid phone number (at least 7 digits).');
                isValid = false;
            }

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

            if (appointmentDateString) {
                const appointmentDate = new Date(appointmentDateString);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                appointmentDate.setHours(0,0,0,0);

                if (appointmentDate < today) {
                    document.getElementById('appointment-date-error').style.display = 'block';
                    isValid = false;
                }
            }

            if (!isValid) {
                event.preventDefault();
            }
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
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
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
            nextSection.classList.remove('hidden');
            nextSection.style.opacity = 0;
            nextSection.style.transform = 'translateY(30px) scale(0.95)';
            requestAnimationFrame(() => {
                nextSection.style.transition = 'opacity 1.2s ease, transform 1.2s ease';
                nextSection.style.opacity = 1;
                nextSection.style.transform = 'translateY(0) scale(1)';
            });
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