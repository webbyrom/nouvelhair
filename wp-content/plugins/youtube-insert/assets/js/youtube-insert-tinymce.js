(function(){
    tinymce.PluginManager.add('youtube_insert_tinymce_button', function (editor, url){
        editor.addButton('youtube_insert_tinymce_button', {
            text: 'Insérer une vidéo youtube',
            icon: false,
            onclick: function () {
                var videoIds = getEnregistredVideoIds();
                if (videoIds.length >0) {
                    var selectedVideoId = prompt('Sélectionnerun ID de vidéo :', '');
                    if (selectedVideoId && videoIds.indexOf(selectedVideoId) !== -1) {
                        editor.insertContent('[youtube_video id="' + selectedVideoId + '"]');
                    } else {
                        alert('ID de vidéo non valide. Veuillez sélectionner un ID de la liste.');
                    }
                } else {
                    alert('Aucune vidéo enregistrée. Veuillez ajouter des vidéos dans l\'administration.');
                
                }
            }
        });
    });


    function getEnregistredVideoIds() {
        // Utilisez une requête AJAX pour appeler la fonction PHP
        var xhr = new XMLHttpRequest();
        xhr.open('GET', your_plugin_ajax_url + '?action=get_enregistred_video_ids', false);
        xhr.send();

        if (xhr.status === 200) {
            return JSON.parse(xhr.responseText);
        } else {
            return [];
        }
    }
})();