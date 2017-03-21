'use strict';
var $ = require('jquery');
$(function () {
    $('.checkbox-switch').bootstrapSwitch({
        size: 'xs',
        onText: "启用",
        offText: "停用"
    });
});
