/*****
 * menu sticky
 */
(function ($) {
    $(document).ready(function () {
        $(document).scroll(function () {
            if ($(document).scrollTop() > 0) {
                $("#Nvh_nav_menu").addClass("sticky");
            } else {
                $("#Nvh_nav_menu").removeClass("sticky");
            }
        })
    })
})(jQuery);



/*****customisation des balises li du sous-menu */

jQuery(document).ready(function ($) {
    // Ciblez spécifiquement les éléments li ayant la classe "menu-item-type-custom" 
    // qui sont des enfants d'ul ayant la classe "sub-menu"
    $('ul.sub-menu li.menu-item-type-custom').addClass('Nvh-submenu-li');

});

jQuery(document).ready(function ($) {
    // Fonction pour mettre à jour l'état du sous-menu actif en fonction des paramètres d'URL
    function updateActiveSubMenu() {
        var urlParams = new URLSearchParams(window.location.search);

        var activeSubMenu = urlParams.get('active_submenu');
        if (activeSubMenu) {
            // Supprimez la classe active de tous les éléments du sous-menu
            $('.Nvh-submenu-li').removeClass('Nvh_m_sub_active');

            // Ajoutez la classe active à l'élément du sous-menu correspondant
            var activeSubMenuLink = $('.Nvh-submenu-li a[href*="active_submenu=' + activeSubMenu + '"]');
            activeSubMenuLink.closest('li').addClass('Nvh_m_sub_active');
        }
    }

    // Appelez la fonction pour mettre à jour l'état du sous-menu actif lorsque la page se charge
    updateActiveSubMenu();

    // Intercepter le clic sur les liens du sous-menu
    $('.Nvh-submenu-li a').on('click', function () {
        var href = $(this).attr('href');
        var activeSubMenu = href.match(/active_submenu=([^&]*)/);

        if (activeSubMenu) {
            // Mettre à jour l'URL sans recharger la page
            history.pushState(null, null, '?' + activeSubMenu[0]);
            // Mettre à jour l'état du sous-menu actif
            updateActiveSubMenu();
        }
    });
});




// scroll top buton

// affichage du bouton retour vers le haut au défilement de la page
window.addEventListener('scroll', function () {
    var button = this.document.getElementById('Nvh_scroll_top_button');
    if (this.window.scrollY > 100) {
        button.style.display = 'block';
    } else {
        button.style.display = 'none';
    }
});
// défiler la page vers le haut au click
document.querySelector('.Nvh-scroll-totop').addEventListener('click', function (e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
(function($) {
    $('#Nvh_icon_responsive').click(function(e) {
        e.preventDefault();
        $('body').toggleClass('top-menu')
    })
}) (jQuery);