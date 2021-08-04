/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/croppie.js":
/*!*********************************!*\
  !*** ./resources/js/croppie.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var $uploadCrop, $uploadCropHead, rawImg, imageId;

function readFile(input, modalId, modalBodyId) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(modalBodyId).addClass('ready');
      $(modalId).modal('show');
      rawImg = e.target.result;
    };

    reader.readAsDataURL(input.files[0]);
  }
} //ヘッダー画像


if ($(window).width() > 768) {
  // PC表示の時の処理
  $uploadCropHead = $('#upload-demo-head').croppie({
    viewport: {
      width: 540,
      height: 180
    },
    boundary: {
      width: 600,
      height: 180
    },
    showZoomer: false,
    enableOrientation: true
  });
} else {
  $uploadCropHead = $('#upload-demo-head').croppie({
    viewport: {
      width: 270,
      height: 90
    },
    boundary: {
      width: 300,
      height: 90
    },
    showZoomer: false,
    enableOrientation: true
  });
}

$('#cropImagePop-head').on('shown.bs.modal', function () {
  $uploadCropHead.croppie('bind', {
    url: rawImg
  }).then(function () {});
});
$('.image-head').on('change', function () {
  imageId = $(this).data('id');
  $('#cancelCropBtn-head').data('id', imageId);
  readFile(this, '#cropImagePop-head', '#upload-demo-head');
  $(this).val('');
});
$('#cropImageBtn-head').on('click', function (ev) {
  $uploadCropHead.croppie('result', {
    type: 'base64',
    format: 'jpg',
    backgroundColor: '#fff',
    size: {
      width: 1500,
      height: 500
    }
  }).then(function (resp) {
    $('#image-output-head').attr('src', resp);
    $('#cropImage-head').val(resp);
    $('#cropImagePop-head').modal('hide');
  });
}); //プロフィール画像

if ($(window).width() > 768) {
  // PC表示の時の処理
  $uploadCrop = $('#upload-demo').croppie({
    viewport: {
      width: 300,
      height: 300,
      type: 'circle'
    },
    boundary: {
      width: 600,
      height: 600
    },
    showZoomer: false,
    enableOrientation: true
  });
} else {
  $uploadCrop = $('#upload-demo').croppie({
    viewport: {
      width: 100,
      height: 100,
      type: 'circle'
    },
    boundary: {
      width: 300,
      height: 300
    },
    showZoomer: false,
    enableOrientation: true
  });
}

$('#cropImagePop').on('shown.bs.modal', function () {
  $uploadCrop.croppie('bind', {
    url: rawImg
  }).then(function () {});
});
$('.image').on('change', function () {
  imageId = $(this).data('id');
  $('#cancelCropBtn').data('id', imageId);
  readFile(this, '#cropImagePop', '#upload-demo');
  $(this).val('');
});
$('#cropImageBtn').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'base64',
    format: 'jpg',
    backgroundColor: '#fff',
    size: {
      width: 200,
      height: 200
    }
  }).then(function (resp) {
    $('#image-output').attr('src', resp);
    $('#cropImage').val(resp);
    $('#cropImagePop').modal('hide');
  });
});

/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./resources/js/croppie.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/myapp/resources/js/croppie.js */"./resources/js/croppie.js");


/***/ })

/******/ });