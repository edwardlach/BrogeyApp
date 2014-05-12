<?php
/*
Template Name: Rubin Profile
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

    function _button_to($url, $text) {
        return "<a class=\"btn\" href=\"$url\">$text</a>";
    }
    
    if ( !is_user_logged_in() ) {
        go_to_login();
    }

    $wpdb = _prepare_bg_database();
    $scores = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT S.*, C.name, T.color, T.slope_rating, T.course_rating
             FROM $wpdb->bg_scores S
             LEFT JOIN $wpdb->bg_course_tees T USING (course_tee_id)
             LEFT JOIN $wpdb->bg_courses C USING (course_id)
             WHERE user_id = %d
             ORDER BY score_date DESC",
            get_current_user_id()
        ), OBJECT_K
    );

    $total_rounds = count( $scores );
    if ( $total_rounds < 5 ) {
        ## Display a message about no handicap yet
    }
    else {
        $diff_map = array(
            5  => 1,
            6  => 1,
            7  => 2,
            8  => 2,
            9  => 3,
            10 => 3,
            11 => 4,
            12 => 4,
            13 => 5,
            14 => 5,
            15 => 6,
            16 => 6,
            17 => 7,
            18 => 8,
            19 => 9
        );

        $total_differentials = $diff_map[$total_rounds];
        if ( !$total_differentials ) { $total_differentials = 10; }

        /* TODO
         * Ed says use all rounds, best 10
         * http://www.usga.org/rule-books/handicap-system-manual/handicap-manual/
         *   "no more than 20" "ideally the best 10 of the last 20 rounds"
         */

        foreach ( $scores as $score ) {
            $diff = _calculate_differential( $score );
            $score->differential = $diff;
        }

        $sorted_scores = $scores;
        usort( $sorted_scores, function($a, $b) {
            return $b->differential - $a->differential;
        } );

        $diff_scores   = array_slice( $sorted_scores, 0, $total_differentials );
        $differentials = array();

        foreach ( $diff_scores as $diff_score ) {
            $scores[$diff_score->score_id]->class = "handicap";
            array_push( $differentials, $diff_score->differential );
        }

        $handicap = _calculate_handicap( $differentials );
    }


    function _calculate_differential($score) {
        return (
            ($score->score - $score->course_rating) * 113 / $score->slope_rating
        );
    }
    function _calculate_handicap( $differentials ) {
        return (
            array_sum( $differentials ) / count( $differentials ) * .96
        );
    }
    function _show_handicap( $handicap ) {
        ## TODO: the logic here is horrible
        ## We should pass messages into this function maybe?
        if ( is_numeric( $handicap ) ) {
            return "Your handicap is $handicap.";
        }
        else {
            return "You have not played enough games (5) to have a handicap.";
        }
    }

    $html = generate_table( $scores );

    function generate_table($scores) {
        $html = <<<EOHTML
<table>
    <thead>
        <tr>
            <th>Course</th>
            <th>Tee Type</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
EOHTML;

        foreach ($scores as $score) {
            $course = esc_html( $score->name );
            $color  = esc_html( $score->color );
            $class  = esc_html( $score->class );
            $html .= <<<EOHTML
        <tr class="$class">
            <td>$course</td>
            <td>$color</td>
            <td>$score->score</td>
            <td>$score->score_date</td>
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
                            echo _show_handicap( $handicap );
                            echo $html;
                            echo(
                                _button_to(
                                    get_site_url(get_current_blog_id(), 'rubin' ),
                                    "Report a game!"
                                )
                            );
                        ?>

                    <?php do_action ('__after_loop');##hook of the comments and the posts navigation with priorities 10 and 20 ?>

                </div><!--.article-container -->

           <?php do_action( '__after_article_container'); ##hook of left sidebar ?>

        </div><!--.row -->
    </div><!-- .container role: main -->

    <?php do_action( '__after_main_container' ); ?>

</div><!--#main-wrapper"-->

<?php do_action( '__after_main_wrapper' );##hook of the footer with get_get_footer ?>
