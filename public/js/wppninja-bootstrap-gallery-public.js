	jQuery(document).ready(function($) {
		$('.wppninja-gallery').each(function() { // the containers for all your galleries
		    $(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        image:{ titleSrc:'title'},
		        gallery: {
		          enabled:true,
		          	preload:[0,1],
			    navigateByImgClick:true
		        }
		    });
		});
	});