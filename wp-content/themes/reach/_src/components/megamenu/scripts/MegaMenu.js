/* eslint-disable  */
export default class MegaMenu {
    constructor(element) {
        this.el = element;
        this.rootHtml = document.querySelector('html');
        this.body = document.querySelector('body');
        this.siteHeader = document.querySelector('.site-header');
        this.topLevelEls = this.el.querySelectorAll(
            '.megamenu__inner__toplevel__item > .megamenu-child__child__header-wrap > a[data-child]'
        );
        this.dropdowns = this.el.querySelectorAll('.megamenu__inner__toplevel__item > .megamenu-child');
        this.burger = document.querySelector('.site-header__burger');
        this.mobile = this.el.querySelector('.megamenu__mobile');
        this.toggles = this.el.querySelectorAll('.megamenu-child__child__header__toggle');
        this.has = this.el.querySelectorAll('.has-children');

        this.init();
    }

    init() {
        this.topLevelEls.forEach((el) => {
            el.addEventListener('mouseenter', (event) => {
                if (event.target.dataset.child) {
                    const dropdown = this.el.querySelector(`.${event.target.dataset.child}`);
                    const parentHasChildren = event.target.closest('.has-children'); // Find the closest .has-children parent

                    // Deactivate all dropdowns and .has-children
                    this.dropdowns.forEach((dropdownEl) => {
                        dropdownEl.classList.remove('active');
                    });
                    this.has.forEach((hasEl) => {
                        hasEl.classList.remove('active');
                    });

                    // Activate the hovered dropdown and its parent .has-children
                    dropdown.classList.add('active');
                    this.siteHeader.classList.add('megamenu-open');
                    if (parentHasChildren) {
                        parentHasChildren.classList.add('active');
                    }
                }
            });
        });

        this.dropdowns.forEach((el) => {
            el.addEventListener('mouseleave', (event) => {
                event.target.classList.remove('active');
                this.siteHeader.classList.remove('megamenu-open');

                // Remove 'active' from the related .has-children
                const parentHasChildren = event.target.closest('.has-children');
                if (parentHasChildren) {
                    parentHasChildren.classList.remove('active');
                }
            });
        });

        this.burger.addEventListener('click', () => {
            this.siteHeader.classList.toggle('active');
            this.body.classList.toggle('menu-open');
            this.rootHtml.classList.toggle('menu-open');
        });

        this.toggles.forEach((el) => {
            el.addEventListener('click', (event) => {
                event.target.parentNode.classList.toggle('active');
            });
        });
    }
}
