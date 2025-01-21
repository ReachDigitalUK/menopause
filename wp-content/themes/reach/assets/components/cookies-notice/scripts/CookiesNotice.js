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

/***/ "./_src/components/cookies-notice/scripts/CookiesNotice.js":
/*!*****************************************************************!*\
  !*** ./_src/components/cookies-notice/scripts/CookiesNotice.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _scripts_helpers_cookies_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../scripts/helpers/cookies.js */ \"./_src/scripts/helpers/cookies.js\");\n\nclass CookiesNotice {\n  constructor(element) {\n    this.el = element;\n    this.bannerPrevActiveElement = document.activeElement;\n    this.bannerEl = this.el.querySelector('.cookies-notice__banner');\n    this.bannerTogglerEls = document.querySelectorAll('.js-cookies-notice-toggler');\n    this.cookiesPreferencesGroupsEl = this.bannerEl.querySelector('.cookies-preferences__consent-groups');\n    this.init();\n  }\n  init() {\n    if ((0,_scripts_helpers_cookies_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)('cookies-consent-preferences-saved') !== '1') {\n      this.setBannerActive(true);\n    } else {\n      this.setBannerActive(false);\n    }\n    this.bannerTogglerEls.forEach(element => {\n      element.setAttribute('aria-expanded', this.isBannerActive());\n      element.setAttribute('aria-controls', this.el.id);\n      element.addEventListener('click', this.handleBannerTogglerClick.bind(this));\n    });\n    this.cookiesPreferencesGroupsEl.addEventListener('expandend', () => {\n      this.el.classList.add('cookies-notice--expanded');\n    });\n    this.cookiesPreferencesGroupsEl.addEventListener('collapsebegin', () => {\n      this.el.classList.remove('cookies-notice--expanded');\n    });\n    document.addEventListener('cookiespreferencessaved', () => {\n      this.setBannerActive(false);\n    });\n  }\n\n  /**\n   * Set the active state of the notice\n   *\n   * @param {boolean} active Whether or not we want to set the notice as active\n   */\n  setBannerActive(active) {\n    if (active === true) {\n      this.bannerPrevActiveElement = document.activeElement;\n      this.el.removeAttribute('aria-hidden');\n      this.bannerEl.focus();\n      this.bannerTogglerEls.forEach(element => {\n        element.setAttribute('aria-expanded', true);\n      });\n    } else {\n      // this.bannerPrevActiveElement.focus();\n      this.el.setAttribute('aria-hidden', true);\n      this.bannerTogglerEls.forEach(element => {\n        element.setAttribute('aria-expanded', false);\n      });\n    }\n  }\n\n  /**\n   * Toggle the active state\n   *\n   */\n  toggleBannerActive() {\n    this.setBannerActive(!this.isBannerActive());\n  }\n\n  /**\n   * Check whether the notice is currently active\n   *\n   */\n  isBannerActive() {\n    return !this.el.hasAttribute('aria-hidden');\n  }\n\n  /**\n   * Handle a toggler click\n   *\n   */\n  handleBannerTogglerClick() {\n    this.toggleBannerActive();\n  }\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CookiesNotice);\n\n//# sourceURL=webpack://reach/./_src/components/cookies-notice/scripts/CookiesNotice.js?");

/***/ }),

/***/ "./_src/scripts/helpers/cookies.js":
/*!*****************************************!*\
  !*** ./_src/scripts/helpers/cookies.js ***!
  \*****************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"getCookie\": () => (/* binding */ getCookie),\n/* harmony export */   \"setCookie\": () => (/* binding */ setCookie)\n/* harmony export */ });\n// Get a Date a number of days in the future.\nconst getFutureDateFromDays = days => new Date(Date.now() + days * 24 * 60 * 60 * 1000);\n\n// Get a future date as a UTC string.\nconst getFutureUTCStringFromDays = days => getFutureDateFromDays(days).toUTCString();\n\n// Create a key-value string for a cookie attribute.\nconst formatCookiePropVal = (key, value) => `${key}=${value};`;\n\n// Set a cookie with a given lifetime (in days).\nconst setCookie = function (name, value, lifetime) {\n  let path = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '/';\n  let domain = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;\n  let secure = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : true;\n  let samesite = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : 'strict';\n  let cookie = formatCookiePropVal(name, value) + formatCookiePropVal('expires', getFutureUTCStringFromDays(lifetime)) + formatCookiePropVal('path', path) + formatCookiePropVal('SameSite', samesite);\n  if (typeof domain === 'string') {\n    cookie += formatCookiePropVal('Domain', domain);\n  }\n  if (secure === true) {\n    cookie += 'Secure';\n  }\n  document.cookie = cookie;\n};\n\n// Retrieve a cookie value by name. Empty string if not found.\nconst getCookie = name => {\n  const nameFormatted = `${name}=`;\n  const cookies = document.cookie.split(';');\n  for (let i = cookies.length - 1; i > -1; i -= 1) {\n    let cookie = cookies[i];\n    while (cookie.charAt(0) === ' ') {\n      cookie = cookie.substring(1);\n    }\n    if (cookie.indexOf(nameFormatted) === 0) {\n      return cookie.substring(nameFormatted.length, cookie.length);\n    }\n  }\n  return '';\n};\n\n\n//# sourceURL=webpack://reach/./_src/scripts/helpers/cookies.js?");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./_src/components/cookies-notice/scripts/CookiesNotice.js");
/******/ 	
/******/ })()
;