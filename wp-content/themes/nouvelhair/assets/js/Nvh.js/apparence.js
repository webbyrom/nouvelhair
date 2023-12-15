(function ($) {

    wp.customize('header_background', function (value) {
        value.bind(function (newVal) {
            $('.nav').attr('style', 'background:' + newVal + '!important')
        })
    })
})(jQuery)