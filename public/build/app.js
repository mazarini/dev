(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/app.scss */ "./assets/scss/app.scss");
/* harmony import */ var _js_app_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/app.js */ "./assets/js/app.js");
// any CSS you import will output into a single css file (app.css in this case)



/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/app.scss */ "./assets/scss/app.scss");
/* harmony import */ var _modules_bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/bootstrap */ "./assets/js/modules/bootstrap.js");
/* harmony import */ var _modules_theme__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/theme */ "./assets/js/modules/theme.js");
/* harmony import */ var _modules_theme__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_modules_theme__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _modules_feather__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/feather */ "./assets/js/modules/feather.js");
/* harmony import */ var _modules_flatpickr__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/flatpickr */ "./assets/js/modules/flatpickr.js");
/* harmony import */ var _sidebar__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./sidebar */ "./assets/js/sidebar.js");
 // Modules (required)



 // Forms

 // Sidebar



/***/ }),

/***/ "./assets/js/modules/bootstrap.js":
/*!****************************************!*\
  !*** ./assets/js/modules/bootstrap.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
 // Bootstrap
// Note: If you want to make bootstrap globally available, e.g. for using `bootstrap.modal`

window.bootstrap = bootstrap__WEBPACK_IMPORTED_MODULE_0__;

/***/ }),

/***/ "./assets/js/modules/feather.js":
/*!**************************************!*\
  !*** ./assets/js/modules/feather.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var feather_icons__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! feather-icons */ "./node_modules/feather-icons/dist/feather.js");
/* harmony import */ var feather_icons__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(feather_icons__WEBPACK_IMPORTED_MODULE_2__);


// Usage: https://feathericons.com/

document.addEventListener("DOMContentLoaded", function () {
  feather_icons__WEBPACK_IMPORTED_MODULE_2___default().replace();
});
window.feather = (feather_icons__WEBPACK_IMPORTED_MODULE_2___default());

/***/ }),

/***/ "./assets/js/modules/flatpickr.js":
/*!****************************************!*\
  !*** ./assets/js/modules/flatpickr.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var flatpickr__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flatpickr */ "./node_modules/flatpickr/dist/esm/index.js");
// Usage: https://flatpickr.js.org/

window.flatpickr = flatpickr__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./assets/js/modules/theme.js":
/*!************************************!*\
  !*** ./assets/js/modules/theme.js ***!
  \************************************/
/***/ (() => {

/*
 * Add color theme colors to the window object
 * so this can be used by the charts and vector maps
 */
var theme = {
  "primary": "#3B7DDD",
  "secondary": "#6c757d",
  "success": "#1cbb8c",
  "info": "#17a2b8",
  "warning": "#fcb92c",
  "danger": "#dc3545",
  "white": "#fff",
  "gray-100": "#f8f9fa",
  "gray-200": "#e9ecef",
  "gray-300": "#dee2e6",
  "gray-400": "#ced4da",
  "gray-500": "#adb5bd",
  "gray-600": "#6c757d",
  "gray-700": "#495057",
  "gray-800": "#343a40",
  "gray-900": "#212529",
  "black": "#000"
}; // Add theme to the window object

window.theme = theme;

/***/ }),

/***/ "./assets/js/sidebar.js":
/*!******************************!*\
  !*** ./assets/js/sidebar.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var simplebar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! simplebar */ "./node_modules/simplebar/dist/simplebar.esm.js");



// Usage: https://github.com/Grsmto/simplebar


var initialize = function initialize() {
  initializeSimplebar();
  initializeSidebarCollapse();
};

