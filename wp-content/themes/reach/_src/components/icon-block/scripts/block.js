/* eslint-disable */
import gsap from "gsap";

window.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.icon-block__icon');

    const observerOptions = {
        root: null, // Observe relative to the viewport
        rootMargin: "0px",
        threshold: 0.2 // Trigger when 20% of the element is visible
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const item = entry.target;
                const index = Array.from(items).indexOf(item);


                if (index === 0) {
                    gsap.set(item, { opacity: 0, x: -100 });
                    gsap.to(item, {
                        opacity: 1,
                        x: 0,
                        duration: 3,
                        ease: "power2.out"
                    });
                }

                if (index === 1) {
                    gsap.set(item, { opacity: 0, y: 100 });
                    gsap.to(item, {
                        opacity: 1,
                        y: 0,
                        duration: 2,
                        ease: "power2.out"
                    });
                }

                if (index === 2) {
                    gsap.set(item, { opacity: 0, x: 100 });
                    gsap.to(item, {
                        opacity: 1,
                        x: 0,
                        duration: 2,
                        ease: "power2.out"
                    });
                }

                observer.unobserve(item); // Stop observing once animated
            }
        });
    }, observerOptions);

    items.forEach((item) => {
        observer.observe(item);
    });
});