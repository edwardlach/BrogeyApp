<?php
/**
 * Gravity Forms admin settings integrations.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Settings
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.6.0
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'admin_init', 'ddw_gftb_add_gfsettings' ) ;
/**
 * Hook in our plugin's settings page also on the Gravity Forms settings page as
 *    a sub page.
 *
 * @since 1.6.0
 *
 * @uses  is_admin()
 * @uses  RGForms::add_settings_page()
 */
function ddw_gftb_add_gfsettings() {

	if ( is_admin() && class_exists( 'RGForms' ) ) {

		global $pagenow;

		$gftb_gf_settings_string = array(
			'name'      => 'Toolbar',	//__( 'Toolbar', 'gravity-forms-toolbar' ),
			'tab_label' => _x(
				'Toolbar',
				'Translators: Settings (sub) title within Gravity Forms settings page',
				'gravity-forms-toolbar'
			),
			'handler'   => 'ddw_gftb_options_page',
			'icon_path' => ''
		);

		RGForms::add_settings_page(
			$gftb_gf_settings_string,
			'ddw_gftb_options_page',
			''
		);

		/** Add & display message on saving options */
		if ( ( isset( $_GET[ 'subview' ] ) && 'Toolbar' == $_GET[ 'subview' ] )
			&& isset( $_GET[ 'settings-updated' ] )
		) {

			add_action( 'admin_notices', 'ddw_gftb_settings_message' );

		}  // end if

	}  // end if

}  // end of function