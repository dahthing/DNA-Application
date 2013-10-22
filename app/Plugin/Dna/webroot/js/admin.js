Holder.add_theme("dark", {background: "#000", foreground: "#aaa", size: 9});
Holder.add_theme("white", {background: "#fff", foreground: "#c9c9c9", size: 9});

// handle menu toggle button action
function toggleMenuHidden()
{
	//console.log('toggleMenuHidden');
	$('.container-fluid:first').toggleClass('menu-hidden');
	$('#menu').toggleClass('hidden-phone', function()
	{
		if ($('.container-fluid:first').is('.menu-hidden'))
		{
			if (typeof resetResizableMenu != 'undefined') 
				resetResizableMenu(true);
		}
		else 
		{
			removeMenuHiddenPhone();
			
			if (typeof lastResizableMenuPosition != 'undefined') 
				lastResizableMenuPosition();
		}
		
		if (typeof $.cookie != 'undefined')
			$.cookie('menuHidden', $('.container-fluid:first').is('.menu-hidden'));
	});
	
	if (typeof masonryGallery != 'undefined') 
		masonryGallery();	
}

function removeMenuHiddenPhone()
{
    if (!$('.container-fluid:first').is('.menu-hidden') && $('#menu').is('.hidden-phone'))
        $('#menu').removeClass('hidden-phone');
}

$(function() {
    // Sidebar menu collapsibles
    $('#menu .collapse').on('show', function(e)
    {
        e.stopPropagation();
        $(this).parents('.hasSubmenu:first').addClass('active');
    })
            .on('hidden', function(e)
    {
        e.stopPropagation();
        $(this).parents('.hasSubmenu:first').removeClass('active');
    });

    // main menu visibility toggle
    $('.navbar.main .btn-navbar').click(function()
    {
        var disabled = typeof toggleMenuButtonWhileTourOpen != 'undefined' ? toggleMenuButtonWhileTourOpen(true) : false;
        if (!disabled)
            toggleMenuHidden();
    });

    // topnav toggle
    $('.navbar.main .toggle-navbar').click(function()
    {
        var that = $(this);

        if ($('.navbar.main .wrapper').is(':hidden'))
        {
            $(this).slideUp(20, function() {
                $('.navbar.main .wrapper').show();
                $('.navbar.main').animate({height: 34}, 200, function() {
                    $('.navbar.main').toggleClass('navbar-hidden');
                    that.slideDown();
                });
            });
        }
        else
        {
            $(this).slideUp(20, function() {
                $('.navbar.main').animate({height: 0}, 200, function() {
                    $('.navbar.main .wrapper').hide();
                    $('.navbar.main').toggleClass('navbar-hidden');
                    that.slideDown();
                });
            });
        }
    });

    // multi-level top menu
    $('.submenu').hover(function()
    {
        $(this).children('ul').removeClass('submenu-hide').addClass('submenu-show');
    }, function()
    {
        $(this).children('ul').removeClass('.submenu-show').addClass('submenu-hide');
    });
    
    // menu slim scroll max height
    setTimeout(function() {
        var menu_max_height = $(window).height()-$(".appbrand").outerHeight(true);//parseInt($('#menu .slim-scroll').attr('data-scroll-height'));
        var menu_real_max_height = parseInt($('#wrapper').height());
        $('#menu .slim-scroll').slimScroll({
            height: (menu_max_height < menu_real_max_height ? (menu_real_max_height - 40) : menu_max_height) + "px",
            allowPageScroll: true,
            railDraggable: ($.fn.draggable ? true : false)
        });

        if (Modernizr.touch)
            return;

        // fixes weird bug when page loads and mouse over the sidebar (can't scroll)
        $('#menu .slim-scroll').trigger('mouseenter').trigger('mouseleave');
    }, 200);

    /* Slim Scroll Widgets */
    $('.widget-scroll').each(function() {
        $(this).find('.widget-body > div').slimScroll({
            height: $(this).attr('data-scroll-height')
        });
    });

    /* Other non-widget Slim Scroll areas */
    $('#content .slim-scroll').each(function() {
        var scrollSize = $(this).attr('data-scroll-size') ? $(this).attr('data-scroll-size') : "7px";
        $(this).slimScroll({
            height: $(this).attr('data-scroll-height'),
            allowPageScroll: false,
            railVisible: false,
            size: '0',
            railDraggable: ($.fn.draggable ? true : false)
        });
    });
});