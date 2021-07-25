(function ($) {

	'use strict';

    $('.add-article-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
    	var button = $('.add-article-button');
    	var spinner = $('.add-article-spinner');
    	var message = $('.add-article-message');
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
            if (response.status === 0 && response.field === 'title') {
                handleButton(button, spinner);
                handleErrors($('.title'), $('.title-error'), response.info);

            }else if (response.status === 0 && response.field === 'category') {
                handleButton(button, spinner);
                handleErrors($('.category'), $('.category-error'), response.info);

            }else if (response.status === 0 && response.field === 'author') {
                handleButton(button, spinner);
                handleErrors($('.author'), $('.author-error'), response.info);

            }else if (response.status === 0 && response.field === 'status') {
                handleButton(button, spinner);
                handleErrors($('.status'), $('.status-error'), response.info);

            }else if (response.status === 0 && response.field === 'content') {
                handleButton(button, spinner);
                handleErrors($('.content'), $('.content-error'), response.info);

            } else if (response.status === 1) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-danger').addClass('alert-success');
                message.html(response.info).fadeIn();
                window.location.href = response.redirect;

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

    $('.edit-article-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
        var button = $('.edit-article-button');
        var spinner = $('.edit-article-spinner');
        var message = $('.edit-article-message');
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
            if (response.status === 0 && response.field === 'title') {
                handleButton(button, spinner);
                handleErrors($('.title'), $('.title-error'), response.info);

            }else if (response.status === 0 && response.field === 'category') {
                handleButton(button, spinner);
                handleErrors($('.category'), $('.category-error'), response.info);

            }else if (response.status === 0 && response.field === 'author') {
                handleButton(button, spinner);
                handleErrors($('.author'), $('.author-error'), response.info);

            }else if (response.status === 0 && response.field === 'status') {
                handleButton(button, spinner);
                handleErrors($('.status'), $('.status-error'), response.info);

            }else if (response.status === 0 && response.field === 'content') {
                handleButton(button, spinner);
                handleErrors($('.content'), $('.content-error'), response.info);

            } else if (response.status === 1) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-danger').addClass('alert-success');
                message.html(response.info).fadeIn();
                window.location.href = response.redirect;

            } else if (response.status === 0 && response.field === undefined) {
                handleButton(button, spinner);
                message.removeClass('d-none alert-success').addClass('alert-danger');
                message.html(response.info).fadeIn();

            } else {
                handleButton(button, spinner);
                message.html(response.info).fadeIn();
            }
        });

        request.fail(function() {
            handleButton(button, spinner);
            message.html('Network Error. Try Again').fadeIn();
        });
    });

    $('.delete-article').on('click', function() {
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
