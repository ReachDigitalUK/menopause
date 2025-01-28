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

/***/ "./_src/components/product-details/scripts/block.js":
/*!**********************************************************!*\
  !*** ./_src/components/product-details/scripts/block.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* eslint-disable */\ndocument.addEventListener('DOMContentLoaded', function () {\n  let link = document.querySelectorAll('.info-modal');\n  if (link) {\n    for (let i = 0; i < link.length; i++) {\n      link[i].addEventListener('click', function (e) {\n        // Prevent the default action if it's a link\n        e.preventDefault();\n        let name = link[i].getAttribute('data-name');\n        let description = link[i].getAttribute('data-description');\n        let modal = document.createElement('dialog');\n        modal.classList.add('modal');\n        modal.innerHTML = `\n                    <div class=\"modal-content\">\n                        <div class=\"modal-header\">\n                            <h2>` + name + `</h2>\n                        </div>\n                        <div class=\"modal-body\">\n                            <p>` + description + `</p>\n                        </div>\n                        <div class=\"modal-footer\">\n                            <button class=\"close\">Close</button>\n                        </div>\n                    </div>\n                `;\n        document.body.appendChild(modal);\n        modal.showModal();\n\n        // Attach event listener to the close button inside the modal\n        let closeButton = modal.querySelector('.close');\n        closeButton.addEventListener('click', function () {\n          modal.close();\n          modal.remove(); // Optionally, remove the modal from the DOM after closing\n        });\n      });\n    }\n  }\n});\n\n//# sourceURL=webpack://reach/./_src/components/product-details/scripts/block.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
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
/******/ 	__webpack_modules__["./_src/components/product-details/scripts/block.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;