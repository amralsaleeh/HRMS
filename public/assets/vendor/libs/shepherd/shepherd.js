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

/***/ "./node_modules/shepherd.js/dist/js/shepherd.js":
/*!******************************************************!*\
  !*** ./node_modules/shepherd.js/dist/js/shepherd.js ***!
  \******************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t.return && (u = t.return(), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw new Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator.return && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw new Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, catch: function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/*! shepherd.js 11.1.1 */

(function (global, factory) {
  ( false ? 0 : _typeof(exports)) === 'object' && "object" !== 'undefined' ? module.exports = factory() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (0);
})(this, function () {
  'use strict';

  var isMergeableObject = function isMergeableObject(value) {
    return isNonNullObject(value) && !isSpecial(value);
  };
  function isNonNullObject(value) {
    return !!value && _typeof(value) === 'object';
  }
  function isSpecial(value) {
    var stringValue = Object.prototype.toString.call(value);
    return stringValue === '[object RegExp]' || stringValue === '[object Date]' || isReactElement(value);
  }

  // see https://github.com/facebook/react/blob/b5ac963fb791d1298e7f396236383bc955f916c1/src/isomorphic/classic/element/ReactElement.js#L21-L25
  var canUseSymbol = typeof Symbol === 'function' && Symbol.for;
  var REACT_ELEMENT_TYPE = canUseSymbol ? Symbol.for('react.element') : 0xeac7;
  function isReactElement(value) {
    return value.$$typeof === REACT_ELEMENT_TYPE;
  }
  function emptyTarget(val) {
    return Array.isArray(val) ? [] : {};
  }
  function cloneUnlessOtherwiseSpecified(value, options) {
    return options.clone !== false && options.isMergeableObject(value) ? deepmerge(emptyTarget(value), value, options) : value;
  }
  function defaultArrayMerge(target, source, options) {
    return target.concat(source).map(function (element) {
      return cloneUnlessOtherwiseSpecified(element, options);
    });
  }
  function getMergeFunction(key, options) {
    if (!options.customMerge) {
      return deepmerge;
    }
    var customMerge = options.customMerge(key);
    return typeof customMerge === 'function' ? customMerge : deepmerge;
  }
  function getEnumerableOwnPropertySymbols(target) {
    return Object.getOwnPropertySymbols ? Object.getOwnPropertySymbols(target).filter(function (symbol) {
      return Object.propertyIsEnumerable.call(target, symbol);
    }) : [];
  }
  function getKeys(target) {
    return Object.keys(target).concat(getEnumerableOwnPropertySymbols(target));
  }
  function propertyIsOnObject(object, property) {
    try {
      return property in object;
    } catch (_) {
      return false;
    }
  }

  // Protects from prototype poisoning and unexpected merging up the prototype chain.
  function propertyIsUnsafe(target, key) {
    return propertyIsOnObject(target, key) // Properties are safe to merge if they don't exist in the target yet,
    && !(Object.hasOwnProperty.call(target, key) // unsafe if they exist up the prototype chain,
    && Object.propertyIsEnumerable.call(target, key)); // and also unsafe if they're nonenumerable.
  }

  function mergeObject(target, source, options) {
    var destination = {};
    if (options.isMergeableObject(target)) {
      getKeys(target).forEach(function (key) {
        destination[key] = cloneUnlessOtherwiseSpecified(target[key], options);
      });
    }
    getKeys(source).forEach(function (key) {
      if (propertyIsUnsafe(target, key)) {
        return;
      }
      if (propertyIsOnObject(target, key) && options.isMergeableObject(source[key])) {
        destination[key] = getMergeFunction(key, options)(target[key], source[key], options);
      } else {
        destination[key] = cloneUnlessOtherwiseSpecified(source[key], options);
      }
    });
    return destination;
  }
  function deepmerge(target, source, options) {
    options = options || {};
    options.arrayMerge = options.arrayMerge || defaultArrayMerge;
    options.isMergeableObject = options.isMergeableObject || isMergeableObject;
    // cloneUnlessOtherwiseSpecified is added to `options` so that custom arrayMerge()
    // implementations can use it. The caller may not replace it.
    options.cloneUnlessOtherwiseSpecified = cloneUnlessOtherwiseSpecified;
    var sourceIsArray = Array.isArray(source);
    var targetIsArray = Array.isArray(target);
    var sourceAndTargetTypesMatch = sourceIsArray === targetIsArray;
    if (!sourceAndTargetTypesMatch) {
      return cloneUnlessOtherwiseSpecified(source, options);
    } else if (sourceIsArray) {
      return options.arrayMerge(target, source, options);
    } else {
      return mergeObject(target, source, options);
    }
  }
  deepmerge.all = function deepmergeAll(array, options) {
    if (!Array.isArray(array)) {
      throw new Error('first argument should be an array');
    }
    return array.reduce(function (prev, next) {
      return deepmerge(prev, next, options);
    }, {});
  };
  var deepmerge_1 = deepmerge;
  var cjs = deepmerge_1;

  /**
   * Checks if `value` is classified as an `Element`.
   * @param {*} value The param to check if it is an Element
   */
  function isElement$1(value) {
    return value instanceof Element;
  }

  /**
   * Checks if `value` is classified as an `HTMLElement`.
   * @param {*} value The param to check if it is an HTMLElement
   */
  function isHTMLElement$1(value) {
    return value instanceof HTMLElement;
  }

  /**
   * Checks if `value` is classified as a `Function` object.
   * @param {*} value The param to check if it is a function
   */
  function isFunction(value) {
    return typeof value === 'function';
  }

  /**
   * Checks if `value` is classified as a `String` object.
   * @param {*} value The param to check if it is a string
   */
  function isString(value) {
    return typeof value === 'string';
  }

  /**
   * Checks if `value` is undefined.
   * @param {*} value The param to check if it is undefined
   */
  function isUndefined(value) {
    return value === undefined;
  }
  var Evented = /*#__PURE__*/function () {
    function Evented() {
      _classCallCheck(this, Evented);
    }
    _createClass(Evented, [{
      key: "on",
      value: function on(event, handler, ctx, once) {
        if (once === void 0) {
          once = false;
        }
        if (isUndefined(this.bindings)) {
          this.bindings = {};
        }
        if (isUndefined(this.bindings[event])) {
          this.bindings[event] = [];
        }
        this.bindings[event].push({
          handler: handler,
          ctx: ctx,
          once: once
        });
        return this;
      }
    }, {
      key: "once",
      value: function once(event, handler, ctx) {
        return this.on(event, handler, ctx, true);
      }
    }, {
      key: "off",
      value: function off(event, handler) {
        var _this = this;
        if (isUndefined(this.bindings) || isUndefined(this.bindings[event])) {
          return this;
        }
        if (isUndefined(handler)) {
          delete this.bindings[event];
        } else {
          this.bindings[event].forEach(function (binding, index) {
            if (binding.handler === handler) {
              _this.bindings[event].splice(index, 1);
            }
          });
        }
        return this;
      }
    }, {
      key: "trigger",
      value: function trigger(event) {
        var _this2 = this;
        for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
          args[_key - 1] = arguments[_key];
        }
        if (!isUndefined(this.bindings) && this.bindings[event]) {
          this.bindings[event].forEach(function (binding, index) {
            var ctx = binding.ctx,
              handler = binding.handler,
              once = binding.once;
            var context = ctx || _this2;
            handler.apply(context, args);
            if (once) {
              _this2.bindings[event].splice(index, 1);
            }
          });
        }
        return this;
      }
    }]);
    return Evented;
  }();
  /**
   * Binds all the methods on a JS Class to the `this` context of the class.
   * Adapted from https://github.com/sindresorhus/auto-bind
   * @param {object} self The `this` context of the class
   * @return {object} The `this` context of the class
   */
  function autoBind(self) {
    var keys = Object.getOwnPropertyNames(self.constructor.prototype);
    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];
      var val = self[key];
      if (key !== 'constructor' && typeof val === 'function') {
        self[key] = val.bind(self);
      }
    }
    return self;
  }

  /**
   * Sets up the handler to determine if we should advance the tour
   * @param {string} selector
   * @param {Step} step The step instance
   * @return {Function}
   * @private
   */
  function _setupAdvanceOnHandler(selector, step) {
    return function (event) {
      if (step.isOpen()) {
        var targetIsEl = step.el && event.currentTarget === step.el;
        var targetIsSelector = !isUndefined(selector) && event.currentTarget.matches(selector);
        if (targetIsSelector || targetIsEl) {
          step.tour.next();
        }
      }
    };
  }

  /**
   * Bind the event handler for advanceOn
   * @param {Step} step The step instance
   */
  function bindAdvance(step) {
    // An empty selector matches the step element
    var _ref2 = step.options.advanceOn || {},
      event = _ref2.event,
      selector = _ref2.selector;
    if (event) {
      var handler = _setupAdvanceOnHandler(selector, step);

      // TODO: this should also bind/unbind on show/hide
      var el;
      try {
        el = document.querySelector(selector);
      } catch (e) {
        // TODO
      }
      if (!isUndefined(selector) && !el) {
        return console.error("No element was found for the selector supplied to advanceOn: ".concat(selector));
      } else if (el) {
        el.addEventListener(event, handler);
        step.on('destroy', function () {
          return el.removeEventListener(event, handler);
        });
      } else {
        document.body.addEventListener(event, handler, true);
        step.on('destroy', function () {
          return document.body.removeEventListener(event, handler, true);
        });
      }
    } else {
      return console.error('advanceOn was defined, but no event name was passed.');
    }
  }

  /**
   * Ensure class prefix ends in `-`
   * @param {string} prefix The prefix to prepend to the class names generated by nano-css
   * @return {string} The prefix ending in `-`
   */
  function normalizePrefix(prefix) {
    if (!isString(prefix) || prefix === '') {
      return '';
    }
    return prefix.charAt(prefix.length - 1) !== '-' ? "".concat(prefix, "-") : prefix;
  }

  /**
   * Resolves attachTo options, converting element option value to a qualified HTMLElement.
   * @param {Step} step The step instance
   * @returns {{}|{element, on}}
   * `element` is a qualified HTML Element
   * `on` is a string position value
   */
  function parseAttachTo(step) {
    var options = step.options.attachTo || {};
    var returnOpts = Object.assign({}, options);
    if (isFunction(returnOpts.element)) {
      // Bind the callback to step so that it has access to the object, to enable running additional logic
      returnOpts.element = returnOpts.element.call(step);
    }
    if (isString(returnOpts.element)) {
      // Can't override the element in user opts reference because we can't
      // guarantee that the element will exist in the future.
      try {
        returnOpts.element = document.querySelector(returnOpts.element);
      } catch (e) {
        // TODO
      }
      if (!returnOpts.element) {
        console.error("The element for this Shepherd step was not found ".concat(options.element));
      }
    }
    return returnOpts;
  }

  /**
   * Checks if the step should be centered or not. Does not trigger attachTo.element evaluation, making it a pure
   * alternative for the deprecated step.isCentered() method.
   * @param resolvedAttachToOptions
   * @returns {boolean}
   */
  function shouldCenterStep(resolvedAttachToOptions) {
    if (resolvedAttachToOptions === undefined || resolvedAttachToOptions === null) {
      return true;
    }
    return !resolvedAttachToOptions.element || !resolvedAttachToOptions.on;
  }

  /**
   * Create a unique id for steps, tours, modals, etc
   * @return {string}
   */
  function uuid() {
    var d = Date.now();
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
      var r = (d + Math.random() * 16) % 16 | 0;
      d = Math.floor(d / 16);
      return (c == 'x' ? r : r & 0x3 | 0x8).toString(16);
    });
  }
  function _extends() {
    _extends = Object.assign ? Object.assign.bind() : function (target) {
      for (var i = 1; i < arguments.length; i++) {
        var source = arguments[i];
        for (var key in source) {
          if (Object.prototype.hasOwnProperty.call(source, key)) {
            target[key] = source[key];
          }
        }
      }
      return target;
    };
    return _extends.apply(this, arguments);
  }
  function _objectWithoutPropertiesLoose(source, excluded) {
    if (source == null) return {};
    var target = {};
    var sourceKeys = Object.keys(source);
    var key, i;
    for (i = 0; i < sourceKeys.length; i++) {
      key = sourceKeys[i];
      if (excluded.indexOf(key) >= 0) continue;
      target[key] = source[key];
    }
    return target;
  }
  var _excluded2 = ["mainAxis", "crossAxis", "fallbackPlacements", "fallbackStrategy", "fallbackAxisSideDirection", "flipAlignment"],
    _excluded4 = ["mainAxis", "crossAxis", "limiter"];
  function getAlignment(placement) {
    return placement.split('-')[1];
  }
  function getLengthFromAxis(axis) {
    return axis === 'y' ? 'height' : 'width';
  }
  function getSide(placement) {
    return placement.split('-')[0];
  }
  function getMainAxisFromPlacement(placement) {
    return ['top', 'bottom'].includes(getSide(placement)) ? 'x' : 'y';
  }
  function computeCoordsFromPlacement(_ref, placement, rtl) {
    var reference = _ref.reference,
      floating = _ref.floating;
    var commonX = reference.x + reference.width / 2 - floating.width / 2;
    var commonY = reference.y + reference.height / 2 - floating.height / 2;
    var mainAxis = getMainAxisFromPlacement(placement);
    var length = getLengthFromAxis(mainAxis);
    var commonAlign = reference[length] / 2 - floating[length] / 2;
    var side = getSide(placement);
    var isVertical = mainAxis === 'x';
    var coords;
    switch (side) {
      case 'top':
        coords = {
          x: commonX,
          y: reference.y - floating.height
        };
        break;
      case 'bottom':
        coords = {
          x: commonX,
          y: reference.y + reference.height
        };
        break;
      case 'right':
        coords = {
          x: reference.x + reference.width,
          y: commonY
        };
        break;
      case 'left':
        coords = {
          x: reference.x - floating.width,
          y: commonY
        };
        break;
      default:
        coords = {
          x: reference.x,
          y: reference.y
        };
    }
    switch (getAlignment(placement)) {
      case 'start':
        coords[mainAxis] -= commonAlign * (rtl && isVertical ? -1 : 1);
        break;
      case 'end':
        coords[mainAxis] += commonAlign * (rtl && isVertical ? -1 : 1);
        break;
    }
    return coords;
  }

  /**
   * Computes the `x` and `y` coordinates that will place the floating element
   * next to a reference element when it is given a certain positioning strategy.
   *
   * This export does not have any `platform` interface logic. You will need to
   * write one for the platform you are using Floating UI with.
   */
  var computePosition$1 = /*#__PURE__*/function () {
    var _ref3 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(reference, floating, config) {
      var _config$placement, placement, _config$strategy, strategy, _config$middleware, middleware, platform, validMiddleware, rtl, rects, _computeCoordsFromPla, x, y, statefulPlacement, middlewareData, resetCount, i, _validMiddleware$i, name, fn, _yield$fn, nextX, nextY, data, reset, _computeCoordsFromPla2;
      return _regeneratorRuntime().wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            _config$placement = config.placement, placement = _config$placement === void 0 ? 'bottom' : _config$placement, _config$strategy = config.strategy, strategy = _config$strategy === void 0 ? 'absolute' : _config$strategy, _config$middleware = config.middleware, middleware = _config$middleware === void 0 ? [] : _config$middleware, platform = config.platform;
            validMiddleware = middleware.filter(Boolean);
            _context.next = 4;
            return platform.isRTL == null ? void 0 : platform.isRTL(floating);
          case 4:
            rtl = _context.sent;
            _context.next = 7;
            return platform.getElementRects({
              reference: reference,
              floating: floating,
              strategy: strategy
            });
          case 7:
            rects = _context.sent;
            _computeCoordsFromPla = computeCoordsFromPlacement(rects, placement, rtl), x = _computeCoordsFromPla.x, y = _computeCoordsFromPla.y;
            statefulPlacement = placement;
            middlewareData = {};
            resetCount = 0;
            i = 0;
          case 13:
            if (!(i < validMiddleware.length)) {
              _context.next = 46;
              break;
            }
            _validMiddleware$i = validMiddleware[i], name = _validMiddleware$i.name, fn = _validMiddleware$i.fn;
            _context.next = 17;
            return fn({
              x: x,
              y: y,
              initialPlacement: placement,
              placement: statefulPlacement,
              strategy: strategy,
              middlewareData: middlewareData,
              rects: rects,
              platform: platform,
              elements: {
                reference: reference,
                floating: floating
              }
            });
          case 17:
            _yield$fn = _context.sent;
            nextX = _yield$fn.x;
            nextY = _yield$fn.y;
            data = _yield$fn.data;
            reset = _yield$fn.reset;
            x = nextX != null ? nextX : x;
            y = nextY != null ? nextY : y;
            middlewareData = _extends({}, middlewareData, _defineProperty({}, name, _extends({}, middlewareData[name], data)));
            if (!(reset && resetCount <= 50)) {
              _context.next = 43;
              break;
            }
            resetCount++;
            if (!(_typeof(reset) === 'object')) {
              _context.next = 41;
              break;
            }
            if (reset.placement) {
              statefulPlacement = reset.placement;
            }
            if (!reset.rects) {
              _context.next = 38;
              break;
            }
            if (!(reset.rects === true)) {
              _context.next = 36;
              break;
            }
            _context.next = 33;
            return platform.getElementRects({
              reference: reference,
              floating: floating,
              strategy: strategy
            });
          case 33:
            _context.t0 = _context.sent;
            _context.next = 37;
            break;
          case 36:
            _context.t0 = reset.rects;
          case 37:
            rects = _context.t0;
          case 38:
            _computeCoordsFromPla2 = computeCoordsFromPlacement(rects, statefulPlacement, rtl);
            x = _computeCoordsFromPla2.x;
            y = _computeCoordsFromPla2.y;
          case 41:
            i = -1;
            return _context.abrupt("continue", 43);
          case 43:
            i++;
            _context.next = 13;
            break;
          case 46:
            return _context.abrupt("return", {
              x: x,
              y: y,
              placement: statefulPlacement,
              strategy: strategy,
              middlewareData: middlewareData
            });
          case 47:
          case "end":
            return _context.stop();
        }
      }, _callee);
    }));
    return function computePosition$1(_x, _x2, _x3) {
      return _ref3.apply(this, arguments);
    };
  }();
  function expandPaddingObject(padding) {
    return _extends({
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    }, padding);
  }
  function getSideObjectFromPadding(padding) {
    return typeof padding !== 'number' ? expandPaddingObject(padding) : {
      top: padding,
      right: padding,
      bottom: padding,
      left: padding
    };
  }
  function rectToClientRect(rect) {
    return _extends({}, rect, {
      top: rect.y,
      left: rect.x,
      right: rect.x + rect.width,
      bottom: rect.y + rect.height
    });
  }

  /**
   * Resolves with an object of overflow side offsets that determine how much the
   * element is overflowing a given clipping boundary on each side.
   * - positive = overflowing the boundary by that number of pixels
   * - negative = how many pixels left before it will overflow
   * - 0 = lies flush with the boundary
   * @see https://floating-ui.com/docs/detectOverflow
   */
  function detectOverflow(_x4, _x5) {
    return _detectOverflow.apply(this, arguments);
  }
  function _detectOverflow() {
    _detectOverflow = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee7(state, options) {
      var _await$platform$isEle, x, y, platform, rects, elements, strategy, _options5, _options5$boundary, boundary, _options5$rootBoundar, rootBoundary, _options5$elementCont, elementContext, _options5$altBoundary, altBoundary, _options5$padding, padding, paddingObject, altContext, element, clippingClientRect, rect, offsetParent, offsetScale, elementClientRect;
      return _regeneratorRuntime().wrap(function _callee7$(_context7) {
        while (1) switch (_context7.prev = _context7.next) {
          case 0:
            if (options === void 0) {
              options = {};
            }
            x = state.x, y = state.y, platform = state.platform, rects = state.rects, elements = state.elements, strategy = state.strategy;
            _options5 = options, _options5$boundary = _options5.boundary, boundary = _options5$boundary === void 0 ? 'clippingAncestors' : _options5$boundary, _options5$rootBoundar = _options5.rootBoundary, rootBoundary = _options5$rootBoundar === void 0 ? 'viewport' : _options5$rootBoundar, _options5$elementCont = _options5.elementContext, elementContext = _options5$elementCont === void 0 ? 'floating' : _options5$elementCont, _options5$altBoundary = _options5.altBoundary, altBoundary = _options5$altBoundary === void 0 ? false : _options5$altBoundary, _options5$padding = _options5.padding, padding = _options5$padding === void 0 ? 0 : _options5$padding;
            paddingObject = getSideObjectFromPadding(padding);
            altContext = elementContext === 'floating' ? 'reference' : 'floating';
            element = elements[altBoundary ? altContext : elementContext];
            _context7.t0 = rectToClientRect;
            _context7.t1 = platform;
            _context7.next = 10;
            return platform.isElement == null ? void 0 : platform.isElement(element);
          case 10:
            _context7.t2 = _await$platform$isEle = _context7.sent;
            if (!(_context7.t2 != null)) {
              _context7.next = 15;
              break;
            }
            _context7.t3 = _await$platform$isEle;
            _context7.next = 16;
            break;
          case 15:
            _context7.t3 = true;
          case 16:
            if (!_context7.t3) {
              _context7.next = 20;
              break;
            }
            _context7.t4 = element;
            _context7.next = 26;
            break;
          case 20:
            _context7.t5 = element.contextElement;
            if (_context7.t5) {
              _context7.next = 25;
              break;
            }
            _context7.next = 24;
            return platform.getDocumentElement == null ? void 0 : platform.getDocumentElement(elements.floating);
          case 24:
            _context7.t5 = _context7.sent;
          case 25:
            _context7.t4 = _context7.t5;
          case 26:
            _context7.t6 = _context7.t4;
            _context7.t7 = boundary;
            _context7.t8 = rootBoundary;
            _context7.t9 = strategy;
            _context7.t10 = {
              element: _context7.t6,
              boundary: _context7.t7,
              rootBoundary: _context7.t8,
              strategy: _context7.t9
            };
            _context7.next = 33;
            return _context7.t1.getClippingRect.call(_context7.t1, _context7.t10);
          case 33:
            _context7.t11 = _context7.sent;
            clippingClientRect = (0, _context7.t0)(_context7.t11);
            rect = elementContext === 'floating' ? _extends({}, rects.floating, {
              x: x,
              y: y
            }) : rects.reference;
            _context7.next = 38;
            return platform.getOffsetParent == null ? void 0 : platform.getOffsetParent(elements.floating);
          case 38:
            offsetParent = _context7.sent;
            _context7.next = 41;
            return platform.isElement == null ? void 0 : platform.isElement(offsetParent);
          case 41:
            if (!_context7.sent) {
              _context7.next = 50;
              break;
            }
            _context7.next = 44;
            return platform.getScale == null ? void 0 : platform.getScale(offsetParent);
          case 44:
            _context7.t13 = _context7.sent;
            if (_context7.t13) {
              _context7.next = 47;
              break;
            }
            _context7.t13 = {
              x: 1,
              y: 1
            };
          case 47:
            _context7.t12 = _context7.t13;
            _context7.next = 51;
            break;
          case 50:
            _context7.t12 = {
              x: 1,
              y: 1
            };
          case 51:
            offsetScale = _context7.t12;
            _context7.t14 = rectToClientRect;
            if (!platform.convertOffsetParentRelativeRectToViewportRelativeRect) {
              _context7.next = 59;
              break;
            }
            _context7.next = 56;
            return platform.convertOffsetParentRelativeRectToViewportRelativeRect({
              rect: rect,
              offsetParent: offsetParent,
              strategy: strategy
            });
          case 56:
            _context7.t15 = _context7.sent;
            _context7.next = 60;
            break;
          case 59:
            _context7.t15 = rect;
          case 60:
            _context7.t16 = _context7.t15;
            elementClientRect = (0, _context7.t14)(_context7.t16);
            return _context7.abrupt("return", {
              top: (clippingClientRect.top - elementClientRect.top + paddingObject.top) / offsetScale.y,
              bottom: (elementClientRect.bottom - clippingClientRect.bottom + paddingObject.bottom) / offsetScale.y,
              left: (clippingClientRect.left - elementClientRect.left + paddingObject.left) / offsetScale.x,
              right: (elementClientRect.right - clippingClientRect.right + paddingObject.right) / offsetScale.x
            });
          case 63:
          case "end":
            return _context7.stop();
        }
      }, _callee7);
    }));
    return _detectOverflow.apply(this, arguments);
  }
  var min$1 = Math.min;
  var max$1 = Math.max;
  function within(min$1$1, value, max$1$1) {
    return max$1(min$1$1, min$1(value, max$1$1));
  }

  /**
   * Provides data to position an inner element of the floating element so that it
   * appears centered to the reference element.
   * @see https://floating-ui.com/docs/arrow
   */
  var arrow = function arrow(options) {
    return {
      name: 'arrow',
      options: options,
      fn: function fn(state) {
        return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
          var _data, _ref5;
          var _ref4, element, _ref4$padding, padding, x, y, placement, rects, platform, elements, paddingObject, coords, axis, length, arrowDimensions, isYAxis, minProp, maxProp, clientProp, endDiff, startDiff, arrowOffsetParent, clientSize, centerToReference, min, max, center, offset, shouldAddOffset, alignmentOffset;
          return _regeneratorRuntime().wrap(function _callee2$(_context2) {
            while (1) switch (_context2.prev = _context2.next) {
              case 0:
                // Since `element` is required, we don't Partial<> the type.
                _ref4 = options || {}, element = _ref4.element, _ref4$padding = _ref4.padding, padding = _ref4$padding === void 0 ? 0 : _ref4$padding;
                x = state.x, y = state.y, placement = state.placement, rects = state.rects, platform = state.platform, elements = state.elements;
                if (!(element == null)) {
                  _context2.next = 4;
                  break;
                }
                return _context2.abrupt("return", {});
              case 4:
                paddingObject = getSideObjectFromPadding(padding);
                coords = {
                  x: x,
                  y: y
                };
                axis = getMainAxisFromPlacement(placement);
                length = getLengthFromAxis(axis);
                _context2.next = 10;
                return platform.getDimensions(element);
              case 10:
                arrowDimensions = _context2.sent;
                isYAxis = axis === 'y';
                minProp = isYAxis ? 'top' : 'left';
                maxProp = isYAxis ? 'bottom' : 'right';
                clientProp = isYAxis ? 'clientHeight' : 'clientWidth';
                endDiff = rects.reference[length] + rects.reference[axis] - coords[axis] - rects.floating[length];
                startDiff = coords[axis] - rects.reference[axis];
                _context2.next = 19;
                return platform.getOffsetParent == null ? void 0 : platform.getOffsetParent(element);
              case 19:
                arrowOffsetParent = _context2.sent;
                clientSize = arrowOffsetParent ? arrowOffsetParent[clientProp] : 0; // DOM platform can return `window` as the `offsetParent`.
                _context2.t0 = !clientSize;
                if (_context2.t0) {
                  _context2.next = 26;
                  break;
                }
                _context2.next = 25;
                return platform.isElement == null ? void 0 : platform.isElement(arrowOffsetParent);
              case 25:
                _context2.t0 = !_context2.sent;
              case 26:
                if (!_context2.t0) {
                  _context2.next = 28;
                  break;
                }
                clientSize = elements.floating[clientProp] || rects.floating[length];
              case 28:
                centerToReference = endDiff / 2 - startDiff / 2; // Make sure the arrow doesn't overflow the floating element if the center
                // point is outside the floating element's bounds.
                min = paddingObject[minProp];
                max = clientSize - arrowDimensions[length] - paddingObject[maxProp];
                center = clientSize / 2 - arrowDimensions[length] / 2 + centerToReference;
                offset = within(min, center, max); // If the reference is small enough that the arrow's padding causes it to
                // to point to nothing for an aligned placement, adjust the offset of the
                // floating element itself. This stops `shift()` from taking action, but can
                // be worked around by calling it again after the `arrow()` if desired.
                shouldAddOffset = getAlignment(placement) != null && center != offset && rects.reference[length] / 2 - (center < min ? paddingObject[minProp] : paddingObject[maxProp]) - arrowDimensions[length] / 2 < 0;
                alignmentOffset = shouldAddOffset ? center < min ? min - center : max - center : 0;
                return _context2.abrupt("return", (_ref5 = {}, _defineProperty(_ref5, axis, coords[axis] - alignmentOffset), _defineProperty(_ref5, "data", (_data = {}, _defineProperty(_data, axis, offset), _defineProperty(_data, "centerOffset", center - offset), _data)), _ref5));
              case 36:
              case "end":
                return _context2.stop();
            }
          }, _callee2);
        }))();
      }
    };
  };
  var oppositeSideMap = {
    left: 'right',
    right: 'left',
    bottom: 'top',
    top: 'bottom'
  };
  function getOppositePlacement(placement) {
    return placement.replace(/left|right|bottom|top/g, function (side) {
      return oppositeSideMap[side];
    });
  }
  function getAlignmentSides(placement, rects, rtl) {
    if (rtl === void 0) {
      rtl = false;
    }
    var alignment = getAlignment(placement);
    var mainAxis = getMainAxisFromPlacement(placement);
    var length = getLengthFromAxis(mainAxis);
    var mainAlignmentSide = mainAxis === 'x' ? alignment === (rtl ? 'end' : 'start') ? 'right' : 'left' : alignment === 'start' ? 'bottom' : 'top';
    if (rects.reference[length] > rects.floating[length]) {
      mainAlignmentSide = getOppositePlacement(mainAlignmentSide);
    }
    return {
      main: mainAlignmentSide,
      cross: getOppositePlacement(mainAlignmentSide)
    };
  }
  var oppositeAlignmentMap = {
    start: 'end',
    end: 'start'
  };
  function getOppositeAlignmentPlacement(placement) {
    return placement.replace(/start|end/g, function (alignment) {
      return oppositeAlignmentMap[alignment];
    });
  }
  function getExpandedPlacements(placement) {
    var oppositePlacement = getOppositePlacement(placement);
    return [getOppositeAlignmentPlacement(placement), oppositePlacement, getOppositeAlignmentPlacement(oppositePlacement)];
  }
  function getSideList(side, isStart, rtl) {
    var lr = ['left', 'right'];
    var rl = ['right', 'left'];
    var tb = ['top', 'bottom'];
    var bt = ['bottom', 'top'];
    switch (side) {
      case 'top':
      case 'bottom':
        if (rtl) return isStart ? rl : lr;
        return isStart ? lr : rl;
      case 'left':
      case 'right':
        return isStart ? tb : bt;
      default:
        return [];
    }
  }
  function getOppositeAxisPlacements(placement, flipAlignment, direction, rtl) {
    var alignment = getAlignment(placement);
    var list = getSideList(getSide(placement), direction === 'start', rtl);
    if (alignment) {
      list = list.map(function (side) {
        return side + "-" + alignment;
      });
      if (flipAlignment) {
        list = list.concat(list.map(getOppositeAlignmentPlacement));
      }
    }
    return list;
  }

  /**
   * Optimizes the visibility of the floating element by flipping the `placement`
   * in order to keep it in view when the preferred placement(s) will overflow the
   * clipping boundary. Alternative to `autoPlacement`.
   * @see https://floating-ui.com/docs/flip
   */
  var flip = function flip(options) {
    if (options === void 0) {
      options = {};
    }
    return {
      name: 'flip',
      options: options,
      fn: function fn(state) {
        return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
          var _middlewareData$flip, placement, middlewareData, rects, initialPlacement, platform, elements, _options, _options$mainAxis, checkMainAxis, _options$crossAxis, checkCrossAxis, specifiedFallbackPlacements, _options$fallbackStra, fallbackStrategy, _options$fallbackAxis, fallbackAxisSideDirection, _options$flipAlignmen, flipAlignment, detectOverflowOptions, side, isBasePlacement, rtl, fallbackPlacements, placements, overflow, overflows, overflowsData, _getAlignmentSides, main, cross, _middlewareData$flip2, _overflowsData$filter, nextIndex, nextPlacement, resetPlacement, _overflowsData$map$so, _placement;
          return _regeneratorRuntime().wrap(function _callee3$(_context3) {
            while (1) switch (_context3.prev = _context3.next) {
              case 0:
                placement = state.placement, middlewareData = state.middlewareData, rects = state.rects, initialPlacement = state.initialPlacement, platform = state.platform, elements = state.elements;
                _options = options, _options$mainAxis = _options.mainAxis, checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis, _options$crossAxis = _options.crossAxis, checkCrossAxis = _options$crossAxis === void 0 ? true : _options$crossAxis, specifiedFallbackPlacements = _options.fallbackPlacements, _options$fallbackStra = _options.fallbackStrategy, fallbackStrategy = _options$fallbackStra === void 0 ? 'bestFit' : _options$fallbackStra, _options$fallbackAxis = _options.fallbackAxisSideDirection, fallbackAxisSideDirection = _options$fallbackAxis === void 0 ? 'none' : _options$fallbackAxis, _options$flipAlignmen = _options.flipAlignment, flipAlignment = _options$flipAlignmen === void 0 ? true : _options$flipAlignmen, detectOverflowOptions = _objectWithoutPropertiesLoose(options, _excluded2);
                side = getSide(placement);
                isBasePlacement = getSide(initialPlacement) === initialPlacement;
                _context3.next = 6;
                return platform.isRTL == null ? void 0 : platform.isRTL(elements.floating);
              case 6:
                rtl = _context3.sent;
                fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipAlignment ? [getOppositePlacement(initialPlacement)] : getExpandedPlacements(initialPlacement));
                if (!specifiedFallbackPlacements && fallbackAxisSideDirection !== 'none') {
                  fallbackPlacements.push.apply(fallbackPlacements, _toConsumableArray(getOppositeAxisPlacements(initialPlacement, flipAlignment, fallbackAxisSideDirection, rtl)));
                }
                placements = [initialPlacement].concat(_toConsumableArray(fallbackPlacements));
                _context3.next = 12;
                return detectOverflow(state, detectOverflowOptions);
              case 12:
                overflow = _context3.sent;
                overflows = [];
                overflowsData = ((_middlewareData$flip = middlewareData.flip) == null ? void 0 : _middlewareData$flip.overflows) || [];
                if (checkMainAxis) {
                  overflows.push(overflow[side]);
                }
                if (checkCrossAxis) {
                  _getAlignmentSides = getAlignmentSides(placement, rects, rtl), main = _getAlignmentSides.main, cross = _getAlignmentSides.cross;
                  overflows.push(overflow[main], overflow[cross]);
                }
                overflowsData = [].concat(_toConsumableArray(overflowsData), [{
                  placement: placement,
                  overflows: overflows
                }]);

                // One or more sides is overflowing.
                if (overflows.every(function (side) {
                  return side <= 0;
                })) {
                  _context3.next = 35;
                  break;
                }
                nextIndex = (((_middlewareData$flip2 = middlewareData.flip) == null ? void 0 : _middlewareData$flip2.index) || 0) + 1;
                nextPlacement = placements[nextIndex];
                if (!nextPlacement) {
                  _context3.next = 23;
                  break;
                }
                return _context3.abrupt("return", {
                  data: {
                    index: nextIndex,
                    overflows: overflowsData
                  },
                  reset: {
                    placement: nextPlacement
                  }
                });
              case 23:
                // First, find the candidates that fit on the mainAxis side of overflow,
                // then find the placement that fits the best on the main crossAxis side.
                resetPlacement = (_overflowsData$filter = overflowsData.filter(function (d) {
                  return d.overflows[0] <= 0;
                }).sort(function (a, b) {
                  return a.overflows[1] - b.overflows[1];
                })[0]) == null ? void 0 : _overflowsData$filter.placement; // Otherwise fallback.
                if (resetPlacement) {
                  _context3.next = 33;
                  break;
                }
                _context3.t0 = fallbackStrategy;
                _context3.next = _context3.t0 === 'bestFit' ? 28 : _context3.t0 === 'initialPlacement' ? 31 : 33;
                break;
              case 28:
                _placement = (_overflowsData$map$so = overflowsData.map(function (d) {
                  return [d.placement, d.overflows.filter(function (overflow) {
                    return overflow > 0;
                  }).reduce(function (acc, overflow) {
                    return acc + overflow;
                  }, 0)];
                }).sort(function (a, b) {
                  return a[1] - b[1];
                })[0]) == null ? void 0 : _overflowsData$map$so[0];
                if (_placement) {
                  resetPlacement = _placement;
                }
                return _context3.abrupt("break", 33);
              case 31:
                resetPlacement = initialPlacement;
                return _context3.abrupt("break", 33);
              case 33:
                if (!(placement !== resetPlacement)) {
                  _context3.next = 35;
                  break;
                }
                return _context3.abrupt("return", {
                  reset: {
                    placement: resetPlacement
                  }
                });
              case 35:
                return _context3.abrupt("return", {});
              case 36:
              case "end":
                return _context3.stop();
            }
          }, _callee3);
        }))();
      }
    };
  };
  function getCrossAxis(axis) {
    return axis === 'x' ? 'y' : 'x';
  }

  /**
   * Optimizes the visibility of the floating element by shifting it in order to
   * keep it in view when it will overflow the clipping boundary.
   * @see https://floating-ui.com/docs/shift
   */
  var shift = function shift(options) {
    if (options === void 0) {
      options = {};
    }
    return {
      name: 'shift',
      options: options,
      fn: function fn(state) {
        return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
          var _extends3;
          var x, y, placement, _options2, _options2$mainAxis, checkMainAxis, _options2$crossAxis, checkCrossAxis, _options2$limiter, limiter, detectOverflowOptions, coords, overflow, mainAxis, crossAxis, mainAxisCoord, crossAxisCoord, minSide, maxSide, _min, _max, _minSide, _maxSide, _min2, _max2, limitedCoords;
          return _regeneratorRuntime().wrap(function _callee4$(_context4) {
            while (1) switch (_context4.prev = _context4.next) {
              case 0:
                x = state.x, y = state.y, placement = state.placement;
                _options2 = options, _options2$mainAxis = _options2.mainAxis, checkMainAxis = _options2$mainAxis === void 0 ? true : _options2$mainAxis, _options2$crossAxis = _options2.crossAxis, checkCrossAxis = _options2$crossAxis === void 0 ? false : _options2$crossAxis, _options2$limiter = _options2.limiter, limiter = _options2$limiter === void 0 ? {
                  fn: function fn(_ref) {
                    var x = _ref.x,
                      y = _ref.y;
                    return {
                      x: x,
                      y: y
                    };
                  }
                } : _options2$limiter, detectOverflowOptions = _objectWithoutPropertiesLoose(options, _excluded4);
                coords = {
                  x: x,
                  y: y
                };
                _context4.next = 5;
                return detectOverflow(state, detectOverflowOptions);
              case 5:
                overflow = _context4.sent;
                mainAxis = getMainAxisFromPlacement(getSide(placement));
                crossAxis = getCrossAxis(mainAxis);
                mainAxisCoord = coords[mainAxis];
                crossAxisCoord = coords[crossAxis];
                if (checkMainAxis) {
                  minSide = mainAxis === 'y' ? 'top' : 'left';
                  maxSide = mainAxis === 'y' ? 'bottom' : 'right';
                  _min = mainAxisCoord + overflow[minSide];
                  _max = mainAxisCoord - overflow[maxSide];
                  mainAxisCoord = within(_min, mainAxisCoord, _max);
                }
                if (checkCrossAxis) {
                  _minSide = crossAxis === 'y' ? 'top' : 'left';
                  _maxSide = crossAxis === 'y' ? 'bottom' : 'right';
                  _min2 = crossAxisCoord + overflow[_minSide];
                  _max2 = crossAxisCoord - overflow[_maxSide];
                  crossAxisCoord = within(_min2, crossAxisCoord, _max2);
                }
                limitedCoords = limiter.fn(_extends({}, state, (_extends3 = {}, _defineProperty(_extends3, mainAxis, mainAxisCoord), _defineProperty(_extends3, crossAxis, crossAxisCoord), _extends3)));
                return _context4.abrupt("return", _extends({}, limitedCoords, {
                  data: {
                    x: limitedCoords.x - x,
                    y: limitedCoords.y - y
                  }
                }));
              case 14:
              case "end":
                return _context4.stop();
            }
          }, _callee4);
        }))();
      }
    };
  };
  /**
   * Built-in `limiter` that will stop `shift()` at a certain point.
   */
  var limitShift = function limitShift(options) {
    if (options === void 0) {
      options = {};
    }
    return {
      options: options,
      fn: function fn(state) {
        var _ref6;
        var x = state.x,
          y = state.y,
          placement = state.placement,
          rects = state.rects,
          middlewareData = state.middlewareData;
        var _options3 = options,
          _options3$offset = _options3.offset,
          offset = _options3$offset === void 0 ? 0 : _options3$offset,
          _options3$mainAxis = _options3.mainAxis,
          checkMainAxis = _options3$mainAxis === void 0 ? true : _options3$mainAxis,
          _options3$crossAxis = _options3.crossAxis,
          checkCrossAxis = _options3$crossAxis === void 0 ? true : _options3$crossAxis;
        var coords = {
          x: x,
          y: y
        };
        var mainAxis = getMainAxisFromPlacement(placement);
        var crossAxis = getCrossAxis(mainAxis);
        var mainAxisCoord = coords[mainAxis];
        var crossAxisCoord = coords[crossAxis];
        var rawOffset = typeof offset === 'function' ? offset(state) : offset;
        var computedOffset = typeof rawOffset === 'number' ? {
          mainAxis: rawOffset,
          crossAxis: 0
        } : _extends({
          mainAxis: 0,
          crossAxis: 0
        }, rawOffset);
        if (checkMainAxis) {
          var len = mainAxis === 'y' ? 'height' : 'width';
          var limitMin = rects.reference[mainAxis] - rects.floating[len] + computedOffset.mainAxis;
          var limitMax = rects.reference[mainAxis] + rects.reference[len] - computedOffset.mainAxis;
          if (mainAxisCoord < limitMin) {
            mainAxisCoord = limitMin;
          } else if (mainAxisCoord > limitMax) {
            mainAxisCoord = limitMax;
          }
        }
        if (checkCrossAxis) {
          var _middlewareData$offse, _middlewareData$offse2;
          var _len2 = mainAxis === 'y' ? 'width' : 'height';
          var isOriginSide = ['top', 'left'].includes(getSide(placement));
          var _limitMin = rects.reference[crossAxis] - rects.floating[_len2] + (isOriginSide ? ((_middlewareData$offse = middlewareData.offset) == null ? void 0 : _middlewareData$offse[crossAxis]) || 0 : 0) + (isOriginSide ? 0 : computedOffset.crossAxis);
          var _limitMax = rects.reference[crossAxis] + rects.reference[_len2] + (isOriginSide ? 0 : ((_middlewareData$offse2 = middlewareData.offset) == null ? void 0 : _middlewareData$offse2[crossAxis]) || 0) - (isOriginSide ? computedOffset.crossAxis : 0);
          if (crossAxisCoord < _limitMin) {
            crossAxisCoord = _limitMin;
          } else if (crossAxisCoord > _limitMax) {
            crossAxisCoord = _limitMax;
          }
        }
        return _ref6 = {}, _defineProperty(_ref6, mainAxis, mainAxisCoord), _defineProperty(_ref6, crossAxis, crossAxisCoord), _ref6;
      }
    };
  };
  function getWindow(node) {
    var _node$ownerDocument;
    return ((_node$ownerDocument = node.ownerDocument) == null ? void 0 : _node$ownerDocument.defaultView) || window;
  }
  function getComputedStyle$1(element) {
    return getWindow(element).getComputedStyle(element);
  }
  function isNode(value) {
    return value instanceof getWindow(value).Node;
  }
  function getNodeName(node) {
    return isNode(node) ? (node.nodeName || '').toLowerCase() : '';
  }
  var uaString;
  function getUAString() {
    if (uaString) {
      return uaString;
    }
    var uaData = navigator.userAgentData;
    if (uaData && Array.isArray(uaData.brands)) {
      uaString = uaData.brands.map(function (item) {
        return item.brand + "/" + item.version;
      }).join(' ');
      return uaString;
    }
    return navigator.userAgent;
  }
  function isHTMLElement(value) {
    return value instanceof getWindow(value).HTMLElement;
  }
  function isElement(value) {
    return value instanceof getWindow(value).Element;
  }
  function isShadowRoot(node) {
    // Browsers without `ShadowRoot` support.
    if (typeof ShadowRoot === 'undefined') {
      return false;
    }
    var OwnElement = getWindow(node).ShadowRoot;
    return node instanceof OwnElement || node instanceof ShadowRoot;
  }
  function isOverflowElement(element) {
    var _getComputedStyle$ = getComputedStyle$1(element),
      overflow = _getComputedStyle$.overflow,
      overflowX = _getComputedStyle$.overflowX,
      overflowY = _getComputedStyle$.overflowY,
      display = _getComputedStyle$.display;
    return /auto|scroll|overlay|hidden|clip/.test(overflow + overflowY + overflowX) && !['inline', 'contents'].includes(display);
  }
  function isTableElement(element) {
    return ['table', 'td', 'th'].includes(getNodeName(element));
  }
  function isContainingBlock(element) {
    // TODO: Try to use feature detection here instead.
    var isFirefox = /firefox/i.test(getUAString());
    var css = getComputedStyle$1(element);
    var backdropFilter = css.backdropFilter || css.WebkitBackdropFilter;

    // This is non-exhaustive but covers the most common CSS properties that
    // create a containing block.
    // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block
    return css.transform !== 'none' || css.perspective !== 'none' || (backdropFilter ? backdropFilter !== 'none' : false) || isFirefox && css.willChange === 'filter' || isFirefox && (css.filter ? css.filter !== 'none' : false) || ['transform', 'perspective'].some(function (value) {
      return css.willChange.includes(value);
    }) || ['paint', 'layout', 'strict', 'content'].some(function (value) {
      // Add type check for old browsers.
      var contain = css.contain;
      return contain != null ? contain.includes(value) : false;
    });
  }

  /**
   * Determines whether or not `.getBoundingClientRect()` is affected by visual
   * viewport offsets. In Safari, the `x`/`y` offsets are values relative to the
   * visual viewport, while in other engines, they are values relative to the
   * layout viewport.
   */
  function isClientRectVisualViewportBased() {
    // TODO: Try to use feature detection here instead. Feature detection for
    // this can fail in various ways, making the userAgent check the most
    // reliable:
    // • Always-visible scrollbar or not
    // • Width of <html>

    // Is Safari.
    return /^((?!chrome|android).)*safari/i.test(getUAString());
  }
  function isLastTraversableNode(node) {
    return ['html', 'body', '#document'].includes(getNodeName(node));
  }
  var min = Math.min;
  var max = Math.max;
  var round = Math.round;
  function getCssDimensions(element) {
    var css = getComputedStyle$1(element);
    var width = parseFloat(css.width);
    var height = parseFloat(css.height);
    var hasOffset = isHTMLElement(element);
    var offsetWidth = hasOffset ? element.offsetWidth : width;
    var offsetHeight = hasOffset ? element.offsetHeight : height;
    var shouldFallback = round(width) !== offsetWidth || round(height) !== offsetHeight;
    if (shouldFallback) {
      width = offsetWidth;
      height = offsetHeight;
    }
    return {
      width: width,
      height: height,
      fallback: shouldFallback
    };
  }
  function unwrapElement(element) {
    return !isElement(element) ? element.contextElement : element;
  }
  var FALLBACK_SCALE = {
    x: 1,
    y: 1
  };
  function getScale(element) {
    var domElement = unwrapElement(element);
    if (!isHTMLElement(domElement)) {
      return FALLBACK_SCALE;
    }
    var rect = domElement.getBoundingClientRect();
    var _getCssDimensions = getCssDimensions(domElement),
      width = _getCssDimensions.width,
      height = _getCssDimensions.height,
      fallback = _getCssDimensions.fallback;
    var x = (fallback ? round(rect.width) : rect.width) / width;
    var y = (fallback ? round(rect.height) : rect.height) / height;

    // 0, NaN, or Infinity should always fallback to 1.

    if (!x || !Number.isFinite(x)) {
      x = 1;
    }
    if (!y || !Number.isFinite(y)) {
      y = 1;
    }
    return {
      x: x,
      y: y
    };
  }
  function getBoundingClientRect(element, includeScale, isFixedStrategy, offsetParent) {
    var _win$visualViewport, _win$visualViewport2;
    if (includeScale === void 0) {
      includeScale = false;
    }
    if (isFixedStrategy === void 0) {
      isFixedStrategy = false;
    }
    var clientRect = element.getBoundingClientRect();
    var domElement = unwrapElement(element);
    var scale = FALLBACK_SCALE;
    if (includeScale) {
      if (offsetParent) {
        if (isElement(offsetParent)) {
          scale = getScale(offsetParent);
        }
      } else {
        scale = getScale(element);
      }
    }
    var win = domElement ? getWindow(domElement) : window;
    var addVisualOffsets = isClientRectVisualViewportBased() && isFixedStrategy;
    var x = (clientRect.left + (addVisualOffsets ? ((_win$visualViewport = win.visualViewport) == null ? void 0 : _win$visualViewport.offsetLeft) || 0 : 0)) / scale.x;
    var y = (clientRect.top + (addVisualOffsets ? ((_win$visualViewport2 = win.visualViewport) == null ? void 0 : _win$visualViewport2.offsetTop) || 0 : 0)) / scale.y;
    var width = clientRect.width / scale.x;
    var height = clientRect.height / scale.y;
    if (domElement) {
      var _win = getWindow(domElement);
      var offsetWin = offsetParent && isElement(offsetParent) ? getWindow(offsetParent) : offsetParent;
      var currentIFrame = _win.frameElement;
      while (currentIFrame && offsetParent && offsetWin !== _win) {
        var iframeScale = getScale(currentIFrame);
        var iframeRect = currentIFrame.getBoundingClientRect();
        var css = getComputedStyle(currentIFrame);
        iframeRect.x += (currentIFrame.clientLeft + parseFloat(css.paddingLeft)) * iframeScale.x;
        iframeRect.y += (currentIFrame.clientTop + parseFloat(css.paddingTop)) * iframeScale.y;
        x *= iframeScale.x;
        y *= iframeScale.y;
        width *= iframeScale.x;
        height *= iframeScale.y;
        x += iframeRect.x;
        y += iframeRect.y;
        currentIFrame = getWindow(currentIFrame).frameElement;
      }
    }
    return rectToClientRect({
      width: width,
      height: height,
      x: x,
      y: y
    });
  }
  function getDocumentElement(node) {
    return ((isNode(node) ? node.ownerDocument : node.document) || window.document).documentElement;
  }
  function getNodeScroll(element) {
    if (isElement(element)) {
      return {
        scrollLeft: element.scrollLeft,
        scrollTop: element.scrollTop
      };
    }
    return {
      scrollLeft: element.pageXOffset,
      scrollTop: element.pageYOffset
    };
  }
  function convertOffsetParentRelativeRectToViewportRelativeRect(_ref) {
    var rect = _ref.rect,
      offsetParent = _ref.offsetParent,
      strategy = _ref.strategy;
    var isOffsetParentAnElement = isHTMLElement(offsetParent);
    var documentElement = getDocumentElement(offsetParent);
    if (offsetParent === documentElement) {
      return rect;
    }
    var scroll = {
      scrollLeft: 0,
      scrollTop: 0
    };
    var scale = {
      x: 1,
      y: 1
    };
    var offsets = {
      x: 0,
      y: 0
    };
    if (isOffsetParentAnElement || !isOffsetParentAnElement && strategy !== 'fixed') {
      if (getNodeName(offsetParent) !== 'body' || isOverflowElement(documentElement)) {
        scroll = getNodeScroll(offsetParent);
      }
      if (isHTMLElement(offsetParent)) {
        var offsetRect = getBoundingClientRect(offsetParent);
        scale = getScale(offsetParent);
        offsets.x = offsetRect.x + offsetParent.clientLeft;
        offsets.y = offsetRect.y + offsetParent.clientTop;
      }
    }
    return {
      width: rect.width * scale.x,
      height: rect.height * scale.y,
      x: rect.x * scale.x - scroll.scrollLeft * scale.x + offsets.x,
      y: rect.y * scale.y - scroll.scrollTop * scale.y + offsets.y
    };
  }
  function getWindowScrollBarX(element) {
    // If <html> has a CSS width greater than the viewport, then this will be
    // incorrect for RTL.
    return getBoundingClientRect(getDocumentElement(element)).left + getNodeScroll(element).scrollLeft;
  }

  // Gets the entire size of the scrollable document area, even extending outside
  // of the `<html>` and `<body>` rect bounds if horizontally scrollable.
  function getDocumentRect(element) {
    var html = getDocumentElement(element);
    var scroll = getNodeScroll(element);
    var body = element.ownerDocument.body;
    var width = max(html.scrollWidth, html.clientWidth, body.scrollWidth, body.clientWidth);
    var height = max(html.scrollHeight, html.clientHeight, body.scrollHeight, body.clientHeight);
    var x = -scroll.scrollLeft + getWindowScrollBarX(element);
    var y = -scroll.scrollTop;
    if (getComputedStyle$1(body).direction === 'rtl') {
      x += max(html.clientWidth, body.clientWidth) - width;
    }
    return {
      width: width,
      height: height,
      x: x,
      y: y
    };
  }
  function getParentNode(node) {
    if (getNodeName(node) === 'html') {
      return node;
    }
    var result =
    // Step into the shadow DOM of the parent of a slotted node.
    node.assignedSlot ||
    // DOM Element detected.
    node.parentNode ||
    // ShadowRoot detected.
    isShadowRoot(node) && node.host ||
    // Fallback.
    getDocumentElement(node);
    return isShadowRoot(result) ? result.host : result;
  }
  function getNearestOverflowAncestor(node) {
    var parentNode = getParentNode(node);
    if (isLastTraversableNode(parentNode)) {
      // `getParentNode` will never return a `Document` due to the fallback
      // check, so it's either the <html> or <body> element.
      return parentNode.ownerDocument.body;
    }
    if (isHTMLElement(parentNode) && isOverflowElement(parentNode)) {
      return parentNode;
    }
    return getNearestOverflowAncestor(parentNode);
  }
  function getOverflowAncestors(node, list) {
    var _node$ownerDocument;
    if (list === void 0) {
      list = [];
    }
    var scrollableAncestor = getNearestOverflowAncestor(node);
    var isBody = scrollableAncestor === ((_node$ownerDocument = node.ownerDocument) == null ? void 0 : _node$ownerDocument.body);
    var win = getWindow(scrollableAncestor);
    if (isBody) {
      return list.concat(win, win.visualViewport || [], isOverflowElement(scrollableAncestor) ? scrollableAncestor : []);
    }
    return list.concat(scrollableAncestor, getOverflowAncestors(scrollableAncestor));
  }
  function getViewportRect(element, strategy) {
    var win = getWindow(element);
    var html = getDocumentElement(element);
    var visualViewport = win.visualViewport;
    var width = html.clientWidth;
    var height = html.clientHeight;
    var x = 0;
    var y = 0;
    if (visualViewport) {
      width = visualViewport.width;
      height = visualViewport.height;
      var visualViewportBased = isClientRectVisualViewportBased();
      if (!visualViewportBased || visualViewportBased && strategy === 'fixed') {
        x = visualViewport.offsetLeft;
        y = visualViewport.offsetTop;
      }
    }
    return {
      width: width,
      height: height,
      x: x,
      y: y
    };
  }

  // Returns the inner client rect, subtracting scrollbars if present.
  function getInnerBoundingClientRect(element, strategy) {
    var clientRect = getBoundingClientRect(element, true, strategy === 'fixed');
    var top = clientRect.top + element.clientTop;
    var left = clientRect.left + element.clientLeft;
    var scale = isHTMLElement(element) ? getScale(element) : {
      x: 1,
      y: 1
    };
    var width = element.clientWidth * scale.x;
    var height = element.clientHeight * scale.y;
    var x = left * scale.x;
    var y = top * scale.y;
    return {
      width: width,
      height: height,
      x: x,
      y: y
    };
  }
  function getClientRectFromClippingAncestor(element, clippingAncestor, strategy) {
    var rect;
    if (clippingAncestor === 'viewport') {
      rect = getViewportRect(element, strategy);
    } else if (clippingAncestor === 'document') {
      rect = getDocumentRect(getDocumentElement(element));
    } else if (isElement(clippingAncestor)) {
      rect = getInnerBoundingClientRect(clippingAncestor, strategy);
    } else {
      var mutableRect = _extends({}, clippingAncestor);
      if (isClientRectVisualViewportBased()) {
        var _win$visualViewport, _win$visualViewport2;
        var win = getWindow(element);
        mutableRect.x -= ((_win$visualViewport = win.visualViewport) == null ? void 0 : _win$visualViewport.offsetLeft) || 0;
        mutableRect.y -= ((_win$visualViewport2 = win.visualViewport) == null ? void 0 : _win$visualViewport2.offsetTop) || 0;
      }
      rect = mutableRect;
    }
    return rectToClientRect(rect);
  }

  // A "clipping ancestor" is an `overflow` element with the characteristic of
  // clipping (or hiding) child elements. This returns all clipping ancestors
  // of the given element up the tree.
  function getClippingElementAncestors(element, cache) {
    var cachedResult = cache.get(element);
    if (cachedResult) {
      return cachedResult;
    }
    var result = getOverflowAncestors(element).filter(function (el) {
      return isElement(el) && getNodeName(el) !== 'body';
    });
    var currentContainingBlockComputedStyle = null;
    var elementIsFixed = getComputedStyle$1(element).position === 'fixed';
    var currentNode = elementIsFixed ? getParentNode(element) : element;

    // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block
    while (isElement(currentNode) && !isLastTraversableNode(currentNode)) {
      var computedStyle = getComputedStyle$1(currentNode);
      var containingBlock = isContainingBlock(currentNode);
      var shouldIgnoreCurrentNode = computedStyle.position === 'fixed';
      if (shouldIgnoreCurrentNode) {
        currentContainingBlockComputedStyle = null;
      } else {
        var shouldDropCurrentNode = elementIsFixed ? !containingBlock && !currentContainingBlockComputedStyle : !containingBlock && computedStyle.position === 'static' && !!currentContainingBlockComputedStyle && ['absolute', 'fixed'].includes(currentContainingBlockComputedStyle.position);
        if (shouldDropCurrentNode) {
          // Drop non-containing blocks.
          result = result.filter(function (ancestor) {
            return ancestor !== currentNode;
          });
        } else {
          // Record last containing block for next iteration.
          currentContainingBlockComputedStyle = computedStyle;
        }
      }
      currentNode = getParentNode(currentNode);
    }
    cache.set(element, result);
    return result;
  }

  // Gets the maximum area that the element is visible in due to any number of
  // clipping ancestors.
  function getClippingRect(_ref) {
    var element = _ref.element,
      boundary = _ref.boundary,
      rootBoundary = _ref.rootBoundary,
      strategy = _ref.strategy;
    var elementClippingAncestors = boundary === 'clippingAncestors' ? getClippingElementAncestors(element, this._c) : [].concat(boundary);
    var clippingAncestors = [].concat(_toConsumableArray(elementClippingAncestors), [rootBoundary]);
    var firstClippingAncestor = clippingAncestors[0];
    var clippingRect = clippingAncestors.reduce(function (accRect, clippingAncestor) {
      var rect = getClientRectFromClippingAncestor(element, clippingAncestor, strategy);
      accRect.top = max(rect.top, accRect.top);
      accRect.right = min(rect.right, accRect.right);
      accRect.bottom = min(rect.bottom, accRect.bottom);
      accRect.left = max(rect.left, accRect.left);
      return accRect;
    }, getClientRectFromClippingAncestor(element, firstClippingAncestor, strategy));
    return {
      width: clippingRect.right - clippingRect.left,
      height: clippingRect.bottom - clippingRect.top,
      x: clippingRect.left,
      y: clippingRect.top
    };
  }
  function getDimensions(element) {
    return getCssDimensions(element);
  }
  function getTrueOffsetParent(element, polyfill) {
    if (!isHTMLElement(element) || getComputedStyle$1(element).position === 'fixed') {
      return null;
    }
    if (polyfill) {
      return polyfill(element);
    }
    return element.offsetParent;
  }
  function getContainingBlock(element) {
    var currentNode = getParentNode(element);
    while (isHTMLElement(currentNode) && !isLastTraversableNode(currentNode)) {
      if (isContainingBlock(currentNode)) {
        return currentNode;
      } else {
        currentNode = getParentNode(currentNode);
      }
    }
    return null;
  }

  // Gets the closest ancestor positioned element. Handles some edge cases,
  // such as table ancestors and cross browser bugs.
  function getOffsetParent(element, polyfill) {
    var window = getWindow(element);
    if (!isHTMLElement(element)) {
      return window;
    }
    var offsetParent = getTrueOffsetParent(element, polyfill);
    while (offsetParent && isTableElement(offsetParent) && getComputedStyle$1(offsetParent).position === 'static') {
      offsetParent = getTrueOffsetParent(offsetParent, polyfill);
    }
    if (offsetParent && (getNodeName(offsetParent) === 'html' || getNodeName(offsetParent) === 'body' && getComputedStyle$1(offsetParent).position === 'static' && !isContainingBlock(offsetParent))) {
      return window;
    }
    return offsetParent || getContainingBlock(element) || window;
  }
  function getRectRelativeToOffsetParent(element, offsetParent, strategy) {
    var isOffsetParentAnElement = isHTMLElement(offsetParent);
    var documentElement = getDocumentElement(offsetParent);
    var rect = getBoundingClientRect(element, true, strategy === 'fixed', offsetParent);
    var scroll = {
      scrollLeft: 0,
      scrollTop: 0
    };
    var offsets = {
      x: 0,
      y: 0
    };
    if (isOffsetParentAnElement || !isOffsetParentAnElement && strategy !== 'fixed') {
      if (getNodeName(offsetParent) !== 'body' || isOverflowElement(documentElement)) {
        scroll = getNodeScroll(offsetParent);
      }
      if (isHTMLElement(offsetParent)) {
        var offsetRect = getBoundingClientRect(offsetParent, true);
        offsets.x = offsetRect.x + offsetParent.clientLeft;
        offsets.y = offsetRect.y + offsetParent.clientTop;
      } else if (documentElement) {
        offsets.x = getWindowScrollBarX(documentElement);
      }
    }
    return {
      x: rect.left + scroll.scrollLeft - offsets.x,
      y: rect.top + scroll.scrollTop - offsets.y,
      width: rect.width,
      height: rect.height
    };
  }
  var platform = {
    getClippingRect: getClippingRect,
    convertOffsetParentRelativeRectToViewportRelativeRect: convertOffsetParentRelativeRectToViewportRelativeRect,
    isElement: isElement,
    getDimensions: getDimensions,
    getOffsetParent: getOffsetParent,
    getDocumentElement: getDocumentElement,
    getScale: getScale,
    getElementRects: function getElementRects(_ref) {
      var _this3 = this;
      return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
        var reference, floating, strategy, getOffsetParentFn, getDimensionsFn;
        return _regeneratorRuntime().wrap(function _callee5$(_context5) {
          while (1) switch (_context5.prev = _context5.next) {
            case 0:
              reference = _ref.reference, floating = _ref.floating, strategy = _ref.strategy;
              getOffsetParentFn = _this3.getOffsetParent || getOffsetParent;
              getDimensionsFn = _this3.getDimensions;
              _context5.t0 = getRectRelativeToOffsetParent;
              _context5.t1 = reference;
              _context5.next = 7;
              return getOffsetParentFn(floating);
            case 7:
              _context5.t2 = _context5.sent;
              _context5.t3 = strategy;
              _context5.t4 = (0, _context5.t0)(_context5.t1, _context5.t2, _context5.t3);
              _context5.t5 = _extends;
              _context5.t6 = {
                x: 0,
                y: 0
              };
              _context5.next = 14;
              return getDimensionsFn(floating);
            case 14:
              _context5.t7 = _context5.sent;
              _context5.t8 = (0, _context5.t5)(_context5.t6, _context5.t7);
              return _context5.abrupt("return", {
                reference: _context5.t4,
                floating: _context5.t8
              });
            case 17:
            case "end":
              return _context5.stop();
          }
        }, _callee5);
      }))();
    },
    getClientRects: function getClientRects(element) {
      return Array.from(element.getClientRects());
    },
    isRTL: function isRTL(element) {
      return getComputedStyle$1(element).direction === 'rtl';
    }
  };

  /**
   * Automatically updates the position of the floating element when necessary.
   * Should only be called when the floating element is mounted on the DOM or
   * visible on the screen.
   * @returns cleanup function that should be invoked when the floating element is
   * removed from the DOM or hidden from the screen.
   * @see https://floating-ui.com/docs/autoUpdate
   */
  function autoUpdate(reference, floating, update, options) {
    if (options === void 0) {
      options = {};
    }
    var _options4 = options,
      _options4$ancestorScr = _options4.ancestorScroll,
      _ancestorScroll = _options4$ancestorScr === void 0 ? true : _options4$ancestorScr,
      _options4$ancestorRes = _options4.ancestorResize,
      ancestorResize = _options4$ancestorRes === void 0 ? true : _options4$ancestorRes,
      _options4$elementResi = _options4.elementResize,
      elementResize = _options4$elementResi === void 0 ? true : _options4$elementResi,
      _options4$animationFr = _options4.animationFrame,
      animationFrame = _options4$animationFr === void 0 ? false : _options4$animationFr;
    var ancestorScroll = _ancestorScroll && !animationFrame;
    var ancestors = ancestorScroll || ancestorResize ? [].concat(_toConsumableArray(isElement(reference) ? getOverflowAncestors(reference) : reference.contextElement ? getOverflowAncestors(reference.contextElement) : []), _toConsumableArray(getOverflowAncestors(floating))) : [];
    ancestors.forEach(function (ancestor) {
      ancestorScroll && ancestor.addEventListener('scroll', update, {
        passive: true
      });
      ancestorResize && ancestor.addEventListener('resize', update);
    });
    var observer = null;
    if (elementResize) {
      observer = new ResizeObserver(function () {
        update();
      });
      isElement(reference) && !animationFrame && observer.observe(reference);
      if (!isElement(reference) && reference.contextElement && !animationFrame) {
        observer.observe(reference.contextElement);
      }
      observer.observe(floating);
    }
    var frameId;
    var prevRefRect = animationFrame ? getBoundingClientRect(reference) : null;
    if (animationFrame) {
      frameLoop();
    }
    function frameLoop() {
      var nextRefRect = getBoundingClientRect(reference);
      if (prevRefRect && (nextRefRect.x !== prevRefRect.x || nextRefRect.y !== prevRefRect.y || nextRefRect.width !== prevRefRect.width || nextRefRect.height !== prevRefRect.height)) {
        update();
      }
      prevRefRect = nextRefRect;
      frameId = requestAnimationFrame(frameLoop);
    }
    update();
    return function () {
      var _observer;
      ancestors.forEach(function (ancestor) {
        ancestorScroll && ancestor.removeEventListener('scroll', update);
        ancestorResize && ancestor.removeEventListener('resize', update);
      });
      (_observer = observer) == null ? void 0 : _observer.disconnect();
      observer = null;
      if (animationFrame) {
        cancelAnimationFrame(frameId);
      }
    };
  }

  /**
   * Computes the `x` and `y` coordinates that will place the floating element
   * next to a reference element when it is given a certain CSS positioning
   * strategy.
   */
  var computePosition = function computePosition(reference, floating, options) {
    // This caches the expensive `getClippingElementAncestors` function so that
    // multiple lifecycle resets re-use the same result. It only lives for a
    // single call. If other functions become expensive, we can add them as well.
    var cache = new Map();
    var mergedOptions = _extends({
      platform: platform
    }, options);
    var platformWithCache = _extends({}, mergedOptions.platform, {
      _c: cache
    });
    return computePosition$1(reference, floating, _extends({}, mergedOptions, {
      platform: platformWithCache
    }));
  };

  /**
   * Floating UI Options
   *
   * @typedef {object} FloatingUIOptions
   */

  /**
   * Determines options for the tooltip and initializes event listeners.
   *
   * @param {Step} step The step instance
   *
   * @return {FloatingUIOptions}
   */
  function setupTooltip(step) {
    if (step.cleanup) {
      step.cleanup();
    }
    var attachToOptions = step._getResolvedAttachToOptions();
    var target = attachToOptions.element;
    var floatingUIOptions = getFloatingUIOptions(attachToOptions, step);
    var shouldCenter = shouldCenterStep(attachToOptions);
    if (shouldCenter) {
      target = document.body;
      var content = step.shepherdElementComponent.getElement();
      content.classList.add('shepherd-centered');
    }
    step.cleanup = autoUpdate(target, step.el, function () {
      // The element might have already been removed by the end of the tour.
      if (!step.el) {
        step.cleanup();
        return;
      }
      setPosition(target, step, floatingUIOptions, shouldCenter);
    });
    step.target = attachToOptions.element;
    return floatingUIOptions;
  }

  /**
   * Merge tooltip options handling nested keys.
   *
   * @param tourOptions - The default tour options.
   * @param options - Step specific options.
   *
   * @return {floatingUIOptions: FloatingUIOptions}
   */
  function mergeTooltipConfig(tourOptions, options) {
    return {
      floatingUIOptions: cjs(tourOptions.floatingUIOptions || {}, options.floatingUIOptions || {})
    };
  }

  /**
   * Cleanup function called when the step is closed/destroyed.
   *
   * @param {Step} step
   */
  function destroyTooltip(step) {
    if (step.cleanup) {
      step.cleanup();
    }
    step.cleanup = null;
  }

  /**
   *
   * @return {Promise<*>}
   */
  function setPosition(target, step, floatingUIOptions, shouldCenter) {
    return computePosition(target, step.el, floatingUIOptions).then(floatingUIposition(step, shouldCenter))
    // Wait before forcing focus.
    .then(function (step) {
      return new Promise(function (resolve) {
        setTimeout(function () {
          return resolve(step);
        }, 300);
      });
    })
    // Replaces focusAfterRender modifier.
    .then(function (step) {
      if (step && step.el) {
        step.el.focus({
          preventScroll: true
        });
      }
    });
  }

  /**
   *
   * @param step
   * @param shouldCenter
   * @return {function({x: *, y: *, placement: *, middlewareData: *}): Promise<unknown>}
   */
  function floatingUIposition(step, shouldCenter) {
    return function (_ref) {
      var x = _ref.x,
        y = _ref.y,
        placement = _ref.placement,
        middlewareData = _ref.middlewareData;
      if (!step.el) {
        return step;
      }
      if (shouldCenter) {
        Object.assign(step.el.style, {
          position: 'fixed',
          left: '50%',
          top: '50%',
          transform: 'translate(-50%, -50%)'
        });
      } else {
        Object.assign(step.el.style, {
          position: 'absolute',
          left: "".concat(x, "px"),
          top: "".concat(y, "px")
        });
      }
      step.el.dataset.popperPlacement = placement;
      placeArrow(step.el, middlewareData);
      return step;
    };
  }

  /**
   *
   * @param el
   * @param middlewareData
   */
  function placeArrow(el, middlewareData) {
    var arrowEl = el.querySelector('.shepherd-arrow');
    if (arrowEl && middlewareData.arrow) {
      var _middlewareData$arrow = middlewareData.arrow,
        arrowX = _middlewareData$arrow.x,
        arrowY = _middlewareData$arrow.y;
      Object.assign(arrowEl.style, {
        left: arrowX != null ? "".concat(arrowX, "px") : '',
        top: arrowY != null ? "".concat(arrowY, "px") : ''
      });
    }
  }

  /**
   * Gets the `Floating UI` options from a set of base `attachTo` options
   * @param attachToOptions
   * @param {Step} step The step instance
   * @return {Object}
   * @private
   */
  function getFloatingUIOptions(attachToOptions, step) {
    var options = {
      strategy: 'absolute',
      middleware: []
    };
    var arrowEl = addArrow(step);
    var shouldCenter = shouldCenterStep(attachToOptions);
    if (!shouldCenter) {
      options.middleware.push(flip(),
      // Replicate PopperJS default behavior.
      shift({
        limiter: limitShift(),
        crossAxis: true
      }));
      if (arrowEl) {
        options.middleware.push(arrow({
          element: arrowEl
        }));
      }
      options.placement = attachToOptions.on;
    }
    return cjs(step.options.floatingUIOptions || {}, options);
  }

  /**
   * @param {Step} step
   * @return {HTMLElement|false|null}
   */
  function addArrow(step) {
    if (step.options.arrow && step.el) {
      return step.el.querySelector('.shepherd-arrow');
    }
    return false;
  }
  function noop() {}
  function assign(tar, src) {
    // @ts-ignore
    for (var k in src) tar[k] = src[k];
    return tar;
  }
  function run(fn) {
    return fn();
  }
  function blank_object() {
    return Object.create(null);
  }
  function run_all(fns) {
    fns.forEach(run);
  }
  function is_function(thing) {
    return typeof thing === 'function';
  }
  function safe_not_equal(a, b) {
    return a != a ? b == b : a !== b || a && _typeof(a) === 'object' || typeof a === 'function';
  }
  function is_empty(obj) {
    return Object.keys(obj).length === 0;
  }
  function append(target, node) {
    target.appendChild(node);
  }
  function insert(target, node, anchor) {
    target.insertBefore(node, anchor || null);
  }
  function detach(node) {
    if (node.parentNode) {
      node.parentNode.removeChild(node);
    }
  }
  function destroy_each(iterations, detaching) {
    for (var i = 0; i < iterations.length; i += 1) {
      if (iterations[i]) iterations[i].d(detaching);
    }
  }
  function element(name) {
    return document.createElement(name);
  }
  function svg_element(name) {
    return document.createElementNS('http://www.w3.org/2000/svg', name);
  }
  function text(data) {
    return document.createTextNode(data);
  }
  function space() {
    return text(' ');
  }
  function empty() {
    return text('');
  }
  function listen(node, event, handler, options) {
    node.addEventListener(event, handler, options);
    return function () {
      return node.removeEventListener(event, handler, options);
    };
  }
  function attr(node, attribute, value) {
    if (value == null) node.removeAttribute(attribute);else if (node.getAttribute(attribute) !== value) node.setAttribute(attribute, value);
  }
  function set_attributes(node, attributes) {
    // @ts-ignore
    var descriptors = Object.getOwnPropertyDescriptors(node.__proto__);
    for (var key in attributes) {
      if (attributes[key] == null) {
        node.removeAttribute(key);
      } else if (key === 'style') {
        node.style.cssText = attributes[key];
      } else if (key === '__value') {
        node.value = node[key] = attributes[key];
      } else if (descriptors[key] && descriptors[key].set) {
        node[key] = attributes[key];
      } else {
        attr(node, key, attributes[key]);
      }
    }
  }
  function children(element) {
    return Array.from(element.childNodes);
  }
  function toggle_class(element, name, toggle) {
    element.classList[toggle ? 'add' : 'remove'](name);
  }
  var current_component;
  function set_current_component(component) {
    current_component = component;
  }
  function get_current_component() {
    if (!current_component) throw new Error('Function called outside component initialization');
    return current_component;
  }
  /**
   * The `onMount` function schedules a callback to run as soon as the component has been mounted to the DOM.
   * It must be called during the component's initialisation (but doesn't need to live *inside* the component;
   * it can be called from an external module).
   *
   * `onMount` does not run inside a [server-side component](/docs#run-time-server-side-component-api).
   *
   * https://svelte.dev/docs#run-time-svelte-onmount
   */
  function onMount(fn) {
    get_current_component().$$.on_mount.push(fn);
  }
  /**
   * Schedules a callback to run immediately after the component has been updated.
   *
   * The first time the callback runs will be after the initial `onMount`
   */
  function afterUpdate(fn) {
    get_current_component().$$.after_update.push(fn);
  }
  var dirty_components = [];
  var binding_callbacks = [];
  var render_callbacks = [];
  var flush_callbacks = [];
  var resolved_promise = /* @__PURE__ */Promise.resolve();
  var update_scheduled = false;
  function schedule_update() {
    if (!update_scheduled) {
      update_scheduled = true;
      resolved_promise.then(flush);
    }
  }
  function add_render_callback(fn) {
    render_callbacks.push(fn);
  }
  // flush() calls callbacks in this order:
  // 1. All beforeUpdate callbacks, in order: parents before children
  // 2. All bind:this callbacks, in reverse order: children before parents.
  // 3. All afterUpdate callbacks, in order: parents before children. EXCEPT
  //    for afterUpdates called during the initial onMount, which are called in
  //    reverse order: children before parents.
  // Since callbacks might update component values, which could trigger another
  // call to flush(), the following steps guard against this:
  // 1. During beforeUpdate, any updated components will be added to the
  //    dirty_components array and will cause a reentrant call to flush(). Because
  //    the flush index is kept outside the function, the reentrant call will pick
  //    up where the earlier call left off and go through all dirty components. The
  //    current_component value is saved and restored so that the reentrant call will
  //    not interfere with the "parent" flush() call.
  // 2. bind:this callbacks cannot trigger new flush() calls.
  // 3. During afterUpdate, any updated components will NOT have their afterUpdate
  //    callback called a second time; the seen_callbacks set, outside the flush()
  //    function, guarantees this behavior.
  var seen_callbacks = new Set();
  var flushidx = 0; // Do *not* move this inside the flush() function
  function flush() {
    // Do not reenter flush while dirty components are updated, as this can
    // result in an infinite loop. Instead, let the inner flush handle it.
    // Reentrancy is ok afterwards for bindings etc.
    if (flushidx !== 0) {
      return;
    }
    var saved_component = current_component;
    do {
      // first, call beforeUpdate functions
      // and update components
      try {
        while (flushidx < dirty_components.length) {
          var component = dirty_components[flushidx];
          flushidx++;
          set_current_component(component);
          update(component.$$);
        }
      } catch (e) {
        // reset dirty state to not end up in a deadlocked state and then rethrow
        dirty_components.length = 0;
        flushidx = 0;
        throw e;
      }
      set_current_component(null);
      dirty_components.length = 0;
      flushidx = 0;
      while (binding_callbacks.length) binding_callbacks.pop()();
      // then, once components are updated, call
      // afterUpdate functions. This may cause
      // subsequent updates...
      for (var i = 0; i < render_callbacks.length; i += 1) {
        var callback = render_callbacks[i];
        if (!seen_callbacks.has(callback)) {
          // ...so guard against infinite loops
          seen_callbacks.add(callback);
          callback();
        }
      }
      render_callbacks.length = 0;
    } while (dirty_components.length);
    while (flush_callbacks.length) {
      flush_callbacks.pop()();
    }
    update_scheduled = false;
    seen_callbacks.clear();
    set_current_component(saved_component);
  }
  function update($$) {
    if ($$.fragment !== null) {
      $$.update();
      run_all($$.before_update);
      var dirty = $$.dirty;
      $$.dirty = [-1];
      $$.fragment && $$.fragment.p($$.ctx, dirty);
      $$.after_update.forEach(add_render_callback);
    }
  }
  /**
   * Useful for example to execute remaining `afterUpdate` callbacks before executing `destroy`.
   */
  function flush_render_callbacks(fns) {
    var filtered = [];
    var targets = [];
    render_callbacks.forEach(function (c) {
      return fns.indexOf(c) === -1 ? filtered.push(c) : targets.push(c);
    });
    targets.forEach(function (c) {
      return c();
    });
    render_callbacks = filtered;
  }
  var outroing = new Set();
  var outros;
  function group_outros() {
    outros = {
      r: 0,
      c: [],
      p: outros // parent group
    };
  }

  function check_outros() {
    if (!outros.r) {
      run_all(outros.c);
    }
    outros = outros.p;
  }
  function transition_in(block, local) {
    if (block && block.i) {
      outroing.delete(block);
      block.i(local);
    }
  }
  function transition_out(block, local, detach, callback) {
    if (block && block.o) {
      if (outroing.has(block)) return;
      outroing.add(block);
      outros.c.push(function () {
        outroing.delete(block);
        if (callback) {
          if (detach) block.d(1);
          callback();
        }
      });
      block.o(local);
    } else if (callback) {
      callback();
    }
  }
  function get_spread_update(levels, updates) {
    var update = {};
    var to_null_out = {};
    var accounted_for = {
      $$scope: 1
    };
    var i = levels.length;
    while (i--) {
      var o = levels[i];
      var n = updates[i];
      if (n) {
        for (var key in o) {
          if (!(key in n)) to_null_out[key] = 1;
        }
        for (var _key2 in n) {
          if (!accounted_for[_key2]) {
            update[_key2] = n[_key2];
            accounted_for[_key2] = 1;
          }
        }
        levels[i] = n;
      } else {
        for (var _key3 in o) {
          accounted_for[_key3] = 1;
        }
      }
    }
    for (var _key4 in to_null_out) {
      if (!(_key4 in update)) update[_key4] = undefined;
    }
    return update;
  }
  function create_component(block) {
    block && block.c();
  }
  function mount_component(component, target, anchor, customElement) {
    var _component$$$ = component.$$,
      fragment = _component$$$.fragment,
      after_update = _component$$$.after_update;
    fragment && fragment.m(target, anchor);
    if (!customElement) {
      // onMount happens before the initial afterUpdate
      add_render_callback(function () {
        var new_on_destroy = component.$$.on_mount.map(run).filter(is_function);
        // if the component was destroyed immediately
        // it will update the `$$.on_destroy` reference to `null`.
        // the destructured on_destroy may still reference to the old array
        if (component.$$.on_destroy) {
          var _component$$$$on_dest;
          (_component$$$$on_dest = component.$$.on_destroy).push.apply(_component$$$$on_dest, _toConsumableArray(new_on_destroy));
        } else {
          // Edge case - component was destroyed immediately,
          // most likely as a result of a binding initialising
          run_all(new_on_destroy);
        }
        component.$$.on_mount = [];
      });
    }
    after_update.forEach(add_render_callback);
  }
  function destroy_component(component, detaching) {
    var $$ = component.$$;
    if ($$.fragment !== null) {
      flush_render_callbacks($$.after_update);
      run_all($$.on_destroy);
      $$.fragment && $$.fragment.d(detaching);
      // TODO null out other refs, including component.$$ (but need to
      // preserve final state?)
      $$.on_destroy = $$.fragment = null;
      $$.ctx = [];
    }
  }
  function make_dirty(component, i) {
    if (component.$$.dirty[0] === -1) {
      dirty_components.push(component);
      schedule_update();
      component.$$.dirty.fill(0);
    }
    component.$$.dirty[i / 31 | 0] |= 1 << i % 31;
  }
  function init(component, options, instance, create_fragment, not_equal, props, append_styles, dirty) {
    if (dirty === void 0) {
      dirty = [-1];
    }
    var parent_component = current_component;
    set_current_component(component);
    var $$ = component.$$ = {
      fragment: null,
      ctx: [],
      // state
      props: props,
      update: noop,
      not_equal: not_equal,
      bound: blank_object(),
      // lifecycle
      on_mount: [],
      on_destroy: [],
      on_disconnect: [],
      before_update: [],
      after_update: [],
      context: new Map(options.context || (parent_component ? parent_component.$$.context : [])),
      // everything else
      callbacks: blank_object(),
      dirty: dirty,
      skip_bound: false,
      root: options.target || parent_component.$$.root
    };
    append_styles && append_styles($$.root);
    var ready = false;
    $$.ctx = instance ? instance(component, options.props || {}, function (i, ret) {
      var value = (arguments.length <= 2 ? 0 : arguments.length - 2) ? arguments.length <= 2 ? undefined : arguments[2] : ret;
      if ($$.ctx && not_equal($$.ctx[i], $$.ctx[i] = value)) {
        if (!$$.skip_bound && $$.bound[i]) $$.bound[i](value);
        if (ready) make_dirty(component, i);
      }
      return ret;
    }) : [];
    $$.update();
    ready = true;
    run_all($$.before_update);
    // `false` as a special case of no DOM component
    $$.fragment = create_fragment ? create_fragment($$.ctx) : false;
    if (options.target) {
      if (options.hydrate) {
        var nodes = children(options.target);
        // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
        $$.fragment && $$.fragment.l(nodes);
        nodes.forEach(detach);
      } else {
        // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
        $$.fragment && $$.fragment.c();
      }
      if (options.intro) transition_in(component.$$.fragment);
      mount_component(component, options.target, options.anchor, options.customElement);
      flush();
    }
    set_current_component(parent_component);
  }
  /**
   * Base class for Svelte components. Used when dev=false.
   */
  var SvelteComponent = /*#__PURE__*/function () {
    function SvelteComponent() {
      _classCallCheck(this, SvelteComponent);
    }
    _createClass(SvelteComponent, [{
      key: "$destroy",
      value: function $destroy() {
        destroy_component(this, 1);
        this.$destroy = noop;
      }
    }, {
      key: "$on",
      value: function $on(type, callback) {
        if (!is_function(callback)) {
          return noop;
        }
        var callbacks = this.$$.callbacks[type] || (this.$$.callbacks[type] = []);
        callbacks.push(callback);
        return function () {
          var index = callbacks.indexOf(callback);
          if (index !== -1) callbacks.splice(index, 1);
        };
      }
    }, {
      key: "$set",
      value: function $set($$props) {
        if (this.$$set && !is_empty($$props)) {
          this.$$.skip_bound = true;
          this.$$set($$props);
          this.$$.skip_bound = false;
        }
      }
    }]);
    return SvelteComponent;
  }();
  /* src/js/components/shepherd-button.svelte generated by Svelte v3.58.0 */
  function create_fragment$8(ctx) {
    var button;
    var button_aria_label_value;
    var button_class_value;
    var mounted;
    var dispose;
    return {
      c: function c() {
        button = element("button");
        attr(button, "aria-label", button_aria_label_value = /*label*/ctx[3] ? /*label*/ctx[3] : null);
        attr(button, "class", button_class_value = "".concat( /*classes*/ctx[1] || '', " shepherd-button ").concat( /*secondary*/ctx[4] ? 'shepherd-button-secondary' : ''));
        button.disabled = /*disabled*/ctx[2];
        attr(button, "tabindex", "0");
      },
      m: function m(target, anchor) {
        insert(target, button, anchor);
        button.innerHTML = /*text*/ctx[5];
        if (!mounted) {
          dispose = listen(button, "click", function () {
            if (is_function( /*action*/ctx[0])) /*action*/ctx[0].apply(this, arguments);
          });
          mounted = true;
        }
      },
      p: function p(new_ctx, _ref) {
        var _ref7 = _slicedToArray(_ref, 1),
          dirty = _ref7[0];
        ctx = new_ctx;
        if (dirty & /*text*/32) button.innerHTML = /*text*/ctx[5];
        if (dirty & /*label*/8 && button_aria_label_value !== (button_aria_label_value = /*label*/ctx[3] ? /*label*/ctx[3] : null)) {
          attr(button, "aria-label", button_aria_label_value);
        }
        if (dirty & /*classes, secondary*/18 && button_class_value !== (button_class_value = "".concat( /*classes*/ctx[1] || '', " shepherd-button ").concat( /*secondary*/ctx[4] ? 'shepherd-button-secondary' : ''))) {
          attr(button, "class", button_class_value);
        }
        if (dirty & /*disabled*/4) {
          button.disabled = /*disabled*/ctx[2];
        }
      },
      i: noop,
      o: noop,
      d: function d(detaching) {
        if (detaching) detach(button);
        mounted = false;
        dispose();
      }
    };
  }
  function instance$8($$self, $$props, $$invalidate) {
    var config = $$props.config,
      step = $$props.step;
    var action, classes, disabled, label, secondary, text;
    function getConfigOption(option) {
      if (isFunction(option)) {
        return option = option.call(step);
      }
      return option;
    }
    $$self.$$set = function ($$props) {
      if ('config' in $$props) $$invalidate(6, config = $$props.config);
      if ('step' in $$props) $$invalidate(7, step = $$props.step);
    };
    $$self.$$.update = function () {
      if ($$self.$$.dirty & /*config, step*/192) {
        {
          $$invalidate(0, action = config.action ? config.action.bind(step.tour) : null);
          $$invalidate(1, classes = config.classes);
          $$invalidate(2, disabled = config.disabled ? getConfigOption(config.disabled) : false);
          $$invalidate(3, label = config.label ? getConfigOption(config.label) : null);
          $$invalidate(4, secondary = config.secondary);
          $$invalidate(5, text = config.text ? getConfigOption(config.text) : null);
        }
      }
    };
    return [action, classes, disabled, label, secondary, text, config, step];
  }
  var Shepherd_button = /*#__PURE__*/function (_SvelteComponent) {
    _inherits(Shepherd_button, _SvelteComponent);
    var _super = _createSuper(Shepherd_button);
    function Shepherd_button(options) {
      var _this4;
      _classCallCheck(this, Shepherd_button);
      _this4 = _super.call(this);
      init(_assertThisInitialized(_this4), options, instance$8, create_fragment$8, safe_not_equal, {
        config: 6,
        step: 7
      });
      return _this4;
    }
    return _createClass(Shepherd_button);
  }(SvelteComponent);
  /* src/js/components/shepherd-footer.svelte generated by Svelte v3.58.0 */
  function get_each_context(ctx, list, i) {
    var child_ctx = ctx.slice();
    child_ctx[2] = list[i];
    return child_ctx;
  }

  // (24:4) {#if buttons}
  function create_if_block$3(ctx) {
    var each_1_anchor;
    var current;
    var each_value = /*buttons*/ctx[1];
    var each_blocks = [];
    for (var i = 0; i < each_value.length; i += 1) {
      each_blocks[i] = create_each_block(get_each_context(ctx, each_value, i));
    }
    var out = function out(i) {
      return transition_out(each_blocks[i], 1, 1, function () {
        each_blocks[i] = null;
      });
    };
    return {
      c: function c() {
        for (var _i = 0; _i < each_blocks.length; _i += 1) {
          each_blocks[_i].c();
        }
        each_1_anchor = empty();
      },
      m: function m(target, anchor) {
        for (var _i2 = 0; _i2 < each_blocks.length; _i2 += 1) {
          if (each_blocks[_i2]) {
            each_blocks[_i2].m(target, anchor);
          }
        }
        insert(target, each_1_anchor, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        if (dirty & /*buttons, step*/3) {
          each_value = /*buttons*/ctx[1];
          var _i3;
          for (_i3 = 0; _i3 < each_value.length; _i3 += 1) {
            var child_ctx = get_each_context(ctx, each_value, _i3);
            if (each_blocks[_i3]) {
              each_blocks[_i3].p(child_ctx, dirty);
              transition_in(each_blocks[_i3], 1);
            } else {
              each_blocks[_i3] = create_each_block(child_ctx);
              each_blocks[_i3].c();
              transition_in(each_blocks[_i3], 1);
              each_blocks[_i3].m(each_1_anchor.parentNode, each_1_anchor);
            }
          }
          group_outros();
          for (_i3 = each_value.length; _i3 < each_blocks.length; _i3 += 1) {
            out(_i3);
          }
          check_outros();
        }
      },
      i: function i(local) {
        if (current) return;
        for (var _i4 = 0; _i4 < each_value.length; _i4 += 1) {
          transition_in(each_blocks[_i4]);
        }
        current = true;
      },
      o: function o(local) {
        each_blocks = each_blocks.filter(Boolean);
        for (var _i5 = 0; _i5 < each_blocks.length; _i5 += 1) {
          transition_out(each_blocks[_i5]);
        }
        current = false;
      },
      d: function d(detaching) {
        destroy_each(each_blocks, detaching);
        if (detaching) detach(each_1_anchor);
      }
    };
  }

  // (25:8) {#each buttons as config}
  function create_each_block(ctx) {
    var shepherdbutton;
    var current;
    shepherdbutton = new Shepherd_button({
      props: {
        config: /*config*/ctx[2],
        step: /*step*/ctx[0]
      }
    });
    return {
      c: function c() {
        create_component(shepherdbutton.$$.fragment);
      },
      m: function m(target, anchor) {
        mount_component(shepherdbutton, target, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        var shepherdbutton_changes = {};
        if (dirty & /*buttons*/2) shepherdbutton_changes.config = /*config*/ctx[2];
        if (dirty & /*step*/1) shepherdbutton_changes.step = /*step*/ctx[0];
        shepherdbutton.$set(shepherdbutton_changes);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdbutton.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdbutton.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        destroy_component(shepherdbutton, detaching);
      }
    };
  }
  function create_fragment$7(ctx) {
    var footer;
    var current;
    var if_block = /*buttons*/ctx[1] && create_if_block$3(ctx);
    return {
      c: function c() {
        footer = element("footer");
        if (if_block) if_block.c();
        attr(footer, "class", "shepherd-footer");
      },
      m: function m(target, anchor) {
        insert(target, footer, anchor);
        if (if_block) if_block.m(footer, null);
        current = true;
      },
      p: function p(ctx, _ref) {
        var _ref8 = _slicedToArray(_ref, 1),
          dirty = _ref8[0];
        if ( /*buttons*/ctx[1]) {
          if (if_block) {
            if_block.p(ctx, dirty);
            if (dirty & /*buttons*/2) {
              transition_in(if_block, 1);
            }
          } else {
            if_block = create_if_block$3(ctx);
            if_block.c();
            transition_in(if_block, 1);
            if_block.m(footer, null);
          }
        } else if (if_block) {
          group_outros();
          transition_out(if_block, 1, 1, function () {
            if_block = null;
          });
          check_outros();
        }
      },
      i: function i(local) {
        if (current) return;
        transition_in(if_block);
        current = true;
      },
      o: function o(local) {
        transition_out(if_block);
        current = false;
      },
      d: function d(detaching) {
        if (detaching) detach(footer);
        if (if_block) if_block.d();
      }
    };
  }
  function instance$7($$self, $$props, $$invalidate) {
    var buttons;
    var step = $$props.step;
    $$self.$$set = function ($$props) {
      if ('step' in $$props) $$invalidate(0, step = $$props.step);
    };
    $$self.$$.update = function () {
      if ($$self.$$.dirty & /*step*/1) {
        $$invalidate(1, buttons = step.options.buttons);
      }
    };
    return [step, buttons];
  }
  var Shepherd_footer = /*#__PURE__*/function (_SvelteComponent2) {
    _inherits(Shepherd_footer, _SvelteComponent2);
    var _super2 = _createSuper(Shepherd_footer);
    function Shepherd_footer(options) {
      var _this5;
      _classCallCheck(this, Shepherd_footer);
      _this5 = _super2.call(this);
      init(_assertThisInitialized(_this5), options, instance$7, create_fragment$7, safe_not_equal, {
        step: 0
      });
      return _this5;
    }
    return _createClass(Shepherd_footer);
  }(SvelteComponent);
  /* src/js/components/shepherd-cancel-icon.svelte generated by Svelte v3.58.0 */
  function create_fragment$6(ctx) {
    var button;
    var span;
    var button_aria_label_value;
    var mounted;
    var dispose;
    return {
      c: function c() {
        button = element("button");
        span = element("span");
        span.textContent = "×";
        attr(span, "aria-hidden", "true");
        attr(button, "aria-label", button_aria_label_value = /*cancelIcon*/ctx[0].label ? /*cancelIcon*/ctx[0].label : 'Close Tour');
        attr(button, "class", "shepherd-cancel-icon");
        attr(button, "type", "button");
      },
      m: function m(target, anchor) {
        insert(target, button, anchor);
        append(button, span);
        if (!mounted) {
          dispose = listen(button, "click", /*handleCancelClick*/ctx[1]);
          mounted = true;
        }
      },
      p: function p(ctx, _ref) {
        var _ref9 = _slicedToArray(_ref, 1),
          dirty = _ref9[0];
        if (dirty & /*cancelIcon*/1 && button_aria_label_value !== (button_aria_label_value = /*cancelIcon*/ctx[0].label ? /*cancelIcon*/ctx[0].label : 'Close Tour')) {
          attr(button, "aria-label", button_aria_label_value);
        }
      },
      i: noop,
      o: noop,
      d: function d(detaching) {
        if (detaching) detach(button);
        mounted = false;
        dispose();
      }
    };
  }
  function instance$6($$self, $$props, $$invalidate) {
    var cancelIcon = $$props.cancelIcon,
      step = $$props.step;

    /**
    * Add a click listener to the cancel link that cancels the tour
    */
    var handleCancelClick = function handleCancelClick(e) {
      e.preventDefault();
      step.cancel();
    };
    $$self.$$set = function ($$props) {
      if ('cancelIcon' in $$props) $$invalidate(0, cancelIcon = $$props.cancelIcon);
      if ('step' in $$props) $$invalidate(2, step = $$props.step);
    };
    return [cancelIcon, handleCancelClick, step];
  }
  var Shepherd_cancel_icon = /*#__PURE__*/function (_SvelteComponent3) {
    _inherits(Shepherd_cancel_icon, _SvelteComponent3);
    var _super3 = _createSuper(Shepherd_cancel_icon);
    function Shepherd_cancel_icon(options) {
      var _this6;
      _classCallCheck(this, Shepherd_cancel_icon);
      _this6 = _super3.call(this);
      init(_assertThisInitialized(_this6), options, instance$6, create_fragment$6, safe_not_equal, {
        cancelIcon: 0,
        step: 2
      });
      return _this6;
    }
    return _createClass(Shepherd_cancel_icon);
  }(SvelteComponent);
  /* src/js/components/shepherd-title.svelte generated by Svelte v3.58.0 */
  function create_fragment$5(ctx) {
    var h3;
    return {
      c: function c() {
        h3 = element("h3");
        attr(h3, "id", /*labelId*/ctx[1]);
        attr(h3, "class", "shepherd-title");
      },
      m: function m(target, anchor) {
        insert(target, h3, anchor);
        /*h3_binding*/
        ctx[3](h3);
      },
      p: function p(ctx, _ref) {
        var _ref10 = _slicedToArray(_ref, 1),
          dirty = _ref10[0];
        if (dirty & /*labelId*/2) {
          attr(h3, "id", /*labelId*/ctx[1]);
        }
      },
      i: noop,
      o: noop,
      d: function d(detaching) {
        if (detaching) detach(h3);
        /*h3_binding*/
        ctx[3](null);
      }
    };
  }
  function instance$5($$self, $$props, $$invalidate) {
    var labelId = $$props.labelId,
      element = $$props.element,
      title = $$props.title;
    afterUpdate(function () {
      if (isFunction(title)) {
        $$invalidate(2, title = title());
      }
      $$invalidate(0, element.innerHTML = title, element);
    });
    function h3_binding($$value) {
      binding_callbacks[$$value ? 'unshift' : 'push'](function () {
        element = $$value;
        $$invalidate(0, element);
      });
    }
    $$self.$$set = function ($$props) {
      if ('labelId' in $$props) $$invalidate(1, labelId = $$props.labelId);
      if ('element' in $$props) $$invalidate(0, element = $$props.element);
      if ('title' in $$props) $$invalidate(2, title = $$props.title);
    };
    return [element, labelId, title, h3_binding];
  }
  var Shepherd_title = /*#__PURE__*/function (_SvelteComponent4) {
    _inherits(Shepherd_title, _SvelteComponent4);
    var _super4 = _createSuper(Shepherd_title);
    function Shepherd_title(options) {
      var _this7;
      _classCallCheck(this, Shepherd_title);
      _this7 = _super4.call(this);
      init(_assertThisInitialized(_this7), options, instance$5, create_fragment$5, safe_not_equal, {
        labelId: 1,
        element: 0,
        title: 2
      });
      return _this7;
    }
    return _createClass(Shepherd_title);
  }(SvelteComponent);
  /* src/js/components/shepherd-header.svelte generated by Svelte v3.58.0 */
  function create_if_block_1$1(ctx) {
    var shepherdtitle;
    var current;
    shepherdtitle = new Shepherd_title({
      props: {
        labelId: /*labelId*/ctx[0],
        title: /*title*/ctx[2]
      }
    });
    return {
      c: function c() {
        create_component(shepherdtitle.$$.fragment);
      },
      m: function m(target, anchor) {
        mount_component(shepherdtitle, target, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        var shepherdtitle_changes = {};
        if (dirty & /*labelId*/1) shepherdtitle_changes.labelId = /*labelId*/ctx[0];
        if (dirty & /*title*/4) shepherdtitle_changes.title = /*title*/ctx[2];
        shepherdtitle.$set(shepherdtitle_changes);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdtitle.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdtitle.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        destroy_component(shepherdtitle, detaching);
      }
    };
  }

  // (39:4) {#if cancelIcon && cancelIcon.enabled}
  function create_if_block$2(ctx) {
    var shepherdcancelicon;
    var current;
    shepherdcancelicon = new Shepherd_cancel_icon({
      props: {
        cancelIcon: /*cancelIcon*/ctx[3],
        step: /*step*/ctx[1]
      }
    });
    return {
      c: function c() {
        create_component(shepherdcancelicon.$$.fragment);
      },
      m: function m(target, anchor) {
        mount_component(shepherdcancelicon, target, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        var shepherdcancelicon_changes = {};
        if (dirty & /*cancelIcon*/8) shepherdcancelicon_changes.cancelIcon = /*cancelIcon*/ctx[3];
        if (dirty & /*step*/2) shepherdcancelicon_changes.step = /*step*/ctx[1];
        shepherdcancelicon.$set(shepherdcancelicon_changes);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdcancelicon.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdcancelicon.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        destroy_component(shepherdcancelicon, detaching);
      }
    };
  }
  function create_fragment$4(ctx) {
    var header;
    var t;
    var current;
    var if_block0 = /*title*/ctx[2] && create_if_block_1$1(ctx);
    var if_block1 = /*cancelIcon*/ctx[3] && /*cancelIcon*/ctx[3].enabled && create_if_block$2(ctx);
    return {
      c: function c() {
        header = element("header");
        if (if_block0) if_block0.c();
        t = space();
        if (if_block1) if_block1.c();
        attr(header, "class", "shepherd-header");
      },
      m: function m(target, anchor) {
        insert(target, header, anchor);
        if (if_block0) if_block0.m(header, null);
        append(header, t);
        if (if_block1) if_block1.m(header, null);
        current = true;
      },
      p: function p(ctx, _ref) {
        var _ref11 = _slicedToArray(_ref, 1),
          dirty = _ref11[0];
        if ( /*title*/ctx[2]) {
          if (if_block0) {
            if_block0.p(ctx, dirty);
            if (dirty & /*title*/4) {
              transition_in(if_block0, 1);
            }
          } else {
            if_block0 = create_if_block_1$1(ctx);
            if_block0.c();
            transition_in(if_block0, 1);
            if_block0.m(header, t);
          }
        } else if (if_block0) {
          group_outros();
          transition_out(if_block0, 1, 1, function () {
            if_block0 = null;
          });
          check_outros();
        }
        if ( /*cancelIcon*/ctx[3] && /*cancelIcon*/ctx[3].enabled) {
          if (if_block1) {
            if_block1.p(ctx, dirty);
            if (dirty & /*cancelIcon*/8) {
              transition_in(if_block1, 1);
            }
          } else {
            if_block1 = create_if_block$2(ctx);
            if_block1.c();
            transition_in(if_block1, 1);
            if_block1.m(header, null);
          }
        } else if (if_block1) {
          group_outros();
          transition_out(if_block1, 1, 1, function () {
            if_block1 = null;
          });
          check_outros();
        }
      },
      i: function i(local) {
        if (current) return;
        transition_in(if_block0);
        transition_in(if_block1);
        current = true;
      },
      o: function o(local) {
        transition_out(if_block0);
        transition_out(if_block1);
        current = false;
      },
      d: function d(detaching) {
        if (detaching) detach(header);
        if (if_block0) if_block0.d();
        if (if_block1) if_block1.d();
      }
    };
  }
  function instance$4($$self, $$props, $$invalidate) {
    var labelId = $$props.labelId,
      step = $$props.step;
    var title, cancelIcon;
    $$self.$$set = function ($$props) {
      if ('labelId' in $$props) $$invalidate(0, labelId = $$props.labelId);
      if ('step' in $$props) $$invalidate(1, step = $$props.step);
    };
    $$self.$$.update = function () {
      if ($$self.$$.dirty & /*step*/2) {
        {
          $$invalidate(2, title = step.options.title);
          $$invalidate(3, cancelIcon = step.options.cancelIcon);
        }
      }
    };
    return [labelId, step, title, cancelIcon];
  }
  var Shepherd_header = /*#__PURE__*/function (_SvelteComponent5) {
    _inherits(Shepherd_header, _SvelteComponent5);
    var _super5 = _createSuper(Shepherd_header);
    function Shepherd_header(options) {
      var _this8;
      _classCallCheck(this, Shepherd_header);
      _this8 = _super5.call(this);
      init(_assertThisInitialized(_this8), options, instance$4, create_fragment$4, safe_not_equal, {
        labelId: 0,
        step: 1
      });
      return _this8;
    }
    return _createClass(Shepherd_header);
  }(SvelteComponent);
  /* src/js/components/shepherd-text.svelte generated by Svelte v3.58.0 */
  function create_fragment$3(ctx) {
    var div;
    return {
      c: function c() {
        div = element("div");
        attr(div, "class", "shepherd-text");
        attr(div, "id", /*descriptionId*/ctx[1]);
      },
      m: function m(target, anchor) {
        insert(target, div, anchor);
        /*div_binding*/
        ctx[3](div);
      },
      p: function p(ctx, _ref) {
        var _ref12 = _slicedToArray(_ref, 1),
          dirty = _ref12[0];
        if (dirty & /*descriptionId*/2) {
          attr(div, "id", /*descriptionId*/ctx[1]);
        }
      },
      i: noop,
      o: noop,
      d: function d(detaching) {
        if (detaching) detach(div);
        /*div_binding*/
        ctx[3](null);
      }
    };
  }
  function instance$3($$self, $$props, $$invalidate) {
    var descriptionId = $$props.descriptionId,
      element = $$props.element,
      step = $$props.step;
    afterUpdate(function () {
      var text = step.options.text;
      if (isFunction(text)) {
        text = text.call(step);
      }
      if (isHTMLElement$1(text)) {
        element.appendChild(text);
      } else {
        $$invalidate(0, element.innerHTML = text, element);
      }
    });
    function div_binding($$value) {
      binding_callbacks[$$value ? 'unshift' : 'push'](function () {
        element = $$value;
        $$invalidate(0, element);
      });
    }
    $$self.$$set = function ($$props) {
      if ('descriptionId' in $$props) $$invalidate(1, descriptionId = $$props.descriptionId);
      if ('element' in $$props) $$invalidate(0, element = $$props.element);
      if ('step' in $$props) $$invalidate(2, step = $$props.step);
    };
    return [element, descriptionId, step, div_binding];
  }
  var Shepherd_text = /*#__PURE__*/function (_SvelteComponent6) {
    _inherits(Shepherd_text, _SvelteComponent6);
    var _super6 = _createSuper(Shepherd_text);
    function Shepherd_text(options) {
      var _this9;
      _classCallCheck(this, Shepherd_text);
      _this9 = _super6.call(this);
      init(_assertThisInitialized(_this9), options, instance$3, create_fragment$3, safe_not_equal, {
        descriptionId: 1,
        element: 0,
        step: 2
      });
      return _this9;
    }
    return _createClass(Shepherd_text);
  }(SvelteComponent);
  /* src/js/components/shepherd-content.svelte generated by Svelte v3.58.0 */
  function create_if_block_2(ctx) {
    var shepherdheader;
    var current;
    shepherdheader = new Shepherd_header({
      props: {
        labelId: /*labelId*/ctx[1],
        step: /*step*/ctx[2]
      }
    });
    return {
      c: function c() {
        create_component(shepherdheader.$$.fragment);
      },
      m: function m(target, anchor) {
        mount_component(shepherdheader, target, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        var shepherdheader_changes = {};
        if (dirty & /*labelId*/2) shepherdheader_changes.labelId = /*labelId*/ctx[1];
        if (dirty & /*step*/4) shepherdheader_changes.step = /*step*/ctx[2];
        shepherdheader.$set(shepherdheader_changes);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdheader.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdheader.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        destroy_component(shepherdheader, detaching);
      }
    };
  }

  // (28:2) {#if !isUndefined(step.options.text)}
  function create_if_block_1(ctx) {
    var shepherdtext;
    var current;
    shepherdtext = new Shepherd_text({
      props: {
        descriptionId: /*descriptionId*/ctx[0],
        step: /*step*/ctx[2]
      }
    });
    return {
      c: function c() {
        create_component(shepherdtext.$$.fragment);
      },
      m: function m(target, anchor) {
        mount_component(shepherdtext, target, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        var shepherdtext_changes = {};
        if (dirty & /*descriptionId*/1) shepherdtext_changes.descriptionId = /*descriptionId*/ctx[0];
        if (dirty & /*step*/4) shepherdtext_changes.step = /*step*/ctx[2];
        shepherdtext.$set(shepherdtext_changes);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdtext.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdtext.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        destroy_component(shepherdtext, detaching);
      }
    };
  }

  // (35:2) {#if Array.isArray(step.options.buttons) && step.options.buttons.length}
  function create_if_block$1(ctx) {
    var shepherdfooter;
    var current;
    shepherdfooter = new Shepherd_footer({
      props: {
        step: /*step*/ctx[2]
      }
    });
    return {
      c: function c() {
        create_component(shepherdfooter.$$.fragment);
      },
      m: function m(target, anchor) {
        mount_component(shepherdfooter, target, anchor);
        current = true;
      },
      p: function p(ctx, dirty) {
        var shepherdfooter_changes = {};
        if (dirty & /*step*/4) shepherdfooter_changes.step = /*step*/ctx[2];
        shepherdfooter.$set(shepherdfooter_changes);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdfooter.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdfooter.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        destroy_component(shepherdfooter, detaching);
      }
    };
  }
  function create_fragment$2(ctx) {
    var div;
    var show_if_2 = !isUndefined( /*step*/ctx[2].options.title) || /*step*/ctx[2].options.cancelIcon && /*step*/ctx[2].options.cancelIcon.enabled;
    var t0;
    var show_if_1 = !isUndefined( /*step*/ctx[2].options.text);
    var t1;
    var show_if = Array.isArray( /*step*/ctx[2].options.buttons) && /*step*/ctx[2].options.buttons.length;
    var current;
    var if_block0 = show_if_2 && create_if_block_2(ctx);
    var if_block1 = show_if_1 && create_if_block_1(ctx);
    var if_block2 = show_if && create_if_block$1(ctx);
    return {
      c: function c() {
        div = element("div");
        if (if_block0) if_block0.c();
        t0 = space();
        if (if_block1) if_block1.c();
        t1 = space();
        if (if_block2) if_block2.c();
        attr(div, "class", "shepherd-content");
      },
      m: function m(target, anchor) {
        insert(target, div, anchor);
        if (if_block0) if_block0.m(div, null);
        append(div, t0);
        if (if_block1) if_block1.m(div, null);
        append(div, t1);
        if (if_block2) if_block2.m(div, null);
        current = true;
      },
      p: function p(ctx, _ref) {
        var _ref13 = _slicedToArray(_ref, 1),
          dirty = _ref13[0];
        if (dirty & /*step*/4) show_if_2 = !isUndefined( /*step*/ctx[2].options.title) || /*step*/ctx[2].options.cancelIcon && /*step*/ctx[2].options.cancelIcon.enabled;
        if (show_if_2) {
          if (if_block0) {
            if_block0.p(ctx, dirty);
            if (dirty & /*step*/4) {
              transition_in(if_block0, 1);
            }
          } else {
            if_block0 = create_if_block_2(ctx);
            if_block0.c();
            transition_in(if_block0, 1);
            if_block0.m(div, t0);
          }
        } else if (if_block0) {
          group_outros();
          transition_out(if_block0, 1, 1, function () {
            if_block0 = null;
          });
          check_outros();
        }
        if (dirty & /*step*/4) show_if_1 = !isUndefined( /*step*/ctx[2].options.text);
        if (show_if_1) {
          if (if_block1) {
            if_block1.p(ctx, dirty);
            if (dirty & /*step*/4) {
              transition_in(if_block1, 1);
            }
          } else {
            if_block1 = create_if_block_1(ctx);
            if_block1.c();
            transition_in(if_block1, 1);
            if_block1.m(div, t1);
          }
        } else if (if_block1) {
          group_outros();
          transition_out(if_block1, 1, 1, function () {
            if_block1 = null;
          });
          check_outros();
        }
        if (dirty & /*step*/4) show_if = Array.isArray( /*step*/ctx[2].options.buttons) && /*step*/ctx[2].options.buttons.length;
        if (show_if) {
          if (if_block2) {
            if_block2.p(ctx, dirty);
            if (dirty & /*step*/4) {
              transition_in(if_block2, 1);
            }
          } else {
            if_block2 = create_if_block$1(ctx);
            if_block2.c();
            transition_in(if_block2, 1);
            if_block2.m(div, null);
          }
        } else if (if_block2) {
          group_outros();
          transition_out(if_block2, 1, 1, function () {
            if_block2 = null;
          });
          check_outros();
        }
      },
      i: function i(local) {
        if (current) return;
        transition_in(if_block0);
        transition_in(if_block1);
        transition_in(if_block2);
        current = true;
      },
      o: function o(local) {
        transition_out(if_block0);
        transition_out(if_block1);
        transition_out(if_block2);
        current = false;
      },
      d: function d(detaching) {
        if (detaching) detach(div);
        if (if_block0) if_block0.d();
        if (if_block1) if_block1.d();
        if (if_block2) if_block2.d();
      }
    };
  }
  function instance$2($$self, $$props, $$invalidate) {
    var descriptionId = $$props.descriptionId,
      labelId = $$props.labelId,
      step = $$props.step;
    $$self.$$set = function ($$props) {
      if ('descriptionId' in $$props) $$invalidate(0, descriptionId = $$props.descriptionId);
      if ('labelId' in $$props) $$invalidate(1, labelId = $$props.labelId);
      if ('step' in $$props) $$invalidate(2, step = $$props.step);
    };
    return [descriptionId, labelId, step];
  }
  var Shepherd_content = /*#__PURE__*/function (_SvelteComponent7) {
    _inherits(Shepherd_content, _SvelteComponent7);
    var _super7 = _createSuper(Shepherd_content);
    function Shepherd_content(options) {
      var _this10;
      _classCallCheck(this, Shepherd_content);
      _this10 = _super7.call(this);
      init(_assertThisInitialized(_this10), options, instance$2, create_fragment$2, safe_not_equal, {
        descriptionId: 0,
        labelId: 1,
        step: 2
      });
      return _this10;
    }
    return _createClass(Shepherd_content);
  }(SvelteComponent);
  /* src/js/components/shepherd-element.svelte generated by Svelte v3.58.0 */
  function create_if_block(ctx) {
    var div;
    return {
      c: function c() {
        div = element("div");
        attr(div, "class", "shepherd-arrow");
        attr(div, "data-popper-arrow", "");
      },
      m: function m(target, anchor) {
        insert(target, div, anchor);
      },
      d: function d(detaching) {
        if (detaching) detach(div);
      }
    };
  }
  function create_fragment$1(ctx) {
    var div;
    var t;
    var shepherdcontent;
    var div_aria_describedby_value;
    var div_aria_labelledby_value;
    var current;
    var mounted;
    var dispose;
    var if_block = /*step*/ctx[4].options.arrow && /*step*/ctx[4].options.attachTo && /*step*/ctx[4].options.attachTo.element && /*step*/ctx[4].options.attachTo.on && create_if_block();
    shepherdcontent = new Shepherd_content({
      props: {
        descriptionId: /*descriptionId*/ctx[2],
        labelId: /*labelId*/ctx[3],
        step: /*step*/ctx[4]
      }
    });
    var div_levels = [{
      "aria-describedby": div_aria_describedby_value = !isUndefined( /*step*/ctx[4].options.text) ? /*descriptionId*/ctx[2] : null
    }, {
      "aria-labelledby": div_aria_labelledby_value = /*step*/ctx[4].options.title ? /*labelId*/ctx[3] : null
    }, /*dataStepId*/ctx[1], {
      role: "dialog"
    }, {
      tabindex: "0"
    }];
    var div_data = {};
    for (var i = 0; i < div_levels.length; i += 1) {
      div_data = assign(div_data, div_levels[i]);
    }
    return {
      c: function c() {
        div = element("div");
        if (if_block) if_block.c();
        t = space();
        create_component(shepherdcontent.$$.fragment);
        set_attributes(div, div_data);
        toggle_class(div, "shepherd-has-cancel-icon", /*hasCancelIcon*/ctx[5]);
        toggle_class(div, "shepherd-has-title", /*hasTitle*/ctx[6]);
        toggle_class(div, "shepherd-element", true);
      },
      m: function m(target, anchor) {
        insert(target, div, anchor);
        if (if_block) if_block.m(div, null);
        append(div, t);
        mount_component(shepherdcontent, div, null);
        /*div_binding*/
        ctx[13](div);
        current = true;
        if (!mounted) {
          dispose = listen(div, "keydown", /*handleKeyDown*/ctx[7]);
          mounted = true;
        }
      },
      p: function p(ctx, _ref) {
        var _ref14 = _slicedToArray(_ref, 1),
          dirty = _ref14[0];
        if ( /*step*/ctx[4].options.arrow && /*step*/ctx[4].options.attachTo && /*step*/ctx[4].options.attachTo.element && /*step*/ctx[4].options.attachTo.on) {
          if (if_block) ;else {
            if_block = create_if_block();
            if_block.c();
            if_block.m(div, t);
          }
        } else if (if_block) {
          if_block.d(1);
          if_block = null;
        }
        var shepherdcontent_changes = {};
        if (dirty & /*descriptionId*/4) shepherdcontent_changes.descriptionId = /*descriptionId*/ctx[2];
        if (dirty & /*labelId*/8) shepherdcontent_changes.labelId = /*labelId*/ctx[3];
        if (dirty & /*step*/16) shepherdcontent_changes.step = /*step*/ctx[4];
        shepherdcontent.$set(shepherdcontent_changes);
        set_attributes(div, div_data = get_spread_update(div_levels, [(!current || dirty & /*step, descriptionId*/20 && div_aria_describedby_value !== (div_aria_describedby_value = !isUndefined( /*step*/ctx[4].options.text) ? /*descriptionId*/ctx[2] : null)) && {
          "aria-describedby": div_aria_describedby_value
        }, (!current || dirty & /*step, labelId*/24 && div_aria_labelledby_value !== (div_aria_labelledby_value = /*step*/ctx[4].options.title ? /*labelId*/ctx[3] : null)) && {
          "aria-labelledby": div_aria_labelledby_value
        }, dirty & /*dataStepId*/2 && /*dataStepId*/ctx[1], {
          role: "dialog"
        }, {
          tabindex: "0"
        }]));
        toggle_class(div, "shepherd-has-cancel-icon", /*hasCancelIcon*/ctx[5]);
        toggle_class(div, "shepherd-has-title", /*hasTitle*/ctx[6]);
        toggle_class(div, "shepherd-element", true);
      },
      i: function i(local) {
        if (current) return;
        transition_in(shepherdcontent.$$.fragment, local);
        current = true;
      },
      o: function o(local) {
        transition_out(shepherdcontent.$$.fragment, local);
        current = false;
      },
      d: function d(detaching) {
        if (detaching) detach(div);
        if (if_block) if_block.d();
        destroy_component(shepherdcontent);
        /*div_binding*/
        ctx[13](null);
        mounted = false;
        dispose();
      }
    };
  }
  var KEY_TAB = 9;
  var KEY_ESC = 27;
  var LEFT_ARROW = 37;
  var RIGHT_ARROW = 39;
  function getClassesArray(classes) {
    return classes.split(' ').filter(function (className) {
      return !!className.length;
    });
  }
  function instance$1($$self, $$props, $$invalidate) {
    var classPrefix = $$props.classPrefix,
      element = $$props.element,
      descriptionId = $$props.descriptionId,
      firstFocusableElement = $$props.firstFocusableElement,
      focusableElements = $$props.focusableElements,
      labelId = $$props.labelId,
      lastFocusableElement = $$props.lastFocusableElement,
      step = $$props.step,
      dataStepId = $$props.dataStepId;
    var hasCancelIcon, hasTitle, classes;
    var getElement = function getElement() {
      return element;
    };
    onMount(function () {
      // Get all elements that are focusable
      $$invalidate(1, dataStepId = _defineProperty({}, "data-".concat(classPrefix, "shepherd-step-id"), step.id));
      $$invalidate(9, focusableElements = element.querySelectorAll('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]'));
      $$invalidate(8, firstFocusableElement = focusableElements[0]);
      $$invalidate(10, lastFocusableElement = focusableElements[focusableElements.length - 1]);
    });
    afterUpdate(function () {
      if (classes !== step.options.classes) {
        updateDynamicClasses();
      }
    });
    function updateDynamicClasses() {
      removeClasses(classes);
      classes = step.options.classes;
      addClasses(classes);
    }
    function removeClasses(classes) {
      if (isString(classes)) {
        var oldClasses = getClassesArray(classes);
        if (oldClasses.length) {
          var _element$classList;
          (_element$classList = element.classList).remove.apply(_element$classList, _toConsumableArray(oldClasses));
        }
      }
    }
    function addClasses(classes) {
      if (isString(classes)) {
        var newClasses = getClassesArray(classes);
        if (newClasses.length) {
          var _element$classList2;
          (_element$classList2 = element.classList).add.apply(_element$classList2, _toConsumableArray(newClasses));
        }
      }
    }

    /**
    * Setup keydown events to allow closing the modal with ESC
    *
    * Borrowed from this great post! https://bitsofco.de/accessible-modal-dialog/
    *
    * @private
    */
    var handleKeyDown = function handleKeyDown(e) {
      var _step = step,
        tour = _step.tour;
      switch (e.keyCode) {
        case KEY_TAB:
          if (focusableElements.length === 0) {
            e.preventDefault();
            break;
          }
          // Backward tab
          if (e.shiftKey) {
            if (document.activeElement === firstFocusableElement || document.activeElement.classList.contains('shepherd-element')) {
              e.preventDefault();
              lastFocusableElement.focus();
            }
          } else {
            if (document.activeElement === lastFocusableElement) {
              e.preventDefault();
              firstFocusableElement.focus();
            }
          }
          break;
        case KEY_ESC:
          if (tour.options.exitOnEsc) {
            step.cancel();
          }
          break;
        case LEFT_ARROW:
          if (tour.options.keyboardNavigation) {
            tour.back();
          }
          break;
        case RIGHT_ARROW:
          if (tour.options.keyboardNavigation) {
            tour.next();
          }
          break;
      }
    };
    function div_binding($$value) {
      binding_callbacks[$$value ? 'unshift' : 'push'](function () {
        element = $$value;
        $$invalidate(0, element);
      });
    }
    $$self.$$set = function ($$props) {
      if ('classPrefix' in $$props) $$invalidate(11, classPrefix = $$props.classPrefix);
      if ('element' in $$props) $$invalidate(0, element = $$props.element);
      if ('descriptionId' in $$props) $$invalidate(2, descriptionId = $$props.descriptionId);
      if ('firstFocusableElement' in $$props) $$invalidate(8, firstFocusableElement = $$props.firstFocusableElement);
      if ('focusableElements' in $$props) $$invalidate(9, focusableElements = $$props.focusableElements);
      if ('labelId' in $$props) $$invalidate(3, labelId = $$props.labelId);
      if ('lastFocusableElement' in $$props) $$invalidate(10, lastFocusableElement = $$props.lastFocusableElement);
      if ('step' in $$props) $$invalidate(4, step = $$props.step);
      if ('dataStepId' in $$props) $$invalidate(1, dataStepId = $$props.dataStepId);
    };
    $$self.$$.update = function () {
      if ($$self.$$.dirty & /*step*/16) {
        {
          $$invalidate(5, hasCancelIcon = step.options && step.options.cancelIcon && step.options.cancelIcon.enabled);
          $$invalidate(6, hasTitle = step.options && step.options.title);
        }
      }
    };
    return [element, dataStepId, descriptionId, labelId, step, hasCancelIcon, hasTitle, handleKeyDown, firstFocusableElement, focusableElements, lastFocusableElement, classPrefix, getElement, div_binding];
  }
  var Shepherd_element = /*#__PURE__*/function (_SvelteComponent8) {
    _inherits(Shepherd_element, _SvelteComponent8);
    var _super8 = _createSuper(Shepherd_element);
    function Shepherd_element(options) {
      var _this11;
      _classCallCheck(this, Shepherd_element);
      _this11 = _super8.call(this);
      init(_assertThisInitialized(_this11), options, instance$1, create_fragment$1, safe_not_equal, {
        classPrefix: 11,
        element: 0,
        descriptionId: 2,
        firstFocusableElement: 8,
        focusableElements: 9,
        labelId: 3,
        lastFocusableElement: 10,
        step: 4,
        dataStepId: 1,
        getElement: 12
      });
      return _this11;
    }
    _createClass(Shepherd_element, [{
      key: "getElement",
      get: function get() {
        return this.$$.ctx[12];
      }
    }]);
    return Shepherd_element;
  }(SvelteComponent);
  /**
   * A class representing steps to be added to a tour.
   * @extends {Evented}
   */
  var Step = /*#__PURE__*/function (_Evented) {
    _inherits(Step, _Evented);
    var _super9 = _createSuper(Step);
    /**
     * Create a step
     * @param {Tour} tour The tour for the step
     * @param {object} options The options for the step
     * @param {boolean} options.arrow Whether to display the arrow for the tooltip or not. Defaults to `true`.
     * @param {object} options.attachTo The element the step should be attached to on the page.
     * An object with properties `element` and `on`.
     *
     * ```js
     * const step = new Step(tour, {
     *   attachTo: { element: '.some .selector-path', on: 'left' },
     *   ...moreOptions
     * });
     * ```
     *
     * If you don’t specify an `attachTo` the element will appear in the middle of the screen. The same will happen if your `attachTo.element` callback returns `null`, `undefined`, or a selector that does not exist in the DOM.
     * If you omit the `on` portion of `attachTo`, the element will still be highlighted, but the tooltip will appear
     * in the middle of the screen, without an arrow pointing to the target.
     * If the element to highlight does not yet exist while instantiating tour steps, you may use lazy evaluation by supplying a function to `attachTo.element`. The function will be called in the `before-show` phase.
     * @param {string|HTMLElement|function} options.attachTo.element An element selector string, DOM element, or a function (returning a selector, a DOM element, `null` or `undefined`).
     * @param {string} options.attachTo.on The optional direction to place the FloatingUI tooltip relative to the element.
     *   - Possible string values: 'top', 'top-start', 'top-end', 'bottom', 'bottom-start', 'bottom-end', 'right', 'right-start', 'right-end', 'left', 'left-start', 'left-end'
     * @param {Object} options.advanceOn An action on the page which should advance shepherd to the next step.
     * It should be an object with a string `selector` and an `event` name
     * ```js
     * const step = new Step(tour, {
     *   advanceOn: { selector: '.some .selector-path', event: 'click' },
     *   ...moreOptions
     * });
     * ```
     * `event` doesn’t have to be an event inside the tour, it can be any event fired on any element on the page.
     * You can also always manually advance the Tour by calling `myTour.next()`.
     * @param {function} options.beforeShowPromise A function that returns a promise.
     * When the promise resolves, the rest of the `show` code for the step will execute.
     * @param {Object[]} options.buttons An array of buttons to add to the step. These will be rendered in a
     * footer below the main body text.
     * @param {function} options.buttons.button.action A function executed when the button is clicked on.
     * It is automatically bound to the `tour` the step is associated with, so things like `this.next` will
     * work inside the action.
     * You can use action to skip steps or navigate to specific steps, with something like:
     * ```js
     * action() {
     *   return this.show('some_step_name');
     * }
     * ```
     * @param {string} options.buttons.button.classes Extra classes to apply to the `<a>`
     * @param {boolean} options.buttons.button.disabled Should the button be disabled?
     * @param {string} options.buttons.button.label The aria-label text of the button
     * @param {boolean} options.buttons.button.secondary If true, a shepherd-button-secondary class is applied to the button
     * @param {string} options.buttons.button.text The HTML text of the button
     * @param {boolean} options.canClickTarget A boolean, that when set to false, will set `pointer-events: none` on the target
     * @param {object} options.cancelIcon Options for the cancel icon
     * @param {boolean} options.cancelIcon.enabled Should a cancel “✕” be shown in the header of the step?
     * @param {string} options.cancelIcon.label The label to add for `aria-label`
     * @param {string} options.classes A string of extra classes to add to the step's content element.
     * @param {string} options.highlightClass An extra class to apply to the `attachTo` element when it is
     * highlighted (that is, when its step is active). You can then target that selector in your CSS.
     * @param {string} options.id The string to use as the `id` for the step.
     * @param {number} options.modalOverlayOpeningPadding An amount of padding to add around the modal overlay opening
     * @param {number | { topLeft: number, bottomLeft: number, bottomRight: number, topRight: number }} options.modalOverlayOpeningRadius An amount of border radius to add around the modal overlay opening
     * @param {object} options.floatingUIOptions Extra options to pass to FloatingUI
     * @param {boolean|Object} options.scrollTo Should the element be scrolled to when this step is shown? If true, uses the default `scrollIntoView`,
     * if an object, passes that object as the params to `scrollIntoView` i.e. `{behavior: 'smooth', block: 'center'}`
     * @param {function} options.scrollToHandler A function that lets you override the default scrollTo behavior and
     * define a custom action to do the scrolling, and possibly other logic.
     * @param {function} options.showOn A function that, when it returns `true`, will show the step.
     * If it returns false, the step will be skipped.
     * @param {string} options.text The text in the body of the step. It can be one of three types:
     * ```
     * - HTML string
     * - `HTMLElement` object
     * - `Function` to be executed when the step is built. It must return one the two options above.
     * ```
     * @param {string} options.title The step's title. It becomes an `h3` at the top of the step. It can be one of two types:
     * ```
     * - HTML string
     * - `Function` to be executed when the step is built. It must return HTML string.
     * ```
     * @param {object} options.when You can define `show`, `hide`, etc events inside `when`. For example:
     * ```js
     * when: {
     *   show: function() {
     *     window.scrollTo(0, 0);
     *   }
     * }
     * ```
     * @return {Step} The newly created Step instance
     */
    function Step(tour, options) {
      var _this12;
      _classCallCheck(this, Step);
      if (options === void 0) {
        options = {};
      }
      _this12 = _super9.call(this, tour, options);
      _this12.tour = tour;
      _this12.classPrefix = _this12.tour.options ? normalizePrefix(_this12.tour.options.classPrefix) : '';
      _this12.styles = tour.styles;

      /**
       * Resolved attachTo options. Due to lazy evaluation, we only resolve the options during `before-show` phase.
       * Do not use this directly, use the _getResolvedAttachToOptions method instead.
       * @type {null|{}|{element, to}}
       * @private
       */
      _this12._resolvedAttachTo = null;
      autoBind(_assertThisInitialized(_this12));
      _this12._setOptions(options);
      return _possibleConstructorReturn(_this12, _assertThisInitialized(_this12));
    }

    /**
     * Cancel the tour
     * Triggers the `cancel` event
     */
    _createClass(Step, [{
      key: "cancel",
      value: function cancel() {
        this.tour.cancel();
        this.trigger('cancel');
      }

      /**
       * Complete the tour
       * Triggers the `complete` event
       */
    }, {
      key: "complete",
      value: function complete() {
        this.tour.complete();
        this.trigger('complete');
      }

      /**
       * Remove the step, delete the step's element, and destroy the FloatingUI instance for the step.
       * Triggers `destroy` event
       */
    }, {
      key: "destroy",
      value: function destroy() {
        destroyTooltip(this);
        if (isHTMLElement$1(this.el)) {
          this.el.remove();
          this.el = null;
        }
        this._updateStepTargetOnHide();
        this.trigger('destroy');
      }

      /**
       * Returns the tour for the step
       * @return {Tour} The tour instance
       */
    }, {
      key: "getTour",
      value: function getTour() {
        return this.tour;
      }

      /**
       * Hide the step
       */
    }, {
      key: "hide",
      value: function hide() {
        this.tour.modal.hide();
        this.trigger('before-hide');
        if (this.el) {
          this.el.hidden = true;
        }
        this._updateStepTargetOnHide();
        this.trigger('hide');
      }

      /**
       * Resolves attachTo options.
       * @returns {{}|{element, on}}
       * @private
       */
    }, {
      key: "_resolveAttachToOptions",
      value: function _resolveAttachToOptions() {
        this._resolvedAttachTo = parseAttachTo(this);
        return this._resolvedAttachTo;
      }

      /**
       * A selector for resolved attachTo options.
       * @returns {{}|{element, on}}
       * @private
       */
    }, {
      key: "_getResolvedAttachToOptions",
      value: function _getResolvedAttachToOptions() {
        if (this._resolvedAttachTo === null) {
          return this._resolveAttachToOptions();
        }
        return this._resolvedAttachTo;
      }

      /**
       * Check if the step is open and visible
       * @return {boolean} True if the step is open and visible
       */
    }, {
      key: "isOpen",
      value: function isOpen() {
        return Boolean(this.el && !this.el.hidden);
      }

      /**
       * Wraps `_show` and ensures `beforeShowPromise` resolves before calling show
       * @return {*|Promise}
       */
    }, {
      key: "show",
      value: function show() {
        var _this13 = this;
        if (isFunction(this.options.beforeShowPromise)) {
          return Promise.resolve(this.options.beforeShowPromise()).then(function () {
            return _this13._show();
          });
        }
        return Promise.resolve(this._show());
      }

      /**
       * Updates the options of the step.
       *
       * @param {Object} options The options for the step
       */
    }, {
      key: "updateStepOptions",
      value: function updateStepOptions(options) {
        Object.assign(this.options, options);
        if (this.shepherdElementComponent) {
          this.shepherdElementComponent.$set({
            step: this
          });
        }
      }

      /**
       * Returns the element for the step
       * @return {HTMLElement|null|undefined} The element instance. undefined if it has never been shown, null if it has been destroyed
       */
    }, {
      key: "getElement",
      value: function getElement() {
        return this.el;
      }

      /**
       * Returns the target for the step
       * @return {HTMLElement|null|undefined} The element instance. undefined if it has never been shown, null if query string has not been found
       */
    }, {
      key: "getTarget",
      value: function getTarget() {
        return this.target;
      }

      /**
       * Creates Shepherd element for step based on options
       *
       * @return {Element} The DOM element for the step tooltip
       * @private
       */
    }, {
      key: "_createTooltipContent",
      value: function _createTooltipContent() {
        var descriptionId = "".concat(this.id, "-description");
        var labelId = "".concat(this.id, "-label");
        this.shepherdElementComponent = new Shepherd_element({
          target: this.tour.options.stepsContainer || document.body,
          props: {
            classPrefix: this.classPrefix,
            descriptionId: descriptionId,
            labelId: labelId,
            step: this,
            styles: this.styles
          }
        });
        return this.shepherdElementComponent.getElement();
      }

      /**
       * If a custom scrollToHandler is defined, call that, otherwise do the generic
       * scrollIntoView call.
       *
       * @param {boolean|Object} scrollToOptions If true, uses the default `scrollIntoView`,
       * if an object, passes that object as the params to `scrollIntoView` i.e. `{ behavior: 'smooth', block: 'center' }`
       * @private
       */
    }, {
      key: "_scrollTo",
      value: function _scrollTo(scrollToOptions) {
        var _this$_getResolvedAtt = this._getResolvedAttachToOptions(),
          element = _this$_getResolvedAtt.element;
        if (isFunction(this.options.scrollToHandler)) {
          this.options.scrollToHandler(element);
        } else if (isElement$1(element) && typeof element.scrollIntoView === 'function') {
          element.scrollIntoView(scrollToOptions);
        }
      }

      /**
       * _getClassOptions gets all possible classes for the step
       * @param {Object} stepOptions The step specific options
       * @returns {String} unique string from array of classes
       * @private
       */
    }, {
      key: "_getClassOptions",
      value: function _getClassOptions(stepOptions) {
        var defaultStepOptions = this.tour && this.tour.options && this.tour.options.defaultStepOptions;
        var stepClasses = stepOptions.classes ? stepOptions.classes : '';
        var defaultStepOptionsClasses = defaultStepOptions && defaultStepOptions.classes ? defaultStepOptions.classes : '';
        var allClasses = [].concat(_toConsumableArray(stepClasses.split(' ')), _toConsumableArray(defaultStepOptionsClasses.split(' ')));
        var uniqClasses = new Set(allClasses);
        return Array.from(uniqClasses).join(' ').trim();
      }

      /**
       * Sets the options for the step, maps `when` to events, sets up buttons
       * @param {Object} options The options for the step
       * @private
       */
    }, {
      key: "_setOptions",
      value: function _setOptions(options) {
        var _this14 = this;
        if (options === void 0) {
          options = {};
        }
        var tourOptions = this.tour && this.tour.options && this.tour.options.defaultStepOptions;
        tourOptions = cjs({}, tourOptions || {});
        this.options = Object.assign({
          arrow: true
        }, tourOptions, options, mergeTooltipConfig(tourOptions, options));
        var when = this.options.when;
        this.options.classes = this._getClassOptions(options);
        this.destroy();
        this.id = this.options.id || "step-".concat(uuid());
        if (when) {
          Object.keys(when).forEach(function (event) {
            _this14.on(event, when[event], _this14);
          });
        }
      }

      /**
       * Create the element and set up the FloatingUI instance
       * @private
       */
    }, {
      key: "_setupElements",
      value: function _setupElements() {
        if (!isUndefined(this.el)) {
          this.destroy();
        }
        this.el = this._createTooltipContent();
        if (this.options.advanceOn) {
          bindAdvance(this);
        }

        // The tooltip implementation details are handled outside of the Step
        // object.
        setupTooltip(this);
      }

      /**
       * Triggers `before-show`, generates the tooltip DOM content,
       * sets up a FloatingUI instance for the tooltip, then triggers `show`.
       * @private
       */
    }, {
      key: "_show",
      value: function _show() {
        var _this15 = this;
        this.trigger('before-show');

        // Force resolve to make sure the options are updated on subsequent shows.
        this._resolveAttachToOptions();
        this._setupElements();
        if (!this.tour.modal) {
          this.tour._setupModal();
        }
        this.tour.modal.setupForStep(this);
        this._styleTargetElementForStep(this);
        this.el.hidden = false;

        // start scrolling to target before showing the step
        if (this.options.scrollTo) {
          setTimeout(function () {
            _this15._scrollTo(_this15.options.scrollTo);
          });
        }
        this.el.hidden = false;
        var content = this.shepherdElementComponent.getElement();
        var target = this.target || document.body;
        target.classList.add("".concat(this.classPrefix, "shepherd-enabled"));
        target.classList.add("".concat(this.classPrefix, "shepherd-target"));
        content.classList.add('shepherd-enabled');
        this.trigger('show');
      }

      /**
       * Modulates the styles of the passed step's target element, based on the step's options and
       * the tour's `modal` option, to visually emphasize the element
       *
       * @param step The step object that attaches to the element
       * @private
       */
    }, {
      key: "_styleTargetElementForStep",
      value: function _styleTargetElementForStep(step) {
        var targetElement = step.target;
        if (!targetElement) {
          return;
        }
        if (step.options.highlightClass) {
          targetElement.classList.add(step.options.highlightClass);
        }
        targetElement.classList.remove('shepherd-target-click-disabled');
        if (step.options.canClickTarget === false) {
          targetElement.classList.add('shepherd-target-click-disabled');
        }
      }

      /**
       * When a step is hidden, remove the highlightClass and 'shepherd-enabled'
       * and 'shepherd-target' classes
       * @private
       */
    }, {
      key: "_updateStepTargetOnHide",
      value: function _updateStepTargetOnHide() {
        var target = this.target || document.body;
        if (this.options.highlightClass) {
          target.classList.remove(this.options.highlightClass);
        }
        target.classList.remove('shepherd-target-click-disabled', "".concat(this.classPrefix, "shepherd-enabled"), "".concat(this.classPrefix, "shepherd-target"));
      }
    }]);
    return Step;
  }(Evented);
  /**
   * Cleanup the steps and set pointerEvents back to 'auto'
   * @param tour The tour object
   */
  function cleanupSteps(tour) {
    if (tour) {
      var steps = tour.steps;
      steps.forEach(function (step) {
        if (step.options && step.options.canClickTarget === false && step.options.attachTo) {
          if (step.target instanceof HTMLElement) {
            step.target.classList.remove('shepherd-target-click-disabled');
          }
        }
      });
    }
  }

  /**
   * Generates the svg path data for a rounded rectangle overlay
   * @param {Object} dimension - Dimensions of rectangle.
   * @param {number} width - Width.
   * @param {number} height - Height.
   * @param {number} [x=0] - Offset from top left corner in x axis. default 0.
   * @param {number} [y=0] - Offset from top left corner in y axis. default 0.
   * @param {number | { topLeft: number, topRight: number, bottomRight: number, bottomLeft: number }} [r=0] - Corner Radius. Keep this smaller than half of width or height.
   * @returns {string} - Rounded rectangle overlay path data.
   */
  function makeOverlayPath(_ref) {
    var width = _ref.width,
      height = _ref.height,
      _ref$x = _ref.x,
      x = _ref$x === void 0 ? 0 : _ref$x,
      _ref$y = _ref.y,
      y = _ref$y === void 0 ? 0 : _ref$y,
      _ref$r = _ref.r,
      r = _ref$r === void 0 ? 0 : _ref$r;
    var _window = window,
      w = _window.innerWidth,
      h = _window.innerHeight;
    var _ref15 = typeof r === 'number' ? {
        topLeft: r,
        topRight: r,
        bottomRight: r,
        bottomLeft: r
      } : r,
      _ref15$topLeft = _ref15.topLeft,
      topLeft = _ref15$topLeft === void 0 ? 0 : _ref15$topLeft,
      _ref15$topRight = _ref15.topRight,
      topRight = _ref15$topRight === void 0 ? 0 : _ref15$topRight,
      _ref15$bottomRight = _ref15.bottomRight,
      bottomRight = _ref15$bottomRight === void 0 ? 0 : _ref15$bottomRight,
      _ref15$bottomLeft = _ref15.bottomLeft,
      bottomLeft = _ref15$bottomLeft === void 0 ? 0 : _ref15$bottomLeft;
    return "M".concat(w, ",").concat(h, "H0V0H").concat(w, "V").concat(h, "ZM").concat(x + topLeft, ",").concat(y, "a").concat(topLeft, ",").concat(topLeft, ",0,0,0-").concat(topLeft, ",").concat(topLeft, "V").concat(height + y - bottomLeft, "a").concat(bottomLeft, ",").concat(bottomLeft, ",0,0,0,").concat(bottomLeft, ",").concat(bottomLeft, "H").concat(width + x - bottomRight, "a").concat(bottomRight, ",").concat(bottomRight, ",0,0,0,").concat(bottomRight, "-").concat(bottomRight, "V").concat(y + topRight, "a").concat(topRight, ",").concat(topRight, ",0,0,0-").concat(topRight, "-").concat(topRight, "Z");
  }

  /* src/js/components/shepherd-modal.svelte generated by Svelte v3.58.0 */
  function create_fragment(ctx) {
    var svg;
    var path;
    var svg_class_value;
    var mounted;
    var dispose;
    return {
      c: function c() {
        svg = svg_element("svg");
        path = svg_element("path");
        attr(path, "d", /*pathDefinition*/ctx[2]);
        attr(svg, "class", svg_class_value = "".concat( /*modalIsVisible*/ctx[1] ? 'shepherd-modal-is-visible' : '', " shepherd-modal-overlay-container"));
      },
      m: function m(target, anchor) {
        insert(target, svg, anchor);
        append(svg, path);
        /*svg_binding*/
        ctx[11](svg);
        if (!mounted) {
          dispose = listen(svg, "touchmove", /*_preventModalOverlayTouch*/ctx[3]);
          mounted = true;
        }
      },
      p: function p(ctx, _ref) {
        var _ref16 = _slicedToArray(_ref, 1),
          dirty = _ref16[0];
        if (dirty & /*pathDefinition*/4) {
          attr(path, "d", /*pathDefinition*/ctx[2]);
        }
        if (dirty & /*modalIsVisible*/2 && svg_class_value !== (svg_class_value = "".concat( /*modalIsVisible*/ctx[1] ? 'shepherd-modal-is-visible' : '', " shepherd-modal-overlay-container"))) {
          attr(svg, "class", svg_class_value);
        }
      },
      i: noop,
      o: noop,
      d: function d(detaching) {
        if (detaching) detach(svg);
        /*svg_binding*/
        ctx[11](null);
        mounted = false;
        dispose();
      }
    };
  }
  function _getScrollParent(element) {
    if (!element) {
      return null;
    }
    var isHtmlElement = element instanceof HTMLElement;
    var overflowY = isHtmlElement && window.getComputedStyle(element).overflowY;
    var isScrollable = overflowY !== 'hidden' && overflowY !== 'visible';
    if (isScrollable && element.scrollHeight >= element.clientHeight) {
      return element;
    }
    return _getScrollParent(element.parentElement);
  }

  /**
   * Get the visible height of the target element relative to its scrollParent.
   * If there is no scroll parent, the height of the element is returned.
   *
   * @param {HTMLElement} element The target element
   * @param {HTMLElement} [scrollParent] The scrollable parent element
   * @returns {{y: number, height: number}}
   * @private
   */
  function _getVisibleHeight(element, scrollParent) {
    var elementRect = element.getBoundingClientRect();
    var top = elementRect.y || elementRect.top;
    var bottom = elementRect.bottom || top + elementRect.height;
    if (scrollParent) {
      var scrollRect = scrollParent.getBoundingClientRect();
      var scrollTop = scrollRect.y || scrollRect.top;
      var scrollBottom = scrollRect.bottom || scrollTop + scrollRect.height;
      top = Math.max(top, scrollTop);
      bottom = Math.min(bottom, scrollBottom);
    }
    var height = Math.max(bottom - top, 0); // Default to 0 if height is negative
    return {
      y: top,
      height: height
    };
  }
  function instance($$self, $$props, $$invalidate) {
    var element = $$props.element,
      openingProperties = $$props.openingProperties;
    uuid();
    var modalIsVisible = false;
    var rafId = undefined;
    var pathDefinition;
    closeModalOpening();
    var getElement = function getElement() {
      return element;
    };
    function closeModalOpening() {
      $$invalidate(4, openingProperties = {
        width: 0,
        height: 0,
        x: 0,
        y: 0,
        r: 0
      });
    }
    function hide() {
      $$invalidate(1, modalIsVisible = false);

      // Ensure we cleanup all event listeners when we hide the modal
      _cleanupStepEventListeners();
    }
    function positionModal(modalOverlayOpeningPadding, modalOverlayOpeningRadius, scrollParent, targetElement) {
      if (modalOverlayOpeningPadding === void 0) {
        modalOverlayOpeningPadding = 0;
      }
      if (modalOverlayOpeningRadius === void 0) {
        modalOverlayOpeningRadius = 0;
      }
      if (targetElement) {
        var _getVisibleHeight2 = _getVisibleHeight(targetElement, scrollParent),
          y = _getVisibleHeight2.y,
          height = _getVisibleHeight2.height;
        var _targetElement$getBou = targetElement.getBoundingClientRect(),
          x = _targetElement$getBou.x,
          width = _targetElement$getBou.width,
          left = _targetElement$getBou.left;

        // getBoundingClientRect is not consistent. Some browsers use x and y, while others use left and top
        $$invalidate(4, openingProperties = {
          width: width + modalOverlayOpeningPadding * 2,
          height: height + modalOverlayOpeningPadding * 2,
          x: (x || left) - modalOverlayOpeningPadding,
          y: y - modalOverlayOpeningPadding,
          r: modalOverlayOpeningRadius
        });
      } else {
        closeModalOpening();
      }
    }
    function setupForStep(step) {
      // Ensure we move listeners from the previous step, before we setup new ones
      _cleanupStepEventListeners();
      if (step.tour.options.useModalOverlay) {
        _styleForStep(step);
        show();
      } else {
        hide();
      }
    }
    function show() {
      $$invalidate(1, modalIsVisible = true);
    }
    var _preventModalBodyTouch = function _preventModalBodyTouch(e) {
      e.preventDefault();
    };
    var _preventModalOverlayTouch = function _preventModalOverlayTouch(e) {
      e.stopPropagation();
    };

    /**
    * Add touchmove event listener
    * @private
    */
    function _addStepEventListeners() {
      // Prevents window from moving on touch.
      window.addEventListener('touchmove', _preventModalBodyTouch, {
        passive: false
      });
    }

    /**
    * Cancel the requestAnimationFrame loop and remove touchmove event listeners
    * @private
    */
    function _cleanupStepEventListeners() {
      if (rafId) {
        cancelAnimationFrame(rafId);
        rafId = undefined;
      }
      window.removeEventListener('touchmove', _preventModalBodyTouch, {
        passive: false
      });
    }

    /**
    * Style the modal for the step
    * @param {Step} step The step to style the opening for
    * @private
    */
    function _styleForStep(step) {
      var _step$options = step.options,
        modalOverlayOpeningPadding = _step$options.modalOverlayOpeningPadding,
        modalOverlayOpeningRadius = _step$options.modalOverlayOpeningRadius;
      var scrollParent = _getScrollParent(step.target);

      // Setup recursive function to call requestAnimationFrame to update the modal opening position
      var rafLoop = function rafLoop() {
        rafId = undefined;
        positionModal(modalOverlayOpeningPadding, modalOverlayOpeningRadius, scrollParent, step.target);
        rafId = requestAnimationFrame(rafLoop);
      };
      rafLoop();
      _addStepEventListeners();
    }
    function svg_binding($$value) {
      binding_callbacks[$$value ? 'unshift' : 'push'](function () {
        element = $$value;
        $$invalidate(0, element);
      });
    }
    $$self.$$set = function ($$props) {
      if ('element' in $$props) $$invalidate(0, element = $$props.element);
      if ('openingProperties' in $$props) $$invalidate(4, openingProperties = $$props.openingProperties);
    };
    $$self.$$.update = function () {
      if ($$self.$$.dirty & /*openingProperties*/16) {
        $$invalidate(2, pathDefinition = makeOverlayPath(openingProperties));
      }
    };
    return [element, modalIsVisible, pathDefinition, _preventModalOverlayTouch, openingProperties, getElement, closeModalOpening, hide, positionModal, setupForStep, show, svg_binding];
  }
  var Shepherd_modal = /*#__PURE__*/function (_SvelteComponent9) {
    _inherits(Shepherd_modal, _SvelteComponent9);
    var _super10 = _createSuper(Shepherd_modal);
    function Shepherd_modal(options) {
      var _this16;
      _classCallCheck(this, Shepherd_modal);
      _this16 = _super10.call(this);
      init(_assertThisInitialized(_this16), options, instance, create_fragment, safe_not_equal, {
        element: 0,
        openingProperties: 4,
        getElement: 5,
        closeModalOpening: 6,
        hide: 7,
        positionModal: 8,
        setupForStep: 9,
        show: 10
      });
      return _this16;
    }
    _createClass(Shepherd_modal, [{
      key: "getElement",
      get: function get() {
        return this.$$.ctx[5];
      }
    }, {
      key: "closeModalOpening",
      get: function get() {
        return this.$$.ctx[6];
      }
    }, {
      key: "hide",
      get: function get() {
        return this.$$.ctx[7];
      }
    }, {
      key: "positionModal",
      get: function get() {
        return this.$$.ctx[8];
      }
    }, {
      key: "setupForStep",
      get: function get() {
        return this.$$.ctx[9];
      }
    }, {
      key: "show",
      get: function get() {
        return this.$$.ctx[10];
      }
    }]);
    return Shepherd_modal;
  }(SvelteComponent);
  var Shepherd = new Evented();

  /**
   * Class representing the site tour
   * @extends {Evented}
   */
  var Tour = /*#__PURE__*/function (_Evented2) {
    _inherits(Tour, _Evented2);
    var _super11 = _createSuper(Tour);
    /**
     * @param {Object} options The options for the tour
     * @param {boolean | function(): boolean | Promise<boolean> | function(): Promise<boolean>} options.confirmCancel If true, will issue a `window.confirm` before cancelling.
     * If it is a function(support Async Function), it will be called and wait for the return value, and will only be cancelled if the value returned is true
     * @param {string} options.confirmCancelMessage The message to display in the `window.confirm` dialog
     * @param {string} options.classPrefix The prefix to add to the `shepherd-enabled` and `shepherd-target` class names as well as the `data-shepherd-step-id`.
     * @param {Object} options.defaultStepOptions Default options for Steps ({@link Step#constructor}), created through `addStep`
     * @param {boolean} options.exitOnEsc Exiting the tour with the escape key will be enabled unless this is explicitly
     * set to false.
     * @param {boolean} options.keyboardNavigation Navigating the tour via left and right arrow keys will be enabled
     * unless this is explicitly set to false.
     * @param {HTMLElement} options.stepsContainer An optional container element for the steps.
     * If not set, the steps will be appended to `document.body`.
     * @param {HTMLElement} options.modalContainer An optional container element for the modal.
     * If not set, the modal will be appended to `document.body`.
     * @param {object[] | Step[]} options.steps An array of step options objects or Step instances to initialize the tour with
     * @param {string} options.tourName An optional "name" for the tour. This will be appended to the the tour's
     * dynamically generated `id` property.
     * @param {boolean} options.useModalOverlay Whether or not steps should be placed above a darkened
     * modal overlay. If true, the overlay will create an opening around the target element so that it
     * can remain interactive
     * @returns {Tour}
     */
    function Tour(options) {
      var _this17;
      _classCallCheck(this, Tour);
      if (options === void 0) {
        options = {};
      }
      _this17 = _super11.call(this, options);
      autoBind(_assertThisInitialized(_this17));
      var defaultTourOptions = {
        exitOnEsc: true,
        keyboardNavigation: true
      };
      _this17.options = Object.assign({}, defaultTourOptions, options);
      _this17.classPrefix = normalizePrefix(_this17.options.classPrefix);
      _this17.steps = [];
      _this17.addSteps(_this17.options.steps);

      // Pass these events onto the global Shepherd object
      var events = ['active', 'cancel', 'complete', 'inactive', 'show', 'start'];
      events.map(function (event) {
        (function (e) {
          _this17.on(e, function (opts) {
            opts = opts || {};
            opts.tour = _assertThisInitialized(_this17);
            Shepherd.trigger(e, opts);
          });
        })(event);
      });
      _this17._setTourID();
      return _possibleConstructorReturn(_this17, _assertThisInitialized(_this17));
    }

    /**
     * Adds a new step to the tour
     * @param {Object|Step} options An object containing step options or a Step instance
     * @param {number} index The optional index to insert the step at. If undefined, the step
     * is added to the end of the array.
     * @return {Step} The newly added step
     */
    _createClass(Tour, [{
      key: "addStep",
      value: function addStep(options, index) {
        var step = options;
        if (!(step instanceof Step)) {
          step = new Step(this, step);
        } else {
          step.tour = this;
        }
        if (!isUndefined(index)) {
          this.steps.splice(index, 0, step);
        } else {
          this.steps.push(step);
        }
        return step;
      }

      /**
       * Add multiple steps to the tour
       * @param {Array<object> | Array<Step>} steps The steps to add to the tour
       */
    }, {
      key: "addSteps",
      value: function addSteps(steps) {
        var _this18 = this;
        if (Array.isArray(steps)) {
          steps.forEach(function (step) {
            _this18.addStep(step);
          });
        }
        return this;
      }

      /**
       * Go to the previous step in the tour
       */
    }, {
      key: "back",
      value: function back() {
        var index = this.steps.indexOf(this.currentStep);
        this.show(index - 1, false);
      }

      /**
       * Calls _done() triggering the 'cancel' event
       * If `confirmCancel` is true, will show a window.confirm before cancelling
       * If `confirmCancel` is a function, will call it and wait for the return value,
       * and only cancel when the value returned is true
       */
    }, {
      key: "cancel",
      value: function () {
        var _cancel = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee6() {
          var confirmCancelIsFunction, cancelMessage, stopTour;
          return _regeneratorRuntime().wrap(function _callee6$(_context6) {
            while (1) switch (_context6.prev = _context6.next) {
              case 0:
                if (!this.options.confirmCancel) {
                  _context6.next = 14;
                  break;
                }
                confirmCancelIsFunction = typeof this.options.confirmCancel === 'function';
                cancelMessage = this.options.confirmCancelMessage || 'Are you sure you want to stop the tour?';
                if (!confirmCancelIsFunction) {
                  _context6.next = 9;
                  break;
                }
                _context6.next = 6;
                return this.options.confirmCancel();
              case 6:
                _context6.t0 = _context6.sent;
                _context6.next = 10;
                break;
              case 9:
                _context6.t0 = window.confirm(cancelMessage);
              case 10:
                stopTour = _context6.t0;
                if (stopTour) {
                  this._done('cancel');
                }
                _context6.next = 15;
                break;
              case 14:
                this._done('cancel');
              case 15:
              case "end":
                return _context6.stop();
            }
          }, _callee6, this);
        }));
        function cancel() {
          return _cancel.apply(this, arguments);
        }
        return cancel;
      }()
      /**
       * Calls _done() triggering the `complete` event
       */
    }, {
      key: "complete",
      value: function complete() {
        this._done('complete');
      }

      /**
       * Gets the step from a given id
       * @param {Number|String} id The id of the step to retrieve
       * @return {Step} The step corresponding to the `id`
       */
    }, {
      key: "getById",
      value: function getById(id) {
        return this.steps.find(function (step) {
          return step.id === id;
        });
      }

      /**
       * Gets the current step
       * @returns {Step|null}
       */
    }, {
      key: "getCurrentStep",
      value: function getCurrentStep() {
        return this.currentStep;
      }

      /**
       * Hide the current step
       */
    }, {
      key: "hide",
      value: function hide() {
        var currentStep = this.getCurrentStep();
        if (currentStep) {
          return currentStep.hide();
        }
      }

      /**
       * Check if the tour is active
       * @return {boolean}
       */
    }, {
      key: "isActive",
      value: function isActive() {
        return Shepherd.activeTour === this;
      }

      /**
       * Go to the next step in the tour
       * If we are at the end, call `complete`
       */
    }, {
      key: "next",
      value: function next() {
        var index = this.steps.indexOf(this.currentStep);
        if (index === this.steps.length - 1) {
          this.complete();
        } else {
          this.show(index + 1, true);
        }
      }

      /**
       * Removes the step from the tour
       * @param {String} name The id for the step to remove
       */
    }, {
      key: "removeStep",
      value: function removeStep(name) {
        var _this19 = this;
        var current = this.getCurrentStep();

        // Find the step, destroy it and remove it from this.steps
        this.steps.some(function (step, i) {
          if (step.id === name) {
            if (step.isOpen()) {
              step.hide();
            }
            step.destroy();
            _this19.steps.splice(i, 1);
            return true;
          }
        });
        if (current && current.id === name) {
          this.currentStep = undefined;

          // If we have steps left, show the first one, otherwise just cancel the tour
          this.steps.length ? this.show(0) : this.cancel();
        }
      }

      /**
       * Show a specific step in the tour
       * @param {Number|String} key The key to look up the step by
       * @param {Boolean} forward True if we are going forward, false if backward
       */
    }, {
      key: "show",
      value: function show(key, forward) {
        if (key === void 0) {
          key = 0;
        }
        if (forward === void 0) {
          forward = true;
        }
        var step = isString(key) ? this.getById(key) : this.steps[key];
        if (step) {
          this._updateStateBeforeShow();
          var shouldSkipStep = isFunction(step.options.showOn) && !step.options.showOn();

          // If `showOn` returns false, we want to skip the step, otherwise, show the step like normal
          if (shouldSkipStep) {
            this._skipStep(step, forward);
          } else {
            this.trigger('show', {
              step: step,
              previous: this.currentStep
            });
            this.currentStep = step;
            step.show();
          }
        }
      }

      /**
       * Start the tour
       */
    }, {
      key: "start",
      value: function start() {
        this.trigger('start');

        // Save the focused element before the tour opens
        this.focusedElBeforeOpen = document.activeElement;
        this.currentStep = null;
        this._setupModal();
        this._setupActiveTour();
        this.next();
      }

      /**
       * Called whenever the tour is cancelled or completed, basically anytime we exit the tour
       * @param {String} event The event name to trigger
       * @private
       */
    }, {
      key: "_done",
      value: function _done(event) {
        var index = this.steps.indexOf(this.currentStep);
        if (Array.isArray(this.steps)) {
          this.steps.forEach(function (step) {
            return step.destroy();
          });
        }
        cleanupSteps(this);
        this.trigger(event, {
          index: index
        });
        Shepherd.activeTour = null;
        this.trigger('inactive', {
          tour: this
        });
        if (this.modal) {
          this.modal.hide();
        }
        if (event === 'cancel' || event === 'complete') {
          if (this.modal) {
            var modalContainer = document.querySelector('.shepherd-modal-overlay-container');
            if (modalContainer) {
              modalContainer.remove();
            }
          }
        }

        // Focus the element that was focused before the tour started
        if (isHTMLElement$1(this.focusedElBeforeOpen)) {
          this.focusedElBeforeOpen.focus();
        }
      }

      /**
       * Make this tour "active"
       * @private
       */
    }, {
      key: "_setupActiveTour",
      value: function _setupActiveTour() {
        this.trigger('active', {
          tour: this
        });
        Shepherd.activeTour = this;
      }

      /**
       * _setupModal create the modal container and instance
       * @private
       */
    }, {
      key: "_setupModal",
      value: function _setupModal() {
        this.modal = new Shepherd_modal({
          target: this.options.modalContainer || document.body,
          props: {
            classPrefix: this.classPrefix,
            styles: this.styles
          }
        });
      }

      /**
       * Called when `showOn` evaluates to false, to skip the step or complete the tour if it's the last step
       * @param {Step} step The step to skip
       * @param {Boolean} forward True if we are going forward, false if backward
       * @private
       */
    }, {
      key: "_skipStep",
      value: function _skipStep(step, forward) {
        var index = this.steps.indexOf(step);
        if (index === this.steps.length - 1) {
          this.complete();
        } else {
          var nextIndex = forward ? index + 1 : index - 1;
          this.show(nextIndex, forward);
        }
      }

      /**
       * Before showing, hide the current step and if the tour is not
       * already active, call `this._setupActiveTour`.
       * @private
       */
    }, {
      key: "_updateStateBeforeShow",
      value: function _updateStateBeforeShow() {
        if (this.currentStep) {
          this.currentStep.hide();
        }
        if (!this.isActive()) {
          this._setupActiveTour();
        }
      }

      /**
       * Sets this.id to `${tourName}--${uuid}`
       * @private
       */
    }, {
      key: "_setTourID",
      value: function _setTourID() {
        var tourName = this.options.tourName || 'tour';
        this.id = "".concat(tourName, "--").concat(uuid());
      }
    }]);
    return Tour;
  }(Evented);
  var isServerSide = typeof window === 'undefined';
  var NoOp = /*#__PURE__*/_createClass(function NoOp() {
    _classCallCheck(this, NoOp);
  });
  if (isServerSide) {
    Object.assign(Shepherd, {
      Tour: NoOp,
      Step: NoOp
    });
  } else {
    Object.assign(Shepherd, {
      Tour: Tour,
      Step: Step
    });
  }
  return Shepherd;
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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
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
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!***********************************************************!*\
  !*** ./resources/assets/vendor/libs/shepherd/shepherd.js ***!
  \***********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Shepherd: function() { return /* reexport default from dynamic */ shepherd_js_dist_js_shepherd__WEBPACK_IMPORTED_MODULE_0___default.a; }
/* harmony export */ });
/* harmony import */ var shepherd_js_dist_js_shepherd__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! shepherd.js/dist/js/shepherd */ "./node_modules/shepherd.js/dist/js/shepherd.js");
/* harmony import */ var shepherd_js_dist_js_shepherd__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(shepherd_js_dist_js_shepherd__WEBPACK_IMPORTED_MODULE_0__);


}();
/******/ 	return __webpack_exports__;
/******/ })()
;
});