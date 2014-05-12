<?php 
/**
 * Main plugin file.
 * This plugin adds useful admin links and resources for Gravity Forms to the
 *    WordPress Toolbar / Admin Bar.
 *
 * @package     Gravity Forms Toolbar
 * @author      David Decker
 * @link        http://deckerweb.de/twitter
 * @author      Milan Petrovic
 * @link        http://twitter.com/milangd
 * @copyright   Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Gravity Forms Toolbar
 * Plugin URI:  http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * Description: This plugin adds useful admin links and resources for Gravity Forms to the WordPress Toolbar / Admin Bar.
 * Version:     1.7.0
 * Author:      David Decker - DECKERWEB / Milan Petrovic - Dev4Press
 * Author URI:  http://deckerweb.de/
 * License:     GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: gravity-forms-toolbar
 * Domain Path: /languages/
 *
 * Copyright (c) 2012-2014 David Decker - DECKERWEB
 *
 *     This file is part of Gravity Forms Toolbar,
 *     a plugin for WordPress.
 *
 *     Gravity Forms Toolbar is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     Gravity Forms Toolbar is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
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
 * Setting constants.
 *
 * @since 1.0.0
 */
/** Plugin directory */
define( 'GFTB_PLUGIN_DIR', trailingslashit( dirname( __FILE__ ) ) );

/** Plugin base directory */
define( 'GFTB_PLUGIN_BASEDIR', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );


/**
 * Load extra set of helper functions.
 *
 * @since  1.7.0
 */
require_once( GFTB_PLUGIN_DIR . 'lib/gftb-functions.php' );


add_action( 'init', 'ddw_gftb_init' );
/**
 * Load the text domain for translation of the plugin.
 * Load admin settings & helper functions - only within 'wp-admin'.
 * 
 * @since 1.0.0
 *
 * @uses  is_admin()
 * @uses  get_locale()
 * @uses  load_textdomain()	To load translations first from WP_LANG_DIR sub folder.
 * @uses  load_plugin_textdomain() To additionally load default translations from plugin folder (default).
 * @uses  current_user_can()
 */
function ddw_gftb_init() {

	/** Set unique textdomain string */
	$gftb_textdomain = 'gravity-forms-toolbar';

	/** The 'plugin_locale' filter is also used by default in load_plugin_textdomain() */
	$locale = apply_filters( 'plugin_locale', get_locale(), $gftb_textdomain );

	/** Set filter for WordPress languages directory */
	$gftb_wp_lang_dir = apply_filters(
		'gftb_filter_wp_lang_dir',
		trailingslashit( WP_LANG_DIR ) . 'gravity-forms-toolbar/' . $gftb_textdomain . '-' . $locale . '.mo'
	);

	/** Translations: First, look in WordPress' "languages" folder = custom & update-secure! */
	load_textdomain( $gftb_textdomain, $gftb_wp_lang_dir );

	/** Translations: Secondly, look in plugin's "languages" folder = default */
	load_plugin_textdomain( $gftb_textdomain, FALSE, GFTB_PLUGIN_BASEDIR . 'languages' );


	/** If 'wp-admin' include admin functions */
	if ( is_admin() ) {

		/** Plugin admin settings */
		require_once( GFTB_PLUGIN_DIR . 'admin/admin.php' );

		/** Gravity Forms settings integrations */
		require_once( GFTB_PLUGIN_DIR . 'lib/gftb-admin-settings.php' );

		/** Plugin admin extras (help) */
		require_once( GFTB_PLUGIN_DIR . 'lib/gftb-admin-extras.php' );

	}  // end if is_admin() check

	/** Add "Settings Page" link to plugin page - only within 'wp-admin' */
	if ( is_admin()
		&& ( current_user_can( 'gravityforms_edit_forms' ) || current_user_can( 'gform_full_access' ) )
	) {

		add_filter(
			'plugin_action_links_' . plugin_basename( __FILE__ ),
			'ddw_gftb_settings_page_link'
		);

	}  // end if admin & cap check

	/** Define constants and set defaults for removing all or certain sections */
	if ( ! defined( 'GFTB_DISPLAY' ) ) {
		define( 'GFTB_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_ADDONS_DISPLAY' ) ) {
		define( 'GFTB_ADDONS_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_EXTENSIONS_DISPLAY' ) ) {
		define( 'GFTB_EXTENSIONS_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_RESOURCES_DISPLAY' ) ) {
		define( 'GFTB_RESOURCES_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_DE_DISPLAY' ) ) {
		define( 'GFTB_DE_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_NL_DISPLAY' ) ) {
		define( 'GFTB_NL_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_ES_DISPLAY' ) ) {
		define( 'GFTB_ES_DISPLAY', TRUE );
	}

}  // end of function ddw_gftb_init


