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

/***/ "./resources/assets/vendor/libs/formvalidation/dist/js/locales/nl_NL.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/vendor/libs/formvalidation/dist/js/locales/nl_NL.js ***!
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
   * The Dutch language package
   * Translated by @jvanderheide
   */
  var nl_NL = {
    base64: {
      "default": 'Voer een geldige Base64 geëncodeerde tekst in'
    },
    between: {
      "default": 'Voer een waarde in van %s tot en met %s',
      notInclusive: 'Voer een waarde die tussen %s en %s ligt'
    },
    bic: {
      "default": 'Voer een geldige BIC-code in'
    },
    callback: {
      "default": 'Voer een geldige waarde in'
    },
    choice: {
      between: 'Kies tussen de %s - %s opties',
      "default": 'Voer een geldige waarde in',
      less: 'Kies minimaal %s optie(s)',
      more: 'Kies maximaal %s opties'
    },
    color: {
      "default": 'Voer een geldige kleurcode in'
    },
    creditCard: {
      "default": 'Voer een geldig creditcardnummer in'
    },
    cusip: {
      "default": 'Voer een geldig CUSIP-nummer in'
    },
    date: {
      "default": 'Voer een geldige datum in',
      max: 'Voer een datum in die vóór %s ligt',
      min: 'Voer een datum in die na %s ligt',
      range: 'Voer een datum in die tussen %s en %s ligt'
    },
    different: {
      "default": 'Voer een andere waarde in'
    },
    digits: {
      "default": 'Voer enkel cijfers in'
    },
    ean: {
      "default": 'Voer een geldige EAN-code in'
    },
    ein: {
      "default": 'Voer een geldige EIN-code in'
    },
    emailAddress: {
      "default": 'Voer een geldig e-mailadres in'
    },
    file: {
      "default": 'Kies een geldig bestand'
    },
    greaterThan: {
      "default": 'Voer een waarde in die gelijk is aan of groter is dan %s',
      notInclusive: 'Voer een waarde in die is groter dan %s'
    },
    grid: {
      "default": 'Voer een geldig GRId-nummer in'
    },
    hex: {
      "default": 'Voer een geldig hexadecimaal nummer in'
    },
    iban: {
      countries: {
        AD: 'Andorra',
        AE: 'Verenigde Arabische Emiraten',
        AL: 'Albania',
        AO: 'Angola',
        AT: 'Oostenrijk',
        AZ: 'Azerbeidzjan',
        BA: 'Bosnië en Herzegovina',
        BE: 'België',
        BF: 'Burkina Faso',
        BG: 'Bulgarije"',
        BH: 'Bahrein',
        BI: 'Burundi',
        BJ: 'Benin',
        BR: 'Brazilië',
        CH: 'Zwitserland',
        CI: 'Ivoorkust',
        CM: 'Kameroen',
        CR: 'Costa Rica',
        CV: 'Cape Verde',
        CY: 'Cyprus',
        CZ: 'Tsjechische Republiek',
        DE: 'Duitsland',
        DK: 'Denemarken',
        DO: 'Dominicaanse Republiek',
        DZ: 'Algerije',
        EE: 'Estland',
        ES: 'Spanje',
        FI: 'Finland',
        FO: 'Faeröer',
        FR: 'Frankrijk',
        GB: 'Verenigd Koninkrijk',
        GE: 'Georgia',
        GI: 'Gibraltar',
        GL: 'Groenland',
        GR: 'Griekenland',
        GT: 'Guatemala',
        HR: 'Kroatië',
        HU: 'Hongarije',
        IE: 'Ierland',
        IL: 'Israël',
        IR: 'Iran',
        IS: 'IJsland',
        IT: 'Italië',
        JO: 'Jordan',
        KW: 'Koeweit',
        KZ: 'Kazachstan',
        LB: 'Libanon',
        LI: 'Liechtenstein',
        LT: 'Litouwen',
        LU: 'Luxemburg',
        LV: 'Letland',
        MC: 'Monaco',
        MD: 'Moldavië',
        ME: 'Montenegro',
        MG: 'Madagascar',
        MK: 'Macedonië',
        ML: 'Mali',
        MR: 'Mauretanië',
        MT: 'Malta',
        MU: 'Mauritius',
        MZ: 'Mozambique',
        NL: 'Nederland',
        NO: 'Noorwegen',
        PK: 'Pakistan',
        PL: 'Polen',
        PS: 'Palestijnse',
        PT: 'Portugal',
        QA: 'Qatar',
        RO: 'Roemenië',
        RS: 'Servië',
        SA: 'Saudi-Arabië',
        SE: 'Zweden',
        SI: 'Slovenië',
        SK: 'Slowakije',
        SM: 'San Marino',
        SN: 'Senegal',
        TL: 'Oost-Timor',
        TN: 'Tunesië',
        TR: 'Turkije',
        VG: 'Britse Maagdeneilanden',
        XK: 'Republiek Kosovo'
      },
      country: 'Voer een geldig IBAN nummer in uit %s',
      "default": 'Voer een geldig IBAN nummer in'
    },
    id: {
      countries: {
        BA: 'Bosnië en Herzegovina',
        BG: 'Bulgarije',
        BR: 'Brazilië',
        CH: 'Zwitserland',
        CL: 'Chili',
        CN: 'China',
        CZ: 'Tsjechische Republiek',
        DK: 'Denemarken',
        EE: 'Estland',
        ES: 'Spanje',
        FI: 'Finland',
        HR: 'Kroatië',
        IE: 'Ierland',
        IS: 'IJsland',
        LT: 'Litouwen',
        LV: 'Letland',
        ME: 'Montenegro',
        MK: 'Macedonië',
        NL: 'Nederland',
        PL: 'Polen',
        RO: 'Roemenië',
        RS: 'Servië',
        SE: 'Zweden',
        SI: 'Slovenië',
        SK: 'Slowakije',
        SM: 'San Marino',
        TH: 'Thailand',
        TR: 'Turkije',
        ZA: 'Zuid-Afrika'
      },
      country: 'Voer een geldig identificatie nummer in uit %s',
      "default": 'Voer een geldig identificatie nummer in'
    },
    identical: {
      "default": 'Voer dezelfde waarde in'
    },
    imei: {
      "default": 'Voer een geldig IMEI-nummer in'
    },
    imo: {
      "default": 'Voer een geldig IMO-nummer in'
    },
    integer: {
      "default": 'Voer een geldig getal in'
    },
    ip: {
      "default": 'Voer een geldig IP adres in',
      ipv4: 'Voer een geldig IPv4 adres in',
      ipv6: 'Voer een geldig IPv6 adres in'
    },
    isbn: {
      "default": 'Voer een geldig ISBN-nummer in'
    },
    isin: {
      "default": 'Voer een geldig ISIN-nummer in'
    },
    ismn: {
      "default": 'Voer een geldig ISMN-nummer in'
    },
    issn: {
      "default": 'Voer een geldig ISSN-nummer in'
    },
    lessThan: {
      "default": 'Voer een waarde in gelijk aan of kleiner dan %s',
      notInclusive: 'Voer een waarde in kleiner dan %s'
    },
    mac: {
      "default": 'Voer een geldig MAC adres in'
    },
    meid: {
      "default": 'Voer een geldig MEID-nummer in'
    },
    notEmpty: {
      "default": 'Voer een waarde in'
    },
    numeric: {
      "default": 'Voer een geldig kommagetal in'
    },
    phone: {
      countries: {
        AE: 'Verenigde Arabische Emiraten',
        BG: 'Bulgarije',
        BR: 'Brazilië',
        CN: 'China',
        CZ: 'Tsjechische Republiek',
        DE: 'Duitsland',
        DK: 'Denemarken',
        ES: 'Spanje',
        FR: 'Frankrijk',
        GB: 'Verenigd Koninkrijk',
        IN: 'Indië',
        MA: 'Marokko',
        NL: 'Nederland',
        PK: 'Pakistan',
        RO: 'Roemenië',
        RU: 'Rusland',
        SK: 'Slowakije',
        TH: 'Thailand',
        US: 'VS',
        VE: 'Venezuela'
      },
      country: 'Voer een geldig telefoonnummer in uit %s',
      "default": 'Voer een geldig telefoonnummer in'
    },
    promise: {
      "default": 'Voer een geldige waarde in'
    },
    regexp: {
      "default": 'Voer een waarde in die overeenkomt met het patroon'
    },
    remote: {
      "default": 'Voer een geldige waarde in'
    },
    rtn: {
      "default": 'Voer een geldig RTN-nummer in'
    },
    sedol: {
      "default": 'Voer een geldig SEDOL-nummer in'
    },
    siren: {
      "default": 'Voer een geldig SIREN-nummer in'
    },
    siret: {
      "default": 'Voer een geldig SIRET-nummer in'
    },
    step: {
      "default": 'Voer een meervoud van %s in'
    },
    stringCase: {
      "default": 'Voer enkel kleine letters in',
      upper: 'Voer enkel hoofdletters in'
    },
    stringLength: {
      between: 'Voer tussen tussen %s en %s karakters in',
      "default": 'Voer een waarde met de juiste lengte in',
      less: 'Voer minder dan %s karakters in',
      more: 'Voer meer dan %s karakters in'
    },
    uri: {
      "default": 'Voer een geldige link in'
    },
    uuid: {
      "default": 'Voer een geldige UUID in',
      version: 'Voer een geldige UUID (versie %s) in'
    },
    vat: {
      countries: {
        AT: 'Oostenrijk',
        BE: 'België',
        BG: 'Bulgarije',
        BR: 'Brazilië',
        CH: 'Zwitserland',
        CY: 'Cyprus',
        CZ: 'Tsjechische Republiek',
        DE: 'Duitsland',
        DK: 'Denemarken',
        EE: 'Estland',
        EL: 'Griekenland',
        ES: 'Spanje',
        FI: 'Finland',
        FR: 'Frankrijk',
        GB: 'Verenigd Koninkrijk',
        GR: 'Griekenland',
        HR: 'Kroatië',
        HU: 'Hongarije',
        IE: 'Ierland',
        IS: 'IJsland',
        IT: 'Italië',
        LT: 'Litouwen',
        LU: 'Luxemburg',
        LV: 'Letland',
        MT: 'Malta',
        NL: 'Nederland',
        NO: 'Noorwegen',
        PL: 'Polen',
        PT: 'Portugal',
        RO: 'Roemenië',
        RS: 'Servië',
        RU: 'Rusland',
        SE: 'Zweden',
        SI: 'Slovenië',
        SK: 'Slowakije',
        VE: 'Venezuela',
        ZA: 'Zuid-Afrika'
      },
      country: 'Voer een geldig BTW-nummer in uit %s',
      "default": 'Voer een geldig BTW-nummer in'
    },
    vin: {
      "default": 'Voer een geldig VIN-nummer in'
    },
    zipCode: {
      countries: {
        AT: 'Oostenrijk',
        BG: 'Bulgarije',
        BR: 'Brazilië',
        CA: 'Canada',
        CH: 'Zwitserland',
        CZ: 'Tsjechische Republiek',
        DE: 'Duitsland',
        DK: 'Denemarken',
        ES: 'Spanje',
        FR: 'Frankrijk',
        GB: 'Verenigd Koninkrijk',
        IE: 'Ierland',
        IN: 'Indië',
        IT: 'Italië',
        MA: 'Marokko',
        NL: 'Nederland',
        PL: 'Polen',
        PT: 'Portugal',
        RO: 'Roemenië',
        RU: 'Rusland',
        SE: 'Zweden',
        SG: 'Singapore',
        SK: 'Slowakije',
        US: 'VS'
      },
      country: 'Voer een geldige postcode in uit %s',
      "default": 'Voer een geldige postcode in'
    }
  };
  return nl_NL;
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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/libs/formvalidation/dist/js/locales/nl_NL.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});