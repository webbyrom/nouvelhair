(function() {
    tinymce.create('tinymce.plugins.YoutubeButton', {
        init: function(ed, url) {
            ed.addButton('youtube_button', {
                title: 'Insérer une vidéo YouTube',
                cmd: 'cmd_youtube_button',
                image: url + '/youtube-button.png'
            });

            ed.addCommand('cmd_youtube_button', function() {
                // Récupérer les options de la liste déroulante
                var videoOptions = getVideoOptions();
            
                ed.windowManager.open({
                    title: 'Insérer une vidéo YouTube',
                    body: [
                        {
                            type: 'listbox',
                            name: 'video_option',
                            label: 'Sélectionnez une vidéo',
                            values: videoOptions
                        },
                        {
                            type: 'textbox',
                            name: 'video_title',
                            label: 'Titre de la vidéo (facultatif)'
                        }
                    ],
                    onsubmit: function(e) {
                        console.log('Form Data:', e.data);
                        var selectedOption = e.data.video_option;
                        console.log('Selected Option:', selectedOption);
                        var videoId = selectedOption; // Utilise directement selectedOption comme l'ID de la vidéo
                        console.log('Video ID:', videoId);
                        var videoTitle = e.data.video_title;
                        // Générer le shortcode avec les informations saisies.
                        var shortcode = '[youtube_video id="' + videoId + '" title="' + videoTitle + '"]';
                        ed.insertContent(shortcode);
                    }
                    
                    
                    
                });
            });
            
            // Fonction pour récupérer les options de la liste déroulante
            function getVideoOptions() {
                var videoOptions = [];
            
                // Utilisez AJAX pour récupérer les options depuis le serveur
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'GET',
                    data: {
                        action: 'get_enregistred_video_options'
                    },
                    async: false,
                    success: function(response) {
                        console.log('AJAX Response:', response);
            
                        videoOptions = response.map(function(option) {
                            return { text: option.title, value: option.id }; // Assure-toi que le format est correct ici
                        });
                    }
                });
            
                return videoOptions;
            }
        }
    });

    tinymce.PluginManager.add('youtube_button', tinymce.plugins.YoutubeButton);
})();
jQuery(document).ready(function ($) {
    // Attachez un gestionnaire d'événements au lien de suppression
    $('.Nvh-supprimer-video').on('click', function (e) {
        e.preventDefault();
        var videoId = $(this).data('video-id');

        // Affichez une boîte de dialogue de confirmation
        var confirmation = confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?');

        // Si l'utilisateur confirme, redirigez vers la page de suppression
        if (confirmation) {
            window.location.href = '?page=page-admin-videos&action=supprimer_video&video_id=' + videoId;
        }
    });
});