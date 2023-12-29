jQuery(document).ready(function($){
   $(document).scroll(function(){
    if ($(document).scrollTop() >175){
        $("#Nvh_contact_hours").addClass("Nvh-move");
    } else {
        $("#Nvh_contact_hours").removeClass("Nvh-move")
    }
    if ($(document).scrollTop() >225){
        $("#Nvh_contact_conges").addClass("Nvh-move-conge");
    } else{
        $("#Nvh_contact_conges").removeClass("Nvh-move-conge");
    }
    if ($(document).scrollTop() >430){
        $("#Nvh_contact_info").addClass("Nvh-move-info");

    } else {
        $("#Nvh_contact_info").removeClass("Nvh-move-info");
    }
   })
})// Animation pour les horaires et les congés de la pages infos

