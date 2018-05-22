<?php

/**
 * Provides the markup for any textarea field
 *
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/admin/partials
 */

if ( ! empty( $atts['label'] ) ) {
	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'consentcookie' ); ?>: </label><?php

} ?>

<div>
	<div id="<?php echo esc_attr( $atts['id'] ); ?>-holder"><span><?php echo esc_html__( "loading configuration...", "consentcookie"); ?></span></div>
	<textarea  id="<?php echo esc_attr( $atts['id'] ); ?>" name="<?php echo esc_attr( $atts['name'] ); ?>">
	<?php echo $atts['value']; ?>
	</textarea>
</div>
<span class="description"><?php esc_html_e( $atts['description'], 'consentcookie' ); ?></span>
<script>
	jQuery( window ).on( "load", function() {
		var ccc = new CCC( "#<?php echo esc_js( $atts['id'] ); ?>-holder" ).setOptions( { "copyButton" : false } );
		ccc.onMounted(function(configurator) {
			configurator.onChange( function( configurator, config ) {
				jQuery( "#<?php echo esc_js( $atts['id'] ); ?>" ).val( jQuery('<div />').text(JSON.stringify(config)).html() );
				jQuery( "#<?php echo esc_js( $atts['id'] ); ?>" ).change();
			})
		});
		var hiddenValueTextArea = jQuery( "#<?php echo esc_js( $atts['id'] ); ?>" );
		var hiddenValueTextAreaValue = hiddenValueTextArea.val();
		if ( hiddenValueTextAreaValue && !hiddenValueTextAreaValue.trim() == false ) {
			ccc.setConfig( JSON.parse( hiddenValueTextArea.val() ) );
		} else {
			jQuery( "#<?php echo esc_js( $atts['id'] ); ?>" ).val( jQuery('<div />').text(JSON.stringify(ccc.getConfig())).html() );
		}
		ccc.mount();
	});
</script>