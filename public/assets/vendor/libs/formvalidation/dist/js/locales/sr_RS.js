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

/***/ "./resources/assets/vendor/libs/formvalidation/dist/js/locales/sr_RS.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/vendor/libs/formvalidation/dist/js/locales/sr_RS.js ***!
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
   * Serbian Latin language package
   * Translated by @markocrni
   */
  var sr_RS = {
    base64: {
      "default": 'Molimo da unesete važeći base 64 enkodovan'
    },
    between: {
      "default": 'Molimo da unesete vrednost između %s i %s',
      notInclusive: 'Molimo da unesete vrednost strogo između %s i %s'
    },
    bic: {
      "default": 'Molimo da unesete ispravan BIC broj'
    },
    callback: {
      "default": 'Molimo da unesete važeću vrednost'
    },
    choice: {
      between: 'Molimo odaberite %s - %s opcije(a)',
      "default": 'Molimo da unesete važeću vrednost',
      less: 'Molimo da odaberete minimalno %s opciju(a)',
      more: 'Molimo da odaberete maksimalno %s opciju(a)'
    },
    color: {
      "default": 'Molimo da unesete ispravnu boju'
    },
    creditCard: {
      "default": 'Molimo da unesete ispravan broj kreditne kartice'
    },
    cusip: {
      "default": 'Molimo da unesete ispravan CUSIP broj'
    },
    date: {
      "default": 'Molimo da unesete ispravan datum',
      max: 'Molimo da unesete datum pre %s',
      min: 'Molimo da unesete datum posle %s',
      range: 'Molimo da unesete datum od %s do %s'
    },
    different: {
      "default": 'Molimo da unesete drugu vrednost'
    },
    digits: {
      "default": 'Molimo da unesete samo cifre'
    },
    ean: {
      "default": 'Molimo da unesete ispravan EAN broj'
    },
    ein: {
      "default": 'Molimo da unesete ispravan EIN broj'
    },
    emailAddress: {
      "default": 'Molimo da unesete važeću e-mail adresu'
    },
    file: {
      "default": 'Molimo da unesete ispravan fajl'
    },
    greaterThan: {
      "default": 'Molimo da unesete vrednost veću ili jednaku od %s',
      notInclusive: 'Molimo da unesete vrednost veću od %s'
    },
    grid: {
      "default": 'Molimo da unesete ispravan GRId broj'
    },
    hex: {
      "default": 'Molimo da unesete ispravan heksadecimalan broj'
    },
    iban: {
      countries: {
        AD: 'Andore',
        AE: 'Ujedinjenih Arapskih Emirata',
        AL: 'Albanije',
        AO: 'Angole',
        AT: 'Austrije',
        AZ: 'Azerbejdžana',
        BA: 'Bosne i Hercegovine',
        BE: 'Belgije',
        BF: 'Burkina Fasa',
        BG: 'Bugarske',
        BH: 'Bahraina',
        BI: 'Burundija',
        BJ: 'Benina',
        BR: 'Brazila',
        CH: 'Švajcarske',
        CI: 'Obale slonovače',
        CM: 'Kameruna',
        CR: 'Kostarike',
        CV: 'Zelenorotskih Ostrva',
        CY: 'Kipra',
        CZ: 'Češke',
        DE: 'Nemačke',
        DK: 'Danske',
        DO: 'Dominike',
        DZ: 'Alžira',
        EE: 'Estonije',
        ES: 'Španije',
        FI: 'Finske',
        FO: 'Farskih Ostrva',
        FR: 'Francuske',
        GB: 'Engleske',
        GE: 'Džordžije',
        GI: 'Giblartara',
        GL: 'Grenlanda',
        GR: 'Grčke',
        GT: 'Gvatemale',
        HR: 'Hrvatske',
        HU: 'Mađarske',
        IE: 'Irske',
        IL: 'Izraela',
        IR: 'Irana',
        IS: 'Islanda',
        IT: 'Italije',
        JO: 'Jordana',
        KW: 'Kuvajta',
        KZ: 'Kazahstana',
        LB: 'Libana',
        LI: 'Lihtenštajna',
        LT: 'Litvanije',
        LU: 'Luksemburga',
        LV: 'Latvije',
        MC: 'Monaka',
        MD: 'Moldove',
        ME: 'Crne Gore',
        MG: 'Madagaskara',
        MK: 'Makedonije',
        ML: 'Malija',
        MR: 'Mauritanije',
        MT: 'Malte',
        MU: 'Mauricijusa',
        MZ: 'Mozambika',
        NL: 'Holandije',
        NO: 'Norveške',
        PK: 'Pakistana',
        PL: 'Poljske',
        PS: 'Palestine',
        PT: 'Portugala',
        QA: 'Katara',
        RO: 'Rumunije',
        RS: 'Srbije',
        SA: 'Saudijske Arabije',
        SE: 'Švedske',
        SI: 'Slovenije',
        SK: 'Slovačke',
        SM: 'San Marina',
        SN: 'Senegala',
        TL: 'Источни Тимор',
        TN: 'Tunisa',
        TR: 'Turske',
        VG: 'Britanskih Devičanskih Ostrva',
        XK: 'Република Косово'
      },
      country: 'Molimo da unesete ispravan IBAN broj %s',
      "default": 'Molimo da unesete ispravan IBAN broj'
    },
    id: {
      countries: {
        BA: 'Bosne i Herzegovine',
        BG: 'Bugarske',
        BR: 'Brazila',
        CH: 'Švajcarske',
        CL: 'Čilea',
        CN: 'Kine',
        CZ: 'Češke',
        DK: 'Danske',
        EE: 'Estonije',
        ES: 'Španije',
        FI: 'Finske',
        HR: 'Hrvatske',
        IE: 'Irske',
        IS: 'Islanda',
        LT: 'Litvanije',
        LV: 'Letonije',
        ME: 'Crne Gore',
        MK: 'Makedonije',
        NL: 'Holandije',
        PL: 'Poljske',
        RO: 'Rumunije',
        RS: 'Srbije',
        SE: 'Švedske',
        SI: 'Slovenije',
        SK: 'Slovačke',
        SM: 'San Marina',
        TH: 'Tajlanda',
        TR: 'Turske',
        ZA: 'Južne Afrike'
      },
      country: 'Molimo da unesete ispravan identifikacioni broj %s',
      "default": 'Molimo da unesete ispravan identifikacioni broj'
    },
    identical: {
      "default": 'Molimo da unesete istu vrednost'
    },
    imei: {
      "default": 'Molimo da unesete ispravan IMEI broj'
    },
    imo: {
      "default": 'Molimo da unesete ispravan IMO broj'
    },
    integer: {
      "default": 'Molimo da unesete ispravan broj'
    },
    ip: {
      "default": 'Molimo da unesete ispravnu IP adresu',
      ipv4: 'Molimo da unesete ispravnu IPv4 adresu',
      ipv6: 'Molimo da unesete ispravnu IPv6 adresu'
    },
    isbn: {
      "default": 'Molimo da unesete ispravan ISBN broj'
    },
    isin: {
      "default": 'Molimo da unesete ispravan ISIN broj'
    },
    ismn: {
      "default": 'Molimo da unesete ispravan ISMN broj'
    },
    issn: {
      "default": 'Molimo da unesete ispravan ISSN broj'
    },
    lessThan: {
      "default": 'Molimo da unesete vrednost manju ili jednaku od %s',
      notInclusive: 'Molimo da unesete vrednost manju od %s'
    },
    mac: {
      "default": 'Molimo da unesete ispravnu MAC adresu'
    },
    meid: {
      "default": 'Molimo da unesete ispravan MEID broj'
    },
    notEmpty: {
      "default": 'Molimo da unesete vrednost'
    },
    numeric: {
      "default": 'Molimo da unesete ispravan decimalni broj'
    },
    phone: {
      countries: {
        AE: 'Ujedinjenih Arapskih Emirata',
        BG: 'Bugarske',
        BR: 'Brazila',
        CN: 'Kine',
        CZ: 'Češke',
        DE: 'Nemačke',
        DK: 'Danske',
        ES: 'Španije',
        FR: 'Francuske',
        GB: 'Engleske',
        IN: 'Индија',
        MA: 'Maroka',
        NL: 'Holandije',
        PK: 'Pakistana',
        RO: 'Rumunije',
        RU: 'Rusije',
        SK: 'Slovačke',
        TH: 'Tajlanda',
        US: 'Amerike',
        VE: 'Venecuele'
      },
      country: 'Molimo da unesete ispravan broj telefona %s',
      "default": 'Molimo da unesete ispravan broj telefona'
    },
    promise: {
      "default": 'Molimo da unesete važeću vrednost'
    },
    regexp: {
      "default": 'Molimo da unesete vrednost koja se poklapa sa paternom'
    },
    remote: {
      "default": 'Molimo da unesete ispravnu vrednost'
    },
    rtn: {
      "default": 'Molimo da unesete ispravan RTN broj'
    },
    sedol: {
      "default": 'Molimo da unesete ispravan SEDOL broj'
    },
    siren: {
      "default": 'Molimo da unesete ispravan SIREN broj'
    },
    siret: {
      "default": 'Molimo da unesete ispravan SIRET broj'
    },
    step: {
      "default": 'Molimo da unesete ispravan korak od %s'
    },
    stringCase: {
      "default": 'Molimo da unesete samo mala slova',
      upper: 'Molimo da unesete samo velika slova'
    },
    stringLength: {
      between: 'Molimo da unesete vrednost dužine između %s i %s karaktera',
      "default": 'Molimo da unesete vrednost sa ispravnom dužinom',
      less: 'Molimo da unesete manje od %s karaktera',
      more: 'Molimo da unesete više od %s karaktera'
    },
    uri: {
      "default": 'Molimo da unesete ispravan URI'
    },
    uuid: {
      "default": 'Molimo da unesete ispravan UUID broj',
      version: 'Molimo da unesete ispravnu verziju UUID %s broja'
    },
    vat: {
      countries: {
        AT: 'Austrije',
        BE: 'Belgije',
        BG: 'Bugarske',
        BR: 'Brazila',
        CH: 'Švajcarske',
        CY: 'Kipra',
        CZ: 'Češke',
        DE: 'Nemačke',
        DK: 'Danske',
        EE: 'Estonije',
        EL: 'Grčke',
        ES: 'Španije',
        FI: 'Finske',
        FR: 'Francuske',
        GB: 'Engleske',
        GR: 'Grčke',
        HR: 'Hrvatske',
        HU: 'Mađarske',
        IE: 'Irske',
        IS: 'Islanda',
        IT: 'Italije',
        LT: 'Litvanije',
        LU: 'Luksemburga',
        LV: 'Letonije',
        MT: 'Malte',
        NL: 'Holandije',
        NO: 'Norveške',
        PL: 'Poljske',
        PT: 'Portugala',
        RO: 'Romunje',
        RS: 'Srbije',
        RU: 'Rusije',
        SE: 'Švedske',
        SI: 'Slovenije',
        SK: 'Slovačke',
        VE: 'Venecuele',
        ZA: 'Južne Afrike'
      },
      country: 'Molimo da unesete ispravan VAT broj %s',
      "default": 'Molimo da unesete ispravan VAT broj'
    },
    vin: {
      "default": 'Molimo da unesete ispravan VIN broj'
    },
    zipCode: {
      countries: {
        AT: 'Austrije',
        BG: 'Bugarske',
        BR: 'Brazila',
        CA: 'Kanade',
        CH: 'Švajcarske',
        CZ: 'Češke',
        DE: 'Nemačke',
        DK: 'Danske',
        ES: 'Španije',
        FR: 'Francuske',
        GB: 'Engleske',
        IE: 'Irske',
        IN: 'Индија',
        IT: 'Italije',
        MA: 'Maroka',
        NL: 'Holandije',
        PL: 'Poljske',
        PT: 'Portugala',
        RO: 'Rumunije',
        RU: 'Rusije',
        SE: 'Švedske',
        SG: 'Singapura',
        SK: 'Slovačke',
        US: 'Amerike'
      },
      country: 'Molimo da unesete ispravan poštanski broj %s',
      "default": 'Molimo da unesete ispravan poštanski broj'
    }
  };
  return sr_RS;
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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/libs/formvalidation/dist/js/locales/sr_RS.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});