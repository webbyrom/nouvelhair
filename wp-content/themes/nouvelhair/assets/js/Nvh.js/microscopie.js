/********
 *  Animation des photos en dessous de l'explication de la microscopie capillaire 
 */
(function($) {
    const $imgDescp = $('.Nvh-cpaillaire-2img');
    const initialDelay = 500; // Délai initial en millisecondes

    function isElementInViewport(el) {
        const rect = el[0].getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= $(window).height() &&
            rect.right <= $(window).width()
        );
    }

    function checkVisibility() {
        if (isElementInViewport($imgDescp) && !$imgDescp.hasClass('Nvh-anime-img')) {
            setTimeout(function() {
                $imgDescp.addClass('Nvh-anime-img');
            }, initialDelay);
        }
    }

    // Gestionnaire d'événements de défilement
    $(window).on('scroll', function() {
        checkVisibility();
    });

    // Appel initial pour vérifier la visibilité de l'élément au chargement de la page
    checkVisibility();
})(jQuery);






jQuery(document).ready(function($) {
    var columnA = $('.Nvh-cure-home-title, .Nvh-homet-cure, .Nvh-total-cure-home');// mise en varaible des éléments de la colonne A
    var columnB = $('.Nvh-cure-salon-title, .Nvh-cure-salont, .Nvh-total-cure-salon');// mise en varaible des éléments de la colonne B

    function checkVisibility(column) {
        column.each(function(index) {
            var element = $(this);
            var elementPosition = element.offset().top;
            var screenPosition = $(window).scrollTop() + $(window).height() / 1.3;

            if (elementPosition < screenPosition && !element.hasClass('Nvh-visible')) {
                setTimeout(function() {
                    element.addClass('Nvh-visible').animate({ opacity: 1 }, 500);
                }, index * 500);
            }
        });
    }

    function scrollHandler() {
        checkVisibility(columnA);
        checkVisibility(columnB);
    }

    // Gestionnaire d'événements de défilement
    $(window).scroll(scrollHandler);

    // Appel initial pour vérifier la visibilité des éléments au chargement de la page
    checkVisibility(columnA);
    checkVisibility(columnB);
});

