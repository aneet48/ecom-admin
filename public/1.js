(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{89:function(e,t,a){"use strict";a.r(t);var n={data:function(){return{search:"",timeout:""}},watch:{search:function(e){clearTimeout(this.timeout);var t=this;this.timeout=setTimeout((function(){t.handleSearch(e)}),1e3)}},methods:{handleSearch:function(e){this.$emit("handleSearch",e)}}},c=a(0),s=Object(c.a)(n,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("v-text-field",{staticClass:"page-searchbar",attrs:{"hide-details":"",placeholder:"Type your search here..","append-icon":"search","single-line":""},model:{value:e.search,callback:function(t){e.search=t},expression:"search"}})}),[],!1,null,null,null);t.default=s.exports}}]);