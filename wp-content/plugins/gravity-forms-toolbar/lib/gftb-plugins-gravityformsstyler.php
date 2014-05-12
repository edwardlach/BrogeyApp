<?php
/**
 * Display links to active plugins/ extensions settings' pages: Gravity Forms Styler.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Plugin/Extension Support
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.7.0
 */

/**
 * Exit if accessed directly.
 *
 * @since 1.7.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Gravity Forms Styler (premium, by WordPress Gurus via CodeCanyon Marketplace)
 *
 * @since 1.7.0
 */
if ( current_user_can( 'edit_posts' ) ) {

	/** Main level entry */
	$menu_items[ 'gftpaogfstyler' ] = array(
		'parent' => $gravitybar,
		'title'  => __( 'Forms Styler', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=gravity_forms_styler' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Gravity Forms Styler', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'gftpaogfstyler-all' ] = array(
			'parent' => $gftpaogfstyler,
			'title'  => __( 'All Forms Styles', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'edit.php?post_type=gravity_forms_styler' ),
			'meta'   => array(
				'target' => '',
				'title'  => _x( 'All Forms Styles', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gftpaogfstyler-new' ] = array(
			'parent' => $gftpaogfstyler,
			'title'  => __( 'Add new Form Style', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'post-new.php?post_type=gravity_forms_styler' ),
			'meta'   => array(
				'target' => '',
				'title'  => _x( 'Add new Form Style', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
			)
		);

}  // end if cap check