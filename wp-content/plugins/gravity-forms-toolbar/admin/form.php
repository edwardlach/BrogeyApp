<?php
/**
 * Plugin's admin form
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Admin Options
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


$current = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings';
$tabs = array(
	'settings' => __( 'Settings', 'gravity-forms-toolbar' )
);

?>
<div class="wrap">
	<h2><?php _e( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ); ?></h2>
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
	<?php

		foreach( $tabs as $tab => $name ){
		$class = ( $tab == $current ) ? ' nav-tab-active' : '';
		echo '<a class="nav-tab' . $class . '" href="options-general.php?page=ddw_gftb_options_page&tab=' . $tab . '">' . $name . '</a>';
	}

	?>
	</h2>
	<div id="ddw-panel" class="ddw-panel-<?php echo $current; ?>">
		<?php include( GFTB_PLUGIN_DIR . 'admin/tabs/' . $current . '.php' ); ?>
	</div>  
</div><!-- .wrap -->