// navbar.js

document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle the main navigation menu (hamburger icon)
    window.toggleNavbar = function() {
        var navbarLinks = document.getElementById("navbarLinks");
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

    // Function to toggle dropdown menus on click for mobile
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

    // Enhanced click outside handling for mobile
    document.addEventListener('click', function(event) {
        const navbarLinks = document.getElementById('navbarLinks');
        const hamburgerIcon = document.querySelector('.navbar .icon');
        
        // Close dropdowns when clicking outside
        if (!event.target.closest('.dropdown')) {
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
                !hamburgerIcon.contains(event.target)) {
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

    if (navbarLinks) {
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

    // Add touch event handling for better mobile experience
    document.addEventListener('touchstart', function(event) {
        // This helps with iOS Safari touch handling
        // The click event will still fire after touchstart
    });
});