var initializeSimplebar = function initializeSimplebar() {
  var simplebarElement = document.getElementsByClassName("js-simplebar")[0];

  if (simplebarElement) {
    var simplebarInstance = new simplebar__WEBPACK_IMPORTED_MODULE_3__["default"](document.getElementsByClassName("js-simplebar")[0]);
    /* Recalculate simplebar on sidebar dropdown toggle */

    var sidebarDropdowns = document.querySelectorAll(".js-sidebar [data-bs-parent]");
    sidebarDropdowns.forEach(function (link) {
      link.addEventListener("shown.bs.collapse", function () {
        simplebarInstance.recalculate();
      });
      link.addEventListener("hidden.bs.collapse", function () {
        simplebarInstance.recalculate();
      });
    });
  }
};

var initializeSidebarCollapse = function initializeSidebarCollapse() {
  var sidebarElement = document.getElementsByClassName("js-sidebar")[0];
  var sidebarToggleElement = document.getElementsByClassName("js-sidebar-toggle")[0];

  if (sidebarElement && sidebarToggleElement) {
    sidebarToggleElement.addEventListener("click", function () {
      sidebarElement.classList.toggle("collapsed");
      sidebarElement.addEventListener("transitionend", function () {
        window.dispatchEvent(new Event("resize"));
      });
    });
  }
}; // Wait until page is loaded


document.addEventListener("DOMContentLoaded", function () {
  return initialize();
});

/***/ }),

