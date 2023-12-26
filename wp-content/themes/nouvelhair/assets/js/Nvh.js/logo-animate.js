/********
 * Animation logo header
 */
(function ($) {
    $(document).ready(function () {
        $(document).scroll(function () {
            if ($(document).scrollTop() > 0) {
                $("#logo_img_header").addClass("Nvh-logo-animate");
            } else {
                $("#logo_img_header").removeClass("Nvh-logo-animate");
            }
        })
    })
})(jQuery)