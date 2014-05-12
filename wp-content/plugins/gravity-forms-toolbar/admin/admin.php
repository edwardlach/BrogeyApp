<?php
/**
 * Plugin's admin options
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Admin Options
 * @author     Milan Petrovic - Dev4Press
 * @copyright  Copyright (c) 2012-2014, Milan Petrovic - Dev4Press
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://twitter.com/milangd
 *
 * @since      1.2.0
 */

/**
 * Exit if accessed directly.
 *
 * @since 1.6.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'admin_menu', 'ddw_gftb_admin_menu' );
/**
 * Registrer plugin menu panel.
 *
 * @since 1.2.0
 *
 * @uses  current_user_can()
 * @uses  add_options_page()
 */
function ddw_gftb_admin_menu() {

	/** Check for available Gravity Forms capabilities */
	$gftb_options_cap_check = current_user_can( 'gravityforms_edit_forms' ) ? 'gravityforms_edit_forms' : 'gform_full_access';

	/** Set filter for options page capability */
	$gftb_options_capability = apply_filters( 'gftb_filter_options_capability', $gftb_options_cap_check );

	/** Add the menu panel & options page */
	add_options_page(
		__( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ),
		__( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ),
		esc_attr( $gftb_options_capability ),
		'ddw_gftb_options_page',
		'ddw_gftb_options_page'
	);

}  // end of function ddw_gftb_admin_menu


add_action( 'admin_init', 'ddw_gftb_admin_init' );
/**
 * Registrer settings for the plugin.
 *
 * @since 1.2.0
 *
 * @uses  register_setting()
 */
function ddw_gftb_admin_init() {

	register_setting( 'ddw_gftb_options', 'ddw_gftb', 'ddw_gftb_options_validate' );

}  // end of function ddw_gftb_admin_init


/**
 * Validation of the options to save.
 *
 * @since  1.2.0
 *
 * @param  array $input raw options data
 *
 * @return array valid options data
 */
function ddw_gftb_options_validate( $input ) {

	$default = ddw_gftb_default_options();

	if ( ! isset( $input['toolbar_admin'] ) ) {
		$default['toolbar_admin'] = false;
	}

	if ( ! isset( $input['toolbar_frontend'] ) ) {
		$default['toolbar_frontend'] = false;
	}

	if ( ! isset( $input['help_and_support'] ) ) {
		$default['help_and_support'] = false;
	}

	if ( ! isset( $input['extensions'] ) ) {
		$default['extensions'] = false;
	}

	if ( ! isset( $input['forms_details'] ) ) {
		$default['forms_details'] = false;
	}

	if ( ! isset( $input['add_ons'] ) ) {
		$default['add_ons'] = false;
	}

	if ( ! isset( $input['update_notification'] ) ) {
		$default['update_notification'] = false;
	}

	if ( ! isset( $input['unread_notification'] ) ) {
		$default['unread_notification'] = false;
	}

	return $default;

}  // end of function ddw_gftb_options_validate


/**
 * Include form
 *
 * @since 1.2.0
 */
function ddw_gftb_options_page() {

	include( GFTB_PLUGIN_DIR . '/admin/form.php' );
	
}  // end of function ddw_gftb_options_page


/**
 * Register & display "Settings updated" message when saving options.
 *
 * @since 1.0.0
 *
 * @uses  add_settings_error()
 * @uses  settings_errors()
 */
function ddw_gftb_settings_message() {

	/** Register "Update" message */
	add_settings_error( 'gftb-notices', '', __( 'Toolbar Settings updated.', 'gravity-forms-toolbar' ), 'updated' );

	/** Display message */
	settings_errors( 'gftb-notices' );

}  // end of function ddw_gftb_settings_message