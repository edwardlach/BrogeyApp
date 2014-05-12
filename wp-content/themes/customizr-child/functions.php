<?php

/* this function allows for custom css on our login page */

function custom_login_css() {
echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/home4/brogeygo/public_html/wp-content/themes/customizr-child/style.css" />';
}

add_action('login_head', 'custom_login_css');

/* This function allows for custom fonts for our login page */

function custom_fonts() {
echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css">';
}

add_action('login_head', 'custom_fonts');

/* This function makes our logo a link to our homepage (or whatever page we decide we want it to take us) */

add_filter( 'login_headerurl', 'custom_login_header_url' );
function custom_login_header_url($url) {
return 'http://brogeygolfreview.com/';
}


function my_awesome_redirect( $redirect ) {
   $redirect = 'http://brogeygolfreview.com/?p=658‎';

   return $redirect;
}
add_filter( 'wpml_redirect_to', 'my_awesome_redirect' );

?>