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

/***/ "./resources/assets/vendor/libs/formvalidation/dist/js/locales/ua_UA.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/vendor/libs/formvalidation/dist/js/locales/ua_UA.js ***!
  \******************************************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
(function (global, factory) {
  ( false ? 0 : _typeof(exports)) === 'object' && "object" !== 'undefined' ? module.exports = factory() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (0);
})(this, function () {
  'use strict';

  /**
   * Ukrainian language package
   * Translated by @oleg-voloshyn
   */
  var ua_UA = {
    base64: {
      "default": 'Будь ласка, введіть коректний рядок base64'
    },
    between: {
      "default": 'Будь ласка, введіть значення від %s до %s',
      notInclusive: 'Будь ласка, введіть значення між %s і %s'
    },
    bic: {
      "default": 'Будь ласка, введіть правильний номер BIC'
    },
    callback: {
      "default": 'Будь ласка, введіть коректне значення'
    },
    choice: {
      between: 'Будь ласка, виберіть %s - %s опцій',
      "default": 'Будь ласка, введіть коректне значення',
      less: 'Будь ласка, виберіть хоча б %s опцій',
      more: 'Будь ласка, виберіть не більше %s опцій'
    },
    color: {
      "default": 'Будь ласка, введіть правильний номер кольору'
    },
    creditCard: {
      "default": 'Будь ласка, введіть правильний номер кредитної картки'
    },
    cusip: {
      "default": 'Будь ласка, введіть правильний номер CUSIP'
    },
    date: {
      "default": 'Будь ласка, введіть правильну дату',
      max: 'Будь ласка, введіть дату перед %s',
      min: 'Будь ласка, введіть дату після %s',
      range: 'Будь ласка, введіть дату у діапазоні %s - %s'
    },
    different: {
      "default": 'Будь ласка, введіть інше значення'
    },
    digits: {
      "default": 'Будь ласка, введіть тільки цифри'
    },
    ean: {
      "default": 'Будь ласка, введіть правильний номер EAN'
    },
    ein: {
      "default": 'Будь ласка, введіть правильний номер EIN'
    },
    emailAddress: {
      "default": 'Будь ласка, введіть правильну адресу e-mail'
    },
    file: {
      "default": 'Будь ласка, виберіть файл'
    },
    greaterThan: {
      "default": 'Будь ласка, введіть значення більше або рівне %s',
      notInclusive: 'Будь ласка, введіть значення більше %s'
    },
    grid: {
      "default": 'Будь ласка, введіть правильний номер GRId'
    },
    hex: {
      "default": 'Будь ласка, введіть правильний шістнадцятковий(16) номер'
    },
    iban: {
      countries: {
        AD: 'Андоррі',
        AE: "Об'єднаних Арабських Еміратах",
        AL: 'Албанії',
        AO: 'Анголі',
        AT: 'Австрії',
        AZ: 'Азербайджані',
        BA: 'Боснії і Герцеговині',
        BE: 'Бельгії',
        BF: 'Буркіна-Фасо',
        BG: 'Болгарії',
        BH: 'Бахрейні',
        BI: 'Бурунді',
        BJ: 'Беніні',
        BR: 'Бразилії',
        CH: 'Швейцарії',
        CI: "Кот-д'Івуарі",
        CM: 'Камеруні',
        CR: 'Коста-Ріці',
        CV: 'Кабо-Верде',
        CY: 'Кіпрі',
        CZ: 'Чехії',
        DE: 'Германії',
        DK: 'Данії',
        DO: 'Домінікані',
        DZ: 'Алжирі',
        EE: 'Естонії',
        ES: 'Іспанії',
        FI: 'Фінляндії',
        FO: 'Фарерських островах',
        FR: 'Франції',
        GB: 'Великобританії',
        GE: 'Грузії',
        GI: 'Гібралтарі',
        GL: 'Гренландії',
        GR: 'Греції',
        GT: 'Гватемалі',
        HR: 'Хорватії',
        HU: 'Венгрії',
        IE: 'Ірландії',
        IL: 'Ізраїлі',
        IR: 'Ірані',
        IS: 'Ісландії',
        IT: 'Італії',
        JO: 'Йорданії',
        KW: 'Кувейті',
        KZ: 'Казахстані',
        LB: 'Лівані',
        LI: 'Ліхтенштейні',
        LT: 'Литві',
        LU: 'Люксембурзі',
        LV: 'Латвії',
        MC: 'Монако',
        MD: 'Молдові',
        ME: 'Чорногорії',
        MG: 'Мадагаскарі',
        MK: 'Македонії',
        ML: 'Малі',
        MR: 'Мавританії',
        MT: 'Мальті',
        MU: 'Маврикії',
        MZ: 'Мозамбіку',
        NL: 'Нідерландах',
        NO: 'Норвегії',
        PK: 'Пакистані',
        PL: 'Польщі',
        PS: 'Палестині',
        PT: 'Португалії',
        QA: 'Катарі',
        RO: 'Румунії',
        RS: 'Сербії',
        SA: 'Саудівської Аравії',
        SE: 'Швеції',
        SI: 'Словенії',
        SK: 'Словаччині',
        SM: 'Сан-Марино',
        SN: 'Сенегалі',
        TL: 'східний Тимор',
        TN: 'Тунісі',
        TR: 'Туреччині',
        VG: 'Британських Віргінських островах',
        XK: 'Республіка Косово'
      },
      country: 'Будь ласка, введіть правильний номер IBAN в %s',
      "default": 'Будь ласка, введіть правильний номер IBAN'
    },
    id: {
      countries: {
        BA: 'Боснії і Герцеговині',
        BG: 'Болгарії',
        BR: 'Бразилії',
        CH: 'Швейцарії',
        CL: 'Чилі',
        CN: 'Китаї',
        CZ: 'Чехії',
        DK: 'Данії',
        EE: 'Естонії',
        ES: 'Іспанії',
        FI: 'Фінляндії',
        HR: 'Хорватії',
        IE: 'Ірландії',
        IS: 'Ісландії',
        LT: 'Литві',
        LV: 'Латвії',
        ME: 'Чорногорії',
        MK: 'Македонії',
        NL: 'Нідерландах',
        PL: 'Польщі',
        RO: 'Румунії',
        RS: 'Сербії',
        SE: 'Швеції',
        SI: 'Словенії',
        SK: 'Словаччині',
        SM: 'Сан-Марино',
        TH: 'Таїланді',
        TR: 'Туреччині',
        ZA: 'ПАР'
      },
      country: 'Будь ласка, введіть правильний ідентифікаційний номер в %s',
      "default": 'Будь ласка, введіть правильний ідентифікаційний номер'
    },
    identical: {
      "default": 'Будь ласка, введіть таке ж значення'
    },
    imei: {
      "default": 'Будь ласка, введіть правильний номер IMEI'
    },
    imo: {
      "default": 'Будь ласка, введіть правильний номер IMO'
    },
    integer: {
      "default": 'Будь ласка, введіть правильне ціле значення'
    },
    ip: {
      "default": 'Будь ласка, введіть правильну IP-адресу',
      ipv4: 'Будь ласка введіть правильну IPv4-адресу',
      ipv6: 'Будь ласка введіть правильну IPv6-адресу'
    },
    isbn: {
      "default": 'Будь ласка, введіть правильний номер ISBN'
    },
    isin: {
      "default": 'Будь ласка, введіть правильний номер ISIN'
    },
    ismn: {
      "default": 'Будь ласка, введіть правильний номер ISMN'
    },
    issn: {
      "default": 'Будь ласка, введіть правильний номер ISSN'
    },
    lessThan: {
      "default": 'Будь ласка, введіть значення менше або рівне %s',
      notInclusive: 'Будь ласка, введіть значення менше ніж %s'
    },
    mac: {
      "default": 'Будь ласка, введіть правильну MAC-адресу'
    },
    meid: {
      "default": 'Будь ласка, введіть правильний номер MEID'
    },
    notEmpty: {
      "default": 'Будь ласка, введіть значення'
    },
    numeric: {
      "default": 'Будь ласка, введіть коректне дійсне число'
    },
    phone: {
      countries: {
        AE: "Об'єднаних Арабських Еміратах",
        BG: 'Болгарії',
        BR: 'Бразилії',
        CN: 'Китаї',
        CZ: 'Чехії',
        DE: 'Германії',
        DK: 'Данії',
        ES: 'Іспанії',
        FR: 'Франції',
        GB: 'Великобританії',
        IN: 'Індія',
        MA: 'Марокко',
        NL: 'Нідерландах',
        PK: 'Пакистані',
        RO: 'Румунії',
        RU: 'Росії',
        SK: 'Словаччині',
        TH: 'Таїланді',
        US: 'США',
        VE: 'Венесуелі'
      },
      country: 'Будь ласка, введіть правильний номер телефону в %s',
      "default": 'Будь ласка, введіть правильний номер телефону'
    },
    promise: {
      "default": 'Будь ласка, введіть коректне значення'
    },
    regexp: {
      "default": 'Будь ласка, введіть значення відповідне до шаблону'
    },
    remote: {
      "default": 'Будь ласка, введіть правильне значення'
    },
    rtn: {
      "default": 'Будь ласка, введіть правильний номер RTN'
    },
    sedol: {
      "default": 'Будь ласка, введіть правильний номер SEDOL'
    },
    siren: {
      "default": 'Будь ласка, введіть правильний номер SIREN'
    },
    siret: {
      "default": 'Будь ласка, введіть правильний номер SIRET'
    },
    step: {
      "default": 'Будь ласка, введіть правильний крок %s'
    },
    stringCase: {
      "default": 'Будь ласка, вводите тільки малі літери',
      upper: 'Будь ласка, вводите тільки заголовні букви'
    },
    stringLength: {
      between: 'Будь ласка, введіть рядок довжиною від %s до %s символів',
      "default": 'Будь ласка, введіть значення коректної довжини',
      less: 'Будь ласка, введіть не більше %s символів',
      more: 'Будь ласка, введіть, не менше %s символів'
    },
    uri: {
      "default": 'Будь ласка, введіть правильний URI'
    },
    uuid: {
      "default": 'Будь ласка, введіть правильний номер UUID',
      version: 'Будь ласка, введіть правильний номер UUID версії %s'
    },
    vat: {
      countries: {
        AT: 'Австрії',
        BE: 'Бельгії',
        BG: 'Болгарії',
        BR: 'Бразилії',
        CH: 'Швейцарії',
        CY: 'Кіпрі',
        CZ: 'Чехії',
        DE: 'Германії',
        DK: 'Данії',
        EE: 'Естонії',
        EL: 'Греції',
        ES: 'Іспанії',
        FI: 'Фінляндії',
        FR: 'Франції',
        GB: 'Великобританії',
        GR: 'Греції',
        HR: 'Хорватії',
        HU: 'Венгрії',
        IE: 'Ірландії',
        IS: 'Ісландії',
        IT: 'Італії',
        LT: 'Литві',
        LU: 'Люксембургі',
        LV: 'Латвії',
        MT: 'Мальті',
        NL: 'Нідерландах',
        NO: 'Норвегії',
        PL: 'Польщі',
        PT: 'Португалії',
        RO: 'Румунії',
        RS: 'Сербії',
        RU: 'Росії',
        SE: 'Швеції',
        SI: 'Словенії',
        SK: 'Словаччині',
        VE: 'Венесуелі',
        ZA: 'ПАР'
      },
      country: 'Будь ласка, введіть правильний номер VAT в %s',
      "default": 'Будь ласка, введіть правильний номер VAT'
    },
    vin: {
      "default": 'Будь ласка, введіть правильний номер VIN'
    },
    zipCode: {
      countries: {
        AT: 'Австрії',
        BG: 'Болгарії',
        BR: 'Бразилії',
        CA: 'Канаді',
        CH: 'Швейцарії',
        CZ: 'Чехії',
        DE: 'Германії',
        DK: 'Данії',
        ES: 'Іспанії',
        FR: 'Франції',
        GB: 'Великобританії',
        IE: 'Ірландії',
        IN: 'Індія',
        IT: 'Італії',
        MA: 'Марокко',
        NL: 'Нідерландах',
        PL: 'Польщі',
        PT: 'Португалії',
        RO: 'Румунії',
        RU: 'Росії',
        SE: 'Швеції',
        SG: 'Сингапурі',
        SK: 'Словаччині',
        US: 'США'
      },
      country: 'Будь ласка, введіть правильний поштовий індекс в %s',
      "default": 'Будь ласка, введіть правильний поштовий індекс'
    }
  };
  return ua_UA;
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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/libs/formvalidation/dist/js/locales/ua_UA.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});