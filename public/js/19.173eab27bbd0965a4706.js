webpackJsonp([19],{

/***/ 193:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(473)
}
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(475)
/* template */
var __vue_template__ = __webpack_require__(476)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-f41fd344"
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
Component.options.__file = "resources/js/dashboard/modules/system/System.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f41fd344", Component.options)
  } else {
    hotAPI.reload("data-v-f41fd344", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 473:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(474);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("ca2efb32", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f41fd344\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/sass-loader/lib/loader.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./System.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f41fd344\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/sass-loader/lib/loader.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./System.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 474:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)(false);
// imports


// module
exports.push([module.i, "\nh2[data-v-f41fd344] {\n  font-size: 20px;\n  line-height: 30px;\n  margin-top: 0;\n}\nul[data-v-f41fd344] {\n  padding-left: 0;\n}\nul li[data-v-f41fd344] {\n  list-style: none;\n}\n.content[data-v-f41fd344] {\n  margin-top: 30px;\n}\n.table thead th[data-v-f41fd344] {\n  vertical-align: bottom;\n}\n.table th[data-v-f41fd344] {\n  border-bottom: 1px solid #e5e5e5;\n  font-size: 12px;\n  text-transform: uppercase;\n  font-weight: normal;\n  color: #aaa;\n}\n.table :not(:last-child) > td[data-v-f41fd344] {\n  border-bottom: 1px solid #e5e5e5;\n}\n.table td[data-v-f41fd344] {\n  vertical-align: top;\n}\n.table th[data-v-f41fd344],\n.table td[data-v-f41fd344] {\n  padding: 16px 12px;\n}\n.table-hover tbody tr[data-v-f41fd344]:hover {\n  background: #fff;\n}\n.sidebar ul li a[data-v-f41fd344] {\n  font-size: 12px;\n  display: block;\n  text-decoration: none;\n  padding: 8px 14px;\n  cursor: pointer;\n  color: #666;\n}\n.sidebar ul li a[data-v-f41fd344]:hover,\n.active[data-v-f41fd344] {\n  background: #eee;\n  color: #666;\n}\n.sidebar ul li a i[data-v-f41fd344] {\n  font-size: 14px;\n  margin-right: 10px;\n}\n", ""]);

// exports


/***/ }),

/***/ 475:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
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
//
//
//
//
//

exports.default = {
  data: function data() {
    return {
      system: {},
      type: 'system'
    };
  },
  created: function created() {
    var _this = this;

    this.$http.get('system').then(function (response) {
      _this.system = response.data;
    });
  }
};

/***/ }),

/***/ 476:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "box" }, [
      _c("div", { staticClass: "box-title" }, [
        _c("h5", [_vm._v(_vm._s(_vm.$t("page.systems")))])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "box-content" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-2" }, [
            _c("div", { staticClass: "sidebar" }, [
              _c("ul", [
                _c(
                  "li",
                  {
                    class: [_vm.type == "system" ? "active" : ""],
                    attrs: { "aria-expanded": "false" },
                    on: {
                      click: function($event) {
                        _vm.type = "system"
                      }
                    }
                  },
                  [
                    _c("a", [
                      _c("i", { staticClass: "fas fa-puzzle-piece" }),
                      _vm._v(_vm._s(_vm.$t("page.system")))
                    ])
                  ]
                ),
                _vm._v(" "),
                _c(
                  "li",
                  {
                    class: [_vm.type == "php" ? "active" : ""],
                    attrs: { "aria-expanded": "true" },
                    on: {
                      click: function($event) {
                        _vm.type = "php"
                      }
                    }
                  },
                  [_vm._m(0)]
                ),
                _vm._v(" "),
                _c(
                  "li",
                  {
                    class: [_vm.type == "database" ? "active" : ""],
                    attrs: { "aria-expanded": "false" },
                    on: {
                      click: function($event) {
                        _vm.type = "database"
                      }
                    }
                  },
                  [
                    _c("a", [
                      _c("i", { staticClass: "fas fa-database" }),
                      _vm._v(" " + _vm._s(_vm.$t("page.database")))
                    ])
                  ]
                )
              ])
            ])
          ]),
          _vm._v(" "),
          _c("ul", { staticClass: "col-md-10", attrs: { id: "tab-content" } }, [
            _vm.type == "system"
              ? _c("li", { attrs: { "aria-hidden": "true" } }, [
                  _c("h2", [_vm._v(_vm._s(_vm.$t("page.system")))]),
                  _vm._v(" "),
                  _c("table", { staticClass: "table table-hover" }, [
                    _c("thead", [
                      _c("tr", [
                        _c("th", { attrs: { width: "150" } }, [
                          _vm._v(_vm._s(_vm.$t("page.key")))
                        ]),
                        _vm._v(" "),
                        _c("th", [_vm._v(_vm._s(_vm.$t("page.value")))])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("tbody", [
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.server")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.server))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.domain")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.http_host))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v("IP")]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.remote_host))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v("User Agent")]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.user_agent))])
                      ])
                    ])
                  ])
                ])
              : _vm._e(),
            _vm._v(" "),
            _vm.type == "php"
              ? _c("li", { attrs: { "aria-hidden": "false" } }, [
                  _c("h2", [_vm._v("PHP")]),
                  _vm._v(" "),
                  _c("table", { staticClass: "table table-hover" }, [
                    _c("thead", [
                      _c("tr", [
                        _c("th", { attrs: { width: "150" } }, [
                          _vm._v(_vm._s(_vm.$t("page.key")))
                        ]),
                        _vm._v(" "),
                        _c("th", [_vm._v(_vm._s(_vm.$t("page.value")))])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("tbody", [
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.version")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.php))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v("Handler")]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.sapi_name))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.extension")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.extensions))])
                      ])
                    ])
                  ])
                ])
              : _vm._e(),
            _vm._v(" "),
            _vm.type == "database"
              ? _c("li", { attrs: { "aria-hidden": "true" } }, [
                  _c("h2", [_vm._v(_vm._s(_vm.$t("page.database")))]),
                  _vm._v(" "),
                  _c("table", { staticClass: "table table-hover" }, [
                    _c("thead", [
                      _c("tr", [
                        _c("th", { attrs: { width: "150" } }, [
                          _vm._v(_vm._s(_vm.$t("page.key")))
                        ]),
                        _vm._v(" "),
                        _c("th", [_vm._v(_vm._s(_vm.$t("page.value")))])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("tbody", [
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.driver")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.db_connection))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.database")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.db_database))])
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("page.version")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.system.db_version))])
                      ])
                    ])
                  ])
                ])
              : _vm._e()
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("a", [_c("i", { staticClass: "fas fa-code" }), _vm._v(" PHP")])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-f41fd344", module.exports)
  }
}

/***/ })

});