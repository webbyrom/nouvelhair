jQuery(document).ready(function($) {
    // Sélectionne tous les éléments avec la classe "fade-in" en utilisant jQuery
    const elements = $('.fade-in');
    
    // Crée un tableau pour suivre les éléments qui ont été animés
    const animatedElements = [];
    
    // Variable pour indiquer si une animation est en cours
    let animationInProgress = false;

    // Fonction pour animer le prochain élément dans la file d'attente
    function fadeInNextElement() {
        if (animatedElements.length > 0) {
            // Récupère l'élément suivant dans la file d'attente
            const element = animatedElements.shift();
            
            // Ajoute la classe "fade-in-active" pour déclencher l'animation
            element.addClass('fade-in-active');
            
            // Programme la prochaine animation après un délai de 300 millisecondes
            setTimeout(fadeInNextElement, 300);
        } else {
            // S'il n'y a plus d'éléments à animer, indique que l'animation est terminée
            animationInProgress = false;
        }
    }

    // Crée un observateur d'intersection pour détecter lorsque les éléments deviennent visibles dans la fenêtre
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Récupère l'élément en utilisant jQuery
                const element = $(entry.target);
                
                // Vérifie si l'élément n'a pas déjà été animé et n'est pas déjà dans la file d'attente
                if (!element.hasClass('fade-in-active') && !animatedElements.includes(element)) {
                    // Ajoute l'élément à la file d'attente
                    animatedElements.push(element);
                    
                    // Si aucune animation n'est en cours, démarre la première animation
                    if (!animationInProgress) {
                        animationInProgress = true;
                        fadeInNextElement();
                    }
                }
            }
        });
    });

    // Applique l'observateur d'intersection à tous les éléments de la classe "fade-in"
    elements.each(function() {
        observer.observe(this);
    });
});
