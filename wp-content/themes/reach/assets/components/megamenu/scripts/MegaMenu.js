/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./_src/components/megamenu/scripts/MegaMenu.js":
/*!******************************************************!*\
  !*** ./_src/components/megamenu/scripts/MegaMenu.js ***!
  \******************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (/* binding */ MegaMenu)\n/* harmony export */ });\n/* eslint-disable  */\nclass MegaMenu {\n  constructor(element) {\n    this.el = element;\n    this.rootHtml = document.querySelector('html');\n    this.body = document.querySelector('body');\n    this.siteHeader = document.querySelector('.site-header');\n    this.topLevelEls = this.el.querySelectorAll('.megamenu__inner__toplevel__item > .megamenu-child__child__header-wrap > a[data-child]');\n    this.dropdowns = this.el.querySelectorAll('.megamenu__inner__toplevel__item > .megamenu-child');\n    this.burger = document.querySelector('.site-header__burger');\n    this.mobile = this.el.querySelector('.megamenu__mobile');\n    this.toggles = this.el.querySelectorAll('.megamenu-child__child__header__toggle');\n    this.has = this.el.querySelectorAll('.has-children');\n    this.init();\n  }\n  init() {\n    this.topLevelEls.forEach(el => {\n      el.addEventListener('mouseenter', event => {\n        if (event.target.dataset.child) {\n          const dropdown = this.el.querySelector(`.${event.target.dataset.child}`);\n          const parentHasChildren = event.target.closest('.has-children'); // Find the closest .has-children parent\n\n          // Deactivate all dropdowns and .has-children\n          this.dropdowns.forEach(dropdownEl => {\n            dropdownEl.classList.remove('active');\n          });\n          this.has.forEach(hasEl => {\n            hasEl.classList.remove('active');\n          });\n\n          // Activate the hovered dropdown and its parent .has-children\n          dropdown.classList.add('active');\n          this.siteHeader.classList.add('megamenu-open');\n          if (parentHasChildren) {\n            parentHasChildren.classList.add('active');\n          }\n        }\n      });\n    });\n    this.dropdowns.forEach(el => {\n      el.addEventListener('mouseleave', event => {\n        event.target.classList.remove('active');\n        this.siteHeader.classList.remove('megamenu-open');\n\n        // Remove 'active' from the related .has-children\n        const parentHasChildren = event.target.closest('.has-children');\n        if (parentHasChildren) {\n          parentHasChildren.classList.remove('active');\n        }\n      });\n    });\n    this.burger.addEventListener('click', () => {\n      this.siteHeader.classList.toggle('active');\n      this.body.classList.toggle('menu-open');\n      this.rootHtml.classList.toggle('menu-open');\n    });\n    this.toggles.forEach(el => {\n      el.addEventListener('click', event => {\n        event.target.parentNode.classList.toggle('active');\n      });\n    });\n  }\n}\n\n//# sourceURL=webpack://reach/./_src/components/megamenu/scripts/MegaMenu.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./_src/components/megamenu/scripts/MegaMenu.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;