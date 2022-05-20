// Send Message
(function ($) {
    'use strict';

    var form = $('#contact-form'),
        message = $('#form-alert'),
        form_data;

    // Success function
    function done_func(response) {
        message.fadeIn().removeClass('alert-fails').addClass('alert-success');
        message.text(response);
        setTimeout(function () {
            message.fadeOut();
        }, 5000);
        form.find('input:not([type="submit"]), textarea').val('');
    }

    // fail function
    function fail_func(data) {
        message.fadeIn().removeClass('alert-success').addClass('alert-fails');
        message.text(data.responseText);
        setTimeout(function () {
            message.fadeOut();
        }, 5000);
    }
    form.submit(function (e) {
        e.preventDefault();
        form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form_data
        })
        .done(done_func)
        .fail(fail_func);
    });
})(jQuery);