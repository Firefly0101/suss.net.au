!function(e){function t(t){for(var n,i,c=t[0],u=t[1],l=t[2],g=0,p=[];g<c.length;g++)i=c[g],Object.prototype.hasOwnProperty.call(o,i)&&o[i]&&p.push(o[i][0]),o[i]=0;for(n in u)Object.prototype.hasOwnProperty.call(u,n)&&(e[n]=u[n]);for(s&&s(t);p.length;)p.shift()();return a.push.apply(a,l||[]),r()}function r(){for(var e,t=0;t<a.length;t++){for(var r=a[t],n=!0,i=1;i<r.length;i++){var c=r[i];0!==o[c]&&(n=!1)}n&&(a.splice(t--,1),e=__webpack_require__(__webpack_require__.s=r[0]))}return e}var n={},o={20:0},a=[];function __webpack_require__(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,__webpack_require__),r.l=!0,r.exports}__webpack_require__.m=e,__webpack_require__.c=n,__webpack_require__.d=function(e,t,r){__webpack_require__.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},__webpack_require__.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},__webpack_require__.t=function(e,t){if(1&t&&(e=__webpack_require__(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(__webpack_require__.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)__webpack_require__.d(r,n,function(t){return e[t]}.bind(null,n));return r},__webpack_require__.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return __webpack_require__.d(t,"a",t),t},__webpack_require__.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},__webpack_require__.p="";var i=window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[],c=i.push.bind(i);i.push=t,i=i.slice();for(var u=0;u<i.length;u++)t(i[u]);var s=c;a.push([608,0]),r()}({106:function(e,t,r){"use strict";(function(e){r.d(t,"a",(function(){return a}));var n=r(40),o=r(29),a=function(t,r,a){var i=Object(o.c)(t,r,a);Object(o.d)(),Object.keys(e._googlesitekitLegacyData.admin.datacache).forEach((function(t){0!==t.indexOf(i+"::")&&t!==i||delete e._googlesitekitLegacyData.admin.datacache[t]})),Object.keys(Object(n.a)()).forEach((function(e){0!==e.indexOf("googlesitekit_".concat(i,"::"))&&e!=="googlesitekit_".concat(i)||Object(n.a)().removeItem(e)}))}}).call(this,r(16))},15:function(e,t){e.exports=googlesitekit.data},202:function(e,t){e.exports=googlesitekit.modules},29:function(e,t,r){"use strict";(function(e){r.d(t,"d",(function(){return u})),r.d(t,"e",(function(){return s})),r.d(t,"b",(function(){return l})),r.d(t,"a",(function(){return g})),r.d(t,"c",(function(){return p}));var n=r(33),o=r.n(n),a=r(12),i=r(40),c=r(56),u=function(){e._googlesitekitLegacyData.admin=e._googlesitekitLegacyData.admin||{},"string"==typeof e._googlesitekitLegacyData.admin.datacache&&(e._googlesitekitLegacyData.admin.datacache=JSON.parse(e._googlesitekitLegacyData.admin.datacache)),"object"!==o()(e._googlesitekitLegacyData.admin.datacache)&&(e._googlesitekitLegacyData.admin.datacache={})},s=function(t,r){if(void 0!==r&&(!r||"object"!==o()(r)||!r.error&&!r.errors)){u(),e._googlesitekitLegacyData.admin.datacache[t]=Object(a.cloneDeep)(r);var n={value:r,date:Date.now()/1e3};Object(i.a)().setItem("googlesitekit_"+t,JSON.stringify(n))}},l=function(t,r){if(!e._googlesitekitLegacyData.admin.nojscache){if(u(),void 0!==e._googlesitekitLegacyData.admin.datacache[t])return e._googlesitekitLegacyData.admin.datacache[t];var n=JSON.parse(Object(i.a)().getItem("googlesitekit_"+t));return n&&"object"===o()(n)&&n.date&&(!r||Date.now()/1e3-n.date<r)?(e._googlesitekitLegacyData.admin.datacache[t]=Object(a.cloneDeep)(n.value),Object(a.cloneDeep)(e._googlesitekitLegacyData.admin.datacache[t])):void 0}},g=function(t){u(),delete e._googlesitekitLegacyData.admin.datacache[t],Object(i.a)().removeItem("googlesitekit_"+t)},p=function(e,t,r){for(var n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,a=[],i=[e,t,r],u=0,s=i;u<s.length;u++){var l=s[u];if(!l||!l.length)break;a.push(l)}return 3===a.length&&n&&"object"===o()(n)&&Object.keys(n).length&&a.push(Object(c.a)(n)),a.join("::")}}).call(this,r(16))},40:function(e,t,r){"use strict";(function(e){r.d(t,"a",(function(){return l}));var n,o=r(5),a=r.n(o),i=r(6),c=r.n(i),u=function(t){var r=e[t];if(!r)return!1;try{var n="__storage_test__";return r.setItem(n,n),r.removeItem(n),!0}catch(e){return e instanceof DOMException&&(22===e.code||1014===e.code||"QuotaExceededError"===e.name||"NS_ERROR_DOM_QUOTA_REACHED"===e.name)&&0!==r.length}},s=function(){function NullStorage(){a()(this,NullStorage)}return c()(NullStorage,[{key:"key",value:function(){return null}},{key:"getItem",value:function(){return null}},{key:"setItem",value:function(){}},{key:"removeItem",value:function(){}},{key:"clear",value:function(){}},{key:"length",get:function(){return 0}}]),NullStorage}(),l=function(){return n||(n=u("sessionStorage")?e.sessionStorage:u("localStorage")?e.localStorage:new s),n}}).call(this,r(16))},42:function(e,t){e.exports=googlesitekit.api},56:function(e,t,r){"use strict";r.d(t,"a",(function(){return c}));var n=r(33),o=r.n(n),a=r(105),i=r.n(a),c=function(e){return i()(JSON.stringify(function e(t){var r={};Object.keys(t).sort().forEach((function(n){var a=t[n];a&&"object"===o()(a)&&!Array.isArray(a)&&(a=e(a)),r[n]=a}));return r}(e)))}},608:function(e,t,r){"use strict";r.r(t);var n=r(11),o=r.n(n),a=r(49),i=r.n(a),c=r(15),u=r.n(c),s=r(202),l=r.n(s),g="modules/optimize",p=r(4),f=r.n(p),_=r(42),b=r.n(_),d=r(71),y=r(106);function O(e,t){var r=Object.keys(e);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(e)),t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r}function m(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?O(r,!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):O(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var h=u.a.createRegistrySelector,v=u.a.createRegistryControl,S={INITIAL_STATE:{isDoingSubmitChanges:!1},actions:{submitChanges:f.a.mark((function e(){var t;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,{payload:{},type:"START_SUBMIT_CHANGES"};case 2:return e.next=4,{payload:{},type:"SUBMIT_CHANGES"};case 4:return t=e.sent,e.next=7,{payload:{},type:"FINISH_SUBMIT_CHANGES"};case 7:return e.abrupt("return",t);case 8:case"end":return e.stop()}}),e)}))},controls:o()({},"SUBMIT_CHANGES",v((function(e){return function(){var t,r;return f.a.async((function(n){for(;;)switch(n.prev=n.next){case 0:if(!e.select(g).haveSettingsChanged()){n.next=7;break}return n.next=3,f.a.awrap(e.dispatch(g).saveSettings());case 3:if(t=n.sent,!(r=t.error)){n.next=7;break}return n.abrupt("return",{error:r});case 7:return n.next=9,f.a.awrap(b.a.invalidateCache("modules","optimize"));case 9:return Object(y.a)(d.b,"optimize"),n.abrupt("return",{});case 11:case"end":return n.stop()}}))}}))),reducer:function(e,t){switch(t.type){case"START_SUBMIT_CHANGES":return m({},e,{isDoingSubmitChanges:!0});case"FINISH_SUBMIT_CHANGES":return m({},e,{isDoingSubmitChanges:!1});default:return e}},resolvers:{},selectors:{canSubmitChanges:h((function(e){return function(){var t=e(g),r=t.getOptimizeID,n=t.getAMPExperimentJSON,o=t.haveSettingsChanged;if((0,t.isDoingSubmitChanges)())return!1;if(!o())return!1;var a=n();if(""!==a&&!function(e){return"string"==typeof e}(a))return!1;var i=r();return!(""!==i&&!function(e){return"string"==typeof e&&!!e.match(/^OPT-[A-Z0-9]+$/)}(i))}})),isDoingSubmitChanges:function(e){return!!e.isDoingSubmitChanges}}};function k(e,t){var r=Object.keys(e);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(e)),t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r}function j(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?k(r,!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):k(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var w={INITIAL_STATE:{error:void 0},actions:{receiveError:function(e){return{type:"RECEIVE_ERROR",payload:{error:e}}}},controls:{},reducer:function(e,t){var r=t.type,n=t.payload;return"RECEIVE_ERROR"===r?j({},e,{error:n.error}):j({},e)},resolvers:{},selectors:{getError:function(e){return e.error}}};function D(e,t){var r=Object.keys(e);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(e)),t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r}function E(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?D(r,!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):D(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var P,x,I,N,A,C,T,L,q=l.a.createModuleStore("optimize",{storeName:g,settingSlugs:["ampExperimentJSON","optimizeID"]});x=(P=q).actions,I=P.selectors,N=i()(P,["actions","selectors"]),A=x.setAmpExperimentJSON,C=i()(x,["setAmpExperimentJSON"]),T=I.getAmpExperimentJSON,L=i()(I,["getAmpExperimentJSON"]),q=E({},N,{actions:E({},C,{setAMPExperimentJSON:A}),selectors:E({},L,{getAMPExperimentJSON:T})});var M=u.a.combineStores(q,S,w);u.a.registerStore(g,M)},71:function(e,t,r){"use strict";r.d(t,"a",(function(){return n})),r.d(t,"b",(function(){return o}));var n="core",o="modules"}});