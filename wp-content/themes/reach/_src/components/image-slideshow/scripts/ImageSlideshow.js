export default class ImageSlideshow {
    constructor(element) {
        this.el = element;
        this.slides = this.el.querySelectorAll('.image-slideshow__slide');
        this.controls = this.el.querySelectorAll('.image-slideshow__controls__indicator');
        this.transitionTime = this.el.dataset.transitiontime;
        this.index = 0;
        this.max = this.slides.length - 1;
        this.interval = null;

        this.init();
    }

    init() {
        this.processLoop();
        this.interval = setInterval(() => this.processLoop(), this.transitionTime);
        this.controls.forEach((control) => {
            control.addEventListener('click', () => {
                clearInterval(this.interval);
                this.index = parseInt(control.dataset.index, 10);
                this.processLoop();
                this.interval = setInterval(() => this.processLoop(), this.transitionTime);
            });
        });
    }

    processLoop() {
        // Loop through slides and set active
        this.slides.forEach((slide) => {
            if (parseInt(slide.dataset.index, 10) !== this.index) {
                slide.classList.remove('active');
            } else {
                slide.classList.add('active');
            }
        });
        // Loop through controls and set active
        this.controls.forEach((control) => {
            if (parseInt(control.dataset.index, 10) !== this.index) {
                control.classList.remove('active');
            } else {
                control.classList.add('active');
            }
        });
        this.index = this.index + 1 > this.max ? 0 : this.index + 1;
    }
}
