/* eslint-disable  */
import Swiper from 'swiper';
import { Navigation, Scrollbar } from 'swiper/modules';

window.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll('.slider__inner');

    sliders.forEach((slider, index) => {
        const swiper = new Swiper(slider.querySelector('.cards-slider'), {
            direction: 'horizontal',
            modules: [Navigation, Scrollbar],
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: false,
            roundLengths: true,
            speed: 600,
            loop: false,

            navigation: {
                nextEl: slider.querySelector('.right-nav'),
                prevEl: slider.querySelector('.left-nav'),
            },

            scrollbar: {
                el: slider.querySelector('.swiper-scrollbar'),
                draggable: true,
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                812: {
                    slidesPerView: 2.1,
                },
                1550: {
                    slidesPerView: 3.1,
                },
            },

            freeMode: false,
            slidesPerGroup: 1,
        });
    });
});