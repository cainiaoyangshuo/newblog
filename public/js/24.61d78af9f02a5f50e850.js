webpackJsonp([24],{

/***/ 190:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(467)
/* template */
var __vue_template__ = __webpack_require__(468)
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
Component.options.__file = "resources/js/dashboard/modules/link/Link.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3023b0be", Component.options)
  } else {
    hotAPI.reload("data-v-3023b0be", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 467:
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

exports.default = {
  data: function data() {
    return {
      fields: [{
        name: 'id',
        trans: 'table.id',
        titleClass: 'width-5-percent text-center',
        dataClass: 'text-center'
      }, {
        name: 'image',
        trans: 'table.image',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'image'
      }, {
        name: 'name',
        trans: 'table.name',
        titleClass: 'text-center',
        dataClass: 'text-center'
      }, {
        name: 'link',
        trans: 'table.link'
      }, {
        name: '__component',
        trans: 'table.enabled',
        titleClass: 'width-10-percent text-center',
        dataClass: 'text-center'
      }, {
        name: 'created_at',
        trans: 'table.created_at'
      }, {
        name: '__actions',
        trans: 'table.action',
        titleClass: 'text-center',
        dataClass: 'text-center'
      }]
    };
  },

  methods: {
    image: function image(value) {
      return '<img src="' + value + '" width="50" height="50" class="rounded-circle">';
    },
    tableActions: function tableActions(action, data) {
      var _this = this;

      if (action == 'edit-item') {
        this.$router.push({ name: 'dashboard.link.edit', params: { id: data.id } });
      } else if (action == 'delete-item') {
        this.$http.delete('link/' + data.id).then(function (response) {
          toastr.success('You delete the link success!');

          _this.$emit('reload', action);
        }).catch(function (_ref) {
          var response = _ref.response;

          toastr.error(response.status + ' : Resource ' + response.statusText);
        });
      }
    }
  }
};

/***/ }),

/***/ 468:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "row" },
    [
      _c(
        "vue-table",
        {
          attrs: {
            title: _vm.$t("page.links"),
            fields: _vm.fields,
            "api-url": "link",
            "show-paginate": ""
          },
          on: { "table-action": _vm.tableActions }
        },
        [
          _c(
            "template",
            { slot: "buttons" },
            [
              _vm.checkPermission("CREATE_LINK")
                ? _c(
                    "router-link",
                    {
                      staticClass: "btn btn-sm btn-success",
                      attrs: { to: { name: "dashboard.link.create" } }
                    },
                    [_vm._v(_vm._s(_vm.$t("page.create")))]
                  )
                : _vm._e()
            ],
            1
          )
        ],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3023b0be", module.exports)
  }
}

/***/ })

});