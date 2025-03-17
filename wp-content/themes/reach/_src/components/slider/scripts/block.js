/* eslint-disable  */
import Swiper from 'swiper';
import { Navigation, Scrollbar } from 'swiper/modules';

window.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll('.slider__inner');

    sliders.forEach((slider, index) => {
        const swiper = new Swiper(slider.querySelector('.cards-slider'), {
            direction: 'horizontal',
            modules: [Navigation],
            autoHeight: true,
            loop: false,
            slidesPerView: 3.1,
            spaceBetween: 30,

            navigation: {
                nextEl: slider.querySelector('.right-nav'),
                prevEl: slider.querySelector('.left-nav'),
            },

            scrollbar: {
                el: slider.querySelector('.swiper-scrollbar'),
                draggable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1.1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2.1,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3.1,
                    spaceBetween: 30,
                },
            },
        });
    });
});