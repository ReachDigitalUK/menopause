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

/***/ "./_src/components/wp-core-blocks/scripts/editor.js":
/*!**********************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _editor_wp_block_button_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./editor/_wp-block-button.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-button.js\");\n/* harmony import */ var _editor_wp_block_heading_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./editor/_wp-block-heading.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-heading.js\");\n/* harmony import */ var _editor_wp_block_image_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./editor/_wp-block-image.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-image.js\");\n/* harmony import */ var _editor_wp_block_paragraph_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./editor/_wp-block-paragraph.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-paragraph.js\");\n/* harmony import */ var _editor_wp_block_quote_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./editor/_wp-block-quote.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-quote.js\");\n/* harmony import */ var _editor_wp_block_separator_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./editor/_wp-block-separator.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-separator.js\");\n/* harmony import */ var _editor_wp_block_table_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./editor/_wp-block-table.js */ \"./_src/components/wp-core-blocks/scripts/editor/_wp-block-table.js\");\n\n\n\n\n\n\n\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-button.js":
/*!***************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-button.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister default styles for core/button block.\n */\nwp.domReady(() => {\n  wp.blocks.unregisterBlockStyle('core/button', 'default');\n  wp.blocks.unregisterBlockStyle('core/button', 'fill');\n  wp.blocks.unregisterBlockStyle('core/button', 'outline');\n  wp.blocks.unregisterBlockStyle('core/button', 'squared');\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-button.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-heading.js":
/*!****************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-heading.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Register block styles for core/heading block.\n */\nwp.domReady(() => {\n  wp.blocks.registerBlockStyle('core/heading', {\n    name: 'typestyle-h2',\n    label: 'H2 Appearance'\n  });\n  wp.blocks.registerBlockStyle('core/heading', {\n    name: 'typestyle-h3',\n    label: 'H3 Appearance'\n  });\n  wp.blocks.registerBlockStyle('core/heading', {\n    name: 'typestyle-h4',\n    label: 'H4 Appearance'\n  });\n  wp.blocks.registerBlockStyle('core/heading', {\n    name: 'typestyle-h5',\n    label: 'H5 Appearance'\n  });\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-heading.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-image.js":
/*!**************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-image.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister default styles for core/image block.\n */\nwp.domReady(() => {\n  wp.blocks.unregisterBlockStyle('core/image', 'default');\n  wp.blocks.unregisterBlockStyle('core/image', 'rounded');\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-image.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-paragraph.js":
/*!******************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-paragraph.js ***!
  \******************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Register block styles for core/paragraph block.\n */\nwp.domReady(() => {\n  wp.blocks.registerBlockStyle('core/paragraph', {\n    name: 'typestyle-large',\n    label: 'Large'\n  });\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-paragraph.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-quote.js":
/*!**************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-quote.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister default styles for core/quote block.\n */\nwp.domReady(() => {\n  wp.blocks.unregisterBlockStyle('core/quote', 'default');\n  wp.blocks.unregisterBlockStyle('core/quote', 'plain');\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-quote.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-separator.js":
/*!******************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-separator.js ***!
  \******************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister default styles for core/separator block.\n */\nwp.domReady(() => {\n  wp.blocks.unregisterBlockStyle('core/separator', 'default');\n  wp.blocks.unregisterBlockStyle('core/separator', 'dots');\n  wp.blocks.unregisterBlockStyle('core/separator', 'wide');\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-separator.js?");

/***/ }),

/***/ "./_src/components/wp-core-blocks/scripts/editor/_wp-block-table.js":
/*!**************************************************************************!*\
  !*** ./_src/components/wp-core-blocks/scripts/editor/_wp-block-table.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister default styles for core/table block.\n */\nwp.domReady(() => {\n  wp.blocks.unregisterBlockStyle('core/table', 'regular'); // Non-standard 'default' style name.\n  wp.blocks.unregisterBlockStyle('core/table', 'stripes');\n});\n\n//# sourceURL=webpack://reach/./_src/components/wp-core-blocks/scripts/editor/_wp-block-table.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
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
/******/ 	var __webpack_exports__ = __webpack_require__("./_src/components/wp-core-blocks/scripts/editor.js");
/******/ 	
/******/ })()
;