/**
 * Get default plugin options.
 *
 * @since  1.2.0
 *
 * @return array Array with the default options.
 */
function ddw_gftb_default_options() {

	return array(
		'help_and_support'    => TRUE,
		'extensions'          => TRUE,
		'forms_details'       => TRUE,
		'add_ons'             => TRUE,
		'update_notification' => TRUE,
		'unread_notification' => TRUE,
		'toolbar_admin'       => TRUE,
		'toolbar_frontend'    => TRUE
	);

}  // end of function ddw_gftb_default_options


/**
 * Get current plugin options.
 *
 * @since  1.2.0
 *
 * @return array Array with current plugin options.
 */
function ddw_gftb_get_options() {

	$from_db = get_option( 'ddw_gftb' );
	$default = ddw_gftb_default_options();

	return wp_parse_args( $from_db, $default );

}  // end of function ddw_gftb_get_options


add_action( 'admin_bar_menu', 'ddw_gftb_admin_bar_menu', 98 );
/**
 * Plugin's main function.
 * Add new menu items to the WordPress Toolbar / Admin Bar.
 * 
 * @since  1.0.0
 *
 * @global mixed $wp_admin_bar
 */
function ddw_gftb_admin_bar_menu() {

	global $wp_admin_bar;

	/**
	 * Allows for filtering the general user role/capability to display main & sub-level items
	 *
	 * Default capability: 'gravityforms_edit_forms' or 'gform_full_access' (set by Gravity Forms plugin itself!)
	 *
	 * @since 1.4.0
	 */
	$gftb_init_cap_check = current_user_can( 'gravityforms_edit_forms' ) ? 'gravityforms_edit_forms' : 'gform_full_access';

	$gftb_filter_capability = apply_filters( 'gftb_filter_capability_all', $gftb_init_cap_check );

	/**
	 * Required Gravity Forms/ WordPress cabability to display new admin bar entry
	 * Only showing items if toolbar / admin bar is activated and user is logged in!
	 *
	 * @since 1.3.0
	 */
	if ( ! is_user_logged_in()
		|| ! is_admin_bar_showing()
		|| ! current_user_can( esc_attr( $gftb_filter_capability ) )	// allows for custom filtering the required role/capability
		|| ( defined( 'GFTB_DISPLAY' ) && ! GFTB_DISPLAY )	// allows for custom disabling
	) {

		return;

	}  // end if

	/** Defaults for plugin's options */
	$options = ddw_gftb_get_options();

	if ( ( is_admin() && ! $options[ 'toolbar_admin' ] )
		|| ( ! is_admin() && ! $options[ 'toolbar_frontend' ] )
	) {

		return;

	}  // end if

	$update = $options[ 'update_notification' ] ? ddw_gftb_update_available() : false;

	$forms = array();
	$count = 0;

	if ( class_exists( 'RGForms' )
		&& $options[ 'forms_details' ]
		&& ( current_user_can( 'gform_full_access' ) || current_user_can( 'gravityforms_edit_forms' ) )

	) {

		$forms = RGFormsModel::get_form_summary();

	}

	/** Set unique prefix */
	$prefix = 'ddw-gravityforms-';
	
	/** Create parent menu item references */
	$gravitybar = $prefix . 'toolbar';				// root level
	$gfsupport = $prefix . 'gfsupport';						// sub level: support
	$gfdocs = $prefix . 'gfdocs';							// sub level: documentation
	$gffaq = $prefix . 'gffaq';								// sub level: faq
	$gfsites = $prefix . 'gfsites';							// sub level: gf websites
	$gfsettings = $prefix . 'gfsettings';					// sub level: main settings
		$gfsubsettings = $prefix . 'gfsubsettings';					// third level: sub main settings
	$gfforms = $prefix . 'gfforms';							// sub level: forms
		$gfformlist = $prefix . 'gfformlist';					// third level: forms listing
	$gfentries = $prefix . 'gfentries';						// sub level: entries
	$gftpaogfstyler = $prefix . 'gftpaogfstyler';			// sub level third-party add-on: gravity forms styler
	$gfimportexport = $prefix . 'gfimportexport';			// sub level: import/export
	$gfaddonsinstalled = $prefix . 'gfaddonsinstalled';		// sub level: add-ons (dummy)
		$gfaoauthorizenet = $prefix . 'gfaoauthorizenet';		// third level add-on: authorize.net
		$gfaoaweber = $prefix . 'gfaoaweber';					// third level add-on: aweber
		$gfaocampaignmonitor = $prefix . 'gfaocampaignmonitor';	// third level add-on: campaign monitor
		$gfaocoupons = $prefix . 'gfaocoupons';					// third level add-on: coupons
		$gfaofreshbooks = $prefix . 'gfaofreshbooks';			// third level add-on: freshbooks
		$gfaomailchimp = $prefix . 'gfaomailchimp';				// third level add-on: mailchimp
		$gfaopaypal = $prefix . 'gfaopaypal';					// third level add-on: payal
		$gfaopaypalpaymentspro = $prefix . 'gfaopaypalpaymentspro';	// third level add-on: payal payments pro
		$gfaopaypalpro = $prefix . 'gfaopaypalpro';				// third level add-on: payal pro
		$gfaotwilio = $prefix . 'gfaotwilio';					// third level add-on: twilio
		$gfaouserreg = $prefix . 'gfaouserreg';					// third level add-on: user reg.
		$gftpaopideal = $prefix . 'gftpaopideal';				// third level third-party add-on: pronamic ideal
		$gftpaostripe = $prefix . 'gftpaostripe';				// third level third-party add-on: stripe
		$gftpaowysija = $prefix . 'gftpaowysija';				// third level third-party add-on: mp/wysija
		$gftpaoshootq = $prefix . 'gftpaoshootq';				// third level third-party add-on: shootq
		$gftpaoconstantcontact = $prefix . 'gftpaoconstantcontact';	// third level third-party add-on: constant contact
		$gftpaoicontact = $prefix . 'gftpaoicontact';			// third level third-party add-on: icontact
		$gftpaomadmimi = $prefix . 'gftpaomadmimi';				// third level third-party add-on: madmimi
		$gftpaoexacttarget = $prefix . 'gftpaoexacttarget';		// third level third-party add-on: exacttarget
		$gftpaoinfusionsoft = $prefix . 'gftpaoinfusionsoft';	// third level third-party add-on: infusionsoft
		$gftpaoymlp = $prefix . 'gftpaoymlp';					// third level third-party add-on: ymlp
		$gftpaodpspxpay = $prefix . 'gftpaodpspxpay';			// third level third-party add-on: dpspx pay
		$gftpaoqlimit = $prefix . 'gftpaoqlimit';				// third level third-party add-on: quantity limit
		$gftpaobluepay = $prefix . 'gftpaobluepay';				// third level third-party add-on: bluepay
		$gftpaopaystation = $prefix . 'gftpaopaystation';		// third level third-party add-on: paystation
		$gftpaogffdgg = $prefix . 'gftpaogffdgg';				// third level third-party add-on: first data
		$gftpaomarketo = $prefix . 'gftpaomarketo';				// third level third-party add-on: marketo
		$gftpaohighrisecrm = $prefix . 'gftpaohighrisecrm';		// third level third-party add-on: highrise crm
		$gftpaoconvio = $prefix . 'gftpaoconvio';				// third level third-party add-on: convio
		$gftpaohighrisekatz = $prefix . 'gftpaohighrisekatz';	// third level third-party add-on: highrise
		$gftpaogfperiodicmails = $prefix . 'gftpaogfperiodicmails';	// third level third-party add-on: periodic
	$gfextensions = $prefix . 'gfextensions';				// sub level: extensions group
	$extensions = $prefix . 'extensions';					// sub level: extensions (very last main entry)
		$extpideal = $prefix . 'extpideal';						// third level third-party add-on: pronamic ideal
			$extpidealpayments = $prefix . 'extpidealpayments';					// fourth level: ideal payments
			$extpidealconfigurations = $prefix . 'extpidealconfigurations';		// fourth level: ideal configs
		$extgfsolve360 = $prefix . 'extgfsolve360';				// third level third-party add-on: solve360
	$gftpaogravityperks = $prefix . 'gftpaogravityperks';		// third level third-party add-on: gravity perks
		$gfperksgroup = $prefix . 'gfperksgroup';				// third level third-party add-on: gravity perks group
	$gfgroup = $prefix . 'gfgroup';							// sub level: gf group (resources)


	/** Display these items also when Gravity Forms plugin is not installed */
	$menu_items = array();

	/** Display items depending on plugin setting */
	if ( $options[ 'help_and_support' ] && ( defined( 'GFTB_RESOURCES_DISPLAY' ) && GFTB_RESOURCES_DISPLAY ) ) {

		/** Include plugin file with resources links */
		require_once( GFTB_PLUGIN_DIR . 'lib/gftb-resources.php' );

	}  // end if help & support items


	/**
	 * Display these support links only for users who can view Gravity Forms Settings.
	 * Hook in as children of "Support" entry.
	 *
	 * @since 1.1.0
	 */
	if ( current_user_can( 'gravityforms_view_settings' ) || current_user_can( 'gform_full_access' ) ) {

		/** Support at Gravity Help */
		$menu_items[ 'gfregular' ] = array(
			'parent' => $gfsupport,
			'title'  => __( 'Request Support', 'gravity-forms-toolbar' ),
			'href'   => 'http://www.gravityhelp.com/request-support/',
			'meta'   => array( 'title' => __( 'Request Support', 'gravity-forms-toolbar' ) )
		);

		/** Priority support at Gravity Help */
		$menu_items[ 'gfpriority' ] = array(
			'parent' => $gfsupport,
			'title'  => __( 'Priority Support (Dev License Only)', 'gravity-forms-toolbar' ),
			'href'   => 'http://www.gravityhelp.com/priority-support/',
			'meta'   => array( 'title' => __( 'Priority Support (Dev License Only)', 'gravity-forms-toolbar' ) )
		);

		/** User profile at Gravity Help */
		$menu_items[ 'gfuprofile' ] = array(
			'parent' => $gfsupport,
			'title'  => __( 'Your User Profile at Gravity Help', 'gravity-forms-toolbar' ),
			'href'   => 'http://www.gravityhelp.com/forums/profile/',
			'meta'   => array( 'title' => __( 'Your User Profile at Gravity Help', 'gravity-forms-toolbar' ) )
		);

	}  // end if children of support entry


	/** Include plugin file with language specific items/ links */
	if ( ! ddw_gftb_detect_locales( array( 'en_US', 'en_GB', 'en_CA', 'en_NZ', 'en_AU' ) ) ) {

		require_once( GFTB_PLUGIN_DIR . 'lib/gftb-languages.php' );

	}  // end if


	/** Show these items only if Gravity Forms main plugin is actually installed */
	if ( class_exists( 'RGForms' ) ) {

		/** Main Settings */
		if ( current_user_can( 'gravityforms_view_settings' ) || current_user_can( 'gform_full_access' ) ) {

			$menu_items[ 'gfsettings' ] = array(
				'parent' => $gravitybar,
				'title'  => __( 'Plugin Settings', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_settings' ),
				'meta'   => array(
					'target' => '',
					'title'  => _x( 'Plugin Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
				)
			);

			$menu_items[ 'gfs-toolbar' ] = array(
				'parent' => $gfsettings,
				'title'  => __( 'Toolbar Menu', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'options-general.php?page=ddw_gftb_options_page' ),
				'meta'   => array(
					'target' => '',
					'title'  => _x( 'Toolbar Menu', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
				)
			);

			$menu_items[ 'gfs-widgets' ] = array(
				'parent' => $gfsettings,
				'title'  => __( 'Manage Widgets', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'widgets.php' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Manage Widgets', 'gravity-forms-toolbar' )
				)
			);

			/** Check for "Members" plugin + appropiate capabilities, then display settings if activated */
			if ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'members/members.php' ) )
				&& current_user_can( 'edit_roles' )
			) {

				$menu_items[ 'gfs-pmembers' ] = array(
					'parent' => $gfsettings,
					'title'  => __( 'Adjust User Roles &amp; Capabilities (Plugin: Members)', 'gravity-forms-toolbar' ),
					'href'   => admin_url( 'users.php?page=roles' ),
					'meta'   => array(
						'target' => '',
						'title'  => __( 'Adjust User Roles &amp; Capabilities (Plugin: Members)', 'gravity-forms-toolbar' )
					)
				);

			}  // end if members plugin check

			/** Get translated API string */
			$gftb_api_string_l10n = ddw_gftb_l10n_global_string_output( 'Gravity Forms API Settings' );
			$gftb_api_string      = ( ! empty( $gftb_api_string_l10n ) ) ? str_replace( ' ', '+', $gftb_api_string_l10n ) : 'Gravity+Forms+API+Settings';

			/** API Setting */
			$menu_items[ 'gfs-gfapi' ] = array(
				'parent' => $gfsubsettings,
				'title'  => __( 'API Configuration', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_settings&subview=' ) . $gftb_api_string,
				'meta'   => array(
					'target' => '',
					'title'  => __( 'API Configuration', 'gravity-forms-toolbar' )
				)
			);

			/** Uninstall setting */
			$menu_items[ 'gfs-uninstall' ] = array(
				'parent' => $gfsubsettings,
				'title'  => __( 'Uninstall', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_settings&subview=uninstall' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Uninstall', 'gravity-forms-toolbar' )
				)
			);

		}  // end if main settings

		/** Edit Forms */
		if ( current_user_can( 'gravityforms_edit_forms' ) || current_user_can( 'gform_full_access' ) ) {

			$menu_items[ 'gfforms' ] = array(
				'parent' => $gravitybar,
				'title'  => __( 'Edit Forms', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_edit_forms' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Edit Forms', 'gravity-forms-toolbar' )
				)
			);

		}  // end if

		/** Add New Forms */
		if ( current_user_can( 'gravityforms_create_form' ) || current_user_can( 'gform_full_access' ) ) {

			$menu_items[ 'gff-add-form' ] = array(
				'parent' => $gfforms,
				'title'  => __( 'Add new Form', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_new_form' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Add new Form', 'gravity-forms-toolbar' )
				)
			);

		}  // end if

		/**
		 * Dynamically add existing Forms and/or Entries at their sub-levels
		 *
		 * @since 1.2.0
		 */
		if ( ! empty( $forms ) ) {

				$class_first = 'ddw_gftb-first-form';

				foreach ( $forms as $form ) {

					$view_title = $form[ 'title' ];

					if ( $form[ 'unread_count' ] > 0 ) {

						$count+= $form[ 'unread_count' ];
						$view_title .= ' (' . $form[ 'unread_count' ] . ')';

					}  // end if

					/** Hook in existing Forms at "Form" entry */
					$menu_items[ 'gff-edit-form-' . $form[ 'id' ] ] = array(
						'parent' => $gfformlist,
						'title'  => $form[ 'title' ],
						'href'   => admin_url( 'admin.php?page=gf_edit_forms&id=' . $form[ 'id' ] ),
						'meta'   => array(
							'class'  => $class_first,
							'target' => '',
							'title'  => $form[ 'title' ]
						)
					);

					/** Hook in existing Form Entries at "Entries" entry */
					$menu_items[ 'gff-view-form-entries-' . $form[ 'id' ] ] = array(
						'parent' => $gfentries,
						'title'  => $view_title,
						'href'   => admin_url( 'admin.php?page=gf_entries&view=entries&id=' . $form[ 'id' ] ),
						'meta'   => array(
							'class'  => $class_first,
							'target' => '',
							'title'  => $form['title']
						)
					);

					$class_first = '';

				}  // end foreach

		}  // end if !empty forms


		/** View Entries */
		if ( current_user_can( 'gravityforms_view_entries' ) || current_user_can( 'gform_full_access' ) ) {

			$menu_items[ 'gfentries' ] = array(
				'parent' => $gravitybar,
				'title'  => __( 'View Entries', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_entries' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'View Entries', 'gravity-forms-toolbar' )
				)
			);

		}  // end if view entries


		/**
		 * Gravity Forms Styler (premium, by WordPress Gurus)
		 *
		 * @since 1.6.1
		 */
		if ( class_exists( 'Gravity_Forms_Styler' ) ) {

			/** Include code part for Gravity Forms Styler plugin support */
			require_once( GFTB_PLUGIN_DIR . 'lib/gftb-plugins-gravityformsstyler.php' );

		}  // end if GF Styler


		/** Import & Export stuff */
		if ( current_user_can( 'gravityforms_export_entries' ) || current_user_can( 'gform_full_access' ) ) {

			$menu_items[ 'gfimportexport' ] = array(
				'parent' => $gravitybar,
				'title'  => __( 'Import & Export', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Import & Export', 'gravity-forms-toolbar' )
				)
			);

			$menu_items[ 'gfie-entries-export' ] = array(
				'parent' => $gfimportexport,
				'title'  => __( 'Export Entries', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export&view=export_entry' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Export Entries', 'gravity-forms-toolbar' )
				)
			);

			$menu_items[ 'gfie-forms-export' ] = array(
				'parent' => $gfimportexport,
				'title'  => __( 'Export Forms', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export&view=export_form' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Export Forms', 'gravity-forms-toolbar' )
				)
			);

			$menu_items[ 'gfie-forms-import' ] = array(
				'parent' => $gfimportexport,
				'title'  => __( 'Import Forms', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export&view=import_form' ),
				'meta'   => array(
					'target' => '',
					'title'  => __( 'Import Forms', 'gravity-forms-toolbar' )
				)
			);

		}  // end if import/export


		/** Official Add-Ons */
		if ( $options[ 'add_ons' ] && ( defined( 'GFTB_ADDONS_DISPLAY' ) && GFTB_ADDONS_DISPLAY ) ) {

			/** Include plugin file with add-on support links */
			require_once( GFTB_PLUGIN_DIR . 'lib/gftb-addons.php' );

		}  // end of Add-On level entry - back to more main level entries:


		/**
		 * Gravity Perks (premium, by David Smith/ gravitywiz.com)
		 *
		 * @since 1.6.0
		 */
		if ( class_exists( 'GWPerks' ) ) {

			/** Include code part for Gravity Perks plugin support */
			require_once( GFTB_PLUGIN_DIR . 'lib/gftb-plugins-gravityperks.php' );

		}  // end if Gravity Perks


		/** Updates */
		if ( current_user_can( 'gravityforms_view_updates' ) || current_user_can( 'gform_full_access' ) ) {

			$update_title = $update ? __( 'Update Is Available', 'gravity-forms-toolbar' ) : __( 'Check for Update', 'gravity-forms-toolbar' );
			$update_class = $update ? 'ddw_gftb-update-available' : '';

			$menu_items[ 'gfupdates' ] = array(
				'parent' => $gravitybar,
				'title'  => $update_title,
				'href'   => admin_url( 'admin.php?page=gf_update' ),
				'meta'   => array(
					'class'  => $update_class,
					'target' => '',
					'title'  => $update_title
				)
			);

		}  // end if updates


		/** Help (for all capabalities) */
		$menu_items[ 'gfhelp' ] = array(
			'parent' => $gravitybar,
			'title'  => __( 'Help &amp; Links', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_help' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Help &amp; Links', 'gravity-forms-toolbar' )
			)
		);
		 

		/**
		 * Display last main item in the menu for active extensions/plugins
		 * ATTENTION: This is where plugins/extensions hook in on the sub-level hierarchy
		 *
		 * @since 1.0.0
		 */       
		if ( $options[ 'extensions' ] && ( defined( 'GFTB_EXTENSIONS_DISPLAY' ) && GFTB_EXTENSIONS_DISPLAY ) ) {

			$menu_items[ 'extensions' ] = array(
					'parent' => $gfextensions,
					'title'  => __( 'Active Extensions', 'gravity-forms-toolbar' ),
					'href'   => is_network_admin() ? network_admin_url( 'plugins.php' ) : admin_url( 'plugins.php' ),
					'meta'   => array(
						'target' => '',
						'title'  => __( 'Active Extensions', 'gravity-forms-toolbar' )
					)
			);

		}  // end if extensions

		/**
		 * Action Hook 'gftb_custom_extension_items'
		 * allows for hooking other extension-related items in
		 *
		 * @since 1.4.0
		 */
		do_action( 'gftb_custom_extension_items' );

	} else {

		/** If Gravity Forms is not active, to avoid PHP notices */
		$menu_items = $gfgroup_menu_items;

		/** If Gravity Forms is not active and no icon filter is active, then display no icon */
		if ( ! has_filter( 'gftb_filter_main_icon' ) ) {

			add_filter( 'gftb_filter_main_item_icon_display', '__gftb_no_icon_display' );

		}

	}  // end if Gravity Forms conditional (if it is active!)


	/**
	 * Display links to active plugins/extensions settings' pages
	 *
	 * @since 1.0.0
	 */
	/** Include plugin file with plugin support links */
	require_once( GFTB_PLUGIN_DIR . 'lib/gftb-plugins.php' );


	/** Allow menu items to be filtered, but pass in parent menu item IDs */
	$menu_items = (array) apply_filters( 'ddw_gftb_menu_items', $menu_items,
									$prefix,
									$gravitybar,
									$gfsupport,
									$gfdocs,
									$gffaq,
									$gfsites,
									$gfsettings,
										$gfsubsettings,
									$gfforms,
										$gfformlist,
									$gfentries,
									$gfimportexport,
									$gfaddonsinstalled,
										$gfaoauthorizenet,
										$gfaoaweber,
										$gfaocampaignmonitor,
										$gfaocoupons,
										$gfaofreshbooks,
										$gfaomailchimp,
										$gfaopaypal,
										$gfaopaypalpaymentspro,
										$gfaopaypalpro,
										$gfaotwilio,
										$gfaouserreg,
										$gftpaopideal,
										$gftpaostripe,
										$gftpaowysija,
										$gftpaoshootq,
										$gftpaoconstantcontact,
										$gftpaoicontact,
										$gftpaomadmimi,
										$gftpaoexacttarget,
										$gftpaoinfusionsoft,
										$gftpaoymlp,
										$gftpaodpspxpay,
										$gftpaoqlimit,
										$gftpaobluepay,
										$gftpaopaystation,
										$gftpaogffdgg,
										$gftpaomarketo,
										$gftpaohighrisecrm,
										$gftpaoconvio,
										$gftpaohighrisekatz,
										$gftpaogfperiodicmails,
									$gfextensions,
									$extensions,
										$extpideal,
											$extpidealpayments,
											$extpidealconfigurations,
										$extgfsolve360,
									$gftpaogravityperks,
									$gftpaogfstyler,
									$gfgroup
	);  // end of array


	/**
	 * Top level title, unread entries count display/styling, plus update info/check
	 *
	 * @since 1.0.0
	 */
	/** Main item menu title */
	$menu_item_title = apply_filters(
		'gftb_filter_main_item',
		__( 'Gravity Forms', 'gravity-forms-toolbar' )
	);

	/** Filter the main item name's tooltip */
	$gftb_main_item_title_tooltip = apply_filters(
		'gftb_filter_main_item_tooltip',
		_x( 'Gravity Forms', 'Translators: Main item - for the tooltip', 'gravity-forms-toolbar' )
	);

	/** Filter the main item icon's class/display */
	$gftb_main_item_icon_display = apply_filters(
		'gftb_filter_main_item_icon_display', 'icon-gravityforms'
	);

	/** CSS styling */
	$css = 'background: none repeat scroll 0 0 #EEEEEE; border-radius: 10px 10px 10px 10px; color: #333333; display: inline; font-size: 10px; font-weight: bold; padding: 2px 5px; text-shadow: none;';

	/** Menu URL */
	$menu_item_url = defined( 'GF_MIN_WP_VERSION' ) ? admin_url( 'admin.php?page=gf_edit_forms' ) : FALSE;

	/** Logic for unread entries */
	if ( $options[ 'unread_notification' ] && $count > 0 ) {

		$to_add = sprintf( ' <span style="%s">%s</span>', $css, $count );
		$menu_item_title .= '<span title="' . __( 'Unread Entries', 'gravity-forms-toolbar' ) . '">' . $to_add . '</span>';

	}  // end if

	/** Logic for updates */
	if ( $update ) {

		$to_add = sprintf( ' <span style="%s">U</span>', $css );
		$menu_item_title .= '<span title="' . __( 'Update Is Available', 'gravity-forms-toolbar' ) . '">' . $to_add . '</span>';
		$menu_item_url = admin_url( 'admin.php?page=gf_update' );

	}  // end if

	/** Add the Gravity Forms top-level menu item */
	$wp_admin_bar->add_node( array(
		'id'    => $gravitybar,
		'title' => $menu_item_title,
		'href'  => $menu_item_url,
		'meta'  => array(
			'class' => esc_attr( $gftb_main_item_icon_display ),
			'title' => esc_attr__( $gftb_main_item_title_tooltip )
		)
	) );


	/** Loop through the (main) menu items */
	foreach ( $menu_items as $id => $menu_item ) {
		
		/** Add in the item ID */
		$menu_item[ 'id' ] = $prefix . $id;

		/** Add meta target to each item where it's not already set, so links open in new window/tab */
		if ( ! isset( $menu_item[ 'meta' ][ 'target' ] ) ) {

			$menu_item[ 'meta' ][ 'target' ] = '_blank';

		}  // end if

		/** Add class to links that open up in a new window/tab */
		if ( '_blank' === $menu_item[ 'meta' ][ 'target' ] ) {

			if ( ! isset( $menu_item[ 'meta' ][ 'class' ] ) ) {

				$menu_item[ 'meta' ][ 'class' ] = '';

			}  // end if

			$menu_item[ 'meta' ][ 'class' ] .= $prefix . 'gftb-new-tab';

		}  // end if

		/** Add menu items */
		$wp_admin_bar->add_node( $menu_item );

	}  // end foreach


	/**
	 * Add sub group for Gravity Forms settings
	 *
	 * @since 1.6.0
	 */
	$wp_admin_bar->add_group( array(
		'parent' => $gfsettings,
		'id'     => $gfsubsettings
	) );


	/**
	 * Add sub group for Gravity Perks Add-On
	 *
	 * @since 1.6.0
	 */
	$wp_admin_bar->add_group( array(
		'parent' => $gftpaogravityperks,
		'id'     => $gfperksgroup
	) );


	/**
	 * Action Hook 'gftb_custom_main_items'
	 * allows for hooking other main items in
	 *
	 * @since 1.4.0
	 */
	do_action( 'gftb_custom_main_items' );


	/**
	 * Add sub group for Extension Plugins.
	 *
	 * @since 1.6.0
	 */
	$wp_admin_bar->add_group( array(
		'parent' => $gravitybar,
		'id'     => $gfextensions
	) );


	/**
	 * Add sub group for forms listings.
	 *
	 * @since 1.6.0
	 */
	$wp_admin_bar->add_group( array(
		'parent' => $gfforms,
		'id'     => $gfformlist,
		'meta'   => array( 'class' => 'ab-sub-secondary' )
	) );


	/**
	 * Add resource links group.
	 *
	 * @since 1.3.0
	 */
	$wp_admin_bar->add_group( array(
		'parent' => $gravitybar,
		'id'     => $gfgroup,
		'meta'   => array( 'class' => 'ab-sub-secondary' )
	) );


	/** Gravity Forms Group: Loop through the resources group menu items */
	foreach ( $gfgroup_menu_items as $id => $gfgroup_menu_item ) {
	
		/** Gravity Forms Group: Add in the item ID */
		$gfgroup_menu_item[ 'id' ] = $prefix . $id;

		/**
		 * Gravity Forms Group: Add meta target to each item where it's not
		 *    already set, so links open in new window/tab
		 */
		if ( ! isset( $gfgroup_menu_item[ 'meta' ][ 'target' ] ) ) {

			$gfgroup_menu_item[ 'meta' ][ 'target' ] = '_blank';

		}  // end if

		/** Gravity Forms Group: Add class to links that open up in a new window/tab */
		if ( '_blank' === $gfgroup_menu_item[ 'meta' ][ 'target' ] ) {

			if ( ! isset( $gfgroup_menu_item[ 'meta' ][ 'class' ] ) ) {

				$gfgroup_menu_item[ 'meta' ][ 'class' ] = '';

			}  // end if

			$gfgroup_menu_item[ 'meta' ][ 'class' ] .= $prefix . 'gftb-new-tab';

		}  // end if

		/** Gravity Forms Group: Add menu items */
		$wp_admin_bar->add_node( $gfgroup_menu_item );

	}  // end foreach Gravity Forms Group


	/**
	 * Action Hook 'gftb_custom_group_items'
	 * allows for hooking other Gravity Forms Group items in
	 *
	 * @since 1.4.0
	 */
	do_action( 'gftb_custom_group_items' );

}  // end of main function


