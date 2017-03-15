'use strict';
var $ = require('jquery');
$(function () {
    $('#captcha').click(function () {
       $(this).attr('src',$(this).attr('src'));
    });
});
