/* eslint-disable */
import gsap from "gsap";

window.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.single-quote');

    // Set up the IntersectionObserver
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            const imageElement = entry.target.querySelector('.single-quote__image');

            // If the element is in view, animate it
            if (entry.isIntersecting) {
                if (imageElement) {
                    // Make sure the initial state is hidden and off-screen
                    imageElement.style.opacity = 0;
                    imageElement.style.transform = "translateY(50px)"; // Initial position

                    // Trigger animation once it enters the viewport
                    gsap.to(imageElement, {
                        opacity: 1,
                        y: 0, // Moves up to its normal place
                        duration: 1.5,
                        ease: "power2.inOut",
                        stagger: 0.1,
                    });
                }

                // Stop observing after the animation starts
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2, // Trigger when 50% of the element is in view
    });

    // Start observing each item
    items.forEach((item) => {
        observer.observe(item);
    });
});