/***/ "./assets/scss/app.scss":
/*!******************************!*\
  !*** ./assets/scss/app.scss ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js-node_modules_core-js_modules_es_array-1fa220"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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TTtBQUNuREgsUUFBQUEsTUFBTSxDQUFDdUIsYUFBUCxDQUFxQixJQUFJQyxLQUFKLENBQVUsUUFBVixDQUFyQjtBQUNILE9BRkQ7QUFHSCxLQU5EO0FBT0g7QUFDSixDQWJELEVBZUE7OztBQUNBdEIsUUFBUSxDQUFDQyxnQkFBVCxDQUEwQixrQkFBMUIsRUFBOEM7QUFBQSxTQUFNSyxVQUFVLEVBQWhCO0FBQUEsQ0FBOUM7Ozs7Ozs7Ozs7OztBQzVDQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbW9kdWxlcy9ib290c3RyYXAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL21vZHVsZXMvZmVhdGhlci5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbW9kdWxlcy9mbGF0cGlja3IuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL21vZHVsZXMvdGhlbWUuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3NpZGViYXIuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3Njc3MvYXBwLnNjc3MiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuL3Njc3MvYXBwLnNjc3MnO1xuXG5pbXBvcnQgJy4vanMvYXBwLmpzJztcbiIsImltcG9ydCBcIi4uL3Njc3MvYXBwLnNjc3NcIjtcblxuLy8gTW9kdWxlcyAocmVxdWlyZWQpXG5pbXBvcnQgXCIuL21vZHVsZXMvYm9vdHN0cmFwXCI7XG5pbXBvcnQgXCIuL21vZHVsZXMvdGhlbWVcIjtcbmltcG9ydCBcIi4vbW9kdWxlcy9mZWF0aGVyXCI7XG5cbi8vIEZvcm1zXG5pbXBvcnQgXCIuL21vZHVsZXMvZmxhdHBpY2tyXCI7XG5cbi8vIFNpZGViYXJcbmltcG9ydCBcIi4vc2lkZWJhclwiO1xuIiwiaW1wb3J0ICogYXMgYm9vdHN0cmFwIGZyb20gXCJib290c3RyYXBcIjtcblxuLy8gQm9vdHN0cmFwXG4vLyBOb3RlOiBJZiB5b3Ugd2FudCB0byBtYWtlIGJvb3RzdHJhcCBnbG9iYWxseSBhdmFpbGFibGUsIGUuZy4gZm9yIHVzaW5nIGBib290c3RyYXAubW9kYWxgXG53aW5kb3cuYm9vdHN0cmFwID0gYm9vdHN0cmFwOyIsIi8vIFVzYWdlOiBodHRwczovL2ZlYXRoZXJpY29ucy5jb20vXG5pbXBvcnQgZmVhdGhlciBmcm9tIFwiZmVhdGhlci1pY29uc1wiO1xuXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCAoKSA9PiB7XG4gICAgZmVhdGhlci5yZXBsYWNlKCk7XG59KTtcblxud2luZG93LmZlYXRoZXIgPSBmZWF0aGVyOyIsIi8vIFVzYWdlOiBodHRwczovL2ZsYXRwaWNrci5qcy5vcmcvXG5pbXBvcnQgZmxhdHBpY2tyIGZyb20gXCJmbGF0cGlja3JcIjtcblxud2luZG93LmZsYXRwaWNrciA9IGZsYXRwaWNrcjsiLCIvKlxuICogQWRkIGNvbG9yIHRoZW1lIGNvbG9ycyB0byB0aGUgd2luZG93IG9iamVjdFxuICogc28gdGhpcyBjYW4gYmUgdXNlZCBieSB0aGUgY2hhcnRzIGFuZCB2ZWN0b3IgbWFwc1xuICovXG5cbmNvbnN0IHRoZW1lID0ge1xuICBcInByaW1hcnlcIjogXCIjM0I3REREXCIsXG4gIFwic2Vjb25kYXJ5XCI6IFwiIzZjNzU3ZFwiLFxuICBcInN1Y2Nlc3NcIjogXCIjMWNiYjhjXCIsXG4gIFwiaW5mb1wiOiBcIiMxN2EyYjhcIixcbiAgXCJ3YXJuaW5nXCI6IFwiI2ZjYjkyY1wiLFxuICBcImRhbmdlclwiOiBcIiNkYzM1NDVcIixcbiAgXCJ3aGl0ZVwiOiBcIiNmZmZcIixcbiAgXCJncmF5LTEwMFwiOiBcIiNmOGY5ZmFcIixcbiAgXCJncmF5LTIwMFwiOiBcIiNlOWVjZWZcIixcbiAgXCJncmF5LTMwMFwiOiBcIiNkZWUyZTZcIixcbiAgXCJncmF5LTQwMFwiOiBcIiNjZWQ0ZGFcIixcbiAgXCJncmF5LTUwMFwiOiBcIiNhZGI1YmRcIixcbiAgXCJncmF5LTYwMFwiOiBcIiM2Yzc1N2RcIixcbiAgXCJncmF5LTcwMFwiOiBcIiM0OTUwNTdcIixcbiAgXCJncmF5LTgwMFwiOiBcIiMzNDNhNDBcIixcbiAgXCJncmF5LTkwMFwiOiBcIiMyMTI1MjlcIixcbiAgXCJibGFja1wiOiBcIiMwMDBcIlxufTtcblxuLy8gQWRkIHRoZW1lIHRvIHRoZSB3aW5kb3cgb2JqZWN0XG53aW5kb3cudGhlbWUgPSB0aGVtZTsiLCIvLyBVc2FnZTogaHR0cHM6Ly9naXRodWIuY29tL0dyc210by9zaW1wbGViYXJcbmltcG9ydCBTaW1wbGVCYXIgZnJvbSBcInNpbXBsZWJhclwiO1xuXG5jb25zdCBpbml0aWFsaXplID0gKCkgPT4ge1xuICAgIGluaXRpYWxpemVTaW1wbGViYXIoKTtcbiAgICBpbml0aWFsaXplU2lkZWJhckNvbGxhcHNlKCk7XG59XG5cbmNvbnN0IGluaXRpYWxpemVTaW1wbGViYXIgPSAoKSA9PiB7XG4gICAgY29uc3Qgc2ltcGxlYmFyRWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoXCJqcy1zaW1wbGViYXJcIilbMF07XG5cbiAgICBpZiAoc2ltcGxlYmFyRWxlbWVudCkge1xuICAgICAgICBjb25zdCBzaW1wbGViYXJJbnN0YW5jZSA9IG5ldyBTaW1wbGVCYXIoZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcImpzLXNpbXBsZWJhclwiKVswXSk7XG5cbiAgICAgICAgLyogUmVjYWxjdWxhdGUgc2ltcGxlYmFyIG9uIHNpZGViYXIgZHJvcGRvd24gdG9nZ2xlICovXG4gICAgICAgIGNvbnN0IHNpZGViYXJEcm9wZG93bnMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFwiLmpzLXNpZGViYXIgW2RhdGEtYnMtcGFyZW50XVwiKTtcblxuICAgICAgICBzaWRlYmFyRHJvcGRvd25zLmZvckVhY2gobGluayA9PiB7XG4gICAgICAgICAgICBsaW5rLmFkZEV2ZW50TGlzdGVuZXIoXCJzaG93bi5icy5jb2xsYXBzZVwiLCAoKSA9PiB7XG4gICAgICAgICAgICAgICAgc2ltcGxlYmFySW5zdGFuY2UucmVjYWxjdWxhdGUoKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgbGluay5hZGRFdmVudExpc3RlbmVyKFwiaGlkZGVuLmJzLmNvbGxhcHNlXCIsICgpID0+IHtcbiAgICAgICAgICAgICAgICBzaW1wbGViYXJJbnN0YW5jZS5yZWNhbGN1bGF0ZSgpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxuY29uc3QgaW5pdGlhbGl6ZVNpZGViYXJDb2xsYXBzZSA9ICgpID0+IHtcbiAgICBjb25zdCBzaWRlYmFyRWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoXCJqcy1zaWRlYmFyXCIpWzBdO1xuICAgIGNvbnN0IHNpZGViYXJUb2dnbGVFbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcImpzLXNpZGViYXItdG9nZ2xlXCIpWzBdO1xuXG4gICAgaWYgKHNpZGViYXJFbGVtZW50ICYmIHNpZGViYXJUb2dnbGVFbGVtZW50KSB7XG4gICAgICAgIHNpZGViYXJUb2dnbGVFbGVtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCAoKSA9PiB7XG4gICAgICAgICAgICBzaWRlYmFyRWxlbWVudC5jbGFzc0xpc3QudG9nZ2xlKFwiY29sbGFwc2VkXCIpO1xuXG4gICAgICAgICAgICBzaWRlYmFyRWxlbWVudC5hZGRFdmVudExpc3RlbmVyKFwidHJhbnNpdGlvbmVuZFwiLCAoKSA9PiB7XG4gICAgICAgICAgICAgICAgd2luZG93LmRpc3BhdGNoRXZlbnQobmV3IEV2ZW50KFwicmVzaXplXCIpKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG59XG5cbi8vIFdhaXQgdW50aWwgcGFnZSBpcyBsb2FkZWRcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsICgpID0+IGluaXRpYWxpemUoKSk7XG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiYm9vdHN0cmFwIiwid2luZG93IiwiZmVhdGhlciIsImRvY3VtZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsInJlcGxhY2UiLCJmbGF0cGlja3IiLCJ0aGVtZSIsIlNpbXBsZUJhciIsImluaXRpYWxpemUiLCJpbml0aWFsaXplU2ltcGxlYmFyIiwiaW5pdGlhbGl6ZVNpZGViYXJDb2xsYXBzZSIsInNpbXBsZWJhckVsZW1lbnQiLCJnZXRFbGVtZW50c0J5Q2xhc3NOYW1lIiwic2ltcGxlYmFySW5zdGFuY2UiLCJzaWRlYmFyRHJvcGRvd25zIiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJsaW5rIiwicmVjYWxjdWxhdGUiLCJzaWRlYmFyRWxlbWVudCIsInNpZGViYXJUb2dnbGVFbGVtZW50IiwiY2xhc3NMaXN0IiwidG9nZ2xlIiwiZGlzcGF0Y2hFdmVudCIsIkV2ZW50Il0sInNvdXJjZVJvb3QiOiIifQ==