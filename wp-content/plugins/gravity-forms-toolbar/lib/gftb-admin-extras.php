<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Admin
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
 * Add "Settings" link to plugin page.
 *
 * @since  1.4.0
 *
 * @param  $gftb_links
 * @param  $gftb_settings_link
 *
 * @return strings settings link
 */
function ddw_gftb_settings_page_link( $gftb_links ) {

	/** Plugin's settings page link */
	$gftb_settings_link = sprintf(
		'<a href="%s" title="%s">%s</a>',
		admin_url( 'options-general.php?page=ddw_gftb_options_page' ),
		esc_html__( 'Go to the settings page', 'gravity-forms-toolbar' ),
		esc_attr__( 'Settings', 'gravity-forms-toolbar' )
	);

	/** Set the order of the links */
	array_unshift( $gftb_links, $gftb_settings_link );

	/** Display plugin settings links */
	return apply_filters( 'gftb_filter_settings_page_link', $gftb_links );

}  // end of function ddw_gftb_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_gftb_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since  1.0.0
 *
 * @uses   ddw_gftb_info_values()
 *
 * @param  $gftb_links
 * @param  $gftb_file
 *
 * @return strings plugin links
 */
function ddw_gftb_plugin_links( $gftb_links, $gftb_file ) {

	/** Capability check */
	if ( ! current_user_can( 'install_plugins' ) ) {

		return $gftb_links;

	}  // end if cap check

	/** List additional links only for this plugin */
	if ( $gftb_file == GFTB_PLUGIN_BASEDIR . 'gravity-forms-toolbar.php' ) {

		$gftb_info = (array) ddw_gftb_info_values();

		$gftb_links[] = '<a href="' . esc_url( $gftb_info[ 'url_wporg_faq' ] ) . '" target="_new" title="' . __( 'FAQ', 'gravity-forms-toolbar' ) . '">' . __( 'FAQ', 'gravity-forms-toolbar' ) . '</a>';

		$gftb_links[] = '<a href="' . esc_url( $gftb_info[ 'url_wporg_forum' ] ) . '" target="_new" title="' . __( 'Support', 'gravity-forms-toolbar' ) . '">' . __( 'Support', 'gravity-forms-toolbar' ) . '</a>';

		$gftb_links[] = '<a href="' . esc_url( $gftb_info[ 'url_snippets' ] ) . '" target="_new" title="' . __( 'Code Snippets for Customization', 'gravity-forms-toolbar' ) . '">' . __( 'Code Snippets', 'gravity-forms-toolbar' ) . '</a>';

		$gftb_links[] = '<a href="' . esc_url( $gftb_info[ 'url_translate' ] ) . '" target="_new" title="' . __( 'Translations', 'gravity-forms-toolbar' ) . '">' . __( 'Translations', 'gravity-forms-toolbar' ) . '</a>';

		$gftb_links[] = '<a href="' . esc_url( $gftb_info[ 'url_donate' ] ) . '" target="_new" title="' . __( 'Donate', 'gravity-forms-toolbar' ) . '"><strong>' . __( 'Donate', 'gravity-forms-toolbar' ) . '</strong></a>';

	}  // end if plugin links

	/** Output the links */
	return apply_filters( 'gftb_filter_plugin_links', $gftb_links );

}  // end of function ddw_gftb_plugin_links


add_action( 'load-settings_page_ddw_gftb_options_page', 'ddw_gftb_gravityforms_help_tab' );
/**
 * Create and display plugin help tab.
 *
 * @since  1.5.0
 *
 * @uses   get_current_screen()
 * @uses   WP_Screen::add_help_tab()
 * @uses   WP_Screen::set_help_sidebar()
 * @uses   ddw_gftb_help_sidebar_content()
 * @uses   ddw_gftb_help_sidebar_content_extra()
 *
 * @global mixed $gftb_gravityforms_screen
 */
function ddw_gftb_gravityforms_help_tab() {

	global $gftb_gravityforms_screen;

	$gftb_gravityforms_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher */
	if ( ! class_exists( 'WP_Screen' )
		|| ! $gftb_gravityforms_screen
		|| ( defined( 'GFTB_DISPLAY' ) && ! GFTB_DISPLAY )
	) {

		return;

	}  // end if

	/** Add the help tab */
	$gftb_gravityforms_screen->add_help_tab( array(
		'id'       => 'gftb-gravityforms-help',
		'title'    => __( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ),
		'callback' => apply_filters( 'gftb_filter_help_tab_content', 'ddw_gftb_gravityforms_help_tab_content' ),
	) );

	/** Add help sidebar */
	$gftb_gravityforms_screen->set_help_sidebar( ddw_gftb_help_sidebar_content_extra() . ddw_gftb_help_sidebar_content() );

}  // end of function ddw_gftb_gravityforms_help_tab


