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
/*!***********************************************!*\
  !*** ./resources/assets/vendor/js/helpers.js ***!
  \***********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Helpers: function() { return /* binding */ Helpers; }
/* harmony export */ });
function _toArray(arr) { return _arrayWithHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableRest(); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
// Constants
var TRANS_EVENTS = ['transitionend', 'webkitTransitionEnd', 'oTransitionEnd'];
var TRANS_PROPERTIES = ['transition', 'MozTransition', 'webkitTransition', 'WebkitTransition', 'OTransition'];
var INLINE_STYLES = "\n.layout-menu-fixed .layout-navbar-full .layout-menu,\n.layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {\n  top: {navbarHeight}px !important;\n}\n.layout-page {\n  padding-top: {navbarHeight}px !important;\n}\n.content-wrapper {\n  padding-bottom: {footerHeight}px !important;\n}";

// Guard
function requiredParam(name) {
  throw new Error("Parameter required".concat(name ? ": `".concat(name, "`") : ''));
}
var Helpers = {
  // Root Element
  ROOT_EL: typeof window !== 'undefined' ? document.documentElement : null,
  // Large screens breakpoint
  LAYOUT_BREAKPOINT: 1200,
  // Resize delay in milliseconds
  RESIZE_DELAY: 200,
  menuPsScroll: null,
  mainMenu: null,
  // Internal variables
  _curStyle: null,
  _styleEl: null,
  _resizeTimeout: null,
  _resizeCallback: null,
  _transitionCallback: null,
  _transitionCallbackTimeout: null,
  _listeners: [],
  _initialized: false,
  _autoUpdate: false,
  _lastWindowHeight: 0,
  // *******************************************************************************
  // * Utilities
  // ---
  // Scroll To Active Menu Item
  _scrollToActive: function _scrollToActive() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return;
    var activeEl = layoutMenu.querySelector('li.menu-item.active:not(.open)');
    if (activeEl) {
      // t = current time
      // b = start value
      // c = change in value
      // d = duration
      var easeInOutQuad = function easeInOutQuad(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t -= 1;
        return -c / 2 * (t * (t - 2) - 1) + b;
      };
      var element = this.getLayoutMenu().querySelector('.menu-inner');
      if (typeof activeEl === 'string') {
        activeEl = document.querySelector(activeEl);
      }
      if (typeof activeEl !== 'number') {
        activeEl = activeEl.getBoundingClientRect().top + element.scrollTop;
      }

      // If active element's top position is less than 2/3 (66%) of menu height than do not scroll
      if (activeEl < parseInt(element.clientHeight * 2 / 3, 10)) return;
      var start = element.scrollTop;
      var change = activeEl - start - parseInt(element.clientHeight / 2, 10);
      var startDate = +new Date();
      if (animate === true) {
        var animateScroll = function animateScroll() {
          var currentDate = +new Date();
          var currentTime = currentDate - startDate;
          var val = easeInOutQuad(currentTime, start, change, duration);
          element.scrollTop = val;
          if (currentTime < duration) {
            requestAnimationFrame(animateScroll);
          } else {
            element.scrollTop = change;
          }
        };
        animateScroll();
      } else {
        element.scrollTop = change;
      }
    }
  },
  // ---
  // Swipe In Gesture
  _swipeIn: function _swipeIn(targetEl, callback) {
    var _window = window,
      Hammer = _window.Hammer;
    if (typeof Hammer !== 'undefined' && typeof targetEl === 'string') {
      // Swipe menu gesture
      var swipeInElement = document.querySelector(targetEl);
      if (swipeInElement) {
        var hammerInstance = new Hammer(swipeInElement);
        hammerInstance.on('panright', callback);
      }
    }
  },
  // ---
  // Swipe Out Gesture
  _swipeOut: function _swipeOut(targetEl, callback) {
    var _window2 = window,
      Hammer = _window2.Hammer;
    if (typeof Hammer !== 'undefined' && typeof targetEl === 'string') {
      setTimeout(function () {
        // Swipe menu gesture
        var swipeOutElement = document.querySelector(targetEl);
        if (swipeOutElement) {
          var hammerInstance = new Hammer(swipeOutElement);
          hammerInstance.get('pan').set({
            direction: Hammer.DIRECTION_ALL,
            threshold: 250
          });
          hammerInstance.on('panleft', callback);
        }
      }, 500);
    }
  },
  // ---
  // Swipe Out On Overlay Tap
  _overlayTap: function _overlayTap(targetEl, callback) {
    var _window3 = window,
      Hammer = _window3.Hammer;
    if (typeof Hammer !== 'undefined' && typeof targetEl === 'string') {
      // Swipe out overlay element
      var swipeOutOverlayElement = document.querySelector(targetEl);
      if (swipeOutOverlayElement) {
        var hammerInstance = new Hammer(swipeOutOverlayElement);
        hammerInstance.on('tap', callback);
      }
    }
  },
  // ---
  // Add classes
  _addClass: function _addClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.ROOT_EL;
    if (el.length !== undefined) {
      // Add classes to multiple elements
      el.forEach(function (e) {
        cls.split(' ').forEach(function (c) {
          return e.classList.add(c);
        });
      });
    } else {
      // Add classes to single element
      cls.split(' ').forEach(function (c) {
        return el.classList.add(c);
      });
    }
  },
  // ---
  // Remove classes
  _removeClass: function _removeClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.ROOT_EL;
    if (el.length !== undefined) {
      // Remove classes to multiple elements
      el.forEach(function (e) {
        cls.split(' ').forEach(function (c) {
          return e.classList.remove(c);
        });
      });
    } else {
      // Remove classes to single element
      cls.split(' ').forEach(function (c) {
        return el.classList.remove(c);
      });
    }
  },
  // Toggle classes
  _toggleClass: function _toggleClass() {
    var el = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.ROOT_EL;
    var cls1 = arguments.length > 1 ? arguments[1] : undefined;
    var cls2 = arguments.length > 2 ? arguments[2] : undefined;
    if (el.classList.contains(cls1)) {
      el.classList.replace(cls1, cls2);
    } else {
      el.classList.replace(cls2, cls1);
    }
  },
  // ---
  // Has class
  _hasClass: function _hasClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.ROOT_EL;
    var result = false;
    cls.split(' ').forEach(function (c) {
      if (el.classList.contains(c)) result = true;
    });
    return result;
  },
  _findParent: function _findParent(el, cls) {
    if (el && el.tagName.toUpperCase() === 'BODY' || el.tagName.toUpperCase() === 'HTML') return null;
    el = el.parentNode;
    while (el && el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
      el = el.parentNode;
    }
    el = el && el.tagName.toUpperCase() !== 'BODY' ? el : null;
    return el;
  },
  // ---
  // Trigger window event
  _triggerWindowEvent: function _triggerWindowEvent(name) {
    if (typeof window === 'undefined') return;
    if (document.createEvent) {
      var event;
      if (typeof Event === 'function') {
        event = new Event(name);
      } else {
        event = document.createEvent('Event');
        event.initEvent(name, false, true);
      }
      window.dispatchEvent(event);
    } else {
      window.fireEvent("on".concat(name), document.createEventObject());
    }
  },
  // ---
  // Trigger event
  _triggerEvent: function _triggerEvent(name) {
    this._triggerWindowEvent("layout".concat(name));
    this._listeners.filter(function (listener) {
      return listener.event === name;
    }).forEach(function (listener) {
      return listener.callback.call(null);
    });
  },
  // ---
  // Update style
  _updateInlineStyle: function _updateInlineStyle() {
    var navbarHeight = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
    var footerHeight = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
    if (!this._styleEl) {
      this._styleEl = document.createElement('style');
      this._styleEl.type = 'text/css';
      document.head.appendChild(this._styleEl);
    }
    var newStyle = INLINE_STYLES.replace(/\{navbarHeight\}/gi, navbarHeight).replace(/\{footerHeight\}/gi, footerHeight);
    if (this._curStyle !== newStyle) {
      this._curStyle = newStyle;
      this._styleEl.textContent = newStyle;
    }
  },
  // ---
  // Remove style
  _removeInlineStyle: function _removeInlineStyle() {
    if (this._styleEl) document.head.removeChild(this._styleEl);
    this._styleEl = null;
    this._curStyle = null;
  },
  // ---
  // Redraw layout menu (Safari bugfix)
  _redrawLayoutMenu: function _redrawLayoutMenu() {
    var layoutMenu = this.getLayoutMenu();
    if (layoutMenu && layoutMenu.querySelector('.menu')) {
      var inner = layoutMenu.querySelector('.menu-inner');
      var scrollTop = inner.scrollTop;
      var pageScrollTop = document.documentElement.scrollTop;
      layoutMenu.style.display = 'none';
      // layoutMenu.offsetHeight
      layoutMenu.style.display = '';
      inner.scrollTop = scrollTop;
      document.documentElement.scrollTop = pageScrollTop;
      return true;
    }
    return false;
  },
  // ---
  // Check for transition support
  _supportsTransitionEnd: function _supportsTransitionEnd() {
    if (window.QUnit) return false;
    var el = document.body || document.documentElement;
    if (!el) return false;
    var result = false;
    TRANS_PROPERTIES.forEach(function (evnt) {
      if (typeof el.style[evnt] !== 'undefined') result = true;
    });
    return result;
  },
  // ---
  // Calculate current navbar height
  _getNavbarHeight: function _getNavbarHeight() {
    var _this2 = this;
    var layoutNavbar = this.getLayoutNavbar();
    if (!layoutNavbar) return 0;
    if (!this.isSmallScreen()) return layoutNavbar.getBoundingClientRect().height;

    // Needs some logic to get navbar height on small screens

    var clonedEl = layoutNavbar.cloneNode(true);
    clonedEl.id = null;
    clonedEl.style.visibility = 'hidden';
    clonedEl.style.position = 'absolute';
    Array.prototype.slice.call(clonedEl.querySelectorAll('.collapse.show')).forEach(function (el) {
      return _this2._removeClass('show', el);
    });
    layoutNavbar.parentNode.insertBefore(clonedEl, layoutNavbar);
    var navbarHeight = clonedEl.getBoundingClientRect().height;
    clonedEl.parentNode.removeChild(clonedEl);
    return navbarHeight;
  },
  // ---
  // Get current footer height
  _getFooterHeight: function _getFooterHeight() {
    var layoutFooter = this.getLayoutFooter();
    if (!layoutFooter) return 0;
    return layoutFooter.getBoundingClientRect().height;
  },
  // ---
  // Get animation duration of element
  _getAnimationDuration: function _getAnimationDuration(el) {
    var duration = window.getComputedStyle(el).transitionDuration;
    return parseFloat(duration) * (duration.indexOf('ms') !== -1 ? 1 : 1000);
  },
  // ---
  // Set menu hover state
  _setMenuHoverState: function _setMenuHoverState(hovered) {
    this[hovered ? '_addClass' : '_removeClass']('layout-menu-hover');
  },
  // ---
  // Toggle collapsed
  _setCollapsed: function _setCollapsed(collapsed) {
    var _this3 = this;
    if (this.isSmallScreen()) {
      if (collapsed) {
        this._removeClass('layout-menu-expanded');
      } else {
        setTimeout(function () {
          _this3._addClass('layout-menu-expanded');
        }, this._redrawLayoutMenu() ? 5 : 0);
      }
    } else {
      this[collapsed ? '_addClass' : '_removeClass']('layout-menu-collapsed');
    }
  },
  // ---
  // Add layout sivenav toggle animationEnd event
  _bindLayoutAnimationEndEvent: function _bindLayoutAnimationEndEvent(modifier, cb) {
    var _this4 = this;
    var menu = this.getMenu();
    var duration = menu ? this._getAnimationDuration(menu) + 50 : 0;
    if (!duration) {
      modifier.call(this);
      cb.call(this);
      return;
    }
    this._transitionCallback = function (e) {
      if (e.target !== menu) return;
      _this4._unbindLayoutAnimationEndEvent();
      cb.call(_this4);
    };
    TRANS_EVENTS.forEach(function (e) {
      menu.addEventListener(e, _this4._transitionCallback, false);
    });
    modifier.call(this);
    this._transitionCallbackTimeout = setTimeout(function () {
      _this4._transitionCallback.call(_this4, {
        target: menu
      });
    }, duration);
  },
  // ---
  // Remove layout sivenav toggle animationEnd event
  _unbindLayoutAnimationEndEvent: function _unbindLayoutAnimationEndEvent() {
    var _this5 = this;
    var menu = this.getMenu();
    if (this._transitionCallbackTimeout) {
      clearTimeout(this._transitionCallbackTimeout);
      this._transitionCallbackTimeout = null;
    }
    if (menu && this._transitionCallback) {
      TRANS_EVENTS.forEach(function (e) {
        menu.removeEventListener(e, _this5._transitionCallback, false);
      });
    }
    if (this._transitionCallback) {
      this._transitionCallback = null;
    }
  },
  // ---
  // Bind delayed window resize event
  _bindWindowResizeEvent: function _bindWindowResizeEvent() {
    var _this6 = this;
    this._unbindWindowResizeEvent();
    var cb = function cb() {
      if (_this6._resizeTimeout) {
        clearTimeout(_this6._resizeTimeout);
        _this6._resizeTimeout = null;
      }
      _this6._triggerEvent('resize');
    };
    this._resizeCallback = function () {
      if (_this6._resizeTimeout) clearTimeout(_this6._resizeTimeout);
      _this6._resizeTimeout = setTimeout(cb, _this6.RESIZE_DELAY);
    };
    window.addEventListener('resize', this._resizeCallback, false);
  },
  // ---
  // Unbind delayed window resize event
  _unbindWindowResizeEvent: function _unbindWindowResizeEvent() {
    if (this._resizeTimeout) {
      clearTimeout(this._resizeTimeout);
      this._resizeTimeout = null;
    }
    if (this._resizeCallback) {
      window.removeEventListener('resize', this._resizeCallback, false);
      this._resizeCallback = null;
    }
  },
  _bindMenuMouseEvents: function _bindMenuMouseEvents() {
    var _this7 = this;
    if (this._menuMouseEnter && this._menuMouseLeave && this._windowTouchStart) return;
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return this._unbindMenuMouseEvents();
    if (!this._menuMouseEnter) {
      this._menuMouseEnter = function () {
        if (_this7.isSmallScreen() || !_this7._hasClass('layout-menu-collapsed') || _this7.isOffcanvas() || _this7._hasClass('layout-transitioning')) {
          return _this7._setMenuHoverState(false);
        }
        return _this7._setMenuHoverState(true);
      };
      layoutMenu.addEventListener('mouseenter', this._menuMouseEnter, false);
      layoutMenu.addEventListener('touchstart', this._menuMouseEnter, false);
    }
    if (!this._menuMouseLeave) {
      this._menuMouseLeave = function () {
        _this7._setMenuHoverState(false);
      };
      layoutMenu.addEventListener('mouseleave', this._menuMouseLeave, false);
    }
    if (!this._windowTouchStart) {
      this._windowTouchStart = function (e) {
        if (!e || !e.target || !_this7._findParent(e.target, '.layout-menu')) {
          _this7._setMenuHoverState(false);
        }
      };
      window.addEventListener('touchstart', this._windowTouchStart, true);
    }
  },
  _unbindMenuMouseEvents: function _unbindMenuMouseEvents() {
    if (!this._menuMouseEnter && !this._menuMouseLeave && !this._windowTouchStart) return;
    var layoutMenu = this.getLayoutMenu();
    if (this._menuMouseEnter) {
      if (layoutMenu) {
        layoutMenu.removeEventListener('mouseenter', this._menuMouseEnter, false);
        layoutMenu.removeEventListener('touchstart', this._menuMouseEnter, false);
      }
      this._menuMouseEnter = null;
    }
    if (this._menuMouseLeave) {
      if (layoutMenu) {
        layoutMenu.removeEventListener('mouseleave', this._menuMouseLeave, false);
      }
      this._menuMouseLeave = null;
    }
    if (this._windowTouchStart) {
      if (layoutMenu) {
        window.addEventListener('touchstart', this._windowTouchStart, true);
      }
      this._windowTouchStart = null;
    }
    this._setMenuHoverState(false);
  },
  // *******************************************************************************
  // * Methods
  scrollToActive: function scrollToActive() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    this._scrollToActive(animate);
  },
  swipeIn: function swipeIn(el, callback) {
    this._swipeIn(el, callback);
  },
  swipeOut: function swipeOut(el, callback) {
    this._swipeOut(el, callback);
  },
  overlayTap: function overlayTap(el, callback) {
    this._overlayTap(el, callback);
  },
  scrollPageTo: function scrollPageTo(to) {
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    // t = current time
    // b = start value
    // c = change in value
    // d = duration
    var easeInOutQuad = function easeInOutQuad(t, b, c, d) {
      t /= d / 2;
      if (t < 1) return c / 2 * t * t + b;
      t -= 1;
      return -c / 2 * (t * (t - 2) - 1) + b;
    };
    var element = document.scrollingElement;
    if (typeof to === 'string') {
      to = document.querySelector(to);
    }
    if (typeof to !== 'number') {
      to = to.getBoundingClientRect().top + element.scrollTop;
    }
    var start = element.scrollTop;
    var change = to - start;
    var startDate = +new Date();
    // const increment = 20

    var animateScroll = function animateScroll() {
      var currentDate = +new Date();
      var currentTime = currentDate - startDate;
      var val = easeInOutQuad(currentTime, start, change, duration);
      element.scrollTop = val;
      if (currentTime < duration) {
        requestAnimationFrame(animateScroll);
      } else {
        element.scrollTop = to;
      }
    };
    animateScroll();
  },
  // ---
  // Collapse / expand layout
  setCollapsed: function setCollapsed() {
    var _this8 = this;
    var collapsed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('collapsed');
    var animate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return;
    this._unbindLayoutAnimationEndEvent();
    if (animate && this._supportsTransitionEnd()) {
      this._addClass('layout-transitioning');
      if (collapsed) this._setMenuHoverState(false);
      this._bindLayoutAnimationEndEvent(function () {
        // Collapse / Expand
        _this8._setCollapsed(collapsed);
      }, function () {
        _this8._removeClass('layout-transitioning');
        _this8._triggerWindowEvent('resize');
        _this8._triggerEvent('toggle');
        _this8._setMenuHoverState(false);
      });
    } else {
      this._addClass('layout-no-transition');
      if (collapsed) this._setMenuHoverState(false);

      // Collapse / Expand
      this._setCollapsed(collapsed);
      setTimeout(function () {
        _this8._removeClass('layout-no-transition');
        _this8._triggerWindowEvent('resize');
        _this8._triggerEvent('toggle');
        _this8._setMenuHoverState(false);
      }, 1);
    }
  },
  // ---
  // Toggle layout
  toggleCollapsed: function toggleCollapsed() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    this.setCollapsed(!this.isCollapsed(), animate);
  },
  // ---
  // Set layout positioning
  setPosition: function setPosition() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    var offcanvas = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : requiredParam('offcanvas');
    this._removeClass('layout-menu-offcanvas layout-menu-fixed layout-menu-fixed-offcanvas');
    if (!fixed && offcanvas) {
      this._addClass('layout-menu-offcanvas');
    } else if (fixed && !offcanvas) {
      this._addClass('layout-menu-fixed');
      this._redrawLayoutMenu();
    } else if (fixed && offcanvas) {
      this._addClass('layout-menu-fixed-offcanvas');
      this._redrawLayoutMenu();
    }
    this.update();
  },
  // *******************************************************************************
  // * Getters
  getLayoutMenu: function getLayoutMenu() {
    return document.querySelector('.layout-menu');
  },
  getMenu: function getMenu() {
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return null;
    return !this._hasClass('menu', layoutMenu) ? layoutMenu.querySelector('.menu') : layoutMenu;
  },
  getLayoutNavbar: function getLayoutNavbar() {
    return document.querySelector('.layout-navbar');
  },
  getLayoutFooter: function getLayoutFooter() {
    return document.querySelector('.content-footer');
  },
  getLayoutContainer: function getLayoutContainer() {
    return document.querySelector('.layout-page');
  },
  // *******************************************************************************
  // * Setters
  setNavbarFixed: function setNavbarFixed() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    this[fixed ? '_addClass' : '_removeClass']('layout-navbar-fixed');
    this.update();
  },
  setFooterFixed: function setFooterFixed() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    this[fixed ? '_addClass' : '_removeClass']('layout-footer-fixed');
    this.update();
  },
  setFlipped: function setFlipped() {
    var reversed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('reversed');
    this[reversed ? '_addClass' : '_removeClass']('layout-menu-flipped');
  },
  // *******************************************************************************
  // * Update
  update: function update() {
    if (this.getLayoutNavbar() && (!this.isSmallScreen() && this.isLayoutNavbarFull() && this.isFixed() || this.isNavbarFixed()) || this.getLayoutFooter() && this.isFooterFixed()) {
      this._updateInlineStyle(this._getNavbarHeight(), this._getFooterHeight());
    }
    this._bindMenuMouseEvents();
  },
  setAutoUpdate: function setAutoUpdate() {
    var _this9 = this;
    var enable = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('enable');
    if (enable && !this._autoUpdate) {
      this.on('resize.Helpers:autoUpdate', function () {
        return _this9.update();
      });
      this._autoUpdate = true;
    } else if (!enable && this._autoUpdate) {
      this.off('resize.Helpers:autoUpdate');
      this._autoUpdate = false;
    }
  },
  // Update custom option based on element
  updateCustomOptionCheck: function updateCustomOptionCheck(el) {
    if (el.checked) {
      // If custom option element is radio, remove checked from the siblings (closest `.row`)
      if (el.type === 'radio') {
        var customRadioOptionList = [].slice.call(el.closest('.row').querySelectorAll('.custom-option'));
        customRadioOptionList.map(function (customRadioOptionEL) {
          customRadioOptionEL.closest('.custom-option').classList.remove('checked');
        });
      }
      el.closest('.custom-option').classList.add('checked');
    } else {
      el.closest('.custom-option').classList.remove('checked');
    }
  },
  // *******************************************************************************
  // * Tests
  isRtl: function isRtl() {
    return document.querySelector('body').getAttribute('dir') === 'rtl' || document.querySelector('html').getAttribute('dir') === 'rtl';
  },
  isMobileDevice: function isMobileDevice() {
    return typeof window.orientation !== 'undefined' || navigator.userAgent.indexOf('IEMobile') !== -1;
  },
  isSmallScreen: function isSmallScreen() {
    return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) < this.LAYOUT_BREAKPOINT;
  },
  isLayoutNavbarFull: function isLayoutNavbarFull() {
    return !!document.querySelector('.layout-wrapper.layout-navbar-full');
  },
  isCollapsed: function isCollapsed() {
    if (this.isSmallScreen()) {
      return !this._hasClass('layout-menu-expanded');
    }
    return this._hasClass('layout-menu-collapsed');
  },
  isFixed: function isFixed() {
    return this._hasClass('layout-menu-fixed layout-menu-fixed-offcanvas');
  },
  isOffcanvas: function isOffcanvas() {
    return this._hasClass('layout-menu-offcanvas layout-menu-fixed-offcanvas');
  },
  isNavbarFixed: function isNavbarFixed() {
    return this._hasClass('layout-navbar-fixed') || !this.isSmallScreen() && this.isFixed() && this.isLayoutNavbarFull();
  },
  isFooterFixed: function isFooterFixed() {
    return this._hasClass('layout-footer-fixed');
  },
  isFlipped: function isFlipped() {
    return this._hasClass('layout-menu-flipped');
  },
  isLightStyle: function isLightStyle() {
    return document.documentElement.classList.contains('light-style');
  },
  isDarkStyle: function isDarkStyle() {
    return document.documentElement.classList.contains('dark-style');
  },
  // *******************************************************************************
  // * Events
  on: function on() {
    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('event');
    var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : requiredParam('callback');
    var _event$split = event.split('.'),
      _event$split2 = _slicedToArray(_event$split, 1),
      _event = _event$split2[0];
    var _event$split3 = event.split('.'),
      _event$split4 = _toArray(_event$split3),
      namespace = _event$split4.slice(1);
    // let [_event, ...namespace] = event.split('.')
    namespace = namespace.join('.') || null;
    this._listeners.push({
      event: _event,
      namespace: namespace,
      callback: callback
    });
  },
  off: function off() {
    var _this10 = this;
    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('event');
    var _event$split5 = event.split('.'),
      _event$split6 = _slicedToArray(_event$split5, 1),
      _event = _event$split6[0];
    var _event$split7 = event.split('.'),
      _event$split8 = _toArray(_event$split7),
      namespace = _event$split8.slice(1);
    namespace = namespace.join('.') || null;
    this._listeners.filter(function (listener) {
      return listener.event === _event && listener.namespace === namespace;
    }).forEach(function (listener) {
      return _this10._listeners.splice(_this10._listeners.indexOf(listener), 1);
    });
  },
  // *******************************************************************************
  // * Life cycle
  init: function init() {
    var _this11 = this;
    if (this._initialized) return;
    this._initialized = true;

    // Initialize `style` element
    this._updateInlineStyle(0);

    // Bind window resize event
    this._bindWindowResizeEvent();

    // Bind init event
    this.off('init._Helpers');
    this.on('init._Helpers', function () {
      _this11.off('resize._Helpers:redrawMenu');
      _this11.on('resize._Helpers:redrawMenu', function () {
        // eslint-disable-next-line no-unused-expressions
        _this11.isSmallScreen() && !_this11.isCollapsed() && _this11._redrawLayoutMenu();
      });

      // Force repaint in IE 10
      if (typeof document.documentMode === 'number' && document.documentMode < 11) {
        _this11.off('resize._Helpers:ie10RepaintBody');
        _this11.on('resize._Helpers:ie10RepaintBody', function () {
          if (_this11.isFixed()) return;
          var scrollTop = document.documentElement.scrollTop;
          document.body.style.display = 'none';
          // document.body.offsetHeight
          document.body.style.display = 'block';
          document.documentElement.scrollTop = scrollTop;
        });
      }
    });
    this._triggerEvent('init');
  },
  destroy: function destroy() {
    var _this12 = this;
    if (!this._initialized) return;
    this._initialized = false;
    this._removeClass('layout-transitioning');
    this._removeInlineStyle();
    this._unbindLayoutAnimationEndEvent();
    this._unbindWindowResizeEvent();
    this._unbindMenuMouseEvents();
    this.setAutoUpdate(false);
    this.off('init._Helpers');

    // Remove all listeners except `init`
    this._listeners.filter(function (listener) {
      return listener.event !== 'init';
    }).forEach(function (listener) {
      return _this12._listeners.splice(_this12._listeners.indexOf(listener), 1);
    });
  },
  // ---
  // Init Password Toggle
  initPasswordToggle: function initPasswordToggle() {
    var toggler = document.querySelectorAll('.form-password-toggle i');
    if (typeof toggler !== 'undefined' && toggler !== null) {
      toggler.forEach(function (el) {
        el.addEventListener('click', function (e) {
          e.preventDefault();
          var formPasswordToggle = el.closest('.form-password-toggle');
          var formPasswordToggleIcon = formPasswordToggle.querySelector('i');
          var formPasswordToggleInput = formPasswordToggle.querySelector('input');
          if (formPasswordToggleInput.getAttribute('type') === 'text') {
            formPasswordToggleInput.setAttribute('type', 'password');
            formPasswordToggleIcon.classList.replace('ti-eye', 'ti-eye-off');
          } else if (formPasswordToggleInput.getAttribute('type') === 'password') {
            formPasswordToggleInput.setAttribute('type', 'text');
            formPasswordToggleIcon.classList.replace('ti-eye-off', 'ti-eye');
          }
        });
      });
    }
  },
  //--
  // Init custom option check
  initCustomOptionCheck: function initCustomOptionCheck() {
    var _this = this;
    var custopOptionList = [].slice.call(document.querySelectorAll('.custom-option .form-check-input'));
    custopOptionList.map(function (customOptionEL) {
      // Update custom options check on page load
      _this.updateCustomOptionCheck(customOptionEL);

      // Update custom options check on click
      customOptionEL.addEventListener('click', function (e) {
        _this.updateCustomOptionCheck(customOptionEL);
      });
    });
  },
  // ---
  // Init Speech To Text
  initSpeechToText: function initSpeechToText() {
    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    var speechToText = document.querySelectorAll('.speech-to-text');
    if (SpeechRecognition !== undefined && SpeechRecognition !== null) {
      if (typeof speechToText !== 'undefined' && speechToText !== null) {
        var recognition = new SpeechRecognition();
        var toggler = document.querySelectorAll('.speech-to-text i');
        toggler.forEach(function (el) {
          var listening = false;
          el.addEventListener('click', function () {
            el.closest('.input-group').querySelector('.form-control').focus();
            recognition.onspeechstart = function () {
              listening = true;
            };
            if (listening === false) {
              recognition.start();
            }
            recognition.onerror = function () {
              listening = false;
            };
            recognition.onresult = function (event) {
              el.closest('.input-group').querySelector('.form-control').value = event.results[0][0].transcript;
            };
            recognition.onspeechend = function () {
              listening = false;
              recognition.stop();
            };
          });
        });
      }
    }
  },
  // ---
  // Init Navbar Dropdown (i.e notification) PerfectScrollbar
  initNavbarDropdownScrollbar: function initNavbarDropdownScrollbar() {
    var scrollbarContainer = document.querySelectorAll('.navbar-dropdown .scrollable-container');
    var _window4 = window,
      PerfectScrollbar = _window4.PerfectScrollbar;
    if (PerfectScrollbar !== undefined) {
      if (typeof scrollbarContainer !== 'undefined' && scrollbarContainer !== null) {
        scrollbarContainer.forEach(function (el) {
          // eslint-disable-next-line no-new
          new PerfectScrollbar(el, {
            wheelPropagation: false,
            suppressScrollX: true
          });
        });
      }
    }
  },
  // Ajax Call Promise
  ajaxCall: function ajaxCall(url) {
    return new Promise(function (resolve, reject) {
      var req = new XMLHttpRequest();
      req.open('GET', url);
      req.onload = function () {
        return req.status === 200 ? resolve(req.response) : reject(Error(req.statusText));
      };
      req.onerror = function (e) {
        return reject(Error("Network Error: ".concat(e)));
      };
      req.send();
    });
  },
  // ---
  // SidebarToggle (Used in Apps)
  initSidebarToggle: function initSidebarToggle() {
    var sidebarToggler = document.querySelectorAll('[data-bs-toggle="sidebar"]');
    sidebarToggler.forEach(function (el) {
      el.addEventListener('click', function () {
        var target = el.getAttribute('data-target');
        var overlay = el.getAttribute('data-overlay');
        var appOverlay = document.querySelectorAll('.app-overlay');
        var targetEl = document.querySelectorAll(target);
        targetEl.forEach(function (tel) {
          tel.classList.toggle('show');
          if (typeof overlay !== 'undefined' && overlay !== null && overlay !== false && typeof appOverlay !== 'undefined') {
            if (tel.classList.contains('show')) {
              appOverlay[0].classList.add('show');
            } else {
              appOverlay[0].classList.remove('show');
            }
            appOverlay[0].addEventListener('click', function (e) {
              e.currentTarget.classList.remove('show');
              tel.classList.remove('show');
            });
          }
        });
      });
    });
  }
};

// *******************************************************************************
// * Initialization

if (typeof window !== 'undefined') {
  Helpers.init();
  if (Helpers.isMobileDevice() && window.chrome) {
    document.documentElement.classList.add('layout-menu-100vh');
  }

  // Update layout after page load
  if (document.readyState === 'complete') Helpers.update();else document.addEventListener('DOMContentLoaded', function onContentLoaded() {
    Helpers.update();
    document.removeEventListener('DOMContentLoaded', onContentLoaded);
  });
}

// ---

/******/ 	return __webpack_exports__;
/******/ })()
;
});