add_action( 'wp_head', 'ddw_gftb_admin_style' );
add_action( 'admin_head', 'ddw_gftb_admin_style' );
/**
 * Add the styles for new WordPress Toolbar / Admin Bar entry
 * 
 * @since 1.0.0
 *
 * @uses  is_admin_bar_showing()
 * @uses  is_user_logged_in()
 * @uses  GFTB_DISPLAY
 */
function ddw_gftb_admin_style() {

	/** No styles if admin bar is disabled or user is not logged in or items are disabled via constant */
	if ( ! is_admin_bar_showing()
		|| ! is_user_logged_in()
		|| ( defined( 'GFTB_DISPLAY' ) && ! GFTB_DISPLAY )
	) {

		return;

	}  // end if

	/** Add CSS styles to wp_head/admin_head */
	$gftb_main_icon = apply_filters(
		'gftb_filter_main_icon',
		plugins_url( '/gravity-forms-toolbar/images/gravityforms-icon.png', dirname( __FILE__ ) )
	);

	?>
		<style type="text/css">
			#wpadminbar.nojs .ab-top-menu > li.menupop.icon-gravityforms:hover > .ab-item,
			#wpadminbar .ab-top-menu > li.menupop.icon-gravityforms.hover > .ab-item,
			#wpadminbar.nojs .ab-top-menu > li.menupop.icon-gravityforms > .ab-item,
			#wpadminbar .ab-top-menu > li.menupop.icon-gravityforms > .ab-item {
				background-image: url(<?php echo $gftb_main_icon; ?>);
				background-repeat: no-repeat;
				background-position: 0.85em 50%;
				padding-left: 30px;
			}
			#wp-admin-bar-ddw-gravityforms-languages-de > a:before,
			#wp-admin-bar-ddw-gravityforms-languages-nl > a:before,
			#wp-admin-bar-ddw-gravityforms-languages-es > a:before {
				content: '• ';
				/*vertical-align: middle;*/
				margin-top: -2px;
			}
			#wp-admin-bar-ddw-gravityforms-toolbar-default li:first-child {
				border-top: none !important;
			}
			.ddw_gftb-update-available a {
				font-weight: bold !important;
			}
		</style>
	<?php

}  // end of function ddw_gftb_admin_style


