( function( $ ) {
	/* Inside of this function, $() will work as an alias for jQuery()
	and other libraries also using $ will not be accessible under this shortcut */
	$( document ).ready( function() {
		/* initialization formstyler */
		setTimeout( function() {
			$( 'input, select' ).styler();
		}, 100 );
		/* initialization carousel */
		$('.cheap-travel-carousel').carousel( {
			interval: 6000
		});
		/* delete empty <p> and <br> from form */
		$('form').find( 'p:empty, label+br' ).remove();
		$('form').find('label').filter().addClass('wrap_label');

		$( ".cheap-travel-single-tags .cheap-travel-posted-on a, .cheap-travel-image-tags .cheap-travel-posted-on a" ).click( function( event ) {
  			event.preventDefault();
  		});

		$(".pdfprnt-top-right").after( function() {
			return "<div class='clear'></div>";
		});

		$(".subscrbr-sign-up-form").each( function(){
			$("p").has("label [name='sbscrbr_unsubscribe']").hide();
			var sbscrbr_email = $( this ).find("[name=sbscrbr_email]");
			var sbscrbr_submit = $( this ).find(".sbscrbr-submit-block");
			sbscrbr_email.prependTo( sbscrbr_submit );
		});
	})
})( jQuery );