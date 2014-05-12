<?php
/**
 * Various helper functions.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Functions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.7.0
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Helper function for detecting an array of specific locales.
 *
 * @since 1.7.0
 *
 * @param array $locales Array of various locale IDs.
 *
 * @uses  get_locale()
 *
 * @return bool Returns TRUE if locales are currently active, otherwise FALSE.
 */
function ddw_gftb_detect_locales( $locales ) {
	
	return ( in_array( get_locale(), (array) $locales ) ) ? TRUE : FALSE;

}  // end of function ddw_gftb_detect_locales


/**
 * Get a certain translated string from the 'gravityforms' textdomain.
 *
 * @since  1.6.0
 *
 * @param  string $string Original English string.
 *
 * @return string Translated string from the original English string.
 *
 * @global mixed $l10n
 */
function ddw_gftb_l10n_global_string_output( $string = '' ) {

	global $l10n;

	$gftb_output = '';

	/** Get the translated string from the global variable */
	if ( isset( $l10n[ 'gravityforms' ] )
			&& isset( $l10n[ 'gravityforms' ]->entries[ $string ] )
	) {

		$gftb_output = $l10n[ 'gravityforms' ]->entries[ $string ]->translations[0];

	}  // end if

	/** Return the found string for further operations... */
	return $gftb_output;

}  // end of function ddw_gftb_l10n_global_string_output


/**
 * Setting internal plugin helper values.
 *
 * @since  1.6.0
 *
 * @uses   get_locale()
 *
 * @return array Array of info values, boolean or string.
 */
function ddw_gftb_info_values() {

	/** Array of values */
	$gftb_info = array(

		'url_translate'     => 'http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/gravity-forms-toolbar',
		'url_wporg_faq'     => 'http://wordpress.org/plugins/gravity-forms-toolbar/faq/',
		'url_wporg_forum'   => 'http://wordpress.org/support/plugin/gravity-forms-toolbar',
		'url_wporg_profile' => 'http://profiles.wordpress.org/daveshine/',
		'url_suggestions'   => 'https://twitter.com/deckerweb',
		'url_snippets'      => 'https://gist.github.com/deckerweb/2732242',
		'license'           => 'GPL-2.0+',
		'url_license'       => 'http://www.opensource.org/licenses/gpl-license.php',
		'first_release'     => absint( '2012' ),
		'url_donate'        => ddw_gftb_detect_locales( array( 'de_DE', 'de_AT', 'de_CH', 'de_LU', 'gsw' ) ) ? 'http://genesisthemes.de/spenden/' : 'http://genesisthemes.de/en/donate/',
		'url_plugin'        => ddw_gftb_detect_locales( array( 'de_DE', 'de_AT', 'de_CH', 'de_LU', 'gsw' ) ) ? 'http://genesisthemes.de/plugins/gravity-forms-toolbar/' : 'http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/',
		'de_plugin'         => '',
		'de_files'          => 'http://deckerweb.de/sprachdateien/gravityforms-und-addons/',
		'nl_plugin'         => 'http://wordpress.org/plugins/gravityforms-nl/',
		'es_plugin'         => 'http://wordpress.org/plugins/gravityforms-es/',
		'is_german'         => ddw_gftb_detect_locales( array( 'de_DE', 'de_AT', 'de_CH', 'de_LU', 'gsw' ) ) ? TRUE : FALSE,
		'is_dutch'          => ddw_gftb_detect_locales( array( 'nl', 'nl_NL' ) ) ? TRUE : FALSE,
		'is_spanish'        => ddw_gftb_detect_locales( array( 'es_ES', 'es_PE' ) ) ? TRUE : FALSE,

	);  // end of array

	/** Output the array */
	return $gftb_info;

}  // end of function ddw_gftb_info_values