<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Add-Ons
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
 * @since 1.0.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/** Official Add-Ons ('dummy' main entry for all capabalities!) */
$menu_items[ 'gfaddonsinstalled' ] = array(
	'parent' => $gravitybar,
	'title'  => __( 'Installed Add-Ons', 'gravity-forms-toolbar' ),
	'href'   => FALSE,
	'meta'   => array(
		'target' => '',
		'title'  => __( 'Installed Add-Ons', 'gravity-forms-toolbar' )
	)
);

	/** Display message if no Add-Ons are installed */
	if ( ! class_exists( 'GFAuthorizeNet' )
		&& ! class_exists( 'GFAWeber' )
		&& ! class_exists( 'GFCampaignMonitor' )
		&& ! class_exists( 'GFCoupons' )
		&& ! class_exists( 'GFFreshBooks' )
		&& ! class_exists( 'GFLogging' )
		&& ! class_exists( 'GFMailChimp' )
		&& ! class_exists( 'GFMetaRecovery' )
		&& ! class_exists( 'GFPayPal' )
		&& ! class_exists( 'GFPayPalPro' )
		&& ! class_exists( 'GFPayPalPaymentsPro' )
		&& ! class_exists( 'GFPicatcha' )
		&& ! class_exists( 'GFTwilio' )
		&& ! class_exists( 'GFUser' )
		&& ! class_exists( 'GFZapier' )
		&& ! class_exists( 'Pronamic_GravityForms_GravityForms' )
		&& ! class_exists( 'GFStripe' )
		&& ! class_exists( 'GFDirectory' )
		&& ! class_exists( 'GFConstantContact' )
		&& ! class_exists( 'GFSalesforce' )
		&& ! class_exists( 'GFShootQ' )
		&& ! class_exists( 'GFiContact' )
		&& ! class_exists( 'GFMadMimi' )
		&& ! class_exists( 'GFExactTarget' )
		&& ! class_exists( 'GFHubspot' )
		&& ! class_exists( 'GFCapsuleCRM' )
		&& ! class_exists( 'GFMarketo' )
		&& ! class_exists( 'GFHighriseCRM' )
		&& ! class_exists( 'GFConvio' )
		&& ! class_exists( 'GFHighrise' )
		&& ! defined( 'GFEWAY_PLUGIN_ROOT' )
		&& ! defined( 'GRAVITYFORMS_FATZEBRA_PATH' )
		&& ! class_exists( 'Gravity_Forms_Survey_Funnel' )
		&& ! class_exists( 'GFInfusionsoft' )
		&& ! class_exists( 'GFYMLP' )
		&& ! class_exists( 'GFWysija' )
		&& ! class_exists( 'GFGCal' )
		&& ! function_exists( 'get_field_list_massimport' )
		&& ! class_exists( 'GFStatefulForms' )
		&& ! class_exists( 'GFConditionalNotifications' )
		&& ! function_exists( 'gf_survey_results_display' )
		&& ! class_exists( 'GFLimit' )
		&& ! defined( 'GFDPSPXPAY_PLUGIN_VERSION' )
		&& ! defined( 'GFPAYSTATION_PLUGIN_VERSION' )
		&& ! class_exists( 'SpGfMySqlConnect' )
		&& ! class_exists( 'gforms_rcwdupload_plugin' )
		&& ! class_exists( 'Gravity_Forms_Styler' )
		&& ! defined( 'GROUPS_GF_PLUGIN_DOMAIN' )
		&& ! defined( 'PRSOGFORMSADVUPLOADER__DOMAIN' )
		&& ! function_exists( 'gffd_check_requirements' )
		&& ! function_exists( 'weptile_add_scheduled_interval' )
	) {

		$menu_items[ 'gfaonone' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Currently none', 'gravity-forms-toolbar' ),
			'href'   => 'http://www.gravityforms.com/add-ons/',
			'meta'   => array( 'title' => __( 'Currently none', 'gravity-forms-toolbar' ) )
		);

	}  // end if for no installed add-ons


	/**
	 * Add-On: Authorize.Net
	 *
	 * @since 1.3.0
	 */
	if ( class_exists( 'GFAuthorizeNet' ) && current_user_can( 'gravityforms_authorizenet' ) ) {

		$menu_items[ 'gfaoauthorizenet' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Authorize.Net Forms', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_authorizenet' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Authorize.Net Forms', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaoauthorizenet-newform' ] = array(
			'parent' => $gfaoauthorizenet,
			'title'  => __( 'Add new Form', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_authorizenet&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Form', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaoauthorizenet-settings' ] = array(
			'parent' => $gfaoauthorizenet,
			'title'  => __( 'Authorize.Net Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=Authorize.Net' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Authorize.Net Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if authorize.net


	/**
	 * Add-On: AWeber
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFAWeber' ) && current_user_can( 'gravityforms_aweber' ) ) {

		$menu_items[ 'gfaoaweber' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'AWeber Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_aweber' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'AWeber Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaoaweber-newfeed' ] = array(
			'parent' => $gfaoaweber,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_aweber&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaoaweber-settings' ] = array(
			'parent' => $gfaoaweber,
			'title'  => __( 'AWeber Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=AWeber' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'AWeber Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if aweber


	/**
	 * Add-On: Campaign Monitor
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFCampaignMonitor' ) && current_user_can( 'gravityforms_campaignmonitor' ) ) {

		$menu_items[ 'gfaocampaignmonitor' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Campaign Monitor Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_campaignmonitor' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Campaign Monitor Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaocampaignmonitor-newfeed' ] = array(
			'parent' => $gfaocampaignmonitor,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_campaignmonitor&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaocampaignmonitor-settings' ] = array(
			'parent' => $gfaocampaignmonitor,
			'title'  => __( 'Campaign Monitor Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=Campaign+Monitor' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Campaign Monitor Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if campaign monitor


	/**
	 * Add-On: Coupons
	 *
	 * @since 1.6.0
	 */
	if ( class_exists( 'GFCoupons' ) && current_user_can( 'gravityforms_coupons' ) ) {

		$menu_items[ 'gfaocoupons' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Coupons', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_coupons' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Coupons', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaocoupons-addnew' ] = array(
			'parent' => $gfaocoupons,
			'title'  => __( 'Add new Coupon', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_coupons&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Coupon', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaocoupons-settings' ] = array(
			'parent' => $gfaocoupons,
			'title'  => __( 'Coupon Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&subview=Coupons' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Coupon Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if campaign monitor


	/**
	 * Add-On: FreshBooks
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFFreshBooks' ) && current_user_can( 'gravityforms_freshbooks' ) ) {

		$menu_items[ 'gfaofreshbooks' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'FreshBooks Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_freshbooks' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'FreshBooks Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaofreshbooks-newfeed' ] = array(
			'parent' => $gfaofreshbooks,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_freshbooks&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaofreshbooks-settings' ] = array(
			'parent' => $gfaofreshbooks,
			'title'  => __( 'FreshBooks Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=FreshBooks' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'FreshBooks Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if freshbooks


	/**
	 * Add-On: Logging
	 *
	 * @since 1.6.0
	 */
	if ( class_exists( 'GFLogging' ) && current_user_can( 'gravityforms_logging' ) ) {

		$menu_items[ 'gfaologging-settings' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Logging Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&subview=Logging' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Logging Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if logging


	/**
	 * Add-On: MailChimp
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFMailChimp' ) && current_user_can( 'gravityforms_mailchimp' ) ) {

		$menu_items[ 'gfaomailchimp' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'MailChimp Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_mailchimp' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'MailChimp Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaomailchimp-newfeed' ] = array(
			'parent' => $gfaomailchimp,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_mailchimp&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaomailchimp-settings' ] = array(
			'parent' => $gfaomailchimp,
			'title'  => __( 'MailChimp Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=MailChimp' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'MailChimp Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if mailchimp


	/**
	 * Add-On: Meta Recovery Utility
	 *
	 * @since 1.6.0
	 */
	if ( class_exists( 'GFMetaRecovery' ) ) {

		$menu_items[ 'gfaometarecovery-settings' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Meta Recovery Utility', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_metarecovery' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Meta Recovery Utility', 'gravity-forms-toolbar' )
			)
		);

	}  // end if meta recovery


	/**
	 * Add-On: PayPal
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFPayPal' ) && current_user_can( 'gravityforms_paypal' ) ) {

		$menu_items[ 'gfaopaypal' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'PayPal Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_paypal' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'PayPal Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaopaypal-newfeed' ] = array(
			'parent' => $gfaopaypal,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_paypal&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaopaypal-settings' ] = array(
			'parent' => $gfaopaypal,
			'title'  => __( 'PayPal Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=PayPal' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'PayPal Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if paypal


	/**
	 * Add-On: PayPal Payments Pro
	 *
	 * @since 1.6.0
	 */
	if ( class_exists( 'GFPayPalPaymentsPro' ) && current_user_can( 'gravityforms_paypalpaymentspro' ) ) {

		$menu_items[ 'gfaopaypalpaymentspro' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'PayPal Payments Pro Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_paypalpaymentspro' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'PayPal Payments Pro Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaopaypalpaymentspro-newfeed' ] = array(
			'parent' => $gfaopaypalpaymentspro,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_paypalpaymentspro&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaopaypalpaymentspro-settings' ] = array(
			'parent' => $gfaopaypalpaymentspro,
			'title'  => __( 'PayPal Payments Pro Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&subview=PayPal+Payments+Pro' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'PayPal Payments Pro Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if paypal payments pro


	/**
	 * Add-On: PayPal Pro
	 *
	 * @since 1.4.0
	 */
	if ( class_exists( 'GFPayPalPro' ) && current_user_can( 'gravityforms_paypalpro' ) ) {

		$menu_items[ 'gfaopaypalpro' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'PayPal Pro Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_paypalpro' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'PayPal Pro Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaopaypalpro-newfeed' ] = array(
			'parent' => $gfaopaypalpro,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_paypalpro&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaopaypalpro-settings' ] = array(
			'parent' => $gfaopaypalpro,
			'title'  => __( 'PayPal Pro Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=PayPal%20Pro' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'PayPal Pro Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if paypal pro


	/**
	 * Add-On: Picatcha
	 *
	 * @since 1.5.0
	 */
	if ( class_exists( 'GFPicatcha' ) && current_user_can( 'gravityforms_picatcha' ) ) {

		$menu_items[ 'gfaopicatcha-settings' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Picatcha Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=Picatcha' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Picatcha Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if picatcha


	/**
	 * Add-On: Twilio
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFTwilio' ) && current_user_can( 'gravityforms_twilio' ) ) {

		$menu_items[ 'gfaotwilio' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Twilio Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_twilio' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Twilio Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaotwilio-newfeed' ] = array(
			'parent' => $gfaotwilio,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_twilio&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaotwilio-settings' ] = array(
			'parent' => $gfaotwilio,
			'title'  => __( 'Twilio Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=Twilio' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Twilio Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if twilio


	/**
	 * Add-On: User Registration
	 *
	 * @since 1.0.0
	 */
	if ( class_exists( 'GFUser' ) && current_user_can( 'gravityforms_user_registration' ) ) {

		$menu_items[ 'gfaouserreg' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'User Registration Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_user_registration' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'User Registration Feeds', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaouserreg-newfeed' ] = array(
			'parent' => $gfaouserreg,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_user_registration&view=edit&id=0' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaouserreg-pendingfeeds' ] = array(
			'parent' => $gfaouserreg,
			'title'  => __( 'Pending Activations', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_user_registration&view=pending_activations' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Pending Activations', 'gravity-forms-toolbar' )
			)
		);

		$menu_items[ 'gfaouserreg-settings' ] = array(
			'parent' => $gfaouserreg,
			'title'  => __( 'User Registration Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=User+Registration' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'User Registration Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if user-registration


	/**
	 * Add-On: Zapier
	 *
	 * @since 1.6.0
	 */
	if ( class_exists( 'GFZapier' ) && current_user_can( 'gravityforms_zapier' ) ) {

		$menu_items[ 'gfaozapier-settings' ] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'Zapier Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&subview=Zapier' ),
			'meta'   => array(
				'target' => '',
				'title'  => __( 'Zapier Settings', 'gravity-forms-toolbar' )
			)
		);

	}  // end if zapier

	/** Last sub-level entry at very last position included, see end of plugin file '/lib/gftb-plugins.php' */