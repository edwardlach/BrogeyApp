<?php
/*
Template Name: User Upload & Input Form
*/
?>





<?php do_action( '__before_main_wrapper' ); ##hook of the header with get_header ?>
<div id="main-wrapper" class="<?php echo tc__f( 'tc_main_wrapper_classes' , 'container' ) ?>">

    <?php do_action( '__before_main_container' ); ##hook of the featured page (priority 10) and breadcrumb (priority 20)...and whatever you need! ?>
    
    
	<div id="uploadForm">
	
		<?php if (function_exists('user_submitted_posts')) user_submitted_posts(); ?>
		
	</div>
	
    

    <?php do_action( '__after_main_container' ); ?>

</div><!--#main-wrapper"-->


<?php do_action( '__after_main_wrapper' );##hook of the footer with get_get_footer ?>