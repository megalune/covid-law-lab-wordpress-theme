jQuery(document).ready( function() {

	// News Ticker
	var ticker = function()
	{
		setTimeout(function(){
			$('#ticker li:first').animate( {marginTop: '-31px'}, 800, function()
			{
				$(this).detach().appendTo('ul#ticker').removeAttr('style');	
			});
			ticker();
		}, 4000);
	};
	ticker();
	
/*-----------------------------------------------------------------------------------*/
/* Superfish navigation dropdown */
/*-----------------------------------------------------------------------------------*/

	if( jQuery().superfish ) {

		jQuery('.nav ul').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			dropShadows: true
		});
	
	}

/*-----------------------------------------------------------------------------------*/
/* Innerfade Setup */
/*-----------------------------------------------------------------------------------*/

	if ( jQuery('.quotes').length ) {
	
		fadeArgs = new Object();
		
		fadeArgs.animationtype = 'fade';
		fadeArgs.speed = 'normal';
		
		if ( tj_innerfade_settings.can_fade == 'true' ) {
			fadeArgs.timeout = tj_innerfade_settings.timeout;
		} else {
			fadeArgs.timeout = 10000000;
		}
		
		fadeArgs.type = 'random_start';
		fadeArgs.containerheight = '120px';
	
		jQuery('.quotes').innerfade( fadeArgs );
	}

});

/*-----------------------------------------------------------------------------------*/
/* Center Nav Sub Menus */
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(){

	jQuery('#secondary-nav .nav li ul').each(function(){
	
		li_width = jQuery(this).parent('li').width();
		li_width = li_width / 2;
		li_width = 100 - li_width - 15;
		
		jQuery(this).css('margin-left', - li_width);
	
	});

	jQuery('#primary-nav .nav li ul').each(function(){
	
		li_width = jQuery(this).parent('li').width();
		li_width = li_width / 2;
		li_width = 100 - li_width - 15;
		
		jQuery(this).css('margin-left', - li_width);
	
	});	

});