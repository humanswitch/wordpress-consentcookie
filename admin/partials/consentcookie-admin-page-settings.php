<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/admin/partials
 */

?>
<form id="consentcookie-form" method="post" action="options.php"><?php

settings_fields( $this->plugin_name . '-options' );

submit_button( esc_html__( 'Save' ), "primary", $this->plugin_name . "-submit-top", true, array( 'disabled' => 'disabled' ) );

do_settings_sections( $this->plugin_name );

?>
<p class="submit">
<?php submit_button( esc_html__( 'Save' ), "primary", $this->plugin_name . "-submit-bottom", false, array( 'disabled' => 'disabled' ) ); ?>
<input id="ccBtnReset" value="<?php echo esc_html__( 'Reset', 'consentcookie' ) ?>" title="<?php echo esc_html__( 'Reset to initial settings', 'consentcookie' ) ?>" class="button" type="button" onclick = "consentCookieAdmin.reset()">
</p>
</form>