<?php
/**
 * Language resource items.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Languages Support
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.0.0
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/** Get info values from our central helper function */
$gftb_info = (array) ddw_gftb_info_values();


/** Display links to language packs only for these locales: de_DE, de_AT, de_CH, de_LU */
if ( ( defined( 'GFTB_DE_DISPLAY' ) && GFTB_DE_DISPLAY )
	&& ddw_gftb_detect_locales( array( 'de_DE', 'de_AT', 'de_CH', 'de_LU', 'gsw' ) )
) {

	$gfgroup_menu_items[ 'languages-de' ] = array(
		'parent' => $gfgroup,
		'title'  => __( 'German language files', 'gravity-forms-toolbar' ),
		'href'   => esc_url( $gftb_info[ 'de_files' ] ),
		'meta'   => array(
			'title' => __( 'German language files for Gravity Forms and Add-Ons', 'gravity-forms-toolbar' )
		)
	);

}  // end if German locale


/** Display links to language plugin only for this locale: nl, nl_NL - and when NL plugin not active */
if ( ( defined( 'GFTB_NL_DISPLAY' ) && GFTB_NL_DISPLAY )
	&& ( ddw_gftb_detect_locales( array( 'nl', 'nl_NL' ) ) && ! class_exists( 'GravityFormsNLPlugin' ) )
) {

	$gfgroup_menu_items[ 'languages-nl' ] = array(
		'parent' => $gfgroup,
		'title'  => __( 'Dutch language plugin', 'gravity-forms-toolbar' ),
		'href'   => esc_url( $gftb_info[ 'nl_plugin' ] ),
		'meta'   => array(
			'title' => __( 'Dutch language plugin for Gravity Forms - with complete translations!', 'gravity-forms-toolbar' )
		)
	);

}  // end if Dutch locale


/** Display links to language plugin only for this locale: es_ES, es_PE - and when ES plugin not active */
if ( ( defined( 'GFTB_ES_DISPLAY' ) && GFTB_ES_DISPLAY )
	&& ( ddw_gftb_detect_locales( array( 'es_ES', 'es_PE' ) ) && ! class_exists( 'GravityFormsESPlugin' ) )
) {

	$gfgroup_menu_items[ 'languages-es' ] = array(
		'parent' => $gfgroup,
		'title'  => __( 'Spanish language plugin', 'gravity-forms-toolbar' ),
		'href'   => esc_url( $gftb_info[ 'es_plugin' ] ),
		'meta'   => array(
			'title' => _x( 'Spanish language plugin for Gravity Forms - with complete translations!', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if Spanish locale