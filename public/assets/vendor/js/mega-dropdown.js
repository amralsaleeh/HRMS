(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(self, function() {
return /******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/vendor/js/mega-dropdown.js ***!
  \*****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   MegaDropdown: function() { return /* binding */ MegaDropdown; }
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var TIMEOUT = 150;
var MegaDropdown = /*#__PURE__*/function () {
  function MegaDropdown(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    _classCallCheck(this, MegaDropdown);
    this._onHover = options.trigger === 'hover' || element.getAttribute('data-trigger') === 'hover';
    this._container = MegaDropdown._findParent(element, 'mega-dropdown');
    if (!this._container) return;
    this._menu = this._container.querySelector('.dropdown-toggle ~ .dropdown-menu');
    if (!this._menu) return;
    element.setAttribute('aria-expanded', 'false');
    this._el = element;
    this._bindEvents();
  }
  _createClass(MegaDropdown, [{
    key: "open",
    value: function open() {
      if (this._timeout) {
        clearTimeout(this._timeout);
        this._timeout = null;
      }
      if (this._focusTimeout) {
        clearTimeout(this._focusTimeout);
        this._focusTimeout = null;
      }
      if (this._el.getAttribute('aria-expanded') !== 'true') {
        this._triggerEvent('show');
        this._container.classList.add('show');
        this._menu.classList.add('show');
        this._el.setAttribute('aria-expanded', 'true');
        this._el.focus();
        this._triggerEvent('shown');
      }
    }
  }, {
    key: "close",
    value: function close(force) {
      var _this = this;
      if (this._timeout) {
        clearTimeout(this._timeout);
        this._timeout = null;
      }
      if (this._focusTimeout) {
        clearTimeout(this._focusTimeout);
        this._focusTimeout = null;
      }
      if (this._onHover && !force) {
        this._timeout = setTimeout(function () {
          if (_this._timeout) {
            clearTimeout(_this._timeout);
            _this._timeout = null;
          }
          _this._close();
        }, TIMEOUT);
      } else {
        this._close();
      }
    }
  }, {
    key: "toggle",
    value: function toggle() {
      // eslint-disable-next-line no-unused-expressions
      this._el.getAttribute('aria-expanded') === 'true' ? this.close(true) : this.open();
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this._unbindEvents();
      this._el = null;
      if (this._timeout) {
        clearTimeout(this._timeout);
        this._timeout = null;
      }
      if (this._focusTimeout) {
        clearTimeout(this._focusTimeout);
        this._focusTimeout = null;
      }
    }
  }, {
    key: "_close",
    value: function _close() {
      if (this._el.getAttribute('aria-expanded') === 'true') {
        this._triggerEvent('hide');
        this._container.classList.remove('show');
        this._menu.classList.remove('show');
        this._el.setAttribute('aria-expanded', 'false');
        this._triggerEvent('hidden');
      }
    }
  }, {
    key: "_bindEvents",
    value: function _bindEvents() {
      var _this2 = this;
      this._elClickEvnt = function (e) {
        e.preventDefault();
        _this2.toggle();
      };
      this._el.addEventListener('click', this._elClickEvnt);
      this._bodyClickEvnt = function (e) {
        if (!_this2._container.contains(e.target) && _this2._container.classList.contains('show')) {
          _this2.close(true);
        }
      };
      document.body.addEventListener('click', this._bodyClickEvnt, true);
      this._menuClickEvnt = function (e) {
        if (e.target.classList.contains('mega-dropdown-link')) {
          _this2.close(true);
        }
      };
      this._menu.addEventListener('click', this._menuClickEvnt, true);
      this._focusoutEvnt = function () {
        if (_this2._focusTimeout) {
          clearTimeout(_this2._focusTimeout);
          _this2._focusTimeout = null;
        }
        if (_this2._el.getAttribute('aria-expanded') !== 'true') return;
        _this2._focusTimeout = setTimeout(function () {
          if (document.activeElement.tagName.toUpperCase() !== 'BODY' && MegaDropdown._findParent(document.activeElement, 'mega-dropdown') !== _this2._container) {
            _this2.close(true);
          }
        }, 100);
      };
      this._container.addEventListener('focusout', this._focusoutEvnt, true);
      if (this._onHover) {
        this._enterEvnt = function () {
          if (window.getComputedStyle(_this2._menu, null).getPropertyValue('position') === 'static') return;
          _this2.open();
        };
        this._leaveEvnt = function () {
          if (window.getComputedStyle(_this2._menu, null).getPropertyValue('position') === 'static') return;
          _this2.close();
        };
        this._el.addEventListener('mouseenter', this._enterEvnt);
        this._menu.addEventListener('mouseenter', this._enterEvnt);
        this._el.addEventListener('mouseleave', this._leaveEvnt);
        this._menu.addEventListener('mouseleave', this._leaveEvnt);
      }
    }
  }, {
    key: "_unbindEvents",
    value: function _unbindEvents() {
      if (this._elClickEvnt) {
        this._el.removeEventListener('click', this._elClickEvnt);
        this._elClickEvnt = null;
      }
      if (this._bodyClickEvnt) {
        document.body.removeEventListener('click', this._bodyClickEvnt, true);
        this._bodyClickEvnt = null;
      }
      if (this._menuClickEvnt) {
        this._menu.removeEventListener('click', this._menuClickEvnt, true);
        this._menuClickEvnt = null;
      }
      if (this._focusoutEvnt) {
        this._container.removeEventListener('focusout', this._focusoutEvnt, true);
        this._focusoutEvnt = null;
      }
      if (this._enterEvnt) {
        this._el.removeEventListener('mouseenter', this._enterEvnt);
        this._menu.removeEventListener('mouseenter', this._enterEvnt);
        this._enterEvnt = null;
      }
      if (this._leaveEvnt) {
        this._el.removeEventListener('mouseleave', this._leaveEvnt);
        this._menu.removeEventListener('mouseleave', this._leaveEvnt);
        this._leaveEvnt = null;
      }
    }
  }, {
    key: "_triggerEvent",
    value: function _triggerEvent(event) {
      if (document.createEvent) {
        var customEvent;
        if (typeof Event === 'function') {
          customEvent = new Event(event);
        } else {
          customEvent = document.createEvent('Event');
          customEvent.initEvent(event, false, true);
        }
        this._container.dispatchEvent(customEvent);
      } else {
        this._container.fireEvent("on".concat(event), document.createEventObject());
      }
    }
  }], [{
    key: "_findParent",
    value: function _findParent(el, cls) {
      if (el.tagName.toUpperCase() === 'BODY') return null;
      el = el.parentNode;
      while (el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
        el = el.parentNode;
      }
      return el.tagName.toUpperCase() !== 'BODY' ? el : null;
    }
  }]);
  return MegaDropdown;
}();

/******/ 	return __webpack_exports__;
/******/ })()
;
});