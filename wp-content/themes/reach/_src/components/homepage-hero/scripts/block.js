/* eslint-disable */

import gsap from "gsap";

window.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.homepage-hero');

    items.forEach((item) => {
        const textElement = item.querySelector('.homepage-hero__text');
        const quoteSlider = document.querySelector('.quote-slider'); // Select .quote-slider

        // Animate homepage-hero__text (Start lower and move up)
        if (textElement) {
            gsap.set(textElement, { opacity: 0, y: 50 }); // Start lower
            gsap.to(textElement, {
                opacity: 1,
                y: 0, // Moves up to its normal place
                duration: 1, // Increase duration
                ease: "power2.inOut" // Smooth in and out easing
            });
        }

        // Animate quote-slider (Start offscreen to the right and slide in)
        if (quoteSlider) {
            // Set initial state: Start offscreen to the right and hidden
            gsap.set(quoteSlider, { opacity: 0, x: 50 });

            // Animate: Slide in with slower fade-in
            gsap.to(quoteSlider, {
                x: 0,              // Slide to its final position
                duration: 2,       // Slide-in duration (2 seconds)
                ease: "elastic.out(1, 0.5)", // Elastic easing for bouncy feel
                delay: 1           // Delay the animation by 1 second
            });

            // Separate fade-in animation with slower duration
            gsap.to(quoteSlider, {
                opacity: 1,        // Fade in
                duration: 1.5,       // Fade-in duration (4 seconds for slower fade)
                delay: 1,          // Delay fade-in to match the slide-in timing
                ease: "power2.out" // Smooth easing for fade-in
            });
        }
    });
});