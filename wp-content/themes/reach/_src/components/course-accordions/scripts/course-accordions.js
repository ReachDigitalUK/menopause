export default class CourseAccordions {
    constructor(element) {
        this.el = element;

        this.init();
    }

    init() {
        this.el.children[0].addEventListener('click', () => {
            this.el.classList.toggle('active');
        });
    }
}
