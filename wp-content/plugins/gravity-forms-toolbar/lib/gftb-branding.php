<?php
/**
 * Helper functions for custom branding & capabilities
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Branding
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.4.0
 */

/**
 * Exit if accessed directly.
 *
 * @since 1.6.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Helper functions for returning a few popular roles/capabilities.
 *
 * @since  1.4.0
 *
 * @return role/capability
 */
	/**
	 * Helper function for returning 'administrator' role/capability.
	 *
	 * @since  1.4.0
	 *
	 * @return 'administrator' role
	 */
	function __gftb_admin_only() {

		return 'administrator';

	}

	/**
	 * Helper function for returning 'editor' role/capability.
	 *
	 * @since  1.4.0
	 *
	 * @return 'editor' role
	 */
	function __gftb_role_editor() {

		return 'editor';

	}

	/**
	 * Helper function for returning 'manage_options' capability.
	 *
	 * @since  1.4.0
	 *
	 * @return 'manage_options' capability
	 */
	function __gftb_cap_manage_options() {

		return 'manage_options';

	}

	/**
	 * Helper function for returning 'install_plugins' capability.
	 *
	 * @since  1.4.0
	 *
	 * @return 'install_plugins' capability
	 */
	function __gftb_cap_install_plugins() {

		return 'install_plugins';

	}

	/**
	 * Helper function for returning 'activate_plugins' capability.
	 *
	 * @since  1.4.0
	 *
	 * @return 'activate_plugins' capability
	 */
	function __gftb_cap_activate_plugins() {

		return 'activate_plugins';

	}

	/**
	 * Helper function for returning 'edit_theme_options' capability.
	 *
	 * @since  1.4.0
	 *
	 * @return 'edit_theme_options' capability
	 */
	function __gftb_cap_edit_theme_options() {

		return 'edit_theme_options';

	}

/** End of role/capability helper functions */


/**
 * Helper functions for returning colored icons.
 *
 * @since  1.4.0
 *
 * @return colored icon image
 */
	/**
	 * Helper function for returning the blue icon.
	 *
	 * @since  1.4.0
	 *
	 * @return blue icon
	 */
	function __gftb_blue_icon() {

		return plugins_url( 'images/gravityforms-icon-blue.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the lightgreen icon.
	 *
	 * @since  1.4.0
	 *
	 * @return lightgreen icon
	 */
	function __gftb_lightgreen_icon() {

		return plugins_url( 'images/gravityforms-icon-lightgreen.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the lightgrey icon.
	 *
	 * @since  1.4.0
	 *
	 * @return lightgrey icon
	 */
	function __gftb_lightgrey_icon() {

		return plugins_url( 'images/gravityforms-icon-lightgrey.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the orange icon.
	 *
	 * @since  1.4.0
	 *
	 * @return orange icon
	 */
	function __gftb_orange_icon() {

		return plugins_url( 'images/gravityforms-icon-orange.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the pink icon.
	 *
	 * @since  1.4.0
	 *
	 * @return pink icon
	 */
	function __gftb_pink_icon() {

		return plugins_url( 'images/gravityforms-icon-pink.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the red icon.
	 *
	 * @since  1.4.0
	 *
	 * @return red icon
	 */
	function __gftb_red_icon() {

		return plugins_url( 'images/gravityforms-icon-red.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the turquoise icon.
	 *
	 * @since  1.4.0
	 *
	 * @return turquoise icon
	 */
	function __gftb_turquoise_icon() {

		return plugins_url( 'images/gravityforms-icon-turquoise.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning the yellow icon.
	 *
	 * @since  1.4.0
	 *
	 * @return yellow icon
	 */
	function __gftb_yellow_icon() {

		return plugins_url( 'images/gravityforms-icon-yellow.png', dirname( __FILE__ ) );

	}

	/**
	 * Helper function for returning a custom icon (icon-gftb.png) from stylesheet/child/theme "images" folder.
	 *
	 * @since  1.4.0
	 *
	 * @return gftb custom icon
	 */
	function __gftb_theme_images_icon() {

		return get_stylesheet_directory_uri() . '/images/icon-gftb.png';

	}

/** End of icon helper functions */


/**
 * Helper functions for returning icon class.
 *
 * @since  1.4.0
 *
 * @return icon class
 */
	/**
	 * Helper function for returning no icon class.
	 *
	 * @since  1.4.0
	 *
	 * @return no icon class
	 */
	function __gftb_no_icon_display() {

		return NULL;

	}

/** End of icon class helper functions */