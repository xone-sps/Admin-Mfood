(function(t){function e(e){for(var n,s,i=e[0],c=e[1],u=e[2],l=0,d=[];l<i.length;l++)s=i[l],Object.prototype.hasOwnProperty.call(o,s)&&o[s]&&d.push(o[s][0]),o[s]=0;for(n in c)Object.prototype.hasOwnProperty.call(c,n)&&(t[n]=c[n]);f&&f(e);while(d.length)d.shift()();return r.push.apply(r,u||[]),a()}function a(){for(var t,e=0;e<r.length;e++){for(var a=r[e],n=!0,s=1;s<a.length;s++){var i=a[s];0!==o[i]&&(n=!1)}n&&(r.splice(e--,1),t=c(c.s=a[0]))}return t}var n={},s={app:0},o={app:0},r=[];function i(t){return c.p+"js/"+({about:"about"}[t]||t)+"."+{about:"f4f85292"}[t]+".js"}function c(e){if(n[e])return n[e].exports;var a=n[e]={i:e,l:!1,exports:{}};return t[e].call(a.exports,a,a.exports,c),a.l=!0,a.exports}c.e=function(t){var e=[],a={about:1};s[t]?e.push(s[t]):0!==s[t]&&a[t]&&e.push(s[t]=new Promise((function(e,a){for(var n="css/"+({about:"about"}[t]||t)+"."+{about:"ed047252"}[t]+".css",o=c.p+n,r=document.getElementsByTagName("link"),i=0;i<r.length;i++){var u=r[i],l=u.getAttribute("data-href")||u.getAttribute("href");if("stylesheet"===u.rel&&(l===n||l===o))return e()}var d=document.getElementsByTagName("style");for(i=0;i<d.length;i++){u=d[i],l=u.getAttribute("data-href");if(l===n||l===o)return e()}var f=document.createElement("link");f.rel="stylesheet",f.type="text/css",f.onload=e,f.onerror=function(e){var n=e&&e.target&&e.target.src||o,r=new Error("Loading CSS chunk "+t+" failed.\n("+n+")");r.code="CSS_CHUNK_LOAD_FAILED",r.request=n,delete s[t],f.parentNode.removeChild(f),a(r)},f.href=o;var m=document.getElementsByTagName("head")[0];m.appendChild(f)})).then((function(){s[t]=0})));var n=o[t];if(0!==n)if(n)e.push(n[2]);else{var r=new Promise((function(e,a){n=o[t]=[e,a]}));e.push(n[2]=r);var u,l=document.createElement("script");l.charset="utf-8",l.timeout=120,c.nc&&l.setAttribute("nonce",c.nc),l.src=i(t);var d=new Error;u=function(e){l.onerror=l.onload=null,clearTimeout(f);var a=o[t];if(0!==a){if(a){var n=e&&("load"===e.type?"missing":e.type),s=e&&e.target&&e.target.src;d.message="Loading chunk "+t+" failed.\n("+n+": "+s+")",d.name="ChunkLoadError",d.type=n,d.request=s,a[1](d)}o[t]=void 0}};var f=setTimeout((function(){u({type:"timeout",target:l})}),12e4);l.onerror=l.onload=u,document.head.appendChild(l)}return Promise.all(e)},c.m=t,c.c=n,c.d=function(t,e,a){c.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},c.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},c.t=function(t,e){if(1&e&&(t=c(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(c.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)c.d(a,n,function(e){return t[e]}.bind(null,n));return a},c.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return c.d(e,"a",e),e},c.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},c.p="/generated/restaurant/",c.oe=function(t){throw console.error(t),t};var u=window["webpackJsonp"]=window["webpackJsonp"]||[],l=u.push.bind(u);u.push=e,u=u.slice();for(var d=0;d<u.length;d++)e(u[d]);var f=l;r.push([0,"chunk-vendors"]),a()})({0:function(t,e,a){t.exports=a("56d7")},"002a":function(t,e,a){},"37ee":function(t,e,a){"use strict";var n=a("8ba3"),s=a.n(n);s.a},"54d8":function(t,e,a){},"56d7":function(t,e,a){"use strict";a.r(e);a("e260"),a("e6cf"),a("cca6"),a("a79d");var n=a("2b0e"),s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"app"}},[t.$route.meta.hide_navbar?t._e():a("Navbars"),a("router-view")],1)},o=[],r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"div"},[a("nav",{staticClass:"navbar",attrs:{role:"navigation","aria-label":"main navigation"}},[a("div",{staticClass:"container"},[a("div",{staticClass:"navbar-brand"},[a("a",{staticClass:"navbar-burger burger",attrs:{role:"button","aria-label":"menu","aria-expanded":"false","data-target":"navbarBasicExample"},on:{click:function(e){t.showSidebar=!0}}},[a("span",{attrs:{"aria-hidden":"true"}}),a("span",{attrs:{"aria-hidden":"true"}}),a("span",{attrs:{"aria-hidden":"true"}})])]),a("div",{staticClass:"navbar-menu",attrs:{id:"navbarBasicExample"}},[a("div",{staticClass:"navbar-start"},[a("div",{staticClass:"tabs is-centered"},[a("ul",[a("li",{class:{"is-active":"list_order"==t.$route.query.tab},on:{click:function(e){return t.Listorders()}}},[a("a",[t._v("ລາຍການສັ່ງອາຫານ (12)")])]),a("li",{class:{"is-active":"tab_manage"==t.$route.query.tab},on:{click:function(e){return t.TabManage()}}},[a("a",[t._v("ຈັດການຂໍ້ມູນຫຼັກ")])])])])])]),a("div",{staticClass:"navbar-end box-profiles"},[a("div",{staticClass:"navbar-item user"},[a("img",{directives:[{name:"click-outside",rawName:"v-click-outside",value:function(){t.showDropdown=!1},expression:"() => { showDropdown = false }"}],staticClass:"user-image",attrs:{src:"https://www.billiardport.com/assets/pages/media/profile/profile_user.jpg"},on:{click:function(e){t.showDropdown=!t.showDropdown}}}),t.showDropdown?a("div",{staticClass:"dropdown-containers"},[t._m(0),t._m(1),a("hr",{staticClass:"lines"}),a("div",{staticClass:"dropdown-item",staticStyle:{"margin-top":"10px"},on:{click:function(e){return t.SignOut()}}},[a("i",{staticClass:"fal fa-sign-out-alt icon-logout"}),a("span",[t._v("ອອກຈາກລະບົບ")])])]):t._e()])])])]),a("transition",{attrs:{name:"slide-right"}},[t.showSidebar?a("sidebar",{on:{closed:function(){t.showSidebar=!1}}}):t._e()],1)],1)},i=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"dropdown-item"},[a("i",{staticClass:"fal fa-address-card icon-event"}),a("span",[t._v("ໂປຮໄຟລຂອງຂ້ອຍ")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"dropdown-item"},[a("i",{staticClass:"fal fa-user-tag icon-event"}),a("span",[t._v("ລາຍການສັ່ງທັງໝົດ")])])}],c=a("5530"),u=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("nav",{staticClass:"sidebar-menu"},[a("p",{staticClass:"sidebar-close",on:{click:t.closeModal}},[a("i",{staticClass:"fal fa-times-circle"})]),a("div",{staticClass:"sidebar-profile"},[a("img",{staticClass:"profile",attrs:{src:"https://www.billiardport.com/assets/pages/media/profile/profile_user.jpg"}}),a("div",{staticClass:"sidebar-info"},[a("div",{staticClass:"box-btn-profile",staticStyle:{"margin-top":"20px","margin-left":"25px"}},[a("button",{staticClass:"button",on:{click:function(e){return t.ToMyProfle("seeker")}}},[a("i",{staticClass:"fal fa-user-alt"}),t._v(" ໂປຮໄຟລຂອງຂ້ອຍ ")])])])]),t._m(0),a("div",{staticClass:"sidebar-list-menu"},[a("ul",[a("li",{on:{click:function(e){return t.Goto_Router("home")}}},[a("i",{staticClass:"fal fa-home-lg"}),a("span",[t._v("ໜ້າຫຼັກ")])]),a("li",{on:{click:function(e){return t.Goto_Router("about")}}},[a("i",{staticClass:"fal fa-info-circle"}),a("span",[t._v("ຈັດການຂໍ້ມູນຫຼັກ")])]),a("li",{on:{click:function(e){return t.Goto_Router("about")}}},[a("i",{staticClass:"fal fa-utensils-alt"}),a("span",[t._v("ລາຍການສັ່ງອາຫານ")])]),a("li",{on:{click:function(e){return t.Goto_Router("about")}}},[a("i",{staticClass:"fal fa-clipboard-list-check"}),a("span",[t._v("ລາຍງານຂໍ້ມູນທັງໝົດ")])]),a("li",{on:{click:function(e){return t.SignOut()}}},[a("i",{staticClass:"fal fa-sign-out-alt"}),a("span",[t._v("ອອກຈາກລະບົບ")])])])])])},l=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("ul",[a("li",{staticClass:"sidebar-line"})])}],d={data:function(){return{item:""}},methods:{closeModal:function(){this.$emit("closed")},Goto_Router:function(t){"home"==t?this.$router.push({name:"home"}):"about"==t?this.$router.push({name:"about"}):"allJob"==t?this.$router.push({name:"all.job"}):"events"==t?this.$router.push({name:"events"}):"employerSignup"==t?this.$router.push({name:"employer.sign.up"}):"seekerSignup"==t?this.$router.push({name:"seeker.sign.up"}):"employer_seekerDetail"==t&&this.$router.push({name:"employer.search.seeker"}),this.closeModal(),localStorage.removeItem("showLive")},SignOut:function(){this.$store.dispatch("destroyToken"),this.closeModal()}},created:function(){this.item=JSON.parse(localStorage.getItem("user_profile"))},computed:{LoggedIn:function(){return this.$store.getters.LoggedIn}}},f=d,m=(a("c761"),a("2877")),p=Object(m["a"])(f,u,l,!1,null,"39c5c6eb",null),h=p.exports,b={components:{Sidebar:h},data:function(){return{showSidebar:!1,showDropdown:!1,user:{}}},watch:{showSidebar:function(t){document.body.style.overflowY=1==t?"hidden":"auto"}},methods:{SignOut:function(){this.$store.dispatch("destroyToken")},Listorders:function(){"list_order"==this.$route.query.tab?this.$router.push({query:Object(c["a"])(Object(c["a"])({},this.$route.query),{},{list:"ordered"})}).catch((function(){})):this.$router.push({name:"tab.list.ordered",query:{tab:"list_order"}}).catch((function(){}))},TabManage:function(){"tab_manage"==this.$route.query.tab?this.$router.push({query:Object(c["a"])(Object(c["a"])({},this.$route.query),{},{tab:"tab_manage"})}).catch((function(){})):this.$router.push({name:"tab.manage",query:{tab:"tab_manage"}}).catch((function(){}))}},created:function(){}},v=b,g=(a("37ee"),Object(m["a"])(v,r,i,!1,null,"a3a6d84c",null)),_=g.exports,w={components:{Navbars:_}},C=w,y=(a("5c0b"),Object(m["a"])(C,s,o,!1,null,null,null)),k=y.exports,S=(a("99af"),a("d3b7"),a("8c4f")),$={auth:{redirect:{Restaurant:"tab.manage",Cashier:"tab.list.ordered"},path:{Restaurant:"/tab-manage",Cashier:"/tab-list-order"}}};n["a"].use(S["a"]);var O=[],x={guestMeta:Object(c["a"])({requiresVisitor:!0,except:O},$.guest),defaultMeta:{navFixed:!0,hideNavFooter:!0},RestaurantAuthMeta:{requiresAuth:!0,allows:O.concat(["Restaurant"]),path:$.auth.path},CashierAuthMeta:{requiresAuth:!0,allows:O.concat(["Cashier","Restaurant"]),path:$.auth.path},KitchenAuthMeta:{requiresAuth:!0,allows:O.concat(["Kitchen"]),path:$.auth.path}},j=[{path:"/about",name:"About",component:function(){return a.e("about").then(a.bind(null,"f820"))}},{path:"/",name:"restaurant.sign.in",component:function(){return a.e("about").then(a.bind(null,"8bd3"))},meta:{hide_navbar:!0}},{path:"/tab-manage",name:"tab.manage",component:function(){return a.e("about").then(a.bind(null,"f460"))},meta:Object(c["a"])({},x.RestaurantAuthMeta)},{path:"/tab-list-order",name:"tab.list.ordered",component:function(){return a.e("about").then(a.bind(null,"d68c"))},meta:Object(c["a"])({},x.CashierAuthMeta)}],A=new S["a"]({mode:"history",routes:j}),E=A,T=a("2f62"),M=a("bc3a"),q=a.n(M);n["a"].use(T["a"]);var P=new T["a"].Store({state:{token:localStorage.getItem("access_token")||null,msg_error_login:"",userProfile:{}},getters:{LoggedIn:function(t){return null!==t.token},getUserType:function(t){var e=window.localStorage.getItem("user_profile");if(e)try{e=JSON.parse(e)}catch(a){e={}}else e={};return t.userProfile.user_type||e.user_type},getToken:function(t){return t.token},isAuth:function(t){return t.token&&null!==t.token}},mutations:{Restaurant_SignIn:function(t,e){t.token=e},destroyToken:function(t){t.token=null},error_msg_login:function(t,e){t.msg_error_login=e},setUserProfile:function(t,e){t.userProfile=e}},actions:{RestaurantSignIn:function(t,e){return new Promise((function(a,n){q.a.post("sign-in",{email:e.email,password:e.password}).then((function(e){if(a(e),1==e.data.success){var n=e.data.access_token;localStorage.setItem("access_token",n),t.commit("Restaurant_SignIn",n),t.commit("setUserProfile",e.data.user),window.localStorage.setItem("user_profile",JSON.stringify(e.data.user)),"Restaurant"==e.data.user.user_type?E.push({name:"tab.manage"}):"Cashier"==e.data.user.user_type&&E.push({name:"tab.list.ordered"}),setTimeout((function(){window.location.reload()}),300)}else t.commit("error_msg_login",e.data.msg),setTimeout((function(){t.commit("error_msg_login","")}),3e3)})).catch((function(e){n(e),(401==e.response.status||400==e.response.status)&&(t.commit("error_msg_login","ອີເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ..."),setTimeout((function(){t.commit("error_msg_login","")}),3e3))}))}))},destroyToken:function(t){if(t.getters.LoggedIn)return new Promise((function(e,a){q.a.defaults.headers.common["Authorization"]="Bearer "+t.state.token,q.a.post("sign-out").then((function(t){e(t)})).catch((function(t){a(t)})).finally((function(a){e(a),localStorage.removeItem("access_token"),t.commit("destroyToken"),E.push({name:"restaurant.sign.in"}).catch((function(){}))}))}))}},modules:{}}),I=a("c28b"),R=a.n(I),L=a("7bb1"),N=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"modal",class:{"is-active":t.active},attrs:{id:"modal"}},[a("div",{staticClass:"modal-background"}),a("div",{staticClass:"modal-content"},[a("div",{staticClass:"columns"},[a("div",{staticClass:"column is-6-desktop is-8-tablet is-offset-4-desktop is-offset-2-tablet is-12-mobile is-offset-0-mobile"},[a("div",{staticClass:"box"},[t._t("default")],2)])])])])])},D=[],B={name:"modalAdd",props:{active:{default:!1}},data:function(){return{}},methods:{}},J=B,U=(a("fbc8"),Object(m["a"])(J,N,D,!1,null,"30ef8354",null)),G=U.exports,F=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"modal",class:{"is-active":t.active},attrs:{id:"modal"}},[a("div",{staticClass:"modal-background"}),a("div",{staticClass:"modal-content"},[a("div",{staticClass:"columns"},[a("div",{staticClass:"column is-6-desktop is-8-tablet is-offset-4-desktop is-offset-2-tablet is-12-mobile is-offset-0-mobile"},[a("div",{staticClass:"box"},[t._t("default")],2)])])])])])},K=[],V={name:"modalAdd",props:{active:{default:!1}},data:function(){return{}},methods:{}},z=V,H=(a("5f7b"),Object(m["a"])(z,F,K,!1,null,"17b46c3f",null)),Y=H.exports,Q=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"modal",class:{"is-active":t.active},attrs:{id:"modal"}},[a("div",{staticClass:"modal-background"}),a("div",{staticClass:"modal-content"},[a("div",{staticClass:"columns"},[a("div",{staticClass:"column is-6-desktop is-8-tablet is-offset-4-desktop is-offset-2-tablet is-12-mobile is-offset-0-mobile"},[a("div",{staticClass:"box"},[t._t("default")],2)])])])])])},W=[],X={name:"modalAdd",props:{active:{default:!1}},data:function(){return{}},methods:{}},Z=X,tt=(a("efc8"),Object(m["a"])(Z,Q,W,!1,null,"d7819e8a",null)),et=tt.exports,at=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"modal",class:{"is-active":t.active},attrs:{id:"modal"}},[a("div",{staticClass:"modal-background"}),a("div",{staticClass:"modal-content"},[a("div",{staticClass:"columns"},[a("div",{staticClass:"column is-6-desktop is-8-tablet is-offset-4-desktop is-offset-2-tablet is-12-mobile is-offset-0-mobile"},[a("div",{staticClass:"box"},[t._t("default")],2)])])])])])},nt=[],st={name:"modalAdd",props:{active:{default:!1}},data:function(){return{}},methods:{}},ot=st,rt=(a("dd44"),Object(m["a"])(ot,at,nt,!1,null,"31373e2d",null)),it=rt.exports;q.a.defaults.baseURL="http://178.128.60.220/api",n["a"].prototype.$axios=q.a;a("caad"),a("45fc"),a("b0c0"),a("ac1f"),a("2532"),a("5319");var ct=function(t,e){return t.resolve({name:e}).resolved.matched.length>0};function ut(t,e,a){t.beforeEach((function(n,s,o){var r=e.getters.getUserType;if(n.matched.some((function(t){return t.meta.requiresAuth})))e.getters.LoggedIn?n.meta.allows&&n.meta.allows.includes(r)?o():window.location.replace(n.meta.path[r]||"/"):ct(t,a.name)?o({name:a.name}):window.location.replace(a.path);else if(n.matched.some((function(t){return t.meta.requiresVisitor})))if(e.getters.LoggedIn){if(n.meta.except&&n.meta.except.includes(r))return void o();var i=n.meta.redirect[r];ct(t,i)?o({name:i}):window.location.replace(n.meta.path[r]||"/")}else o();else o()}))}P.getters.isAuth&&(q.a.defaults.headers.common["Authorization"]="Bearer "+P.getters.getToken),ut(E,P,{name:"home",path:"/"}),n["a"].use(R.a),n["a"].use(L["b"]),n["a"].component("ModalAdd",G),n["a"].component("ModalEdit",Y),n["a"].component("ModalView",et),n["a"].component("modalDelete",it),new n["a"]({router:E,store:P,render:function(t){return t(k)}}).$mount("#app")},"5c0b":function(t,e,a){"use strict";var n=a("9c0c"),s=a.n(n);s.a},"5f7b":function(t,e,a){"use strict";var n=a("ff19"),s=a.n(n);s.a},"64a4":function(t,e,a){},"8ba3":function(t,e,a){},"9c0c":function(t,e,a){},af9b:function(t,e,a){},c761:function(t,e,a){"use strict";var n=a("54d8"),s=a.n(n);s.a},dd44:function(t,e,a){"use strict";var n=a("002a"),s=a.n(n);s.a},efc8:function(t,e,a){"use strict";var n=a("64a4"),s=a.n(n);s.a},fbc8:function(t,e,a){"use strict";var n=a("af9b"),s=a.n(n);s.a},ff19:function(t,e,a){}});
//# sourceMappingURL=app.f57933d2.js.map