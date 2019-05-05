webpackJsonp([28],{

/***/ 177:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(388)
/* template */
var __vue_template__ = __webpack_require__(389)
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
Component.options.__file = "resources/js/dashboard/modules/article/Article.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-ac90f7a8", Component.options)
  } else {
    hotAPI.reload("data-v-ac90f7a8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 388:
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
        name: 'title',
        trans: 'table.title',
        sortField: 'title'
      }, {
        name: 'subtitle',
        trans: 'table.subtitle',
        sortField: 'subtitle'
      }, {
        name: 'published_at',
        trans: 'table.published_at',
        titleClass: 'width-10-percent',
        sortField: 'created_at'
      }, {
        name: '__actions',
        trans: 'table.action',
        titleClass: 'text-center',
        dataClass: 'text-center'
      }],
      itemActions: [{ name: 'view-item', icon: 'fas fa-eye', class: 'btn btn-success' }, { name: 'edit-item', permission: 'UPDATE_ARTICLE', icon: 'fas fa-pencil-alt', class: 'btn btn-info' }, { name: 'delete-item', permission: 'DESTROY_ARTICLE', icon: 'fas fa-trash-alt', class: 'btn btn-danger' }]
    };
  },

  methods: {
    tableActions: function tableActions(action, data) {
      var _this = this;

      if (action == 'edit-item') {
        this.$router.push({ name: 'dashboard.article.edit', params: { id: data.id } });
      } else if (action == 'delete-item') {
        this.$http.delete('article/' + data.id).then(function (response) {
          toastr.success('You delete the article success!');

          _this.$emit('reload');
        }).catch(function (_ref) {
          var response = _ref.response;

          if (typeof response.data.error !== 'string' && response.data.error) {
            toastr.error(response.data.error.message);
          } else {
            toastr.error(response.status + ' : Resource ' + response.statusText);
          }
        });
      } else if (action == 'view-item') {
        window.open('/' + data.slug, '_blank');
      }
    }
  }
};

/***/ }),

/***/ 389:
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
            title: _vm.$t("page.articles"),
            fields: _vm.fields,
            "api-url": "article",
            "item-actions": _vm.itemActions,
            "show-paginate": ""
          },
          on: { "table-action": _vm.tableActions }
        },
        [
          _c(
            "template",
            { slot: "buttons" },
            [
              _vm.checkPermission("CREATE_ARTICLE")
                ? _c(
                    "router-link",
                    {
                      staticClass: "btn btn-sm btn-success",
                      attrs: { to: { name: "dashboard.article.create" } }
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
    require("vue-hot-reload-api")      .rerender("data-v-ac90f7a8", module.exports)
  }
}

/***/ })

});