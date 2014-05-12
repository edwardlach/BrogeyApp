<?php
/**
 * Display links to active Gravity Forms third-party add-ons/ plugins/
 *    extensions settings' pages
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
 * "Add new Feed" string
 *
 * @since 1.0.0
 */
$gftb_new_feed_string = esc_attr__( 'Add new Feed', 'gravity-forms-toolbar' );


/**
 * Pronamic iDEAL settings pages (free, by Pronamic)
 *
 * NOTE: Requires at least version 2.6.1 of the add-on plugin!
 *
 * @since   1.0.0
 * @version 1.6.0
 */
if ( class_exists( 'Pronamic_GravityForms_GravityForms' ) ) {

	/** Include code part for Pronamic iDEAL plugin support */
	require_once( GFTB_PLUGIN_DIR . 'lib/gftb-plugins-pronamicideal.php' );

}  // end if Pronamic iDEAL


/**
 * Gravity Forms Stripe Add-On (free, by Naomi C. Bush)
 *
 * @since 1.4.0
 */
if ( class_exists( 'GFStripe' )
	&& ( current_user_can( 'gravityforms_stripe' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaostripe' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Stripe Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_stripe' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Stripe Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaostripe-newfeed' ] = array(
		'parent' => $gftpaostripe,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_stripe&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaostripe-settings' ] = array(
		'parent' => $gftpaostripe,
		'title'  => __( 'Stripe Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Stripe' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Stripe Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfstripe' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Stripe Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Stripe' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Stripe Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Stripe


/**
 * Gravity Forms MailPoet/ Wysija Add-on (free, by Ben Hays)
 *
 * @since 1.7.0
 */
if ( class_exists( 'GFWysija' )
	&& ( current_user_can( 'gravityforms_wysija' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaowysija' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'MailPoet Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_wysija' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'MailPoet Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaowysija-newfeed' ] = array(
		'parent' => $gftpaowysija,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_wysija&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

}  // end if GF MailPoet/ Wysija


/**
 * Gravity Forms Directory & Addons (free, by Katz Web Services, Inc.)
 *
 * @since 1.0.0
 */
if ( class_exists( 'GFDirectory' )
	&& ( current_user_can( 'gravityforms_directory' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfd' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Directory+%26+Addons' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfdirectory' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Directory+%26+Addons' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Directory


/**
 * Gravity Forms Salesforce Add-on (free, by Katz Web Services, Inc.)
 *
 * @since 1.0.0
 */
if ( class_exists( 'GFSalesforce' )
	&& ( current_user_can( 'gravityforms_salesforce' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfsf' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_salesforce' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfsalesforce' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_salesforce' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Salesforce


/**
 * Gravity Forms Contact Form 7 Importer (free, by Katz Web Services, Inc.)
 *
 * @since 1.0.0
 */
if ( class_exists( 'GFCF7_Import' )
	&& ( current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfcf7import' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Contact Form 7 Gravity Forms Importer', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfcf7' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Contact Form 7 Gravity Forms Importer', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF CF7-Importer


/**
 * Gravity Forms ShootQ Add-On (free, by pussycatdev)
 *
 * @since 1.1.0
 */
if ( class_exists( 'GFShootQ' )
	&& ( current_user_can( 'gravityforms_shootq' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoshootq' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'ShootQ Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_shootq' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'ShootQ Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoshootq-newfeed' ] = array(
		'parent' => $gftpaoshootq,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_shootq&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoshootq-settings' ] = array(
		'parent' => $gftpaoshootq,
		'title'  => __( 'ShootQ Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ShootQ' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'ShootQ Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfshootq' ] = array(
		'parent' => $extensions,
		'title'  => __( 'ShootQ Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ShootQ' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'ShootQ Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF ShootQ


/**
 * Gravity Forms Constant Contact Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.4.0
 */
if ( class_exists( 'GFConstantContact' )
	&& ( current_user_can( 'gravityforms_constantcontact' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoconstantcontact' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Constant Contact Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_constantcontact' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Constant Contact Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoconstantcontact-newfeed' ] = array(
		'parent' => $gftpaoconstantcontact,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_constantcontact&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoconstantcontact-settings' ] = array(
		'parent' => $gftpaoconstantcontact,
		'title'  => __( 'Constant Contact Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Constant+Contact' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Constant Contact Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfconstantcontact' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Constant Contact Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Constant+Contact' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Constant Contact Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF iContact


/**
 * Gravity Forms iContact Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.1.0
 */
if ( class_exists( 'GFiContact' )
	&& ( current_user_can( 'gravityforms_icontact' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoicontact' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'iContact Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_icontact' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'iContact Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoicontact-newfeed' ] = array(
		'parent' => $gftpaoicontact,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_icontact&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoicontact-settings' ] = array(
		'parent' => $gftpaoicontact,
		'title'  => __( 'iContact Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=iContact' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'iContact Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gficontact' ] = array(
		'parent' => $extensions,
		'title'  => __( 'iContact Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=iContact' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'iContact Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF iContact


/**
 * Gravity Forms Mad Mimi Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.1.0
 */
if ( class_exists( 'GFMadMimi' )
	&& ( current_user_can( 'gravityforms_madmimi' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaomadmimi' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Mad Mimi Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_madmimi' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Mad Mimi Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaomadmimi-newfeed' ] = array(
		'parent' => $gftpaomadmimi,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_madmimi&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaomadmimi-settings' ] = array(
		'parent' => $gftpaomadmimi,
		'title'  => __( 'Mad Mimi Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Mad+Mimi' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Mad Mimi Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfmadmimi' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Mad Mimi Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Mad+Mimi' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Mad Mimi Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Mad Mimi


/**
 * Gravity Forms ExactTarget Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.1.0
 */
if ( class_exists( 'GFExactTarget' )
	&& ( current_user_can( 'gravityforms_exacttarget' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoexacttarget' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'ExactTarget Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_exacttarget' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'ExactTarget Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoexacttarget-newfeed' ] = array(
		'parent' => $gftpaoexacttarget,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_exacttarget&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoexacttarget-settings' ] = array(
		'parent' => $gftpaoexacttarget,
		'title'  => __( 'ExactTarget Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ExactTarget' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'ExactTarget Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfexacttarget' ] = array(
		'parent' => $extensions,
		'title'  => __( 'ExactTarget Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ExactTarget' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'ExactTarget Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF ExactTarget


/**
 * Gravity Forms Infusionsoft Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.5.0
 */
if ( class_exists( 'GFInfusionsoft' )
	&& ( current_user_can( 'gravityforms_infusionsoft' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoinfusionsoft' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Infusionsoft Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_infusionsoft' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Infusionsoft Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoinfusionsoft-newfeed' ] = array(
		'parent' => $gftpaoinfusionsoft,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_infusionsoft&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoinfusionsoft-settings' ] = array(
		'parent' => $gftpaoinfusionsoft,
		'title'  => __( 'Infusionsoft Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Infusionsoft' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Infusionsoft Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfinfusionsoft' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Infusionsoft Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Infusionsoft' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Infusionsoft Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Infusionsoft


/**
 * Gravity Forms YMLP Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.5.1
 */
if ( class_exists( 'GFYMLP' )
	&& ( current_user_can( 'gravityforms_ymlp' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoymlp' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'YMLP Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_ymlp' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'YMLP Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoymlp-newfeed' ] = array(
		'parent' => $gftpaoymlp,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_ymlp&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoymlp-settings' ] = array(
		'parent' => $gftpaoymlp,
		'title'  => __( 'YMLP Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=YMLP' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'YMLP Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfymlp' ] = array(
		'parent' => $extensions,
		'title'  => __( 'YMLP Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=YMLP' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'YMLP Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF YMLP


/**
 * Gravity Forms Marketo Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.7.0
 */
if ( class_exists( 'GFMarketo' )
	&& ( current_user_can( 'gravityforms_marketo' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaomarketo' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Marketo Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_marketo' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Marketo Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaomarketo-newfeed' ] = array(
		'parent' => $gftpaomarketo,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_marketo&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaomarketo-settings' ] = array(
		'parent' => $gftpaomarketo,
		'title'  => __( 'Marketo Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Marketo' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Marketo Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfmarketo' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Marketo Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Marketo' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Marketo Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Marketo


/**
 * Gravity Forms Highrise CRM (free, by Ben Hays)
 *
 * @since 1.7.0
 */
if ( class_exists( 'GFHighriseCRM' )
	&& ( current_user_can( 'gravityforms_highrise' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaohighrisecrm' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Highrise CRM Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_highrise' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Highrise CRM Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaohighrisecrm-newfeed' ] = array(
		'parent' => $gftpaohighrisecrm,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_highrise&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaohighrisecrm-settings' ] = array(
		'parent' => $gftpaohighrisecrm,
		'title'  => __( 'Highrise CRM Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Highrise&subview=Highrise+CRM' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Highrise CRM Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfhighrisecrm' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Highrise CRM Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Highrise&subview=Highrise+CRM' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Highrise CRM Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF HighriseCRM


/**
 * Gravity Forms Convio Add-on (free, by Ben Hays)
 *
 * @since 1.7.0
 */
if ( class_exists( 'GFConvio' )
	&& ( current_user_can( 'gravityforms_convio' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoconvio' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Convio Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_convio' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Convio Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoconvio-newfeed' ] = array(
		'parent' => $gftpaoconvio,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_convio&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaoconvio-settings' ] = array(
		'parent' => $gftpaoconvio,
		'title'  => __( 'Convio Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Convio' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Convio Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfconvio' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Convio Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Convio' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Convio Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Convio


/**
 * Gravity Forms Blue Pay Add-On (free, by David Cramer)
 *
 * @since 1.6.0
 */
if ( class_exists( 'GFBluePay' )
	&& ( current_user_can( 'gravityforms_blue_pay' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaobluepay' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Blue Pay Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_blue_pay' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Blue Pay Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaobluepay-newfeed' ] = array(
		'parent' => $gftpaobluepay,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_blue_pay&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaobluepay-settings' ] = array(
		'parent' => $gftpaobluepay,
		'title'  => __( 'Blue Pay Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=BluePay' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Blue Pay Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfbluepay' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Blue Pay Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=BluePay' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Blue Pay Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Blue Pay


/**
 * Gravity Forms Quantiy Limits (free, by Ben Hays)
 *
 * @since 1.6.0
 */
if ( class_exists( 'GFLimit' )
	&& ( current_user_can( 'gf_limit' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaoqlimit' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Quantity Limit Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_limit' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Quantity Limit Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaoqlimit-newfeed' ] = array(
		'parent' => $gftpaoqlimit,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'admin.php?page=gf_limit&view=edit&id=0' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

}  // end if GF Quantiy Limits


/**
 * Gravity Forms DPS PxPay Add-On (free, by WebAware)
 *
 * @since 1.6.0
 */
if ( defined( 'GFDPSPXPAY_PLUGIN_VERSION' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaodpspxpay' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'DPS PxPay Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=gfdpspxpay_feed' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'DPS PxPay Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaodpspxpay-newfeed' ] = array(
		'parent' => $gftpaodpspxpay,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'post-new.php?post_type=gfdpspxpay_feed' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaodpspxpay-settings' ] = array(
		'parent' => $gftpaodpspxpay,
		'title'  => __( 'DPS PxPay Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&subview=DPS+PxPay' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'DPS PxPay Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfdpspxpay' ] = array(
		'parent' => $extensions,
		'title'  => __( 'DPS PxPay Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&subview=DPS+PxPay' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'DPS PxPay Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF DPS PxPay


/**
 * Gravity Forms Paystation (3 party hosted) (free, by Paystation Limited)
 *
 * @since 1.7.0
 */
if ( defined( 'GFPAYSTATION_PLUGIN_VERSION' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaopaystation' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Paystation Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=gfpaystation_feed' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Paystation Feeds', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaopaystation-newfeed' ] = array(
		'parent' => $gftpaopaystation,
		'title'  => $gftb_new_feed_string,
		'href'   => admin_url( 'post-new.php?post_type=gfpaystation_feed' ),
		'meta'   => array(
			'target' => '',
			'title'  => $gftb_new_feed_string
		)
	);

	$menu_items[ 'gftpaopaystation-settings' ] = array(
		'parent' => $gftpaopaystation,
		'title'  => __( 'Paystation Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfpaystation-options' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Paystation Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfdpspxpay' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Paystation Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfpaystation-options' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Paystation Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF DPS PxPay


/**
 * Gravity Forms Highrise Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.7.0
 */
if ( class_exists( 'GFHighrise' )
	&& ( current_user_can( 'gravityforms_highrise' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaohighrisekatz' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Highrise Instructions', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_highrise' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Highrise Instructions', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'gftpaohighrisekatz-settings' ] = array(
		'parent' => $gftpaohighrisekatz,
		'title'  => __( 'Highrise Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&subview=Highrise' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Highrise Settings', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfhighrisekatz' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Highrise Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&subview=Highrise' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Highrise Add-On Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF HighriseCRM


/**
 * Gravity to Solve360 (free, by Steve Barnett)
 *
 * @since 1.4.0
 */
if ( function_exists( 'gts360' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'extgfsolve360' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Gravity to Solve360', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'tools.php?page=gravity-to-solve360' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Gravity to Solve360 Export', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

	$menu_items[ 'extgfsolve360-options' ] = array(
		'parent' => $extgfsolve360,
		'title'  => __( 'Options', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=gravity-to-solve360-options' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Options', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Solve360


/**
 * Gravity Forms Survey Funnel Add-On (free, by Pronamic)
 *
 * @since 1.5.0
 */
if ( class_exists( 'Gravity_Forms_Survey_Funnel' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfsf' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=gravityforms-surveyfunnel-survey-settings' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfsurveyfunnel' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=gravityforms-surveyfunnel-survey-settings' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Survey Funnel


/**
 * Gravity Forms HubSpot Add-On (free, by Dan Zappone)
 *
 * @since 1.4.0
 */
if ( class_exists( 'GFHubspot' )
	&& ( current_user_can( 'gravityforms_hubspot' ) || current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfhs' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'HubSpot Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_hubspot' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'HubSpot Add-On', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfhubspot' ] = array(
		'parent' => $extensions,
		'title'  => __( 'HubSpot Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_hubspot' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'HubSpot Add-On', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF HubSpot


/**
 * Gravity Forms Fat Zebra Add-On (free, by Matthew Savage)
 *
 * @since 1.5.0
 */
if ( defined( 'GRAVITYFORMS_FATZEBRA_PATH' )
	&& ( current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogffatzebra' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Fat+Zebra+%28Payments%29' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gffatzebra' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Fat+Zebra+%28Payments%29' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Fat Zebra


/**
 * Gravity Forms CapsuleCRM Add-On (free, by Alinea.im)
 *
 * @since 1.4.0
 */
if ( class_exists( 'GFCapsuleCRM' )
	&& ( current_user_can( 'gravityforms_capsulecrm' ) || current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfcapsule' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_capsulecrm' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfcapsule' ] = array(
		'parent' => $extensions,
		'title'  => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_capsulecrm' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF CapsuleCRM


/**
 * GravityForms eWAY (free, by WebAware)
 *
 * @since 1.4.0
 */
if ( defined( 'GFEWAY_PLUGIN_ROOT' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfeway' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'eWAY Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfeway-options' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'eWAY Add-On', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gfeway' ] = array(
		'parent' => $extensions,
		'title'  => __( 'eWAY Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfeway-options' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'eWAY Add-On', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF eWAY


/**
 * Gravity Forms + First Data Global Gateway e4℠ (free, by Aubrey Portwood of
 *    Excion)
 *
 * @since 1.7.0
 */
if ( function_exists( 'gffd_check_requirements' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogffdgg' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'First Data Global Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gffd_feeds' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'First Data Global Feeds', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'gftpaogffdgg-settings' ] = array(
			'parent' => $gftpaogffdgg,
			'title'  => __( 'Gateway Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&subview=First+Data+Global+Gateway' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Gateway Settings', 'gravity-forms-toolbar' )
			)
		);

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-gffdgg' ] = array(
		'parent' => $extensions,
		'title'  => __( 'First Data Global Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gffd_feeds' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'First Data Global Settings', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF First Data


/**
 * Gravity Forms Periodic Notification E-Mails (free, by Weptile)
 *
 * @since 1.7.0
 */
if ( function_exists( 'weptile_add_scheduled_interval' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfperiodicmails' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Periodic Form Mails', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=wdgfm_settings_page' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Periodic Form Mails', 'gravity-forms-toolbar' )
		)
	);

		$menu_items[ 'gftpaogfperiodicmails-tasks' ] = array(
			'parent' => $gftpaogfperiodicmails,
			'title'  => __( 'Mail Tasks', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=wdgfm_tasks_page' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Mail Tasks', 'gravity-forms-toolbar' )
			)
		);

}  // end if GF Periodic Notification E-Mails


/**
 * PixCaptcha Image Captcha for Gravity Forms (free, by Picatcha, Inc.)
 *
 * @since 1.4.0
 */
if ( function_exists( 'add_pixcaptcha_field' )
	&& ( current_user_can( 'edit_posts' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-picatchagf' ] = array(
		'parent' => $extensions,
		'title'  => __( 'PixCaptcha Image Captcha', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=picatcha_submenu' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'PixCaptcha Image Captcha', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Picatcha


/**
 * Gravity Forms SMS Notifications (free, by Mediaburst)
 *
 * @since 1.4.0
 */
if ( class_exists( 'GravityFormsSMS' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-picatchagf' ] = array(
		'parent' => $extensions,
		'title'  => __( 'SMS Notifications (Mediaburst)', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=sms_notifications' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'SMS Notifications by Mediaburst', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF SMS Notifications


/**
 * Gravity Forms Connect to Google Calendar™ (premium, by Eugen Oprea via
 *    CodeCanyon Marketplace)
 *
 * @since 1.6.0
 */
if ( class_exists( 'GFGCal' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfgcal' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Google Calendar Connect', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Google+Calendar' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Google Calendar Connect', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Connect to Google Calendar™


/**
 * Gravity Forms Survey Results
 *    (free, by Daniel Grundel (dgrundel) and Mahmoud Kassassir (mkassassir),
 *     Web Presence Partners -  via GitHub)
 *
 * @since 1.6.0
 */
if ( function_exists( 'gf_survey_results_display' )
	&& ( current_user_can( 'edit_posts' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfstatefulforms' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Survey Results', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_survey_results' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Survey Results', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Survey Results


/**
 * SP Gravity Forms MySQL Connect (premium, by Ralf Fuhrmann/ profine GmbH via
 *    CodeCanyon Marketplace)
 *
 * @since 1.7.0
 */
if ( class_exists( 'SpGfMySqlConnect' )
	&& ( current_user_can( 'edit_posts' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfmysqlconnect' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'MySQL Table Builder', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=spgfmc' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'MySQL Table Builder', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF MySQL Connect


/**
 * Gravity Forms Conditional Notifications Add-On (free, by Gennady Kovshenin
 *    via GitHub)
 *
 * @since 1.6.0
 */
if ( class_exists( 'GFConditionalNotifications' ) && current_user_can( 'gform_full_access' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfconditionalnotifications' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Conditional Notifications', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_conditional_notifications_ui' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Conditional Notifications Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Conditional Notifications


/**
 * Gravity Forms Saved Forms Add-On (free, by Gennady Kovshenin via GitHub)
 *
 * @since 1.6.0
 */
if ( class_exists( 'GFStatefulForms' )
	&& ( current_user_can( 'gravityforms_view_entries' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfstatefulforms' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Pending/ Completed Entries', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_pending_completed_entries' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Pending/ Completed Entries Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Saved Forms


/**
 * Gravity Forms Mass Import (free, by Aryan Duntley)
 *
 * @since 1.6.0
 */
if ( function_exists( 'get_field_list_massimport' )
	&& ( current_user_can( 'activate_plugins' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Import & Export" level submenu */
	$menu_items[ 'gf-entries-massimport' ] = array(
		'parent' => $gfimportexport,
		'title'  => __( 'Entries Mass Import', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_import_entries' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Entries Mass Import (via Add-On)', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfmassimport' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Entries Mass Import', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_import_entries' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Entries Mass Import (via Add-On)', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Mass Import


/**
 * Are You A Human (free, by Are You A Human)
 *
 * @since 1.6.0
 */
if ( defined( 'AYAH_WEB_SERVICE_HOST' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-areyouahuman' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Are You A Human', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=are-you-a-human' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Are You A Human Settings (anti spam protection add-on)', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if Are You A Human


/**
 * Aviary Editor Addon For Gravity Forms (free, by Leon Kiley - NetherWorks, LLC)
 *
 * @since 1.6.0
 */
if ( class_exists( 'GFAviaryEditor' )
	&& ( current_user_can( 'edit_posts' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Extensions" level submenu */
	$menu_items[ 'ext-aviaryeditor' ] = array(
		'parent' => $extensions,
		'title'  => __( 'Aviary Editor Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_aviary_options' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Aviary Editor Add-On', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Aviary Editor Addon


/**
 * Gravity Forms Advanced File Uploader (free, by Benjamin Moody)
 *
 * @since 1.7.0
 */
if ( defined( 'PRSOGFORMSADVUPLOADER__DOMAIN' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfadvfileuploader' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Advanced Uploader Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=prso_gforms_adv_uploader_options_options' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Advanced Uploader Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if GF Advanced File Uploader


/**
 * Rcwd Upload for Gravity Forms (premium, by Roberto Cantarano via CodeCanyon
 *    Marketplace)
 *
 * @since 1.7.0
 */
if ( class_exists( 'gforms_rcwdupload_plugin' )
	&& ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfrcwdupload' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Rcwd Upload Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gforms-rcwdupload' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Rcwd Upload Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if Rcwd Upload for GF


/**
 * Groups Gravity Forms Integration (premium, by itthinx/ Karim Rahimpur via CodeCanyon Marketplace)
 *
 * @since 1.7.0
 */
if ( defined( 'GROUPS_GF_PLUGIN_DOMAIN' )
	&& current_user_can( defined( 'GROUPS_ADMINISTER_OPTIONS' ) ? GROUPS_ADMINISTER_OPTIONS : 'groups_admin_options' )
) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items[ 'gftpaogfgroups' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Groups Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_groups' ),
		'meta'   => array(
			'target' => '',
			'title'  => _x( 'Groups Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' )
		)
	);

}  // end if Groups GF Integration


/**
 * Placing of "Purchase more official Add-Ons" as very last entry of "Add-On"
 *    first-level menu
 *
 * @since 1.0.0
 */
if ( current_user_can( 'gravityforms_view_addons' ) || current_user_can( 'gravityforms_addon_browser' ) || current_user_can( 'gform_full_access' ) ) {

	$menu_items[ 'gfaddonsinstalled-purchase' ] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Purchase more Add-Ons', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_addons' ),
		'meta'   => array(
			'target' => '',
			'title'  => __( 'Purchase more Add-Ons', 'gravity-forms-toolbar' )
		)
	);

}  // end if purchase more add-ons