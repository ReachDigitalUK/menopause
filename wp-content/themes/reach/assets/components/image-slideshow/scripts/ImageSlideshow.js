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

/***/ "./_src/components/image-slideshow/scripts/ImageSlideshow.js":
/*!*******************************************************************!*\
  !*** ./_src/components/image-slideshow/scripts/ImageSlideshow.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (/* binding */ ImageSlideshow)\n/* harmony export */ });\nclass ImageSlideshow {\n  constructor(element) {\n    this.el = element;\n    this.slides = this.el.querySelectorAll('.image-slideshow__slide');\n    this.controls = this.el.querySelectorAll('.image-slideshow__controls__indicator');\n    this.transitionTime = this.el.dataset.transitiontime;\n    this.index = 0;\n    this.max = this.slides.length - 1;\n    this.interval = null;\n    this.init();\n  }\n  init() {\n    this.processLoop();\n    this.interval = setInterval(() => this.processLoop(), this.transitionTime);\n    this.controls.forEach(control => {\n      control.addEventListener('click', () => {\n        clearInterval(this.interval);\n        this.index = parseInt(control.dataset.index, 10);\n        this.processLoop();\n        this.interval = setInterval(() => this.processLoop(), this.transitionTime);\n      });\n    });\n  }\n  processLoop() {\n    // Loop through slides and set active\n    this.slides.forEach(slide => {\n      if (parseInt(slide.dataset.index, 10) !== this.index) {\n        slide.classList.remove('active');\n      } else {\n        slide.classList.add('active');\n      }\n    });\n    // Loop through controls and set active\n    this.controls.forEach(control => {\n      if (parseInt(control.dataset.index, 10) !== this.index) {\n        control.classList.remove('active');\n      } else {\n        control.classList.add('active');\n      }\n    });\n    this.index = this.index + 1 > this.max ? 0 : this.index + 1;\n  }\n}\n\n//# sourceURL=webpack://reach/./_src/components/image-slideshow/scripts/ImageSlideshow.js?");

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
/******/ 	__webpack_modules__["./_src/components/image-slideshow/scripts/ImageSlideshow.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;