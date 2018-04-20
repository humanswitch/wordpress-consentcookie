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

}

?><textarea
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	cols="<?php echo esc_attr( $atts['cols'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	rows="<?php echo esc_attr( $atts['rows'] ); ?>"><?php

	echo html_entity_decode( stripslashes( $atts['value'] ) );
	
?></textarea>

<?php

if ( ! empty( $atts['help_url'] ) ) {

	?><a href="<?php echo esc_attr( $atts['help_url'] ); ?>">
<?php
}
?>
<span class="description"><?php esc_html_e( $atts['description'], 'consentcookie' ); ?></span>
<?php

if ( ! empty( $atts['help_url'] ) ) {

	?></a>
<?php
}
?>
