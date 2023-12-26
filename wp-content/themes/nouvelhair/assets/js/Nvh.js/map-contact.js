/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
jQuery(function($) {
    $('.Nvh-info-adress').on('mouseover', function() {
        $('#Nvh_maps_container').show(600); // Affiche la carte comme un modal lors du survol
    });

    $('.Nvh-maps-close').on('click', function() {
        $('#Nvh_maps_container').hide(900); // Cache le modal lorsque l'utilisateur clique sur le bouton "Fermer"
    });

   /* $('#Nvh_contact_info').on('mouseleave', function() {
        // Cache le modal lorsque l'utilisateur quitte le conteneur
        $('#Nvh_maps_container').hide();
    });*/
});

let map;
function initMap() {
    const position = { lat: 45.63246, lng: 4.45527 };
    
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 18,
      center: position,
      mapId: "NOUVELHAIR_MAP_ID",
    });
  
    const marker = new google.maps.Marker({
      map: map,
      position: position,
      title: "Nouvel'hair",
      label: "Nouvel'hair",
    });
  }
  
  function loadGoogleMapsScript() {
    const script = document.createElement("script");
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyAWmwgTcdzYXvhdK3eehI9uCvnirfIPkdg&callback=initMap`;
    script.async = true;
    document.body.appendChild(script);
  }
  
  // Chargez le script de l'API Google Maps lorsque la page est prête
  window.addEventListener("load", loadGoogleMapsScript);
  

