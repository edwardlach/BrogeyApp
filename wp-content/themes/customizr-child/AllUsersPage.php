<?php
/*
Template Name: All Brogeys
*/
?>



<?php
    ## TODO Move this to a stylesheet
    function custom_css() {
        ## Get rid of the nasty sharing nonsense for this page
        echo <<<EOCSS
<style>
.the_champ_sharing_container { display: none; }
.error {
    color: red;
    background-color: #F4DFDF;
}

tr.handicap td {
    color: green;
    background-color: #a7ee98;
}

</style>
EOCSS;
    }



	function _prepare_bg_database() {
        global $wpdb;
        ## If any slashes are added, everything will probably break
        ## But out database will be safe
        ## So just don't change the blog prefix to something ridiculous
        $prefix = addslashes( $wpdb->get_blog_prefix() );
        $tables = array_map( function($t) { return "$t"; }, array('users') );
        foreach( $tables as $table ) {
            if ( !isset( $wpdb->$table ) ) {
                $wpdb->$table = "$prefix$table";
            }
        }
        return $wpdb;
    }



    add_action('__before_main_wrapper', 'custom_css');
    
    ##TODO Move this to a functions file
    function go_to_login($destination = false) {
        
        if ( !$destination ) {
            $destination = get_site_url();
        }
        $destination = urlencode($destination);
        
        $base = get_site_url(get_current_blog_id(), 'wp-login.php');
        
        wp_safe_redirect( "$base?redirect_to=$destination", 302 );
        exit;
    }

    function _button_to($url, $text) {
        return "<a class=\"btn\" href=\"$url\">$text</a>";
    }
    
    if ( !is_user_logged_in() ) {
        go_to_login();
    }



    $wpdb = _prepare_bg_database();
    	
	$allBrogeyUsers = $wpdb->get_results(
		$wpdb->prepare(
		    "SELECT S.*, user_login
		     FROM $wpdb->users S",
		    get_current_user_id()
		), OBJECT_K
	);


    $html = generate_table( $allBrogeyUsers );

    function generate_table($allBrogeyUsers) {
        $html = <<<EOHTML
<table>
    <thead>
    	<tr>
    	     <th>Brogey Nation</th>
    	</tr>
    </thead>
    <tbody>
EOHTML;

        foreach ($allBrogeyUsers as $allBrogeyUser) {
            $allUserList = esc_html( $allBrogeyUser->user_login );
            $html .= <<<EOHTML
        <tr class="$class">
            <td>$allBrogeyUser->user_login</td>
        </tr>
EOHTML;
        }

    $html .= <<<EOHTML
    </tbody>
</table>
EOHTML;

    return $html;
}

?>
<?php do_action( '__before_main_wrapper' ); ##hook of the header with get_header ?>
<div id="main-wrapper" class="<?php echo tc__f( 'tc_main_wrapper_classes' , 'container' ) ?>">

    <?php do_action( '__before_main_container' ); ##hook of the featured page (priority 10) and breadcrumb (priority 20)...and whatever you need! ?>
    
    <div class="container" role="main">
        <div class="row">

            <?php do_action( '__before_article_container'); ##hook of left sidebar?>
                
                <div id="content" class="<?php echo tc__f( '__screen_layout' , tc__f ( '__ID' ) , 'class' ) ?> article-container">
                    
                    <?php do_action ('__before_loop');##hooks the header of the list of post : archive, search... ?>

                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : ##all other cases for single and lists: post, custom post type, page, archives, search, 404 ?>

                                <?php the_post(); ?>

                                <?php do_action ('__before_article') ?>

                                    <article <?php tc__f('__article_selectors') ?>>

                                        <?php do_action( '__loop' ); ?>

                                    </article>

                                <?php do_action ('__after_article') ?>

                            <?php endwhile; ?>

                        <?php endif; ##end if have posts ?>
                        <?php
                            echo $html;
                            
                        ?>

                    <?php do_action ('__after_loop');##hook of the comments and the posts navigation with priorities 10 and 20 ?>

                </div><!--.article-container -->

           <?php do_action( '__after_article_container'); ##hook of left sidebar ?>

        </div><!--.row -->
    </div><!-- .container role: main -->

    <?php do_action( '__after_main_container' ); ?>

</div><!--#main-wrapper"-->

<?php do_action( '__after_main_wrapper' );##hook of the footer with get_get_footer ?>