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

function do_settings_sections_cc( $page ) {
    global $wp_settings_sections, $wp_settings_fields;

    if ( ! isset( $wp_settings_sections[$page] ) )
        return;

    foreach ( (array) $wp_settings_sections[$page] as $section ) {
        if ( $section['title'] )
            echo "<h1>{$section['title']}</h1>\n";

        if ( $section['callback'] )
            call_user_func( $section['callback'], $section );

        if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
            continue;
        echo '<p>';
        do_settings_fields_cc( $page, $section['id'] );
        echo '</p>';
    }
}


function do_settings_fields_cc($page, $section) {
    global $wp_settings_fields;

    if ( ! isset( $wp_settings_fields[$page][$section] ) )
        return;

    foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
        $class = '';

        if ( ! empty( $field['args']['class'] ) ) {
            $class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
        }

        echo "<p class='settings_field'>";

        if ( ! empty( $field['args']['label_for'] ) ) {
            echo '<h4 class="settings_field_title" scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></h4>';
        } else {
            echo '<h4 class="settings_field_title" scope="row">' . $field['title'] . '</h4>';
        }


        call_user_func($field['callback'], $field['args']);
        echo "</p>";
    }
}


?>
<div class="wrap">
    <h2><?php echo 'ConsentCookie' ?> &raquo; <?php _e('Settings', $this->plugin_name); ?></h2>

    <?php
    if (isset($this->message)) {
        ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>
        <?php
    }
    if (isset($this->errorMessage)) {
        ?>
        <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>
        <?php
    }
    ?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <!-- Content -->
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div class="postbox">
                        <div class="inside">
                            <form id="consentcookie-form" method="post" action="options.php">
                                <?php

                                settings_fields($this->plugin_name . '-options');

                                do_settings_sections_cc($this->plugin_name);

                                ?>

                                <p>
                                    <?php submit_button(esc_html__('Save'), "primary", $this->plugin_name . "-submit-bottom", false /*, array( 'disabled' => 'disabled' )*/); ?>
                                    <input id="ccBtnReset" value="<?php echo esc_html__('Reset', 'consentcookie') ?>"
                                           title="<?php echo esc_html__('Reset to initial settings', 'consentcookie') ?>"
                                           class="button"
                                           type="button" onclick="consentCookieAdmin.reset()">
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /normal-sortables -->
            </div>
            <!-- /post-body-content -->

            <!-- Sidebar -->
            <div id="postbox-container-1" class="postbox-container">
                <div class="postbox">
                    <h3 class="hndle"><?php _e('Your site GDPR compliant?', $this->plugin_name); ?></h3>
                    <div class="inside">
                       Implement ConsentCookie in the correct way to make your website GDPR compliant.
                        <ul>
                            <li><a href="https://www.consentcookie.nl/doc/consentcookie-v1-x/" target="_blank">Documentation</a> </li>
                            <li><a href="https://www.consentcookie.nl/knowledgebase/" target="_blank">Knowledgebase</a> </li>
                            <li><a href="https://www.consentcookie.nl/faq/algemeen/" target="_blank">FAQ</a> </li>

                        </ul>
                        Get <a href="https://www.consentcookie.nl/consentcookie-premium/" target="_blank">Premium</a> and stay up-to-date with the latest ConsentCookie version hosted by <a href="https://www.humanswitch.io" target="_blank">HumanSwitch</a>.
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><?php _e('HumanSwitch', $this->plugin_name); ?></h3>
                    <div class="inside">
                        We are experts in adding human dimension to digital transformation. <a href="https://www.humanswitch.io" target="_blank">Check out</a> our other services.
                    </div>
                </div>
            </div>
            <!-- /postbox-container -->
        </div>
    </div>
</div>

