/* eslint-disable */
import MegaMenu from './MegaMenu.js';

window.addEventListener('DOMContentLoaded', () => {
    const element = document.querySelector('.megamenu');
   
    new MegaMenu(element);




    if (!element) {
        console.log('❌ Megamenu not found');
        return;
    }

    element.addEventListener('mouseenter', function () {
        console.log('Mouse entered menu');

        setTimeout(() => { // Delay to ensure .active is added
            const megs = document.querySelector('.megamenu .megamenu-child.active');
            console.log('Checking for active element:', megs);

            const wpadminbar = document.querySelector('#wpadminbar');

            if (megs && wpadminbar) {
                megs.style.top = '187px';
                console.log('✅ Style applied: top = 187px');
            } else {
                console.log('❌ No active element found yet');
            }
        }, 50); // Slight delay to allow class to be added
    });

    element.addEventListener('mouseleave', function () {
        const megs = document.querySelector('.megamenu .megamenu-child.active');

        if (megs) {
            megs.style.top = ''; // Reset
            console.log('🔄 Reset top style');
        }
    });

});
