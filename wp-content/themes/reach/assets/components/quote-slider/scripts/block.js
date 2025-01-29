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

/***/ "./_src/components/quote-slider/scripts/block.js":
/*!*******************************************************!*\
  !*** ./_src/components/quote-slider/scripts/block.js ***!
  \*******************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* eslint-disable */\n\nwindow.addEventListener('DOMContentLoaded', () => {\n  const items = document.querySelectorAll('.quote-slider');\n  [...items].forEach(item => {\n    const ajaxurl = `${window.location.origin}/wp-admin/admin-ajax.php`;\n    const requestData = new URLSearchParams({\n      action: 'get_quotes'\n    });\n    fetch(ajaxurl, {\n      method: 'POST',\n      headers: {\n        'Content-Type': 'application/x-www-form-urlencoded'\n      },\n      body: requestData\n    }).then(response => response.json()).then(data => {\n      if (data && Array.isArray(data.data)) {\n        const reviews = data.data;\n        let currentIndex = 0;\n        const totalRating = reviews.reduce((sum, review) => sum + parseFloat(review.review.rating), 0);\n        const averageRating = (totalRating / reviews.length).toFixed(1);\n        const averageStarRating = '⭐'.repeat(Math.round(averageRating));\n        const updateQuoteSlider = () => {\n          const {\n            review\n          } = reviews[currentIndex];\n          const fullText = review.text;\n          const text = `${fullText.split('.')[0]}.`;\n          const name = review.author_name;\n          const {\n            rating\n          } = review;\n          const starRating = '⭐'.repeat(parseInt(rating));\n\n          // Use `item.querySelector()` instead of `document.querySelector()`\n          item.querySelector('.quote-slider__quote').classList.add('fade-out');\n          setTimeout(() => {\n            item.querySelector('.quote-slider__quote').classList.remove('fade-out');\n            item.querySelector('.quote-slider__text').innerHTML = `\"${text}\"`;\n            item.querySelector('.quote-slider__title').innerHTML = name;\n            item.querySelector('.quote-slider__rating').innerHTML = starRating;\n            currentIndex = (currentIndex + 1) % reviews.length;\n          }, 500);\n        };\n        updateQuoteSlider();\n        setInterval(updateQuoteSlider, 3000);\n\n        // Update the average rating inside each `.quote-slider`\n        item.querySelector('.quote-slider__review-average').innerHTML = averageRating + averageStarRating;\n      } else {\n        console.error('Invalid data structure:', data);\n      }\n    }).catch(error => {\n      console.error('Fetch Error:', error);\n    });\n  });\n});\n\n//# sourceURL=webpack://reach/./_src/components/quote-slider/scripts/block.js?");

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
/******/ 	__webpack_modules__["./_src/components/quote-slider/scripts/block.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;