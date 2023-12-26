jQuery(document).ready(function($){
    
    $(window).on("scroll", function(){
        const scrolled = $(window).scrollTop();
        $("#Nvh_bubble1").css("transform", `translateX(${scrolled * 0.4}px) translateY(${scrolled * 0.6}px) scale(${1 + scrolled * 0.0005})`);
        $("#Nvh_bubble1").css("opacity", 1 - scrolled * 0.005);
        $("#Nvh_bubble2").css("transform", `translateX(${scrolled * 0.3}px) translateY(${scrolled * 0.4}px) scale(${1 - scrolled * 0.0005})`);
        $("#Nvh_bubble2").css("opacity", 1 - scrolled * 0.005);
        $("#Nvh_bubble3").css("transform", `translateX(${scrolled * 0.2}px) translateY(${scrolled * 0.2}px) scale(${1 + scrolled * 0.0006})`);
        $("#Nvh_bubble3").css("opacity", 1 - scrolled * 0.005);
    });
});
