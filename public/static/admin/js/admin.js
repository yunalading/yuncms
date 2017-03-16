/*! yuncms v1.0.0 | by yunalading Team | http://www.yunalading.com | (c) 2017 HTTGO, Inc. |  | 2017-03-16"A"06:03:24 UTC */ 
(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';
require('../../common/js/jump-message');
require('../../common/js/captcha');
require('./manager-box');
require('./role-check-box');

},{"../../common/js/captcha":4,"../../common/js/jump-message":5,"./manager-box":2,"./role-check-box":3}],2:[function(require,module,exports){
(function (global){
'use strict';
var $ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
$(function () {
    $('.manager-box').css('height',$('body').height()-52);
    $('#context-page').css('height',$('body').height()-105);
});

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}],3:[function(require,module,exports){
(function (global){
'use strict';
var $ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
$(function () {
    $('.am-panel-bd .am-ucheck-checkbox').change(function () {
        if ($(this).is(':checked')) {
            //向上添加
            $(this).parents('.am-panel').find('.am-panel-hd .am-ucheck-checkbox').uCheck('check');
            $(this).parents('.node-1').find('.node-1-title .am-ucheck-checkbox').uCheck('check');
            $(this).parents('.node-2').find('.node-2-title .am-ucheck-checkbox').uCheck('check');
        } else {
            //向下取消
            if ($(this).parent('label').is('.node-1-title')) {
                $(this).parents('.node-1').find('.node-2 .am-ucheck-checkbox').uCheck('uncheck');
            }
            if ($(this).parent('label').is('.node-2-title')) {
                $(this).parents('.node-2').find('div .am-ucheck-checkbox').uCheck('uncheck');
            }
        }
    });
    $('.am-panel-hd .am-ucheck-checkbox').change(function () {
        if (!$(this).is(':checked')) {
            $(this).parents('.am-panel').find('.am-panel-bd .am-ucheck-checkbox').uCheck('uncheck');
        }
    });
});

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}],4:[function(require,module,exports){
(function (global){
'use strict';
var $ = (typeof window !== "undefined" ? window['jQuery'] : typeof global !== "undefined" ? global['jQuery'] : null);
$(function () {
    $('#captcha').click(function () {
       $(this).attr('src',$(this).attr('src'));
    });
});

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}],5:[function(require,module,exports){
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
},{}]},{},[1])