$(function(){
    
    if(!$(".hasSubmenu.active:last").parent().hasClass('in')){
        $(".hasSubmenu.active:last").parent().addClass('in');
        
        if(!$(".hasSubmenu.active:last").parent().parent().hasClass('active')){
            $(".hasSubmenu.active:last").parent().parent().addClass('active');
        }
    }
    
    if(!$(".hasSubmenu li.active:last").parent().hasClass('in')){
        $(".hasSubmenu .active:last").parent().parent().addClass('in');
        
        if(!$(".hasSubmenu .in:last").parent().hasClass('active')){
            $(".hasSubmenu .in:last")
                .parent()
                .addClass('active')
                .parent()
                .addClass('in')
                .parent()
                .addClass('active');
            
        }
    }
    
    
    // main menu -> submenus
    $('#menu .collapse').on('show', function()
    {
            $(this).parents('.hasSubmenu:first').addClass('active');
    })
    .on('hidden', function()
    {
            $(this).parents('.hasSubmenu:first').removeClass('active');
    });

    // main menu visibility toggle
    $('.navbar.main .btn-navbar').click(function()
    {
            $('.container-fluid:first').toggleClass('menu-hidden');
            $('#menu').toggleClass('hidden-phone');

            if (typeof masonryGallery != 'undefined') 
                    masonryGallery();
    });
    
    $(window).resize(function()
    {
        if (!$('#menu').is(':visible') && !$('.container-fluid:first').is('.menu-hidden') && !$('.container-fluid:first').is('.documentation') && !$('.container-fluid:first').is('.login'))
            $('.container-fluid:first').addClass('menu-hidden');
    });

    $(window).resize();
    /*
    * UniformJS: Sexy form elements
    */
   $('.uniformjs').find("select, input, button, textarea").uniform();
});