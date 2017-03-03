'use strict';
var $ = require('jquery');
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
