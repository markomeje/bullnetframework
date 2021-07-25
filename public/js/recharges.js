(function ($) {

	'use strict';

    $('.add-recharge-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
    	var button = $('.add-recharge-button');
    	var spinner = $('.add-recharge-spinner');
    	var message = $('.add-recharge-message');
        button.attr('disabled', true);
        spinner.removeClass('d-none');
        message.hasClass('d-none') ? '' : message.fadeOut();

        var request = $.ajax({
            method: form.attr('method'),
            url: form.attr('data-action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json'
        });

        request.done(function(response){
            if (response.status === 0 && response.field === 'product') {
                handleButton(button, spinner);
                handleErrors($('.product'), $('.product-error'), response.info);

            }else if (response.status === 0 && response.field === 'machine') {
                handleButton(button, spinner);
                handleErrors($('.machine'), $('.machine-error'), response.info);

            }else if (response.status === 0 && response.field === 'amount') {
                handleButton(button, spinner);
                handleErrors($('.amount'), $('.amount-error'), response.info);

            } else if (response.status === 1) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-danger').addClass('alert-success');
                message.html(response.info).fadeIn();
                // window.location.reload();

            } else if (response.status === 0) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-success').addClass('alert-danger');
                message.html(response.info).fadeIn();

            } else {
                handleButton(button, spinner);
                alert('Network Error. Try Again');
            }
        });

        request.fail(function() {
            handleButton(button, spinner);
            alert('Network Error. Try Again');
        });
    });

})(jQuery);
