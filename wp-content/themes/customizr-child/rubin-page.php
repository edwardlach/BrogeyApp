<?php
/*
Template Name: Rubin Page Example
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
</style>
EOCSS;
    }

    function _prepare_bg_database() {
        global $wpdb;
        ## If any slashes are added, everything will probably break
        ## But out database will be safe
        ## So just don't change the blog prefix to something ridiculous
        $prefix = addslashes( $wpdb->get_blog_prefix() );
        $tables = array_map( function($t) { return "bg_$t"; }, array( 'scores', 'course_tees', 'courses' ) );
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
    
    function validate(&$parameters) {
        ## TODO: extract string validation, integer validation to separate functions
        $errors = array();
        
        ## Begin with course parameters
        $course = $parameters['course_name'];
        if ( !$course ) {
            array_push( $errors, "Please enter the courses' name." );
        }
        else if ( strlen( $course ) > 100 ) {
            array_push( $errors, "Course name is too long, try abbreviating it." );
        }
        
        ## TTT (Tee Type Time)!
        $tee_type      = $parameters['tee_type'];
        $course_rating = $parameters['course_rating'];
        $slope_rating  = $parameters['slope_rating'];
        
        if ( !$tee_type ) {
            array_push( $tee_type, "Please enter the tee type (eg. blue)." );
        }
        else if ( strlen( $tee_type ) > 20 ) {
            array_push( $errors, "Tee type is too long, try abbreviating it." );
        }
    
        if ( !$course_rating ) {
            array_push( $course_rating, "Please enter a course rating." );
        }
        else if ( !preg_match( "/^[1-9][0-9]*$/", $course_rating ) ) {
            array_push( $errors, "Course rating must be a positive integer!" );
        }
        else if ( $course_rating < 67 || $course_rating > 77 ) {
            array_push( $errors, "Course rating must be between 67 and 77." );
        }
        
        if ( !$slope_rating ) {
            array_push( $slope_rating, "Please enter a slope rating." );
        }
        else if ( !preg_match( "/^[1-9][0-9]*$/", $slope_rating ) ) {
            array_push( $errors, "Slope rating must be a positive integer!" );
        }
        else if ( $slope_rating < 55 || $slope_rating > 155 ) {
            array_push( $errors, "Slope rating must be between 55 and 155." );
        }
        
        ## Finally score parameters
        $score = $parameters['score'];
        $year  = $parameters['date_year'];
        $month = $parameters['date_month'];
        $day   = $parameters['date_day'];
        $tweet = $parameters['tweet'];
        
        if ( !$score ) {
            array_push( $errors, "Please enter a score." );
        }
        else if ( !preg_match( "/^[1-9][0-9]*$/", $score ) ) {
            array_push( $errors, "Your score must be a positive integer!" );
        }
        else if ( $score > 255 ) {
            array_push( $errors, "Please enter a score no more than 255." );
        }
        
        if ( !$year ) {
            array_push( $errors, "Please enter a year." );
        }
        else if ( !preg_match( "/^[0-9]{4}$/", $year ) ) {
            array_push( $errors, "Please enter a four digit year!" );
        }
    
        if ( !$month ) {
            array_push( $errors, "Please select a month." );
        }
        else if ( !preg_match( "/^1?[0-9]$/", $month ) || $month < 1 || $month > 12 ) {
            array_push( $errors, "Please enter a valid month!" );
        }
        
        if ( !$day ) {
            array_push( $errors, "Please select a day." );
        } 
        else if ( !preg_match( "/^[0-3]?[0-9]$/", $day ) || $day < 1 || $day > 31 ) {
            array_push( $errors, "Please enter a valid day!" );
        }
        ## TODO make sure the day matches the month
        ## I'm sure there's something for that...
        ## Right now 2014-02-31 => 2014-03-03, which is reasonable I guess
        else {
            try {
                $parsed_date = new DateTime( "$year-$month-$day" );
                ## TODO Not everyone plays at noon
                $parameters['parsed_date'] = $parsed_date->format( "Y-m-d 12:00:00" );
            }
            catch (Exception $e) {
                array_push( $errors, "Could not figure out what day you meant, sorry :/" );
            }
        }

        return $errors;
    }
    
    function record($parameters) {
        ## Should save to DB
        $wpdb = _prepare_bg_database();

        $course_table = $wpdb->bg_courses;
        $tee_table    = $wpdb->bg_course_tees;
        $score_table  = $wpdb->bg_scores;

        $course_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT course_id FROM $course_table WHERE name = %s",
                $parameters['course_name']
            )
        );
        if ( !$course_id ) {
            $wpdb->insert(
                $wpdb->bg_courses,
                array( 'name' => $parameters['course_name'] ),
                array( '%s' )
            );
            $course_id = $wpdb->insert_id;
        }

        $tee_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT course_tee_id FROM $tee_table WHERE color = %s"
                . " AND course_rating = %d"
                . " AND slope_rating  = %d"
                . " AND course_id     = %d",
                $parameters['tee_type'],
                $parameters['course_rating'],
                $parameters['slope_rating'],
                $course_id
            )
        );
        if ( !$tee_id ) {
            $wpdb->insert(
                $tee_table,
                array(
                    'color'         => $parameters['tee_type'],
                    'course_rating' => $parameters['course_rating'],
                    'slope_rating'  => $parameters['slope_rating'],
                    'course_id'     => $course_id
                ),
                array(
                    '%s',
                    '%d',
                    '%d',
                    '%d'
                )
            );
            $tee_id = $wpdb->insert_id;
        }

        $wpdb->insert(
            $wpdb->bg_scores,
            array(
                'score'         => $parameters['score'],
                ## Verified a user logged in, so user_id isn't valid, then...
                ## WordPress is BROKED.
                'user_id'       => get_current_user_id(),
                'score_date'    => $parameters['parsed_date'],
                'course_tee_id' => $tee_id,
            ),
            array(
                '%d',
                '%d',
                '%s',
                '%d'
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
    
    if ( !is_user_logged_in() ) {
        go_to_login();
    }
    if ( $_POST['submit'] ) {
        $parameters = array(
            "course_name"   => $_POST['course_name'],
            
            "tee_type"      => $_POST['tee_type'],
            "course_rating" => $_POST['course_rating'],
            "slope_rating"  => $_POST['slope_rating'],
        
            "score"         => $_POST['score'],
            "date_year"     => $_POST['date_year'],
            "date_month"    => $_POST['date_month'],
            "date_day"      => $_POST['date_day']
        );
        
        $errors = validate( $parameters );
        if ( !count( $errors ) ) {
            ## Record and take the user home
            record( $parameters );
            ## TODO: leave a message
            wp_safe_redirect(
                get_site_url(get_current_blog_id(), 'profile'),
                302
            );
            exit;
        }
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
                            if( count( $errors ) ) {
                                echo '<div class="error">';
                                foreach ( $errors as $error ) {
                                    echo "$error<br/>";
                                }
                                echo '</div>';
                            }
                        ?>
                        <form id="score_report" method="post">
                            <label for="score">Score:</label>
                            <input name="score" type="number" min="0" max="255" placeholder="Score" required />
                            <label for="date_day">Day:</label>
                            <input name="date_day" type="number" min="1" max="31" placeholder="Day" title="Please enter a valid day" required />
                            <label for="date_month">Month:</label>
                                <select name="date_month">
                                    <option disabled selected>-- Select a Month --</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>                               
                            <label for="date_year">Year:</label>
                            <input name="date_year" type="text" value="2014" pattern="\d{4}" placeholder="Year" required/>
                            <label for="tweet">Thoughts:</label><textarea name="tweet" placeholder="Currently Ignored" ></textarea>

                            <label for="course_name">Course:</label>
                            <input name="course_name" type="text" pattern=".{1,100}" placeholder="Fair Oak Lawns" required />

                <label for="tee_type">Tee Type:</label>
                <input name="tee_type" type="text" pattern=".{1,20}" placeholder="Rainbow Tees!" required />
                <label for="course_rating">Course Rating:</label>
                <input name="course_rating" type="number" placeholder="Course Rating" min="67" max="77" required />
                <label for="slope_rating">Slope Rating:</label>
                <input name="slope_rating" type="number" placeholder="Slope Rating" min="55" max="155" required />

                <input type="submit" name="submit" value="Continue" />
                            

                        </form>

                    <?php do_action ('__after_loop');##hook of the comments and the posts navigation with priorities 10 and 20 ?>

                </div><!--.article-container -->

           <?php do_action( '__after_article_container'); ##hook of left sidebar ?>

        </div><!--.row -->
    </div><!-- .container role: main -->

    <?php do_action( '__after_main_container' ); ?>

</div><!--#main-wrapper"-->

<?php do_action( '__after_main_wrapper' );##hook of the footer with get_get_footer ?>
