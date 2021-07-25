(function ($) {

	'use strict';

    $('.add-cashier-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
    	var button = $('.add-cashier-button');
    	var spinner = $('.add-cashier-spinner');
    	var message = $('.add-cashier-message');
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
            if (response.status === 0 && response.field === 'firstname') {
                handleButton(button, spinner);
                handleErrors($('.firstname'), $('.firstname-error'), response.info);

            } else if (response.status === 0 && response.field === 'lastname') {
                handleButton(button, spinner);
                handleErrors($('.lastname'), $('.lastname-error'), response.info);

            } else if (response.status === 0 && response.field === 'email') {
                handleButton(button, spinner);
                handleErrors($('.email'), $('.email-error'), response.info);

            } else if (response.status === 0 && response.field === 'phone') {
                handleButton(button, spinner);
                handleErrors($('.phone'), $('.phone-error'), response.info);

            } else if (response.status === 1) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-danger').addClass('alert-success');
                message.html(response.info).fadeIn();
                window.location.reload();

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

    $('.edit-cashier-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
        var button = $('.edit-cashier-button');
        var spinner = $('.edit-cashier-spinner');
        var message = $('.edit-cashier-message');
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
            if (response.status === 0 && response.field === 'name') {
                handleButton(button, spinner);
                handleErrors($('.name'), $('.name-error'), response.info);

            } else if (response.status === 1) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-danger').addClass('alert-success');
                message.html(response.info).fadeIn();
                window.location.reload();

            } else if (response.status === 0 && response.field === undefined) {
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

    $('.delete-cashier').on('click', function() {
        var caller = $(this);
        if(confirm('Are You Sure To Delete?')) {
            var request = $.ajax({
                method: 'post',
                url: caller.attr('data-url'),
                processData: false,
                contentType: false
            });

            request.done(function(response) {
                if (response.status === 1) {
                    alert(response.info);
                    window.location.reload();
                } else if (response.status === 0) {
                    alert(response.info);
                }
            });

            request.fail(function() {
                alert('Network Error. Try Again.');
            });
        }
    });

})(jQuery);
