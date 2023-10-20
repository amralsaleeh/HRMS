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
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.js":
/*!***********************************************************************************!*\
  !*** ./resources/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.js ***!
  \***********************************************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/**
 * FormValidation (https://formvalidation.io), v1.10.0 (2236098)
 * The best validation library for JavaScript
 * (c) 2013 - 2021 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  ( false ? 0 : _typeof(exports)) === 'object' && "object" !== 'undefined' ? module.exports = factory() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (0);
})(this, function () {
  'use strict';

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }
  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }
  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    Object.defineProperty(Constructor, "prototype", {
      writable: false
    });
    return Constructor;
  }
  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function");
    }
    subClass.prototype = Object.create(superClass && superClass.prototype, {
      constructor: {
        value: subClass,
        writable: true,
        configurable: true
      }
    });
    Object.defineProperty(subClass, "prototype", {
      writable: false
    });
    if (superClass) _setPrototypeOf(subClass, superClass);
  }
  function _getPrototypeOf(o) {
    _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) {
      return o.__proto__ || Object.getPrototypeOf(o);
    };
    return _getPrototypeOf(o);
  }
  function _setPrototypeOf(o, p) {
    _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) {
      o.__proto__ = p;
      return o;
    };
    return _setPrototypeOf(o, p);
  }
  function _isNativeReflectConstruct() {
    if (typeof Reflect === "undefined" || !Reflect.construct) return false;
    if (Reflect.construct.sham) return false;
    if (typeof Proxy === "function") return true;
    try {
      Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {}));
      return true;
    } catch (e) {
      return false;
    }
  }
  function _assertThisInitialized(self) {
    if (self === void 0) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }
    return self;
  }
  function _possibleConstructorReturn(self, call) {
    if (call && (_typeof(call) === "object" || typeof call === "function")) {
      return call;
    } else if (call !== void 0) {
      throw new TypeError("Derived constructors may only return object or undefined");
    }
    return _assertThisInitialized(self);
  }
  function _createSuper(Derived) {
    var hasNativeReflectConstruct = _isNativeReflectConstruct();
    return function _createSuperInternal() {
      var Super = _getPrototypeOf(Derived),
        result;
      if (hasNativeReflectConstruct) {
        var NewTarget = _getPrototypeOf(this).constructor;
        result = Reflect.construct(Super, arguments, NewTarget);
      } else {
        result = Super.apply(this, arguments);
      }
      return _possibleConstructorReturn(this, result);
    };
  }
  function _superPropBase(object, property) {
    while (!Object.prototype.hasOwnProperty.call(object, property)) {
      object = _getPrototypeOf(object);
      if (object === null) break;
    }
    return object;
  }
  function _get() {
    if (typeof Reflect !== "undefined" && Reflect.get) {
      _get = Reflect.get.bind();
    } else {
      _get = function _get(target, property, receiver) {
        var base = _superPropBase(target, property);
        if (!base) return;
        var desc = Object.getOwnPropertyDescriptor(base, property);
        if (desc.get) {
          return desc.get.call(arguments.length < 3 ? target : receiver);
        }
        return desc.value;
      };
    }
    return _get.apply(this, arguments);
  }
  var e = FormValidation.utils.classSet;
  var t = FormValidation.utils.hasClass;
  var n = FormValidation.plugins.Framework;
  var l = /*#__PURE__*/function (_n) {
    _inherits(l, _n);
    var _super = _createSuper(l);
    function l(e) {
      var _this;
      _classCallCheck(this, l);
      _this = _super.call(this, Object.assign({}, {
        eleInvalidClass: "is-invalid",
        eleValidClass: "is-valid",
        formClass: "fv-plugins-bootstrap5",
        rowInvalidClass: "fv-plugins-bootstrap5-row-invalid",
        rowPattern: /^(.*)(col|offset)(-(sm|md|lg|xl))*-[0-9]+(.*)$/,
        rowSelector: ".row",
        rowValidClass: "fv-plugins-bootstrap5-row-valid"
      }, e));
      _this.eleValidatedHandler = _this.handleElementValidated.bind(_assertThisInitialized(_this));
      return _this;
    }
    _createClass(l, [{
      key: "install",
      value: function install() {
        _get(_getPrototypeOf(l.prototype), "install", this).call(this);
        this.core.on("core.element.validated", this.eleValidatedHandler);
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        _get(_getPrototypeOf(l.prototype), "install", this).call(this);
        this.core.off("core.element.validated", this.eleValidatedHandler);
      }
    }, {
      key: "handleElementValidated",
      value: function handleElementValidated(n) {
        var _l = n.element.getAttribute("type");
        if (("checkbox" === _l || "radio" === _l) && n.elements.length > 1 && t(n.element, "form-check-input")) {
          var _l5 = n.element.parentElement;
          if (t(_l5, "form-check") && t(_l5, "form-check-inline")) {
            e(_l5, {
              "is-invalid": !n.valid,
              "is-valid": n.valid
            });
          }
        }
      }
    }, {
      key: "onIconPlaced",
      value: function onIconPlaced(n) {
        e(n.element, {
          "fv-plugins-icon-input": true
        });
        var _l3 = n.element.parentElement;
        if (t(_l3, "input-group")) {
          _l3.parentElement.insertBefore(n.iconElement, _l3.nextSibling);
          if (n.element.nextElementSibling && t(n.element.nextElementSibling, "input-group-text")) {
            e(n.iconElement, {
              "fv-plugins-icon-input-group": true
            });
          }
        }
        var i = n.element.getAttribute("type");
        if ("checkbox" === i || "radio" === i) {
          var _i = _l3.parentElement;
          if (t(_l3, "form-check")) {
            e(n.iconElement, {
              "fv-plugins-icon-check": true
            });
            _l3.parentElement.insertBefore(n.iconElement, _l3.nextSibling);
          } else if (t(_l3.parentElement, "form-check")) {
            e(n.iconElement, {
              "fv-plugins-icon-check": true
            });
            _i.parentElement.insertBefore(n.iconElement, _i.nextSibling);
          }
        }
      }
    }, {
      key: "onMessagePlaced",
      value: function onMessagePlaced(n) {
        n.messageElement.classList.add("invalid-feedback");
        var _l4 = n.element.parentElement;
        if (t(_l4, "input-group")) {
          _l4.appendChild(n.messageElement);
          e(_l4, {
            "has-validation": true
          });
          return;
        }
        var i = n.element.getAttribute("type");
        if (("checkbox" === i || "radio" === i) && t(n.element, "form-check-input") && t(_l4, "form-check") && !t(_l4, "form-check-inline")) {
          n.elements[n.elements.length - 1].parentElement.appendChild(n.messageElement);
        }
      }
    }]);
    return l;
  }(n);
  return l;
});

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
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});