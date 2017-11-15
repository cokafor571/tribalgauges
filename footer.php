<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starterpack
 */

?>

	</div><!-- #content -->

    <?php echo do_shortcode("[mc4wp_form id='47']"); ?>
    <?php get_sidebar( 'footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
        <?php
        // Make sure there is a social menu to display.
        if ( has_nav_menu( 'social' ) ) { ?>
            <nav class="social-menu">
                <?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
            </nav><!-- .social-menu -->
        <?php } ?>
        
		<div class="site-info">
			&copy; Tribal Gauges 2017
            <img src="https://tribalgauges.com/wp-content/uploads/2017/10/payment-cards.png">
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
