<?php
/*
Template Name: Decision Tree
*/
?>





<?php do_action( '__before_main_wrapper' ); ##hook of the header with get_header ?>
<div id="main-wrapper" class="<?php echo tc__f( 'tc_main_wrapper_classes' , 'container' ) ?>">

    <?php do_action( '__before_main_container' ); ##hook of the featured page (priority 10) and breadcrumb (priority 20)...and whatever you need! ?>
    
    
    <ul id="decision-matrix">
    	<div id="will-play">
    	<li>Looking for somewhere to play or something to do?</li>
    	</div>
    	<li><a href="http://brogeygolfreview.com/?p=99">Click Here</a></li>
    	<div id="have-played">
    	<li>Have you recently rocked some golf?</li>
    	</div>
	<li><a href="http://brogeygolfreview.com/?p=141">Click Here</a></li>
	<div id="just-browsing">
	<li>You are a man on a mission.  Head straight to your Brofile.</li>
	</div>
	<li><a href="http://brogeygolfreview.com/?p=95">Click Here</a></li>
    </ul>    
    

    <?php do_action( '__after_main_container' ); ?>

</div><!--#main-wrapper"-->


<?php do_action( '__after_main_wrapper' );##hook of the footer with get_get_footer ?>