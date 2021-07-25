(function($) {

    'use strict';

    $('.hanburger-icon').on('click', function() {
        $('.navbar-menu').toggleClass('navbar-toggle');
        $('.hanburger-icon').toggleClass('slide');
    });

    var backendSidebar = $('.backend-sidebar');
    if (backendSidebar) {
        var backendNavigationMenuCloseIcon = $('.backend-navigation-menu-close-icon');
        var backendNavigationMenuIcon = $('.backend-navigation-menu-icon');
        if (backendNavigationMenuIcon) {
            backendNavigationMenuIcon.on('click', function() {
                backendSidebar.removeClass('d-none').addClass('backend-sidebar-toggle');
            });
        }

        if (backendNavigationMenuCloseIcon) {
            backendNavigationMenuCloseIcon.on('click', function() {
                backendSidebar.removeClass('backend-sidebar-toggle').addClass('d-none');
            });
        }
    }

})(jQuery);

function handleButton(button, spinner) {
    button.attr('disabled', false);
    spinner.addClass('d-none');
}

function handleErrors(input, span, message = '') {
    input.addClass('is-invalid');
    span.html(message);
    input.focus(function() {
        input.removeClass('is-invalid');
        span.html('');
    });
}