/**
 * Create and display plugin help tab content.
 *
 * @since 1.5.0
 *
 * @uses  ddw_gftb_info_values()
 * @uses  ddw_gftb_plugin_get_data()
 */
function ddw_gftb_gravityforms_help_tab_content() {

	$gftb_info = (array) ddw_gftb_info_values();

	echo '<h3>' . __( 'Plugin', 'gravity-forms-toolbar' ) . ': ' . __( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ) . ' <small>v' . esc_attr( ddw_gftb_plugin_get_data( 'Version' ) ) . '</small></h3>';

	echo '<ul>' . 
			'<li><a href="' . esc_url( $gftb_info[ 'url_suggestions' ] ) . '" target="_new" title="' . __( 'Suggest new resource items or Add-Ons/ plugins for support', 'gravity-forms-toolbar' ) . '">' . __( 'Suggest new resource items or Add-Ons/ plugins for support', 'gravity-forms-toolbar' ) . '</a></li>' .
			'<li><a href="' . esc_url( $gftb_info[ 'url_snippets' ] ) . '" target="_new" title="' . __( 'Code snippets for customizing &amp; branding', 'gravity-forms-toolbar' ) . '">' . __( 'Code snippets for customizing &amp; branding', 'gravity-forms-toolbar' ) . '</a></li>';

		/** Optional: recommended plugins */
		if ( ! class_exists( 'GFCPTAddon' )
			|| ! class_exists( 'GFReadyClassesAddon' )
			|| ! function_exists( 'gfe_init' ) /* ! class_exists( 'GFEntryDetail' ) */
		) {

			echo '<li><em>' . __( 'Other, recommended Gravity Forms plugins', 'gravity-forms-toolbar' ) . '</em>:';

			if ( ! class_exists( 'GFCPTAddon' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/plugins/gravity-forms-custom-post-types/" target="_new" title="Gravity Forms + Custom Post Types">Gravity Forms + Custom Post Types</a> &mdash; ' . __( 'map forms that create posts to a custom post type, also map dropdown select, radio buttons list and checkboxes lists to a custom taxonomy', 'gravity-forms-toolbar' );

			}  // end if plugin check

			if ( ! class_exists( 'GFReadyClassesAddon' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/plugins/gravity-forms-css-ready-selector/" target="_new" title="Gravity Forms CSS Ready Class Selector">Gravity Forms CSS Ready Class Selector</a> &mdash; ' . __( 'easily select a CSS "Ready Class" for your fields within Gravity Forms', 'gravity-forms-toolbar' );

			}  // end if plugin check

			if ( ! function_exists( 'gfe_init' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/plugins/gravity-forms-pdf-extended/" target="_new" title="Gravity Forms PDF Extended">Gravity Forms PDF Extended</a> &mdash; ' . __( 'save/view/download a PDF from the front- and back-end, and automate PDF creation on form submission', 'gravity-forms-toolbar' );

			}  // end if plugin check

			echo '</li>';

		}  // end if plugins check

	echo '<li><em>' . __( 'Miscellaneous', 'gravity-forms-toolbar' ) . ':</em>' .
		'<br /><a href="http://friendfeed.com/gravityforms-news" target="_new" title="' . __( 'Gravity Forms News Planet', 'gravity-forms-toolbar' ) . '">' . __( 'Gravity Forms News Planet (official and community news via FriendFeed service)', 'gravity-forms-toolbar' ) .
		'</li>';

	/** Set first release year */
	$release_first_year = ( '' != $gftb_info[ 'first_release' ] && date( 'Y' ) != $gftb_info[ 'first_release' ] ) ? $gftb_info[ 'first_release' ] . '&#x02013;' : '';

	echo '</ul>' .
		'<p><h4>' . __( 'Important plugin links:', 'gravity-forms-toolbar' ) . '</h4>' .

		'<a class="button" href="' . esc_url( $gftb_info[ 'url_plugin' ] ) . '" target="_new" title="' . __( 'Plugin website', 'gravity-forms-toolbar' ) . '">' . __( 'Plugin website', 'gravity-forms-toolbar' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $gftb_info[ 'url_wporg_faq' ] ) . '" target="_new" title="' . __( 'FAQ', 'gravity-forms-toolbar' ) . '">' . __( 'FAQ', 'gravity-forms-toolbar' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $gftb_info[ 'url_wporg_forum' ] ) . '" target="_new" title="' . _x( 'Support', 'Translators: Plugin support links', 'gravity-forms-toolbar' ) . '">' . _x( 'Support', 'Translators: Plugin support links', 'gravity-forms-toolbar' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $gftb_info[ 'url_snippets' ] ) . '" target="_new" title="' . __( 'Code Snippets for Customization', 'gravity-forms-toolbar' ) . '">' . __( 'Code Snippets', 'gravity-forms-toolbar' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $gftb_info[ 'url_translate' ] ) . '" target="_new" title="' . __( 'Translations', 'gravity-forms-toolbar' ) . '">' . __( 'Translations', 'gravity-forms-toolbar' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $gftb_info[ 'url_donate' ] ) . '" target="_new" title="' . __( 'Donate', 'gravity-forms-toolbar' ) . '"><strong>' . __( 'Donate', 'gravity-forms-toolbar' ) . '</strong></a></p>';

	echo '<p><a href="' . esc_url( $gftb_info[ 'url_license' ] ). '" target="_new" title="' . esc_attr( $gftb_info[ 'license' ] ). '">' . esc_attr( $gftb_info[ 'license' ] ). '</a> &#x000A9; ' . $release_first_year . date( 'Y' ) . ' <a href="' . esc_url( ddw_gftb_plugin_get_data( 'AuthorURI' ) ) . '" target="_new" title="' . esc_attr__( ddw_gftb_plugin_get_data( 'Author' ) ) . '">' . esc_attr__( ddw_gftb_plugin_get_data( 'Author' ) ) . '</a></p>';

}  // end of function ddw_gftb_gravityforms_help_tab_content


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since 1.6.0
 *
 * @uses  ddw_gftb_info_values()
 * @uses  ddw_gftb_plugin_get_data()
 *
 * @return string HTML content for help sidebar.
 */
function ddw_gftb_help_sidebar_content() {

	$gftb_info = (array) ddw_gftb_info_values();

	$gftb_help_sidebar = '<p><strong>' . __( 'More about the plugin author', 'gravity-forms-toolbar' ) . '</strong></p>' .
		'<p>' . __( 'Social:', 'gravity-forms-toolbar' ) . '<br /><a href="https://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="https://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="' . esc_url( ddw_gftb_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
		'<p><a href="' . esc_url( $gftb_info[ 'url_wporg_profile' ] ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters( 'gftb_filter_help_sidebar_content', $gftb_help_sidebar );

}  // end of function ddw_gftb_help_sidebar_content


/**
 * Helper function for returning the Help Sidebar content - extra for plugin setting page.
 *
 * @since  1.7.0
 *
 * @uses   ddw_gftb_info_values()
 *
 * @return string Extra HTML content for help sidebar.
 */
function ddw_gftb_help_sidebar_content_extra() {

	$gftb_info = (array) ddw_gftb_info_values();

	$gftb_help_sidebar_content_extra = '<p><strong>' . __( 'Actions', 'gravity-forms-toolbar' ) . '</strong></p>' .
		'<p><a class="button button-primary" href="' . esc_url( $gftb_info[ 'url_donate' ] ) . '" target="_new">&rarr; ' . __( 'Donate', 'gravity-forms-toolbar' ) . '</a></p>' .
		'<p><a class="button button-secondary" href="' . esc_url( $gftb_info[ 'url_wporg_forum' ] ) . '" target="_new">&rarr; ' . __( 'Support Forum', 'gravity-forms-toolbar' ) . '</a></p><br />';

	return apply_filters( 'gftb_filter_help_sidebar_content_extra', $gftb_help_sidebar_content_extra );

}  // end of function ddw_gftb_help_sidebar_content_extra


add_action( 'admin_notices', 'ddw_gftb_plugin_advise_activation' );
/**
 * Show user message if Gravity Forms base plugin is not active yet.
 *
 * @since 1.6.1
 *
 * @uses  get_option()
 * @uses  get_current_screen()
 */
function ddw_gftb_plugin_advise_activation() {

	/** Bail early if message was shown already */
	if ( TRUE === get_option( 'gftb-display-activation-message' ) ) {

		return;

	}  // end if

	/** Get current screen hook */
	$screen = get_current_screen();

	/** If message was not shown yet, just show it: */
	if ( FALSE === get_option( 'gftb-display-activation-message' )
		&& ! class_exists( 'RGForms' )
		&& 'plugins' === $screen->id
	) {

		/** Add our helper option */
		add_option( 'gftb-display-activation-message', TRUE );

		/** Setup user notice */
		$gftb_notice = '<div class="error"><p>';
			$gftb_notice .= sprintf(
				__( 'To have %s plugin doing anything you need the %s base plugin installed and activated. You can buy the best form plugin for WordPress at %s.', 'gravity-forms-toolbar' ),
				'<em>' . __( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ) . '</em>',
				'<a href="http://ddwb.me/getgravityforms" target="_new">gravityforms.com</a>',
				'<a href="http://ddwb.me/getgravityforms" target="_new"><strong>Gravity Forms</strong></a>'
			);
			$gftb_notice .= '<div class="alignright"><small>(' . __( 'This message will only be shown once. Go to any other page/ screen here and it will disappear.', 'gravity-forms-toolbar' ) . ')</small></div><div class="clear"></div>';
		$gftb_notice .= '</p></div><!-- /.error -->';

		/** Output the user message */
		echo $gftb_notice;

	}  // end if

}  // end of function