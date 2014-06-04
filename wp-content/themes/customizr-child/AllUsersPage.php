<?php
/*
Template Name: All Brogeys
*/
?>


<script language="javascript" type="text/javascript">
<!--
//Browser Support Code

function ajaxFunction() {

	var ajaxRequest; //The variable that makes ajax possible
	
	try {
		//Opera8.0, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();	
	} catch(e) {
		//Internet Explorer Browsers
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
			// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
			
	//Create a function that will receive data from the server
	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readystate == 4) {
			document.myForm.time.value = ajaxRequest.responseText;
		}
	}
	
	var is_favorited = document.getElementById('is_favorited').value;
	var friended_by_user_id = <?php get_current_user_id(); ?>
	var friend_user_id = document.getElementById('friend_user_id').value;
	var friend_user_name = document.getElementById('friend_user_name').value;
	
	var queryString =  "admin-ajax.php?is_favorited=" + is_favorited + "&friended_by_user_id=" + friended_by_user_id + 
	"&friend_user_id=" + friend_user_id + "&friend_user_name=" + friend_user_name;
	
	ajaxRequest.open("GET", queryString, true);
	ajaxRequest.send(); 

}

//-->
</script>






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
        $tables = array_map( function($t) { return "$t"; }, array('users', 'favorited_friends') );
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
		    "SELECT S.*, ID, user_login
		     FROM $wpdb->users S",
		    get_current_user_id()
		), OBJECT_K
	);
	

		// Retrieve data from Query String
	$is_favorited = $_GET['is_favorited'];
	$friended_by_user_id = $_GET['friended_by_user_id'];
	$friend_user_id = $_GET['friend_user_id'];
	$friend_user_name = $_GET['friend_user_name'];
		// Escape User Input to help prevent SQL Injection
	$is_favorited = mysql_real_escape_string($is_favorited);
	$friended_by_user_id = mysql_real_escape_string($friended_by_user_id);
	$friend_user_id = mysql_real_escape_string($friend_user_id);
	$friend_user_name = mysql_real_escape_string($friend_user_name);	
		

/* //Query built to display information on page after it's updated in database?	
	
		
		//build query
	if(!is_null($is_favorited)
		$query = "SELECT * FROM $wpdb->favorited_friends WHERE is_favorited = '$is_favorited' AND friended_by_user_id = '$friended_by_user_id
			  AND friend_user_id = '$friend_user_id' AND friend_user_name = '$friend_user_name'";
	
		//Execute query
	$qry_result = mysql_query($query) or die(mysql_error());
	
*/	


function record($parameters) {
        ## Should save to DB
        $wpdb = _prepare_bg_database();

        $wpdb->insert(
            $wpdb->bg_favorited_friends,
            array(
                'is_favorited'        => $is_favorited,
                'friended_by_user_id' => $friended_by_user_id,
                'friend_user_id'      => $friend_user_id,
                'friend_user_name'    => $friend_user_name,
            ),
            array(
                '%d',
                '%d',
                '%d',
                '%s'
            )
        );
        
        /* TODO:
         * - check each ->insert status (false means fail)
         * - throw errors when insert fails (ideally never)
         * - handle said errors (probably email someone)
         * - profit?
         */
        return 1;
    }









		

    $html = generate_table( $allBrogeyUsers);

    function generate_table($allBrogeyUsers) {
        $html = <<<EOHTML
<table>
    <thead>
    	<tr>
    	     <th>Brogey Nation</th>
    	     <th style="display:none">ID</th>
    	     <th>Add?</th>
    	     <th></th>
    	</tr>
    </thead>
    <tbody>
	
	<form id="add_to_favorites" method="post">
            
EOHTML;
 
        
        foreach ($allBrogeyUsers as $allBrogeyUser) {
            $allUserList = esc_html( $allBrogeyUser->user_login);
            $allUserIds  = esc_html( $allBrogeyUser->ID);
            $html .= <<<EOHTML
       
        <tr class="$class">
            
            <td id="friend_user_name">$allUserList</td>
            <td id="friend_user_id" style="display:none">$allUserIds</td>
            <td id="is_favorited">
	            <label for="is_favorited"></label>
		            <select id="is_favorited">
		            	<option value=""></option>
		            	<option value="1">Yes</option>
		            </select>
            </td>
            <td>
            	<input type="submit" onclick='ajaxFunction()' value="Add to friends" />
            </td>
        
        </tr>
    	</form>
       
        
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