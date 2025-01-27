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

eval("__webpack_require__.r(__webpack_exports__);\n/* eslint-disable */\nconst ajaxurl = `${window.location.origin}/wp-admin/admin-ajax.php`;\nconst requestData = new URLSearchParams({\n  action: 'get_quotes' // Ensure this matches the action name in your PHP code\n});\n\nfetch(ajaxurl, {\n  method: 'POST',\n  headers: {\n    'Content-Type': 'application/x-www-form-urlencoded'\n  },\n  body: requestData\n}).then(response => response.json()).then(data => {\n  // Log the data to ensure it's being returned correctly\n  console.log('Data:', data);\n\n  // Check if data contains a `data` property and that it's an array\n  if (data && Array.isArray(data.data)) {\n    const reviews = data.data; // Extract the reviews array\n    let currentIndex = 0; // Start with the first review\n\n    // Calculate average rating\n    const totalRating = reviews.reduce((sum, review) => sum + parseFloat(review.review.rating), 0);\n    const averageRating = (totalRating / reviews.length).toFixed(1); // Rounded to 1 decimal place\n\n    // Create star representation of average rating\n    const averageStarRating = '⭐'.repeat(Math.round(averageRating));\n\n    // Log the average rating and stars for debugging\n    console.log('Average Rating:', averageRating);\n    console.log('Average Star Rating:', averageStarRating);\n\n    // Function to update the quote slider content\n    const updateQuoteSlider = () => {\n      const review = reviews[currentIndex].review; // Get the current review\n      const fullText = review.text;\n      const text = fullText.split('.')[0] + '.'; // Get text up to the first full stop\n      const name = review.author_name;\n      const rating = review.rating;\n\n      // Turn rating into stars\n      const starRating = '⭐'.repeat(parseInt(rating));\n\n      // Add fade-out class\n      document.querySelector('.quote-slider__quote').classList.add('fade-out');\n      setTimeout(() => {\n        // Update content after fade-out\n        document.querySelector('.quote-slider__quote').classList.remove('fade-out');\n        document.querySelector('.quote-slider__text').innerHTML = `\"${text}\"`;\n        document.querySelector('.quote-slider__title').innerHTML = name;\n        document.querySelector('.quote-slider__rating').innerHTML = starRating;\n\n        // Move to the next review (loop back to the start if at the end)\n        currentIndex = (currentIndex + 1) % reviews.length;\n      }, 500); // Wait for fade-out transition to complete\n    };\n\n    // Start the slider\n    updateQuoteSlider(); // Show the first review immediately\n    setInterval(updateQuoteSlider, 3000); // Update every 10 seconds\n\n    // Optionally, display the average rating somewhere on the page\n    document.querySelector('.quote-slider__review-average').innerHTML = averageRating + averageStarRating;\n  } else {\n    console.error('Invalid data structure:', data);\n  }\n}).catch(error => {\n  // Log any errors\n  console.error('Fetch Error:', error);\n});\n\n//# sourceURL=webpack://reach/./_src/components/quote-slider/scripts/block.js?");

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