jQuery(document).ready(function($) {
	/* Back to Top */

	(function(selector){
		var $backtotop = $(selector);
		$backtotop.hide();
		var height =  $(document).height();
		$(window).scroll(function () {
			var ajaxPopup = $('#toPopup');
			if(ajaxPopup.length) {
				var ajaxPosition = ajaxPopup.offset();
				ajaxPopup.css({
					top : ajaxPosition.top,
					position: 'absolute',
				});
			}
			if ($(this).scrollTop() > height/10) {
				$backtotop.fadeIn();
			} else {
				$backtotop.fadeOut();
			}
		});
		$backtotop.click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

	})('#backtotop');
	
	$(".block-title.heading").click(function () {
		$header = $(this);
		$content = $header.next();
		$content.slideToggle(500, function () {
			$header.find('i').toggleClass('fa-minus-square');
		});

	});
	
	$('.main').on("click", '.alo_qty_dec', function(){
	    var input = $(this).parent().find('input');
        var value  = parseInt(input.val());
        if(value) input.val(value-1);
	});
    $('.main').on("click", '.alo_qty_inc', function(){
        var input = $(this).parent().find('input');
        var value  = parseInt(input.val());
        input.val(value+1);
    });
	
});

