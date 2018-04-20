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

submit_button( esc_html__( 'Save' ), "primary", $this->plugin_name . "-submit-bottom", true, array( 'disabled' => 'disabled' ) );

?></form>