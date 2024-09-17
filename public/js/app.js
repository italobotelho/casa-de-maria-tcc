// app.js

$(document).ready(function() {
    $('.open-popup').on('click', function() {
        $('.popup-container').fadeIn();
    });

    $('.close-popup').on('click', function() {
        $('.popup-container').fadeOut();
    });
});