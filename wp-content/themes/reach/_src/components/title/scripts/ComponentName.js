export default class ComponentName {
    constructor(element) {
        this.el = element;

        this.init();
    }

    init() {
        console.log(this.el, 'init');
    }
}
