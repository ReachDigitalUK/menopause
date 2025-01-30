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

/***/ "./_src/components/post-grid/scripts/block.js":
/*!****************************************************!*\
  !*** ./_src/components/post-grid/scripts/block.js ***!
  \****************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* eslint-disable */\ndocument.addEventListener('DOMContentLoaded', function () {\n  const ajaxurl = `${window.location.origin}/wp-admin/admin-ajax.php`;\n  fetch(ajaxurl, {\n    method: 'POST',\n    headers: {\n      'Content-Type': 'application/x-www-form-urlencoded'\n    },\n    body: 'action=fetch_posts'\n  }).then(response => response.json()).then(data => {\n    const posts = data.data;\n    const postGrid = document.querySelector('.post-grid__posts');\n    const selector = document.querySelector('#post_grid__category');\n    const allButton = document.querySelector('.post-grid__all-button');\n    showResults(posts);\n    selector.addEventListener('change', e => {\n      const selectedCategory = e.target.value;\n      if (selectedCategory === 'all') {\n        showResults(posts);\n        return;\n      }\n      const filteredPosts = posts.filter(post => {\n        if (post.category && post.category.length > 0) {\n          return post.category.some(cat => cat.name.trim().toLowerCase() === selectedCategory.trim().toLowerCase());\n        }\n        return false;\n      });\n      showResults(filteredPosts);\n    });\n    allButton.addEventListener('click', () => {\n      showResults(posts);\n    });\n  }).catch(error => {\n    console.error('Fetch Error:', error);\n  });\n  function showResults(posts) {\n    const postGrid = document.querySelector('.post-grid__posts');\n    if (!posts || posts.length === 0) {\n      postGrid.innerHTML = '<p>No posts available</p>';\n      return;\n    }\n    const postHTML = posts.map(post => {\n      const firstCategory = post.category && post.category.length > 0 ? post.category[0].name : 'Uncategorized';\n      const truncatedTitle = post.title.length > 50 ? post.title.substring(0, 55) + '...' : post.title;\n      return `\n                <div class=\"post-grid__item\">\n                    <div class=\"post-grid__item__image\">\n                        ${post.image ? `<img src=\"${post.image}\" alt=\"${post.title}\">` : ''}\n                        <div class=\"post-grid__category\">\n                            <p>${firstCategory}</p>\n                        </div>\n                    </div>\n                    <div class=\"post-grid__item__content\">\n                        <p>${post.date}</p>\n                        <h3>${truncatedTitle}</h3>\n                        <a href=\"${post.link}\">Read more</a>\n                    </div>\n                </div>\n            `;\n    }).join('');\n    postGrid.innerHTML = `\n            <div class=\"post-grid__grid_container\">\n                ${postHTML}\n            </div>\n        `;\n  }\n});\n\n//# sourceURL=webpack://reach/./_src/components/post-grid/scripts/block.js?");

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
/******/ 	__webpack_modules__["./_src/components/post-grid/scripts/block.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;