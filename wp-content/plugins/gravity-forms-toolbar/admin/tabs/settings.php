<?php
/**
 * Display plugin's own settings
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Admin Settings
 * @author     Milan Petrovic - Dev4Press
 * @copyright  Copyright (c) 2012-2014, Milan Petrovic - Dev4Press
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://twitter.com/milangd
 *
 * @since      1.2.0
 */

/**
 * Exit if accessed directly.
 *
 * @since 1.6.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


$options = ddw_gftb_get_options();

?>
<form method="post" action="options.php">
	<?php settings_fields( 'ddw_gftb_options' ); ?>

	<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><?php _e( 'Menu Visibility', 'gravity-forms-toolbar' ); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e( 'Menu Visibility', 'gravity-forms-toolbar' ); ?></span></legend>
					<label for="forms_details">
						<input<?php if ( $options['toolbar_admin'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_toolbar_admin" name="ddw_gftb[toolbar_admin]">
						<?php _e( 'Show on admin side', 'gravity-forms-toolbar' ); ?>
					</label><br />
					<label for="forms_details">
						<input<?php if ( $options['toolbar_frontend'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_toolbar_frontend" name="ddw_gftb[toolbar_frontend]">
						<?php _e( 'Show on frontend', 'gravity-forms-toolbar' ); ?>
					</label>
				</fieldset>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Menu Items Visibility', 'gravity-forms-toolbar' ); ?></th>
			<td>
				<fieldset>
                       			<legend class="screen-reader-text"><span><?php _e( 'Menu Items Visibility', 'gravity-forms-toolbar' ); ?></span></legend>
                        		<label for="ddw_gftb_help_and_support">
                            			<input<?php if ( $options['help_and_support'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_help_and_support" name="ddw_gftb[help_and_support]">
                            			<?php _e( 'Help, Documnetation and FAQ options', 'gravity-forms-toolbar' ); ?>
                       			</label><br />
                        		<label for="ddw_gftb_add_ons">
                            			<input<?php if ( $options['add_ons'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_add_ons" name="ddw_gftb[add_ons]">
						<?php _e( 'Active official Add-Ons', 'gravity-forms-toolbar' ); ?>
					</label><br />
                        		<label for="ddw_gftb_extensions">
                            			<input<?php if ( $options['extensions'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_extensions" name="ddw_gftb[extensions]">
						<?php _e( 'Active Extensions', 'gravity-forms-toolbar' ); ?>
					</label>
				</fieldset>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Notifications', 'gravity-forms-toolbar' ); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e( 'Notifications', 'gravity-forms-toolbar' ); ?></span></legend>
					<label for="forms_details">
						<input<?php if ( $options['unread_notification'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_unread_notification" name="ddw_gftb[unread_notification]">
						<?php _e( 'Display notification about number of all unread entries', 'gravity-forms-toolbar' ); ?>
					</label><br />
					<label for="forms_details">
						<input<?php if ( $options['update_notification'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_update_notification" name="ddw_gftb[update_notification]">
						<?php _e( 'Display notification in menu when plugin update is available', 'gravity-forms-toolbar' ); ?>
					</label>
				</fieldset>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Forms Details', 'gravity-forms-toolbar' ); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e( 'Forms Details', 'gravity-forms-toolbar' ); ?></span></legend>
					<label for="forms_details">
						<input<?php if ( $options['forms_details'] ) echo ' checked'; ?> type="checkbox" value="1" id="ddw_gftb_forms_details" name="ddw_gftb[forms_details]">
						<?php _e( 'Include list of forms and entries counts', 'gravity-forms-toolbar' ); ?>
					</label><br>
					<small><em>(<?php _e( 'Note: This will generate additional SQL queries to get forms information.', 'gravity-forms-toolbar' ); ?>)</em></small>
				</fieldset>
			</td>
		</tr>
	</tbody>
	</table>

	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'gravity-forms-toolbar' ); ?>" />
	</p>
</form>