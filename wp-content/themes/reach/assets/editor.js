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

/***/ "./_src/components/_template/scripts/editor.js":
/*!*****************************************************!*\
  !*** ./_src/components/_template/scripts/editor.js ***!
  \*****************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// /**\n//  * Add/update default settings for core blocks\n//  *\n//  * @link https://docs-lodash.com/v4/merge/ - more on lodash.merge()\n//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-attributes/\n//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/\n//  * @param {Object} settings Block settings\n//  * @param {String} name The name of the block, e.g. core/quote or acf/cards\n//  * @returns {Object}\n//  */\n//  wp.hooks.addFilter('blocks.registerBlockType', 'reach/theme', (settings, name) => {\n//     let blockSettings = {};\n\n//     if (name === 'core/quote') {\n//         blockSettings = lodash.merge({}, settings, {\n//             supports: {\n//                 align: ['left', 'right', 'wide'],\n//             },\n//         });\n//     }\n\n//     return lodash.merge({}, settings, blockSettings);\n// });\n\n// wp.hooks.addFilter('blocks.registerBlockType', 'reach/defaults', (settings, name) => {\n//     if (name !== 'core/buttons') {\n//         return settings;\n//     }\n\n//     return lodash.merge({}, settings, {\n//         supports: {\n//             align: false, // remove all alignments.\n//             __experimentalLayout: false, // remove justification and orientation\n//         },\n//     });\n// });\n\n//# sourceURL=webpack://reach/./_src/components/_template/scripts/editor.js?");

/***/ }),

/***/ "./_src/components/flag/scripts/editor.js":
/*!************************************************!*\
  !*** ./_src/components/flag/scripts/editor.js ***!
  \************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// /**\n//  * Add/update default settings for core blocks\n//  *\n//  * @link https://docs-lodash.com/v4/merge/ - more on lodash.merge()\n//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-attributes/\n//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/\n//  * @param {Object} settings Block settings\n//  * @param {String} name The name of the block, e.g. core/quote or acf/cards\n//  * @returns {Object}\n//  */\n//  wp.hooks.addFilter('blocks.registerBlockType', 'reach/theme', (settings, name) => {\n//     let blockSettings = {};\n\n//     if (name === 'core/quote') {\n//         blockSettings = lodash.merge({}, settings, {\n//             supports: {\n//                 align: ['left', 'right', 'wide'],\n//             },\n//         });\n//     }\n\n//     return lodash.merge({}, settings, blockSettings);\n// });\n\n// wp.hooks.addFilter('blocks.registerBlockType', 'reach/defaults', (settings, name) => {\n//     if (name !== 'core/buttons') {\n//         return settings;\n//     }\n\n//     return lodash.merge({}, settings, {\n//         supports: {\n//             align: false, // remove all alignments.\n//             __experimentalLayout: false, // remove justification and orientation\n//         },\n//     });\n// });\n\n//# sourceURL=webpack://reach/./_src/components/flag/scripts/editor.js?");

/***/ }),

/***/ "./_src/components/search/scripts/editor.js":
/*!**************************************************!*\
  !*** ./_src/components/search/scripts/editor.js ***!
  \**************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// /**\n//  * Add/update default settings for core blocks\n//  *\n//  * @link https://docs-lodash.com/v4/merge/ - more on lodash.merge()\n//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-attributes/\n//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/\n//  * @param {Object} settings Block settings\n//  * @param {String} name The name of the block, e.g. core/quote or acf/cards\n//  * @returns {Object}\n//  */\n//  wp.hooks.addFilter('blocks.registerBlockType', 'reach/theme', (settings, name) => {\n//     let blockSettings = {};\n\n//     if (name === 'core/quote') {\n//         blockSettings = lodash.merge({}, settings, {\n//             supports: {\n//                 align: ['left', 'right', 'wide'],\n//             },\n//         });\n//     }\n\n//     return lodash.merge({}, settings, blockSettings);\n// });\n\n// wp.hooks.addFilter('blocks.registerBlockType', 'reach/defaults', (settings, name) => {\n//     if (name !== 'core/buttons') {\n//         return settings;\n//     }\n\n//     return lodash.merge({}, settings, {\n//         supports: {\n//             align: false, // remove all alignments.\n//             __experimentalLayout: false, // remove justification and orientation\n//         },\n//     });\n// });\n\n//# sourceURL=webpack://reach/./_src/components/search/scripts/editor.js?");

/***/ }),

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

/***/ }),

/***/ "./_src/editor.js":
/*!************************!*\
  !*** ./_src/editor.js ***!
  \************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scripts_editor_allowed_blocks_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scripts/editor/allowed-blocks.js */ \"./_src/scripts/editor/allowed-blocks.js\");\n/* harmony import */ var _scripts_editor_embed_variations_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./scripts/editor/embed-variations.js */ \"./_src/scripts/editor/embed-variations.js\");\n/* harmony import */ var _scripts_editor_group_variations_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scripts/editor/group-variations.js */ \"./_src/scripts/editor/group-variations.js\");\n/* harmony import */ var _scripts_editor_rich_text_formats_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./scripts/editor/rich-text-formats.js */ \"./_src/scripts/editor/rich-text-formats.js\");\n/* harmony import */ var _components_template_scripts_editor_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/_template/scripts/editor.js */ \"./_src/components/_template/scripts/editor.js\");\n/* harmony import */ var _components_flag_scripts_editor_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/flag/scripts/editor.js */ \"./_src/components/flag/scripts/editor.js\");\n/* harmony import */ var _components_search_scripts_editor_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/search/scripts/editor.js */ \"./_src/components/search/scripts/editor.js\");\n/* harmony import */ var _components_wp_core_blocks_scripts_editor_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/wp-core-blocks/scripts/editor.js */ \"./_src/components/wp-core-blocks/scripts/editor.js\");\n\n\n\n\n\n/* eslint-disable-next-line import/no-unresolved */\n\n\n\n\n\n//# sourceURL=webpack://reach/./_src/editor.js?");

