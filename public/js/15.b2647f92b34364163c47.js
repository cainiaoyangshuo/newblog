webpackJsonp([15],{

/***/ 195:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(479)
/* template */
var __vue_template__ = __webpack_require__(480)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/dashboard/modules/tag/Create.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2ea4a592", Component.options)
  } else {
    hotAPI.reload("data-v-2ea4a592", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 372:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(373)
/* template */
var __vue_template__ = __webpack_require__(374)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/dashboard/modules/tag/Form.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-352bd4da", Component.options)
  } else {
    hotAPI.reload("data-v-352bd4da", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 373:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _helper = __webpack_require__(69);

exports.default = {
  props: {
    tag: {
      type: Object,
      default: function _default() {
        return {};
      }
    }
  },
  computed: {
    mode: function mode() {
      return this.tag.id ? 'update' : 'create';
    }
  },
  methods: {
    onSubmit: function onSubmit() {
      var _this = this;

      var url = 'tag' + (this.tag.id ? '/' + this.tag.id : '');
      var method = this.tag.id ? 'patch' : 'post';

      this.$http[method](url, this.tag).then(function (response) {
        toastr.success('You ' + _this.mode + 'd the tag success!');

        _this.$router.push({ name: 'dashboard.tag' });
      }).catch(function (_ref) {
        var response = _ref.response;

        (0, _helper.stack_error)(response);
      });
    }
  }
}; //
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/***/ }),

/***/ 374:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c(
      "form",
      {
        staticClass: "col-md-4 offset-md-4",
        attrs: { role: "form" },
        on: {
          submit: function($event) {
            $event.preventDefault()
            return _vm.onSubmit($event)
          }
        }
      },
      [
        _c("div", { staticClass: "form-group" }, [
          _c("label", { attrs: { for: "tag" } }, [
            _vm._v(_vm._s(_vm.$t("form.tag")))
          ]),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.tag.tag,
                expression: "tag.tag"
              }
            ],
            staticClass: "form-control",
            attrs: {
              type: "text",
              id: "tag",
              placeholder: _vm.$t("form.tag"),
              name: "tag",
              disabled: _vm.mode == "udpate" && _vm.tag.tag ? true : false
            },
            domProps: { value: _vm.tag.tag },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.tag, "tag", $event.target.value)
              }
            }
          })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", { attrs: { for: "title" } }, [
            _vm._v(_vm._s(_vm.$t("form.title")))
          ]),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.tag.title,
                expression: "tag.title"
              }
            ],
            staticClass: "form-control",
            attrs: {
              type: "text",
              id: "title",
              placeholder: _vm.$t("form.title"),
              name: "title"
            },
            domProps: { value: _vm.tag.title },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.tag, "title", $event.target.value)
              }
            }
          })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", { attrs: { for: "meta_description" } }, [
            _vm._v(_vm._s(_vm.$t("form.meta_description")))
          ]),
          _vm._v(" "),
          _c("textarea", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.tag.meta_description,
                expression: "tag.meta_description"
              }
            ],
            staticClass: "form-control",
            attrs: {
              name: "meta_description",
              id: "meta_description",
              placeholder: _vm.$t("form.meta_description")
            },
            domProps: { value: _vm.tag.meta_description },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.tag, "meta_description", $event.target.value)
              }
            }
          })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c(
            "button",
            { staticClass: "btn btn-info", attrs: { type: "submit" } },
            [
              _vm._v(
                _vm._s(_vm.tag.id ? _vm.$t("form.edit") : _vm.$t("form.create"))
              )
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-352bd4da", module.exports)
  }
}

/***/ }),

/***/ 479:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Form = __webpack_require__(372);

var _Form2 = _interopRequireDefault(_Form);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
  components: { TagForm: _Form2.default }
}; //
//
//
//
//
//
//
//
//
//
//

/***/ }),

/***/ 480:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "vue-form",
    { attrs: { title: _vm.$t("form.create_tag") } },
    [
      _c(
        "template",
        { slot: "buttons" },
        [
          _c(
            "router-link",
            {
              staticClass: "btn btn-sm btn-secondary",
              attrs: { to: { name: "dashboard.tag" }, exact: "" }
            },
            [_vm._v(_vm._s(_vm.$t("form.back")))]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("template", { slot: "content" }, [_c("tag-form")], 1)
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2ea4a592", module.exports)
  }
}

/***/ }),

/***/ 69:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.stack_error = stack_error;
function stack_error(response) {
  if (typeof response.data == 'string') {
    toastr.error(response.status + ' ' + response.statusText);
  } else {
    var data = response.data.errors;
    var content = '';

    Object.keys(data).map(function (key, index) {
      var value = data[key];

      content += '<span style="color: #e74c3c">' + value[0] + '</span><br>';
    });

    swal({
      title: "Error Text!",
      type: 'error',
      html: content
    });
  }
}

/***/ })

});