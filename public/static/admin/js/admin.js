/*! yuncms v1.0.0 | by yunalading Team | http://www.yunalading.com | (c) 2017 HTTGO, Inc. |  | 2017-02-15"A"08:02:45 UTC */ 
(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function (global){
'use strict';
var $ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
require('../../common/js/captcha');

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{"../../common/js/captcha":2}],2:[function(require,module,exports){
(function (global){
'use strict';
var $ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
$(function () {
    $('#captcha').click(function () {
       $(this).attr('src',$(this).attr('src'));
    });
});

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[1])