/**
 * Gravity Forms version compare for update check.
 *
 * @since  1.3.0
 *
 * @uses   GFCommon::get_version_info()
 *
 * @return version string
 */
function ddw_gftb_update_available() {

	/** Check if Gravity Forms is active - class 'GFCommon' available */
	if ( class_exists( 'GFCommon' ) ) {

		$version_info = GFCommon::get_version_info();

		return version_compare( GFCommon::$version, $version_info[ "version" ], '<' );

	}  // end if class check

}  // end of function ddw_gftb_update_available


/**
 * Helper functions for custom branding of the plugin
 *
 * @since 1.4.0
 */
	/** Include plugin file with special custom stuff */
	require_once( GFTB_PLUGIN_DIR . 'lib/gftb-branding.php' );


/**
 * Returns current plugin's header data in a flexible way.
 *
 * @since  1.5.0
 *
 * @uses   get_plugins()
 *
 * @param  $gftb_plugin_value
 *
 * @return string String of plugin data.
 */
function ddw_gftb_plugin_get_data( $gftb_plugin_value ) {

	/** Bail early if we are not in wp-admin */
	if ( ! is_admin() ) {

		return;

	}  // end if

	/** Include WordPress plugin data */
	if ( ! function_exists( 'get_plugins' ) ) {

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	}  // end if

	$gftb_plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$gftb_plugin_file = basename( ( __FILE__ ) );

	return $gftb_plugin_folder[ $gftb_plugin_file ][ $gftb_plugin_value ];

}  // end of function ddw_gftb_plugin_get_data