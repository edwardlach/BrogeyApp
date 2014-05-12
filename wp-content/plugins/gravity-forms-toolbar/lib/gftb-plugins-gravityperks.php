<?php
/**
 * Display links to active plugins/ extensions settings' pages: Gravity Perks.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Plugin/Extension Support
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.6.0
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
 * Gravity Perks (premium, by David Smith/ gravitywiz.com)
 *
 * @since 1.6.0
 */
if ( current_user_can( 'administrator' ) ) {

	/** Main level entry */
	$menu_items[ 'gftpaogravityperks' ] = array(
		'parent' => $gravitybar,
		'title'  => __( 'Gravity Perks', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gwp_perks' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Gravity Ṕerks - Bonus Functionality', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'gftpaogravityperks-manage' ] = array(
			'parent' => $gftpaogravityperks,
			'title'  => __( 'Manage', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gwp_perks' ),
			'meta'   => array(
				'target' => '',
				'title'  => _x( 'Manage Ṕerks', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
			)
		);

	/** Perk: "Email Users" */
	if ( class_exists( 'GWEmailUsers' )
		&& ( current_user_can( 'gravityperks_gwemailusers' ) || current_user_can( 'gform_full_access' ) )
	) {

		$menu_items[ 'gftpaogravityperks-emailusers' ] = array(
			'parent' => $gftpaogravityperks,
			'title'  => __( 'Email Users', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gwp_email_users' ),
			'meta'   => array(
				'target' => '',
				'title'  => _x( 'Email Users of a Specific Form', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
			)
		);

	}  // end if cap check


	/** Perks Group: Extra items */
	$gftb_perk_string = __( 'Perks', 'gravity-forms-toolbar' ) . ': ';
	$gftb_gf_string   = __( 'Gravity Forms', 'gravity-forms-toolbar' ) . ': ';

	if ( current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) ) {

		$menu_items[ 'gfperksgroup-settings' ] = array(
			'parent' => $gfperksgroup,
			'title'  => $gftb_perk_string . __( 'Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&subview=Perks' ),
			'meta'   => array(
				'target' => '',
				'title'  => $gftb_perk_string . __( 'Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if cap check

	$menu_items[ 'gfperksgroup-docs' ] = array(
		'parent' => $gfperksgroup,
		'title'  => $gftb_perk_string . _x( 'Documentation', 'Translators: Gravity Perks docs', 'gravity-forms-toolbar' ),
		'href'   => 'http://gravitywiz.com/documentation/',
		'meta'   => array( 'title' => $gftb_perk_string . _x( 'Documentation', 'Translators: Gravity Perks docs', 'gravity-forms-toolbar' ) )
	);

	$menu_items[ 'gfperksgroup-support' ] = array(
		'parent' => $gfperksgroup,
		'title'  => $gftb_perk_string . _x( 'Support', 'Translators: Gravity Perks support', 'gravity-forms-toolbar' ),
		'href'   => 'http://gravitywiz.com/support/',
		'meta'   => array( 'title' => $gftb_perk_string . _x( 'Support', 'Translators: Gravity Perks support', 'gravity-forms-toolbar' ) )
	);

	$menu_items[ 'gfperksgroup-tutorials' ] = array(
		'parent' => $gfperksgroup,
		'title'  => $gftb_gf_string . _x( 'Tutorials', 'Translators: Gravity Perks tutorials', 'gravity-forms-toolbar' ),
		'href'   => 'http://gravitywiz.com/category/tutorials/',
		'meta'   => array( 'title' => $gftb_gf_string . _x( 'Tutorials', 'Translators: Gravity Perks tutorials', 'gravity-forms-toolbar' ) )
	);

	$menu_items[ 'gfperksgroup-snippets' ] = array(
		'parent' => $gfperksgroup,
		'title'  => $gftb_gf_string . _x( 'Snippets', 'Translators: Gravity Perks snippets', 'gravity-forms-toolbar' ),
		'href'   => 'http://gravitywiz.com/category/snippets/',
		'meta'   => array( 'title' => $gftb_gf_string . _x( 'Code Snippets', 'Translators: Gravity Perks snippets', 'gravity-forms-toolbar' ) )
	);

}  // end if cap check