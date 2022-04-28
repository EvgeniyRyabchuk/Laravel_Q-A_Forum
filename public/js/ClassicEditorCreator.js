/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/MyUploadAdapter.js":
/*!*****************************************!*\
  !*** ./resources/js/MyUploadAdapter.js ***!
  \*****************************************/
/***/ ((module) => {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var MyUploadAdapter = /*#__PURE__*/function () {
  function MyUploadAdapter(loader, uploadUrl) {
    _classCallCheck(this, MyUploadAdapter);

    // The file loader instance to use during the upload. It sounds scary but do not
    // worry — the loader will be passed into the adapter later on in this guide.
    this.loader = loader;
    this.uploadUrl = uploadUrl;
  } // Starts the upload process.
  // Starts the upload process.


  _createClass(MyUploadAdapter, [{
    key: "upload",
    value: function upload() {
      var _this = this;

      return this.loader.file.then(function (file) {
        return new Promise(function (resolve, reject) {
          _this._initRequest();

          _this._initListeners(resolve, reject, file);

          _this._sendRequest(file);
        });
      });
    } // Aborts the upload process.

  }, {
    key: "abort",
    value: function abort() {
      if (this.xhr) {
        this.xhr.abort();
      }
    }
  }, {
    key: "_initRequest",
    value: function _initRequest() {
      var xhr = this.xhr = new XMLHttpRequest(); // Note that your request may look different. It is up to you and your editor
      // integration to choose the right communication channel. This example uses
      // a POST request with JSON as a data structure but your configuration
      // could be different.

      xhr.open('POST', this.uploadUrl, true);
      xhr.setRequestHeader('x-csrf-token', '{{csrf_token()}}');
      xhr.responseType = 'json';
    }
  }, {
    key: "_initListeners",
    value: function _initListeners(resolve, reject, file) {
      var xhr = this.xhr;
      var loader = this.loader;
      var genericErrorText = "Couldn't upload file: ".concat(file.name, ".");
      xhr.addEventListener('error', function () {
        return reject(genericErrorText);
      });
      xhr.addEventListener('abort', function () {
        return reject();
      });
      xhr.addEventListener('load', function () {
        var response = xhr.response; // This example assumes the XHR server's "response" object will come with
        // an "error" which has its own "message" that can be passed to reject()
        // in the upload promise.
        //
        // Your integration may handle upload errors in a different way so make sure
        // it is done properly. The reject() function must be called when the upload fails.

        if (!response || response.error) {
          return reject(response && response.error ? response.error.message : genericErrorText);
        } // If the upload is successful, resolve the upload promise with an object containing
        // at least the "default" URL, pointing to the image on the server.
        // This URL will be used to display the image in the content. Learn more in the
        // UploadAdapter#upload documentation.


        imagePathList.push(response.url);
        resolve({
          "default": response.url
        });
      }); // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
      // properties which are used e.g. to display the upload progress bar in the editor
      // user interface.

      if (xhr.upload) {
        xhr.upload.addEventListener('progress', function (evt) {
          if (evt.lengthComputable) {
            loader.uploadTotal = evt.total;
            loader.uploaded = evt.loaded;
          }
        });
      }
    } // Prepares the data and sends the request.

  }, {
    key: "_sendRequest",
    value: function _sendRequest(file) {
      // Prepare the form data.
      var data = new FormData();
      data.append('upload', file); // Important note: This is the right place to implement security mechanisms
      // like authentication and CSRF protection. For instance, you can use
      // XMLHttpRequest.setRequestHeader() to set the request headers containing
      // the CSRF token generated earlier by your application.
      // Send the request.

      this.xhr.send(data);
    }
  }]);

  return MyUploadAdapter;
}();

module.exports = {
  MyUploadAdapter: MyUploadAdapter
};

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
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************************************!*\
  !*** ./resources/js/ClassicEditorCreator.js ***!
  \**********************************************/
var _require = __webpack_require__(/*! ./MyUploadAdapter */ "./resources/js/MyUploadAdapter.js"),
    MyUploadAdapter = _require.MyUploadAdapter;

function ClassicEditorCreate() {
  function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function (loader) {
      // Configure the URL to the upload script in your back-end here!
      return new MyUploadAdapter(loader, uploadUlr);
    };
  }

  ClassicEditor.create(document.querySelector('#summary-ckeditor'), {
    extraPlugins: [MyCustomUploadAdapterPlugin],
    alignment: {
      options: ['left', 'right', 'center']
    },
    toolbar: ['heading', '|', 'bulletedList', 'numberedList', 'alignment', 'undo', 'redo', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'uploadImage'],
    options: [{
      model: 'paragraph',
      title: 'Paragraph',
      "class": 'ck-heading_paragraph'
    }, {
      model: 'heading1',
      view: 'h1',
      title: 'Heading 1',
      "class": 'ck-heading_heading1'
    }, {
      model: 'heading2',
      view: 'h2',
      title: 'Heading 2',
      "class": 'ck-heading_heading2'
    }],
    cloudServices: {
      uploadUrl: uploadUlr
    }
  }).then(function (editor) {
    console.log(editor);
  })["catch"](function (error) {
    console.error(error);
  });
}

ClassicEditorCreate();
})();

/******/ })()
;