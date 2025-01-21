import ImageSlideshow from './ImageSlideshow.js';

window.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.image-slideshow');

    [...items].forEach((item) => {
        new ImageSlideshow(item);
    });
});
