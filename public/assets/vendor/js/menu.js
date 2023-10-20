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
/*!********************************************!*\
  !*** ./resources/assets/vendor/js/menu.js ***!
  \********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Menu: function() { return /* binding */ Menu; }
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var TRANSITION_EVENTS = ['transitionend', 'webkitTransitionEnd', 'oTransitionEnd'];
// const TRANSITION_PROPERTIES = ['transition', 'MozTransition', 'webkitTransition', 'WebkitTransition', 'OTransition']
var DELTA = 5;
var Menu = /*#__PURE__*/function () {
  function Menu(el) {
    var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var _PS = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    _classCallCheck(this, Menu);
    this._el = el;
    this._horizontal = config.orientation === 'horizontal';
    this._animate = config.animate !== false;
    this._accordion = config.accordion !== false;
    this._showDropdownOnHover = Boolean(config.showDropdownOnHover);
    this._closeChildren = Boolean(config.closeChildren);
    this._rtl = document.documentElement.getAttribute('dir') === 'rtl' || document.body.getAttribute('dir') === 'rtl';
    this._onOpen = config.onOpen || function () {};
    this._onOpened = config.onOpened || function () {};
    this._onClose = config.onClose || function () {};
    this._onClosed = config.onClosed || function () {};
    this._psScroll = null;
    this._topParent = null;
    this._menuBgClass = null;
    el.classList.add('menu');
    el.classList[this._animate ? 'remove' : 'add']('menu-no-animation');
    if (!this._horizontal) {
      el.classList.add('menu-vertical');
      el.classList.remove('menu-horizontal');
      var PerfectScrollbarLib = _PS || window.PerfectScrollbar;
      if (PerfectScrollbarLib) {
        this._scrollbar = new PerfectScrollbarLib(el.querySelector('.menu-inner'), {
          suppressScrollX: true,
          wheelPropagation: !Menu._hasClass('layout-menu-fixed layout-menu-fixed-offcanvas')
        });
        window.Helpers.menuPsScroll = this._scrollbar;
      } else {
        el.querySelector('.menu-inner').classList.add('overflow-auto');
      }
    } else {
      el.classList.add('menu-horizontal');
      el.classList.remove('menu-vertical');
      this._inner = el.querySelector('.menu-inner');
      var container = this._inner.parentNode;
      this._prevBtn = el.querySelector('.menu-horizontal-prev');
      if (!this._prevBtn) {
        this._prevBtn = document.createElement('a');
        this._prevBtn.href = '#';
        this._prevBtn.className = 'menu-horizontal-prev';
        container.appendChild(this._prevBtn);
      }
      this._wrapper = el.querySelector('.menu-horizontal-wrapper');
      if (!this._wrapper) {
        this._wrapper = document.createElement('div');
        this._wrapper.className = 'menu-horizontal-wrapper';
        this._wrapper.appendChild(this._inner);
        container.appendChild(this._wrapper);
      }
      this._nextBtn = el.querySelector('.menu-horizontal-next');
      if (!this._nextBtn) {
        this._nextBtn = document.createElement('a');
        this._nextBtn.href = '#';
        this._nextBtn.className = 'menu-horizontal-next';
        container.appendChild(this._nextBtn);
      }
      this._innerPosition = 0;
      this.update();
    }

    // Add data attribute for bg color class of menu
    var menuClassList = el.classList;
    for (var i = 0; i < menuClassList.length; i++) {
      if (menuClassList[i].startsWith('bg-')) {
        this._menuBgClass = menuClassList[i];
      }
    }
    el.setAttribute('data-bg-class', this._menuBgClass);

    // Switch to vertical menu on small screen for horizontal menu layout on page load
    if (this._horizontal && window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) this.switchMenu('vertical');
    this._bindEvents();

    // Link menu instance to element
    el.menuInstance = this;
  }
  _createClass(Menu, [{
    key: "_bindEvents",
    value: function _bindEvents() {
      var _this = this;
      // Click Event
      this._evntElClick = function (e) {
        // Find top parent element
        if (e.target.closest('ul') && e.target.closest('ul').classList.contains('menu-inner')) {
          var menuItem = Menu._findParent(e.target, 'menu-item', false);

          // eslint-disable-next-line prefer-destructuring
          if (menuItem) _this._topParent = menuItem.childNodes[0];
        }
        var toggleLink = e.target.classList.contains('menu-toggle') ? e.target : Menu._findParent(e.target, 'menu-toggle', false);
        if (toggleLink) {
          e.preventDefault();
          if (toggleLink.getAttribute('data-hover') !== 'true') {
            _this.toggle(toggleLink);
          }
        }
      };
      if (!this._showDropdownOnHover && this._horizontal || !this._horizontal || window.Helpers.isMobileDevice) this._el.addEventListener('click', this._evntElClick);
      this._evntWindowResize = function () {
        _this.update();
        if (_this._lastWidth !== window.innerWidth) {
          _this._lastWidth = window.innerWidth;
          _this.update();
        }
        var horizontalMenuTemplate = document.querySelector("[data-template^='horizontal-menu']");
        if (!_this._horizontal && !horizontalMenuTemplate) _this.manageScroll();
      };
      window.addEventListener('resize', this._evntWindowResize);
      if (this._horizontal) {
        this._evntPrevBtnClick = function (e) {
          e.preventDefault();
          if (_this._prevBtn.classList.contains('disabled')) return;
          _this._slide('prev');
        };
        this._prevBtn.addEventListener('click', this._evntPrevBtnClick);
        this._evntNextBtnClick = function (e) {
          e.preventDefault();
          if (_this._nextBtn.classList.contains('disabled')) return;
          _this._slide('next');
        };
        this._nextBtn.addEventListener('click', this._evntNextBtnClick);
        this._evntBodyClick = function (e) {
          if (!_this._inner.contains(e.target) && _this._el.querySelectorAll('.menu-inner > .menu-item.open').length) _this.closeAll();
        };
        document.body.addEventListener('click', this._evntBodyClick);
        if (this._showDropdownOnHover) {
          /** ***********************************************
           * Horizontal Menu Mouse Over Event
           * ? e.target !== e.currentTarget condition to disable mouseover event on whole menu navbar
           * ? !e.target.parentNode.classList.contains('open') to disable mouseover events on icon, text and dropdown arrow
           */
          this._evntElMouseOver = function (e) {
            if (e.target !== e.currentTarget && !e.target.parentNode.classList.contains('open')) {
              var toggleLink = e.target.classList.contains('menu-toggle') ? e.target : null;
              if (toggleLink) {
                e.preventDefault();
                if (toggleLink.getAttribute('data-hover') !== 'true') {
                  _this.toggle(toggleLink);
                }
              }
            }
            e.stopPropagation();
          };
          if (this._horizontal && window.screen.width > window.Helpers.LAYOUT_BREAKPOINT) {
            this._el.addEventListener('mouseover', this._evntElMouseOver);
          }

          /** ***********************************************
           * Horizontal Menu Mouse Out Event
           * ? e.target !== e.currentTarget condition to disable mouseout event on whole menu navbar
           * ? mouseOutEl.parentNode.classList.contains('open') to check if the mouseout element has open class or not
           * ? !mouseOutEl.classList.contains('menu-toggle') to check if mouseout was from single menu item and not from the one which has submenu
           * ? !mouseOverEl.parentNode.classList.contains('menu-link') to disable mouseout event for icon, text and dropdown arrow
           */
          this._evntElMouseOut = function (e) {
            var mainEl = e.currentTarget;
            var mouseOutEl = e.target;
            var mouseOverEl = e.toElement || e.relatedTarget;

            // Find absolute parent of any menu item from which mouseout event triggered
            if (mouseOutEl.closest('ul') && mouseOutEl.closest('ul').classList.contains('menu-inner')) {
              _this._topParent = mouseOutEl;
            }
            if (mouseOutEl !== mainEl && (mouseOutEl.parentNode.classList.contains('open') || !mouseOutEl.classList.contains('menu-toggle')) && mouseOverEl && mouseOverEl.parentNode && !mouseOverEl.parentNode.classList.contains('menu-link')) {
              // When mouse goes totally out of menu items, check mouse over element to confirm it's not the child of menu, once confirmed close the menu
              if (_this._topParent && !Menu.childOf(mouseOverEl, _this._topParent.parentNode)) {
                var _toggleLink = _this._topParent.classList.contains('menu-toggle') ? _this._topParent : null;
                if (_toggleLink) {
                  e.preventDefault();
                  if (_toggleLink.getAttribute('data-hover') !== 'true') {
                    _this.toggle(_toggleLink);
                    _this._topParent = null;
                  }
                }
              }

              // When mouse enter the sub menu, check if it's child of the initially mouse overed menu item(Actual Parent),
              // if it's the parent do not close the sub menu else close the sub menu
              if (Menu.childOf(mouseOverEl, mouseOutEl.parentNode)) {
                return;
              }
              var toggleLink = mouseOutEl.classList.contains('menu-toggle') ? mouseOutEl : null;
              if (toggleLink) {
                e.preventDefault();
                if (toggleLink.getAttribute('data-hover') !== 'true') {
                  _this.toggle(toggleLink);
                }
              }
            }
            e.stopPropagation();
          };
          if (this._horizontal && window.screen.width > window.Helpers.LAYOUT_BREAKPOINT) {
            this._el.addEventListener('mouseout', this._evntElMouseOut);
          }
        }
      }
    }
  }, {
    key: "_unbindEvents",
    value: function _unbindEvents() {
      if (this._evntElClick) {
        this._el.removeEventListener('click', this._evntElClick);
        this._evntElClick = null;
      }
      if (this._evntElMouseOver) {
        this._el.removeEventListener('mouseover', this._evntElMouseOver);
        this._evntElMouseOver = null;
      }
      if (this._evntElMouseOut) {
        this._el.removeEventListener('mouseout', this._evntElMouseOut);
        this._evntElMouseOut = null;
      }
      if (this._evntWindowResize) {
        window.removeEventListener('resize', this._evntWindowResize);
        this._evntWindowResize = null;
      }
      if (this._evntBodyClick) {
        document.body.removeEventListener('click', this._evntBodyClick);
        this._evntBodyClick = null;
      }
      if (this._evntInnerMousemove) {
        this._inner.removeEventListener('mousemove', this._evntInnerMousemove);
        this._evntInnerMousemove = null;
      }
      if (this._evntInnerMouseleave) {
        this._inner.removeEventListener('mouseleave', this._evntInnerMouseleave);
        this._evntInnerMouseleave = null;
      }
    }
  }, {
    key: "open",
    value: function open(el) {
      var _this2 = this;
      var closeChildren = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this._closeChildren;
      var item = this._findUnopenedParent(Menu._getItem(el, true), closeChildren);
      if (!item) return;
      var toggleLink = Menu._getLink(item, true);
      Menu._promisify(this._onOpen, this, item, toggleLink, Menu._findMenu(item)).then(function () {
        if (!_this2._horizontal || !Menu._isRoot(item)) {
          if (_this2._animate && !_this2._horizontal) {
            window.requestAnimationFrame(function () {
              return _this2._toggleAnimation(true, item, false);
            });
            if (_this2._accordion) _this2._closeOther(item, closeChildren);
          } else if (_this2._animate) {
            _this2._toggleDropdown(true, item, closeChildren);
            // eslint-disable-next-line no-unused-expressions
            _this2._onOpened && _this2._onOpened(_this2, item, toggleLink, Menu._findMenu(item));
          } else {
            item.classList.add('open');
            // eslint-disable-next-line no-unused-expressions
            _this2._onOpened && _this2._onOpened(_this2, item, toggleLink, Menu._findMenu(item));
            if (_this2._accordion) _this2._closeOther(item, closeChildren);
          }
        } else {
          _this2._toggleDropdown(true, item, closeChildren);
          // eslint-disable-next-line no-unused-expressions
          _this2._onOpened && _this2._onOpened(_this2, item, toggleLink, Menu._findMenu(item));
        }
      })["catch"](function () {});
    }
  }, {
    key: "close",
    value: function close(el) {
      var _this3 = this;
      var closeChildren = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this._closeChildren;
      var _autoClose = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
      var item = Menu._getItem(el, true);
      var toggleLink = Menu._getLink(el, true);
      if (!item.classList.contains('open') || item.classList.contains('disabled')) return;
      Menu._promisify(this._onClose, this, item, toggleLink, Menu._findMenu(item), _autoClose).then(function () {
        if (!_this3._horizontal || !Menu._isRoot(item)) {
          if (_this3._animate && !_this3._horizontal) {
            window.requestAnimationFrame(function () {
              return _this3._toggleAnimation(false, item, closeChildren);
            });
          } else {
            item.classList.remove('open');
            if (closeChildren) {
              var opened = item.querySelectorAll('.menu-item.open');
              for (var i = 0, l = opened.length; i < l; i++) opened[i].classList.remove('open');
            }

            // eslint-disable-next-line no-unused-expressions
            _this3._onClosed && _this3._onClosed(_this3, item, toggleLink, Menu._findMenu(item));
          }
        } else {
          _this3._toggleDropdown(false, item, closeChildren);
          // eslint-disable-next-line no-unused-expressions
          _this3._onClosed && _this3._onClosed(_this3, item, toggleLink, Menu._findMenu(item));
        }
      })["catch"](function () {});
    }
  }, {
    key: "_closeOther",
    value: function _closeOther(item, closeChildren) {
      var opened = Menu._findChild(item.parentNode, ['menu-item', 'open']);
      for (var i = 0, l = opened.length; i < l; i++) {
        if (opened[i] !== item) this.close(opened[i], closeChildren);
      }
    }
  }, {
    key: "toggle",
    value: function toggle(el) {
      var closeChildren = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this._closeChildren;
      var item = Menu._getItem(el, true);
      // const toggleLink = Menu._getLink(el, true)

      if (item.classList.contains('open')) this.close(item, closeChildren);else this.open(item, closeChildren);
    }
  }, {
    key: "_toggleDropdown",
    value: function _toggleDropdown(show, item, closeChildren) {
      var menu = Menu._findMenu(item);
      var actualItem = item;
      var subMenuItem = false;
      if (show) {
        if (Menu._findParent(item, 'menu-sub', false)) {
          subMenuItem = true;
          item = this._topParent ? this._topParent.parentNode : item;
        }
        var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
        var position = this._innerPosition;
        var itemOffset = this._getItemOffset(item);
        var itemWidth = Math.round(item.getBoundingClientRect().width);
        if (itemOffset - DELTA <= -1 * position) {
          this._innerPosition = -1 * itemOffset;
        } else if (itemOffset + position + itemWidth + DELTA >= wrapperWidth) {
          if (itemWidth > wrapperWidth) {
            this._innerPosition = -1 * itemOffset;
          } else {
            this._innerPosition = -1 * (itemOffset + itemWidth - wrapperWidth);
          }
        }
        actualItem.classList.add('open');
        var menuWidth = Math.round(menu.getBoundingClientRect().width);
        if (subMenuItem) {
          if (itemOffset + this._innerPosition + menuWidth * 2 > wrapperWidth && menuWidth < wrapperWidth && menuWidth >= itemWidth) {
            menu.style.left = [this._rtl ? '100%' : '-100%'];
          }
        } else if (itemOffset + this._innerPosition + menuWidth > wrapperWidth && menuWidth < wrapperWidth && menuWidth > itemWidth) {
          menu.style[this._rtl ? 'marginRight' : 'marginLeft'] = "-".concat(menuWidth - itemWidth, "px");
        }
        this._closeOther(actualItem, closeChildren);
        this._updateSlider();
      } else {
        var toggle = Menu._findChild(item, ['menu-toggle']);

        // eslint-disable-next-line no-unused-expressions
        toggle.length && toggle[0].removeAttribute('data-hover', 'true');
        item.classList.remove('open');
        menu.style[this._rtl ? 'marginRight' : 'marginLeft'] = null;
        if (closeChildren) {
          var opened = menu.querySelectorAll('.menu-item.open');
          for (var i = 0, l = opened.length; i < l; i++) opened[i].classList.remove('open');
        }
      }
    }
  }, {
    key: "_slide",
    value: function _slide(direction) {
      var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
      var innerWidth = this._innerWidth;
      var newPosition;
      if (direction === 'next') {
        newPosition = this._getSlideNextPos();
        if (innerWidth + newPosition < wrapperWidth) {
          newPosition = wrapperWidth - innerWidth;
        }
      } else {
        newPosition = this._getSlidePrevPos();
        if (newPosition > 0) newPosition = 0;
      }
      this._innerPosition = newPosition;
      this.update();
    }
  }, {
    key: "_getSlideNextPos",
    value: function _getSlideNextPos() {
      var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
      var position = this._innerPosition;
      var curItem = this._inner.childNodes[0];
      var left = 0;
      while (curItem) {
        if (curItem.tagName) {
          var curItemWidth = Math.round(curItem.getBoundingClientRect().width);
          if (left + position - DELTA <= wrapperWidth && left + position + curItemWidth + DELTA >= wrapperWidth) {
            if (curItemWidth > wrapperWidth && left === -1 * position) left += curItemWidth;
            break;
          }
          left += curItemWidth;
        }
        curItem = curItem.nextSibling;
      }
      return -1 * left;
    }
  }, {
    key: "_getSlidePrevPos",
    value: function _getSlidePrevPos() {
      var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
      var position = this._innerPosition;
      var curItem = this._inner.childNodes[0];
      var left = 0;
      while (curItem) {
        if (curItem.tagName) {
          var curItemWidth = Math.round(curItem.getBoundingClientRect().width);
          if (left - DELTA <= -1 * position && left + curItemWidth + DELTA >= -1 * position) {
            if (curItemWidth <= wrapperWidth) left = left + curItemWidth - wrapperWidth;
            break;
          }
          left += curItemWidth;
        }
        curItem = curItem.nextSibling;
      }
      return -1 * left;
    }
  }, {
    key: "_findUnopenedParent",
    value: function _findUnopenedParent(item, closeChildren) {
      var tree = [];
      var parentItem = null;
      while (item) {
        if (item.classList.contains('disabled')) {
          parentItem = null;
          tree = [];
        } else {
          if (!item.classList.contains('open')) parentItem = item;
          tree.push(item);
        }
        item = Menu._findParent(item, 'menu-item', false);
      }
      if (!parentItem) return null;
      if (tree.length === 1) return parentItem;
      tree = tree.slice(0, tree.indexOf(parentItem));
      for (var i = 0, l = tree.length; i < l; i++) {
        tree[i].classList.add('open');
        if (this._accordion) {
          var openedItems = Menu._findChild(tree[i].parentNode, ['menu-item', 'open']);
          for (var j = 0, k = openedItems.length; j < k; j++) {
            if (openedItems[j] !== tree[i]) {
              openedItems[j].classList.remove('open');
              if (closeChildren) {
                var openedChildren = openedItems[j].querySelectorAll('.menu-item.open');
                for (var x = 0, z = openedChildren.length; x < z; x++) {
                  openedChildren[x].classList.remove('open');
                }
              }
            }
          }
        }
      }
      return parentItem;
    }
  }, {
    key: "_toggleAnimation",
    value: function _toggleAnimation(open, item, closeChildren) {
      var _this4 = this;
      var toggleLink = Menu._getLink(item, true);
      var menu = Menu._findMenu(item);
      Menu._unbindAnimationEndEvent(item);
      var linkHeight = Math.round(toggleLink.getBoundingClientRect().height);
      item.style.overflow = 'hidden';
      var clearItemStyle = function clearItemStyle() {
        item.classList.remove('menu-item-animating');
        item.classList.remove('menu-item-closing');
        item.style.overflow = null;
        item.style.height = null;
        if (!_this4._horizontal) _this4.update();
      };
      if (open) {
        item.style.height = "".concat(linkHeight, "px");
        item.classList.add('menu-item-animating');
        item.classList.add('open');
        Menu._bindAnimationEndEvent(item, function () {
          clearItemStyle();
          _this4._onOpened(_this4, item, toggleLink, menu);
        });
        setTimeout(function () {
          item.style.height = "".concat(linkHeight + Math.round(menu.getBoundingClientRect().height), "px");
        }, 50);
      } else {
        item.style.height = "".concat(linkHeight + Math.round(menu.getBoundingClientRect().height), "px");
        item.classList.add('menu-item-animating');
        item.classList.add('menu-item-closing');
        Menu._bindAnimationEndEvent(item, function () {
          item.classList.remove('open');
          clearItemStyle();
          if (closeChildren) {
            var opened = item.querySelectorAll('.menu-item.open');
            for (var i = 0, l = opened.length; i < l; i++) opened[i].classList.remove('open');
          }
          _this4._onClosed(_this4, item, toggleLink, menu);
        });
        setTimeout(function () {
          item.style.height = "".concat(linkHeight, "px");
        }, 50);
      }
    }
  }, {
    key: "_getItemOffset",
    value: function _getItemOffset(item) {
      var curItem = this._inner.childNodes[0];
      var left = 0;
      while (curItem !== item) {
        if (curItem.tagName) {
          left += Math.round(curItem.getBoundingClientRect().width);
        }
        curItem = curItem.nextSibling;
      }
      return left;
    }
  }, {
    key: "_updateSlider",
    value: function _updateSlider() {
      var wrapperWidth = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var innerWidth = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var position = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
      var _wrapperWidth = wrapperWidth !== null ? wrapperWidth : Math.round(this._wrapper.getBoundingClientRect().width);
      var _innerWidth = innerWidth !== null ? innerWidth : this._innerWidth;
      var _position = position !== null ? position : this._innerPosition;
      if (_innerWidth < _wrapperWidth || window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
        this._prevBtn.classList.add('d-none');
        this._nextBtn.classList.add('d-none');
      } else {
        this._prevBtn.classList.remove('d-none');
        this._nextBtn.classList.remove('d-none');
      }
      if (_innerWidth > _wrapperWidth && window.innerWidth > window.Helpers.LAYOUT_BREAKPOINT) {
        if (_position === 0) this._prevBtn.classList.add('disabled');else this._prevBtn.classList.remove('disabled');
        if (_innerWidth + _position <= _wrapperWidth) this._nextBtn.classList.add('disabled');else this._nextBtn.classList.remove('disabled');
      }
    }
  }, {
    key: "_innerWidth",
    get: function get() {
      var items = this._inner.childNodes;
      var width = 0;
      for (var i = 0, l = items.length; i < l; i++) {
        if (items[i].tagName) {
          width += Math.round(items[i].getBoundingClientRect().width);
        }
      }
      return width;
    }
  }, {
    key: "_innerPosition",
    get: function get() {
      return parseInt(this._inner.style[this._rtl ? 'marginRight' : 'marginLeft'] || '0px', 10);
    },
    set: function set(value) {
      this._inner.style[this._rtl ? 'marginRight' : 'marginLeft'] = "".concat(value, "px");
      return value;
    }
  }, {
    key: "closeAll",
    value: function closeAll() {
      var closeChildren = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this._closeChildren;
      var opened = this._el.querySelectorAll('.menu-inner > .menu-item.open');
      for (var i = 0, l = opened.length; i < l; i++) this.close(opened[i], closeChildren);
    }
  }, {
    key: "update",
    value: function update() {
      if (!this._horizontal) {
        if (this._scrollbar) {
          this._scrollbar.update();
        }
      } else {
        this.closeAll();
        var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
        var innerWidth = this._innerWidth;
        var position = this._innerPosition;
        if (wrapperWidth - position > innerWidth) {
          position = wrapperWidth - innerWidth;
          if (position > 0) position = 0;
          this._innerPosition = position;
        }
        this._updateSlider(wrapperWidth, innerWidth, position);
      }
    }
  }, {
    key: "manageScroll",
    value: function manageScroll() {
      var _window = window,
        PerfectScrollbar = _window.PerfectScrollbar;
      var menuInner = document.querySelector('.menu-inner');
      if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
        if (this._scrollbar !== null) {
          // window.Helpers.menuPsScroll.destroy()
          this._scrollbar.destroy();
          this._scrollbar = null;
        }
        menuInner.classList.add('overflow-auto');
      } else {
        if (this._scrollbar === null) {
          var menuScroll = new PerfectScrollbar(document.querySelector('.menu-inner'), {
            suppressScrollX: true,
            wheelPropagation: false
          });
          // window.Helpers.menuPsScroll = menuScroll
          this._scrollbar = menuScroll;
        }
        menuInner.classList.remove('overflow-auto');
      }
    }
  }, {
    key: "switchMenu",
    value: function switchMenu(menu) {
      // Unbind Events
      this._unbindEvents();

      // const html = document.documentElement
      var navbar = document.querySelector('nav.layout-navbar');
      var navbarCollapse = document.querySelector('#navbar-collapse');
      /* const fullNavbar = document.querySelector('.layout-navbar-full')
      const contentNavbar = document.querySelector('.layout-content-navbar')
      const contentWrapper = document.querySelector('.content-wrapper') */
      var asideMenuWrapper = document.querySelector('#layout-menu div');
      var asideMenu = document.querySelector('#layout-menu');
      var horzMenuClasses = ['layout-menu-horizontal', 'menu', 'menu-horizontal', 'container-fluid', 'flex-grow-0'];
      var vertMenuClasses = ['layout-menu', 'menu', 'menu-vertical'];
      var horzMenuWrapper = document.querySelector('.menu-horizontal-wrapper');
      var menuInner = document.querySelector('.menu-inner');
      var brand = document.querySelector('.app-brand');
      var menuToggler = document.querySelector('.layout-menu-toggle');
      var activeMenuItems = document.querySelectorAll('.menu-inner .active');
      /* const layoutPage = document.querySelector('.layout-page')
      const layoutContainer = document.querySelector('.layout-container')
      const content = document.querySelector('.container-fluid') */

      // const { PerfectScrollbar } = window

      if (menu === 'vertical') {
        var _asideMenu$classList, _asideMenu$classList2;
        this._horizontal = false;
        asideMenuWrapper.insertBefore(brand, horzMenuWrapper);
        asideMenuWrapper.insertBefore(menuInner, horzMenuWrapper);
        asideMenuWrapper.classList.add('flex-column', 'p-0');
        (_asideMenu$classList = asideMenu.classList).remove.apply(_asideMenu$classList, _toConsumableArray(asideMenu.classList));
        (_asideMenu$classList2 = asideMenu.classList).add.apply(_asideMenu$classList2, vertMenuClasses.concat([this._menuBgClass]));
        brand.classList.remove('d-none', 'd-lg-flex');
        menuToggler.classList.remove('d-none');
        // if (PerfectScrollbar !== undefined) {
        //   this._psScroll = new PerfectScrollbar(document.querySelector('.menu-inner'), {
        //     suppressScrollX: true,
        //     wheelPropagation: !Menu._hasClass('layout-menu-fixed layout-menu-fixed-offcanvas')
        //   })
        // }

        menuInner.classList.add('overflow-auto');

        // Add open class to active items
        for (var i = 0; i < activeMenuItems.length - 1; ++i) {
          activeMenuItems[i].classList.add('open');
        }
      } else {
        var _asideMenu$classList3, _asideMenu$classList4;
        this._horizontal = true;
        navbar.children[0].insertBefore(brand, navbarCollapse);
        brand.classList.add('d-none', 'd-lg-flex');
        horzMenuWrapper.appendChild(menuInner);
        asideMenuWrapper.classList.remove('flex-column', 'p-0');
        (_asideMenu$classList3 = asideMenu.classList).remove.apply(_asideMenu$classList3, _toConsumableArray(asideMenu.classList));
        (_asideMenu$classList4 = asideMenu.classList).add.apply(_asideMenu$classList4, horzMenuClasses.concat([this._menuBgClass]));
        menuToggler.classList.add('d-none');
        menuInner.classList.remove('overflow-auto');

        // if (PerfectScrollbar !== undefined && this._psScroll !== null) {
        //   this._psScroll.destroy()
        //   this._psScroll = null
        // }

        // Remove open class from active items
        for (var _i = 0; _i < activeMenuItems.length; ++_i) {
          activeMenuItems[_i].classList.remove('open');
        }
      }
      this._bindEvents();
    }
  }, {
    key: "destroy",
    value: function destroy() {
      if (!this._el) return;
      this._unbindEvents();
      var items = this._el.querySelectorAll('.menu-item');
      for (var i = 0, l = items.length; i < l; i++) {
        Menu._unbindAnimationEndEvent(items[i]);
        items[i].classList.remove('menu-item-animating');
        items[i].classList.remove('open');
        items[i].style.overflow = null;
        items[i].style.height = null;
      }
      var menus = this._el.querySelectorAll('.menu-menu');
      for (var i2 = 0, l2 = menus.length; i2 < l2; i2++) {
        menus[i2].style.marginRight = null;
        menus[i2].style.marginLeft = null;
      }
      this._el.classList.remove('menu-no-animation');
      if (this._wrapper) {
        this._prevBtn.parentNode.removeChild(this._prevBtn);
        this._nextBtn.parentNode.removeChild(this._nextBtn);
        this._wrapper.parentNode.insertBefore(this._inner, this._wrapper);
        this._wrapper.parentNode.removeChild(this._wrapper);
        this._inner.style.marginLeft = null;
        this._inner.style.marginRight = null;
      }
      this._el.menuInstance = null;
      delete this._el.menuInstance;
      this._el = null;
      this._horizontal = null;
      this._animate = null;
      this._accordion = null;
      this._showDropdownOnHover = null;
      this._closeChildren = null;
      this._rtl = null;
      this._onOpen = null;
      this._onOpened = null;
      this._onClose = null;
      this._onClosed = null;
      if (this._scrollbar) {
        this._scrollbar.destroy();
        this._scrollbar = null;
      }
      this._inner = null;
      this._prevBtn = null;
      this._wrapper = null;
      this._nextBtn = null;
    }
  }], [{
    key: "childOf",
    value: function childOf( /* child node */c, /* parent node */p) {
      // returns boolean
      if (c.parentNode) {
        while ((c = c.parentNode) && c !== p);
        return !!c;
      }
      return false;
    }
  }, {
    key: "_isRoot",
    value: function _isRoot(item) {
      return !Menu._findParent(item, 'menu-item', false);
    }
  }, {
    key: "_findParent",
    value: function _findParent(el, cls) {
      var throwError = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      if (el.tagName.toUpperCase() === 'BODY') return null;
      el = el.parentNode;
      while (el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
        el = el.parentNode;
      }
      el = el.tagName.toUpperCase() !== 'BODY' ? el : null;
      if (!el && throwError) throw new Error("Cannot find `.".concat(cls, "` parent element"));
      return el;
    }
  }, {
    key: "_findChild",
    value: function _findChild(el, cls) {
      var items = el.childNodes;
      var found = [];
      for (var i = 0, l = items.length; i < l; i++) {
        if (items[i].classList) {
          var passed = 0;
          for (var j = 0; j < cls.length; j++) {
            if (items[i].classList.contains(cls[j])) passed += 1;
          }
          if (cls.length === passed) found.push(items[i]);
        }
      }
      return found;
    }
  }, {
    key: "_findMenu",
    value: function _findMenu(item) {
      var curEl = item.childNodes[0];
      var menu = null;
      while (curEl && !menu) {
        if (curEl.classList && curEl.classList.contains('menu-sub')) menu = curEl;
        curEl = curEl.nextSibling;
      }
      if (!menu) throw new Error('Cannot find `.menu-sub` element for the current `.menu-toggle`');
      return menu;
    }

    // Has class
  }, {
    key: "_hasClass",
    value: function _hasClass(cls) {
      var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : window.Helpers.ROOT_EL;
      var result = false;
      cls.split(' ').forEach(function (c) {
        if (el.classList.contains(c)) result = true;
      });
      return result;
    }
  }, {
    key: "_getItem",
    value: function _getItem(el, toggle) {
      var item = null;
      var selector = toggle ? 'menu-toggle' : 'menu-link';
      if (el.classList.contains('menu-item')) {
        if (Menu._findChild(el, [selector]).length) item = el;
      } else if (el.classList.contains(selector)) {
        item = el.parentNode.classList.contains('menu-item') ? el.parentNode : null;
      }
      if (!item) {
        throw new Error("".concat(toggle ? 'Toggable ' : '', "`.menu-item` element not found."));
      }
      return item;
    }
  }, {
    key: "_getLink",
    value: function _getLink(el, toggle) {
      var found = [];
      var selector = toggle ? 'menu-toggle' : 'menu-link';
      if (el.classList.contains(selector)) found = [el];else if (el.classList.contains('menu-item')) found = Menu._findChild(el, [selector]);
      if (!found.length) throw new Error("`".concat(selector, "` element not found."));
      return found[0];
    }
  }, {
    key: "_bindAnimationEndEvent",
    value: function _bindAnimationEndEvent(el, handler) {
      var cb = function cb(e) {
        if (e.target !== el) return;
        Menu._unbindAnimationEndEvent(el);
        handler(e);
      };
      var duration = window.getComputedStyle(el).transitionDuration;
      duration = parseFloat(duration) * (duration.indexOf('ms') !== -1 ? 1 : 1000);
      el._menuAnimationEndEventCb = cb;
      TRANSITION_EVENTS.forEach(function (ev) {
        return el.addEventListener(ev, el._menuAnimationEndEventCb, false);
      });
      el._menuAnimationEndEventTimeout = setTimeout(function () {
        cb({
          target: el
        });
      }, duration + 50);
    }
  }, {
    key: "_promisify",
    value: function _promisify(fn) {
      for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        args[_key - 1] = arguments[_key];
      }
      var result = fn.apply(void 0, args);
      if (result instanceof Promise) {
        return result;
      }
      if (result === false) {
        return Promise.reject();
      }
      return Promise.resolve();
    }
  }, {
    key: "_unbindAnimationEndEvent",
    value: function _unbindAnimationEndEvent(el) {
      var cb = el._menuAnimationEndEventCb;
      if (el._menuAnimationEndEventTimeout) {
        clearTimeout(el._menuAnimationEndEventTimeout);
        el._menuAnimationEndEventTimeout = null;
      }
      if (!cb) return;
      TRANSITION_EVENTS.forEach(function (ev) {
        return el.removeEventListener(ev, cb, false);
      });
      el._menuAnimationEndEventCb = null;
    }
  }, {
    key: "setDisabled",
    value: function setDisabled(el, disabled) {
      Menu._getItem(el, false).classList[disabled ? 'add' : 'remove']('disabled');
    }
  }, {
    key: "isActive",
    value: function isActive(el) {
      return Menu._getItem(el, false).classList.contains('active');
    }
  }, {
    key: "isOpened",
    value: function isOpened(el) {
      return Menu._getItem(el, false).classList.contains('open');
    }
  }, {
    key: "isDisabled",
    value: function isDisabled(el) {
      return Menu._getItem(el, false).classList.contains('disabled');
    }
  }]);
  return Menu;
}();

/******/ 	return __webpack_exports__;
/******/ })()
;
});