<?php
/**
 * Display links to active plugins/extensions settings' pages: Pronamic iDEAL.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Plugin/Extension Support
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.0.0
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
 * Pronamic iDEAL settings pages (free, by Pronamic)
 *
 * @since 1.0.0
 */
/** Entries at "Add-Ons" level submenu - Feed items */
if ( current_user_can( 'gravityforms_ideal' ) || current_user_can( 'gform_full_access' ) ) {

	$menu_items[ 'gftpaopideal' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'iDEAL Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=pronamic_pay_gf' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'iDEAL Feeds', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'gftpaopideal-newfeed' ] = array(
			'parent' => $gftpaopideal,
			'title'  => $gftb_new_feed_string,
			'href'   => admin_url( 'post-new.php?post_type=pronamic_pay_gf' ),
			'meta'   => array(
				'target' => '',
				'title'  => $gftb_new_feed_string
			)
		);

	if ( current_user_can( 'pronamic_ideal_settings' ) ) {

		$menu_items[ 'gftpaopideal-settings' ] = array(
			'parent' => $gftpaopideal,
			'title'  => __( 'Pronamic iDEAL Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_pay_settings' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Pronamic iDEAL Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

}  // end if


/** Entries at "Extensions" level submenu */
if ( current_user_can( 'pronamic_ideal' )
	&& ( current_user_can( 'gravityforms_ideal' ) || current_user_can( 'gform_full_access' ) )
) {

	$menu_items[ 'extpideal' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Pronamic iDEAL Payment Gateway', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=pronamic_ideal' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Pronamic iDEAL Payment Gateway', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'ext-pideal-feeds' ] = array(
		'parent' => $extpideal,
		'title'  => __( 'iDEAL Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=pronamic_pay_gf' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'iDEAL Feeds', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'ext-pideal-newfeed' ] = array(
			'parent' => $extpideal,
			'title'  => $gftb_new_feed_string,
			'href'   => admin_url( 'post-new.php?post_type=pronamic_pay_gf' ),
			'meta'   => array(
				'target' => '',
				'title'  => $gftb_new_feed_string
			)
		);

	/** Dashboard */
	$menu_items[ 'ext-pideal-dashboard' ] = array(
		'parent' => $extpideal,
		'title'  => __( 'Dashboard', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=pronamic_ideal' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Dashboard', 'gravity-forms-toolbar' )
		)
	);

	/** Payments */
	$menu_items[ 'extpidealpayments' ] = array(
		'parent' => $extpideal,
		'title'  => __( 'Payments', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=pronamic_payment' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Payments', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'extpidealpayments-new' ] = array(
			'parent' => $extpidealpayments,
			'title'  => __( 'Add new Payment', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'post-new.php?post_type=pronamic_payment' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Payment', 'gravity-forms-toolbar' )
			)
		);

	/** Configurations */
	$menu_items[ 'extpidealconfigurations' ] = array(
		'parent' => $extpideal,
		'title'  => __( 'Configurations', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=pronamic_gateway' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Configurations', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'extpidealconfigurations-new' ] = array(
			'parent' => $extpidealconfigurations,
			'title'  => __( 'Add new Gateway', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'post-new.php?post_type=pronamic_gateway' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Gateway', 'gravity-forms-toolbar' )
			)
		);

	/** Pay Settings */
	if ( current_user_can( 'pronamic_ideal_settings' ) ) {

		$menu_items[ 'ext-pideal-paysettings' ] = array(
			'parent' => $extpideal,
			'title'  => __( 'Pay Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_pay_settings' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Pay Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

	/** System Status */
	if ( current_user_can( 'pronamic_ideal_status' ) ) {

		$menu_items[ 'ext-pideal-systemstatus' ] = array(
			'parent' => $extpideal,
			'title'  => __( 'System Status', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_pay_system_status' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'System Status', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

	/** iDEAL Status */
	if ( current_user_can( 'pronamic_ideal_status' ) ) {

		$menu_items[ 'ext-pideal-idealstatus' ] = array(
			'parent' => $extpideal,
			'title'  => __( 'iDEAL Status', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_ideal_status' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'iDEAL Status', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

	/** Gateways */
	$menu_items[ 'ext-pideal-gateways' ] = array(
		'parent' => $extpideal,
		'title'  => __( 'Gateways', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=pronamic_pay_gateways' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Gateways', 'gravity-forms-toolbar' )
		)
	);

	/** Extensions */
	$menu_items[ 'ext-pideal-extensions' ] = array(
		'parent' => $extpideal,
		'title'  => __( 'Extensions', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=pronamic_pay_extensions' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Extensions', 'gravity-forms-toolbar' )
		)
	);

	/** Documentation */
	if ( current_user_can( 'pronamic_ideal_documentation' ) ) {

		$menu_items[ 'ext-pideal-documentation' ] = array(
			'parent' => $extpideal,
			'title'  => __( 'Documentation', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_pay_documentation' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Documentation', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

	/** Branding */
	if ( current_user_can( 'pronamic_ideal_branding' ) ) {

		$menu_items[ 'ext-pideal-branding' ] = array(
			'parent' => $extpideal,
			'title'  => __( 'Branding', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_pay_branding' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Branding', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

	/** Pages Generator */
	if ( current_user_can( 'pronamic_ideal_pages_generator' ) ) {

		$menu_items[ 'ext-pideal-pages-generator' ] = array(
			'parent' => $extpideal,
			'title'  => __( 'Pages Generator', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_ideal_pages_generator' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Pages Generator', 'gravity-forms-toolbar' )
			)
		);

	}  // end if

}  // end if pronamic cap check