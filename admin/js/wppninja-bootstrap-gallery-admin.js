(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

	 var media = wp.media;
	 if(media.view.Settings.Gallery){
		media.view.Settings.Gallery = media.view.Settings.extend({
			className: "collection-settings gallery-settings",
			template: wp.media.template("gallery-settings"),
			render:	function() {
				media.View.prototype.render.apply( this, arguments );
				var $s = this.$('select.columns');
				$s.find('option[value="1"]').hide();
				$s.find('option[value="9"]').hide();
				$s.find('option[value="8"]').hide();
				$s.find('option[value="7"]').hide();
				$s.find('option[value="5"]').hide();


				var $t = this.$('select.size');
				$t.find('option[value="wppninja-bootstrap-image"]').attr('selected','selected');

				// Select the correct values.
				_( this.model.attributes ).chain().keys().each( this.update, this );
				this.update.apply( this, ['size'] );
				return this;
			}
		});
	}

})( jQuery );
