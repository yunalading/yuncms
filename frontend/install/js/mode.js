'use strict';
$ = require('jquery');
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
