<<<<<<< HEAD
<<<<<<< HEAD
/*! yuncms v1.0.0 | by yunalading Team | http://www.yunalading.com | (c) 2017 HTTGO, Inc. |  | 2017-03-08"A"09:03:40 UTC */ 
=======
/*! yuncms v1.0.0 | by yunalading Team | http://www.yunalading.com | (c) 2017 HTTGO, Inc. |  | 2017-03-07"A"07:03:21 UTC */ 
>>>>>>> upstream/develop
=======
/*! yuncms v1.0.0 | by yunalading Team | http://www.yunalading.com | (c) 2017 HTTGO, Inc. |  | 2017-03-09"A"08:03:05 UTC */ 
>>>>>>> upstream/develop
(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function (global){
'use strict';
var $ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
var timer = 10;
function forwardTimer() {
    if (timer > 0) {
        $('#system-message').find('#wait').html(timer);
        timer--;
        setTimeout(forwardTimer, 1000);
    } else {
        location.href = $('#system-message').find('#href').attr('href');
    }
}
$(function () {
    if ($('#system-message').find('#wait').length > 0) {
        timer = parseInt($('#system-message').find('#wait').html());
        forwardTimer();
    }
});

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}],2:[function(require,module,exports){
'use strict';
require('./mode');
require('../../common/js/jump-message');
},{"../../common/js/jump-message":1,"./mode":3}],3:[function(require,module,exports){
(function (global){
'use strict';
$ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
$(function () {
    $('.mode-item').click(function () {
        $('.mode-item').removeClass('am-active');
        $(this).addClass('am-active');
<<<<<<< HEAD
        // var cookie = $.AMUI.utils.cookie;
        // cookie.set('install-mdoe', $(this).data('mode'));
=======
        $.AMUI.utils.cookie.set('install-mode', $(this).data('mode'));
>>>>>>> upstream/develop
    })
});

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[2])