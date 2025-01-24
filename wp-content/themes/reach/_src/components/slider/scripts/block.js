import Swiper from 'swiper';
import { Navigation, Scrollbar } from 'swiper/modules';

window.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.slider__inner');
    [...items].forEach(() => {
        new Swiper('.cards-slider', {
            direction: 'horizontal',
            modules: [Navigation, Scrollbar],
            autoHeight: true,
            slidesPerView: 3.1,
            spaceBetween: 30,

            navigation: {
                nextEl: '.right-nav',
                prevEl: '.left-nav',
            },

            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
            },

            breakpoints: {
                0: {
                    slidesPerView: 1.1,
                },
                812: {
                    slidesPerView: 2.1,
                },
                1550: {
                    slidesPerView: 3.1,
                },
            },
        });
    });
});
