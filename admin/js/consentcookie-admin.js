var consentCookieAdmin = {
		
	isModified : false,
	
	/*
	 * Mark settings as modified and enable 'Save' button.
	 */
	markAsModified: function() {
		this.isModified = true;
		jQuery("#consentcookie-submit-top").prop("disabled", false);
		jQuery("#consentcookie-submit-bottom").prop("disabled", false);
	},
	
	markAsUnmodified: function() {
		this.isModified = false;
	},	

	init: function() {
		jQuery(document).ready(function($) {
			
			/*
			 * Upgrade 'custom script' textarea to JS script editor
			 */
			var codeMirror = CodeMirror.fromTextArea(document.getElementById("consentcookie-widget-customscript"), {
				lineNumbers : true,
				mode : "javascript",
				matchBrackets : true
			});
			
			/*
			 * Show warning when user tries to leave when modifications are not saved.
			 */

			// Disabled because of https://github.com/humanswitch/wordpress-consentcookie/issues/3
			/*$(window).on("beforeunload", function(ev) {
				if (consentCookieAdmin.isModified) {
					ev.returnValue = consentcookieObjectL10n.unsavedWarning;
					return ev.returnValue;
				}
			});*/
			
			/*
			 * Mark modifications and enable 'Save' button
			 */
			$("#consentcookie-enabled").change(function() {
				consentCookieAdmin.markAsModified();
			});
			$("#consentcookie-widget-ccc").change(function() {
				consentCookieAdmin.markAsModified();
			});
			codeMirror.on("change", function() {
				consentCookieAdmin.markAsModified();
			});
			
			$("#consentcookie-form").submit(function() {
				consentCookieAdmin.markAsUnmodified();
			})
			
		});
	}
	
};

consentCookieAdmin.init();

