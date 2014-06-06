<?php
/*
Template Name: Round Input
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
    
        
    
$html = generate_table();

    function generate_table() {
        $html = <<<EOHTML

<form id="round_info" method="post">

	<label for="course_name">Course Name</label>
        	<input name="course_name" type="text" pattern=".{1,100}"  required />
        <label for="holes">How many holes?</label>
        	<select name="holes">
        		<option disabled selected>--How many today?--</option>
        		<option value="18">18</option>
        		<option value="9">9</option>
        	</select>
        <label for="course_par">Course Par</label>
        	<input name="course_par" type="number" min="0" max="255" required />
        <label for="course_rating">Course Rating</label>
        	<input name="course_rating" type="number" min="67" max="77" required />
        <label for="slope_rating">Slope Rating<label>
        	<input name="slope_rating" type="number" min="55" max="155" required />
        <input type="submit" name="submit" value="Continue" />
        	
</form>


EOHTML;

    return $html;
}
    

 function _prepare_bg_database() {
        global $wpdb;
        ## If any slashes are added, everything will probably break
        ## But out database will be safe
        ## So just don't change the blog prefix to something ridiculous
        $prefix = addslashes( $wpdb->get_blog_prefix() );
        $tables = array_map( function($t) { return "bg_$t"; }, array( 'holes', 'rounds') );
        foreach( $tables as $table ) {
            if ( !isset( $wpdb->$table ) ) {
                $wpdb->$table = "$prefix$table";
            }
        }
        return $wpdb;
    }
    
      
  
    
    
    
    function record($roundParameters) {
    	
    	$wpdb = _prepare_bg_database();
    	
    	$date = date('Y-m-d H:i:s');
    	
    	$rounds_table = $wpdb->bg_rounds;
    	
    	
    	$round_id = $wpdb->get_var(
    		$wpdb->prepare(
    			"SELECT round_id FROM $rounds_table WHERE course_name = %s"
    				."AND holes = %s"
    				."AND course_par = %d"
    				."AND course_rating = %d"
    				."AND slope_rating = %d"
    				."AND user_id = %d"
    				."AND start_date = %f"
    				."AND is_complete = %d",
    				$roundParameters['course_name'],
    				$roundParameters['holes'],
    				$roundParameters['course_par'],
    				$roundParameters['course_rating'],
    				$roundParameters['slope_rating'],
    				get_current_user_id(),
    				$date,
    				"0"
    		)
    	);
    	
    	
    	
    	if (!$round_id) {
	    	$wpdb->insert(
	    		$rounds_table,
	    			array( 
	    				'round_id'	=> uniqid(),
	    				'course_name'   => $roundParameters['course_name'],
	    				'holes' 	=> $roundParameters['holes'],
	    				'course_par'	=> $roundParameters['course_par'],
	    				'course_rating'	=> $roundParameters['course_rating'],
	    				'slope_rating'	=> $roundParameters['slope_rating'],
	    				'user_id'	=> get_current_user_id(),
	    				'start_date'	=> $date,
	    				'is_complete'	=> "0"
	    			),
	    			array( 
					'%f',	    			
	    				'%s',
	    			   	'%s',
	    			   	'%d',
	    			   	'%d',
	    			   	'%d',
	    			   	'%d',
	    			   	'%s',
	    			   	'%d'
	    			)
	    	);
    			
    		$round_id = $wpdb->insert_id;
    	}
    		
    	return 1;
    
    }
    
   
   
    
    if ( !is_user_logged_in() ) {
        go_to_login();
    }
   	  
    
    if ( isset( $_POST['submit'] ) ) {
        $roundParameters = array(
            "course_name"	=> $_POST['course_name'],
            "holes"		=> $_POST['holes'],
            "course_par"        => $_POST['course_par'],
            "course_rating"     => $_POST['course_rating'],
            "slope_rating"	=> $_POST['slope_rating'],
        );
        
        record( $roundParameters );
        
        wp_safe_redirect(
                get_site_url(get_current_blog_id(), 'http://brogeygolfreview.com/?p=759'),
                302
        );
               
       
    	
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
                            /*if( count( $errors ) ) {
                                echo '<div class="error">';
                                foreach ( $errors as $error ) {
                                    echo "$error<br/>";
                                }
                                echo '</div>';
                            }*/
                        ?>
                        
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