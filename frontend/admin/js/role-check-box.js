'use strict';
var $ = require('jquery');
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
