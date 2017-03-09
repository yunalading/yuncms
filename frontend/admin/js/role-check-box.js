'use strict';
var $ = require('jquery');
$(function () {
    $('.role-check-access .am-panel-hd').find('.am-ucheck-checkbox').change(function () {
        $(this).parents('.role-nav').find('.am-panel-bd .am-ucheck-checkbox').uCheck('check');
    });
    $('.role-check-access .menu-title').find('.am-ucheck-checkbox').change(function () {
        //todo 子选择没做
    });
});