/***/ }),

/***/ "./_src/scripts/editor/allowed-blocks.js":
/*!***********************************************!*\
  !*** ./_src/scripts/editor/allowed-blocks.js ***!
  \***********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * A list of core blocks that should NOT be unregistered.\n *\n * Core blocks are unregistered by default to ensure that all blocks that are\n * allowed are fully supported and required in the project.\n */\nconst allowedCoreBlocks = ['core/paragraph', 'core/image', 'core/heading',\n// 'core/gallery',\n'core/list', 'core/list-item', 'core/quote', 'core/shortcode',\n// 'core/archives',\n// 'core/audio',\n'core/button', 'core/buttons',\n// 'core/calendar',\n// 'core/categories',\n// 'core/code',\n// 'core/columns',\n// 'core/column',\n// 'core/cover',\n'core/embed',\n// 'core/file',\n// 'core/group',\n'core/freeform', 'core/html',\n// 'core/media-text',\n// 'core/latest-comments',\n// 'core/latest-posts',\n'core/missing',\n// 'core/more',\n// 'core/nextpage',\n// 'core/page-list',\n// 'core/preformatted',\n// 'core/pullquote',\n// 'core/rss',\n// 'core/search',\n'core/separator', 'core/block',\n// 'core/social-links',\n// 'core/social-link',\n// 'core/spacer',\n'core/table'\n// 'core/tag-cloud',\n// 'core/text-columns',\n// 'core/verse',\n// 'core/video',\n// 'core/site-logo',\n// 'core/site-tagline',\n// 'core/site-title',\n// 'core/query',\n// 'core/post-template',\n// 'core/query-title',\n// 'core/query-pagination',\n// 'core/query-pagination-next',\n// 'core/query-pagination-numbers',\n// 'core/query-pagination-previous',\n// 'core/post-title',\n// 'core/post-content',\n// 'core/post-date',\n// 'core/post-excerpt',\n// 'core/post-featured-image',\n// 'core/post-terms',\n// 'core/loginout',\n];\n\n/**\n * A list of non-core blocks that SHOULD be unregistered,\n * e.g. unwanted blocks added by plugins.\n */\nconst disallowedBlocks = [\n  // 'example/block-name',\n];\nwp.domReady(() => {\n  wp.blocks.getBlockTypes().forEach(blockType => {\n    if (blockType.name.indexOf('core/') === 0) {\n      if (allowedCoreBlocks.indexOf(blockType.name) === -1) {\n        wp.blocks.unregisterBlockType(blockType.name);\n      }\n    } else if (disallowedBlocks.indexOf(blockType.name) >= 0) {\n      wp.blocks.unregisterBlockType(blockType.name);\n    }\n  });\n});\n\n//# sourceURL=webpack://reach/./_src/scripts/editor/allowed-blocks.js?");

/***/ }),

/***/ "./_src/scripts/editor/embed-variations.js":
/*!*************************************************!*\
  !*** ./_src/scripts/editor/embed-variations.js ***!
  \*************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister any embed variants that aren't in the allow list.\n * Note: The default embed (which allows any provider) cannot be unregistered.\n */\nwp.domReady(() => {\n  const allowedEmbedVariants = ['youtube', 'vimeo', 'gravity-forms'];\n  wp.blocks.getBlockVariations('core/embed').forEach(variant => {\n    if (!allowedEmbedVariants.includes(variant.name)) {\n      wp.blocks.unregisterBlockVariation('core/embed', variant.name);\n    }\n  });\n});\n\n//# sourceURL=webpack://reach/./_src/scripts/editor/embed-variations.js?");

/***/ }),

/***/ "./_src/scripts/editor/group-variations.js":
/*!*************************************************!*\
  !*** ./_src/scripts/editor/group-variations.js ***!
  \*************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister any group variants that aren't in the allow list.\n * Note: The default group cannot be unregistered independently of the other variants.\n */\nwp.domReady(() => {\n  const allowedGroupVariants = ['group-stack'\n  // 'group-row',\n  ];\n\n  wp.blocks.getBlockVariations('core/group').forEach(variant => {\n    if (!allowedGroupVariants.includes(variant.name)) {\n      wp.blocks.unregisterBlockVariation('core/group', variant.name);\n    }\n  });\n});\n\n//# sourceURL=webpack://reach/./_src/scripts/editor/group-variations.js?");

/***/ }),

/***/ "./_src/scripts/editor/rich-text-formats.js":
/*!**************************************************!*\
  !*** ./_src/scripts/editor/rich-text-formats.js ***!
  \**************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Unregister unwanted rich text formats.\n */\nwp.domReady(() => {\n  wp.richText.unregisterFormatType('core/code');\n  wp.richText.unregisterFormatType('core/image');\n  wp.richText.unregisterFormatType('core/keyboard');\n  // wp.richText.unregisterFormatType(\"core/strikethrough\");\n  // wp.richText.unregisterFormatType(\"core/subscript\");\n  // wp.richText.unregisterFormatType(\"core/superscript\");\n  wp.richText.unregisterFormatType('core/language');\n  wp.richText.unregisterFormatType('core/text-color');\n});\n\n//# sourceURL=webpack://reach/./_src/scripts/editor/rich-text-formats.js?");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./_src/editor.js");
/******/ 	
/******/ })()
;