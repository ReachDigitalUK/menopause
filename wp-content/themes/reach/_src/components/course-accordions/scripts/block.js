import CourseAccordions from './course-accordions.js';

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
});
