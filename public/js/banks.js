(function ($) {

	'use strict';

    $('.add-bank-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
    	var button = $('.add-bank-button');
    	var spinner = $('.add-bank-spinner');
    	var message = $('.add-bank-message');
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
            if (response.status === 0 && response.field === 'fullname') {
                handleButton(button, spinner);
                handleErrors($('.fullname'), $('.fullname-error'), response.info);

            }else if (response.status === 0 && response.field === 'shortname') {
                handleButton(button, spinner);
                handleErrors($('.shortname'), $('.shortname-error'), response.info);

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

    $('.edit-bank-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
        var button = $('.edit-bank-button');
        var spinner = $('.edit-bank-spinner');
        var message = $('.edit-bank-message');
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
            if (response.status === 0 && response.field === 'fullname') {
                handleButton(button, spinner);
                handleErrors($('.fullname'), $('.fullname-error'), response.info);

            }else if (response.status === 0 && response.field === 'shortname') {
                handleButton(button, spinner);
                handleErrors($('.shortname'), $('.shortname-error'), response.info);

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

    $('.delete-bank').on('click', function() {
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
