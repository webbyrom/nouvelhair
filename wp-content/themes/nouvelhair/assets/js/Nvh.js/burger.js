// menu burger animation
jQuery(document).ready(function($){
    $('.Nvh-menu-icon').click(function(e){
        e.preventDefault();
        //console.log('test 1');
        $this = $(this);
        if($this.hasClass('Nvh-opened')){
            $this.addClass('Nvh-closed').removeClass('Nvh-opened');
        } else {
            $this.removeClass('Nvh-closed').addClass('Nvh-opened');
        }
    })
});
