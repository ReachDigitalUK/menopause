/* eslint-disable */

import CourseAccordions from './course-accordions.js';
import gsap from "gsap";

window.addEventListener('DOMContentLoaded', () => {
    let items;

    if (document.querySelector('.course-accordions__sections__section')) {
        items = document.querySelectorAll('.course-accordions__sections__section');
    } else {
        items = document.querySelectorAll('.course-accordions__accordion__section');
    }

    [...items].forEach((item) => {
        new CourseAccordions(item);
    });

    const items2 = document.querySelectorAll('.course-accordions__sections');

    // Set initial hidden styles before observation
    items2.forEach((item) => {
        item.style.opacity = "0";
        item.style.transform = "translateY(50px)"; // Start below
    });

    // Set up the IntersectionObserver
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const imageElement = entry.target; // Use target directly

                gsap.to(imageElement, {
                    opacity: 1,
                    y: 0, // Move to normal position
                    duration: 1,
                    ease: "power2.inOut",
                    stagger: 0.1,
                });

                observer.unobserve(entry.target); // Stop observing
            }
        });
    }, {
        threshold: 0.5, // 50% of the element must be visible
    });

    // Start observing each item
    items2.forEach((item) => {
        observer.observe(item);
    });
});