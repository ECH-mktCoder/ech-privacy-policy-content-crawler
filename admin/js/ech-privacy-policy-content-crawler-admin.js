(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function () {


		/************* GENERAL FORM **************/
		$('#pp_content_gen_settings_form').on('submit', function (e) {
			e.preventDefault();

			$('.statusMsg').removeClass('error');
			$('.statusMsg').removeClass('updated');

			let statusMsg = '';
			let validStatus = false;

			const b_token = $('#pp_content_gen_settings_form #ech_pp_bearer_token').val();
			const api_link = $('#pp_content_gen_settings_form #ech_pp_api_link').val();

			if (b_token == '') {
				validStatus = false;
				statusMsg += 'Bearer Token cannot be empty<br>';
			} else if (api_link == '') {
				validStatus = false;
				statusMsg += 'API Link cannot be empty<br>';
			}else {
				validStatus = true;
			}
			// set error status msg
			if (!validStatus) {
				$('.statusMsg').html(statusMsg);
				$('.statusMsg').addClass('error');
				return;
			} else {
				$('#pp_content_gen_settings_form').attr('action', 'options.php');
				$('#pp_content_gen_settings_form')[0].submit();
				// output success msg
				statusMsg += 'Settings updated <br>';
				$('.statusMsg').html(statusMsg);
				$('.statusMsg').addClass('updated');
			}
		});
		/************* (END) GENERAL FORM **************/

		/************* COPY SAMPLE SHORTCODE **************/
		$('#copyShortcode').click(function () {
			const shortcode = $('#sample_shortcode').text();
			const tempInput = $('<input>');
			$('body').append(tempInput);
			tempInput.val(shortcode).select();
			try {
				const successful = document.execCommand('copy');
				if (successful) {
					$('#copyShortcode').html('Copied !');
				} else {
					$('#copyMsg').html('Copying failed, try again...');
				}
			} catch (err) {
				$('#copyMsg').html('Unable to copy, please try manually.');
			}
			tempInput.remove();
			setTimeout(function () {
				$('#copyShortcode').html('Copy Shortcode');
			}, 3000);
		});
		/************* (END)COPY SAMPLE SHORTCODE **************/


	}); // doc ready

})(jQuery);
