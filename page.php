<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starterpack
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<!-- Blog Custom Fields In a Post Loop -->

			<?php if( is_page( 'Blg' ) ) :

			$args = array( 
				'post_type' => 'blogs', 
				'posts_per_page' => 10 
			);

			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();  ?>

			<h1>
				<?php the_field( 'blog_page_header' ); ?>
			</h1>
			<p>
				<?php the_field( 'blog_page_header_description' ); ?>
			</p>

				<?php

				// check if the repeater field has rows of data
				if( have_rows('blog_posts') ): ?>

				<div class="blog-posts">

				<?php

					// loop through the rows of data
					while ( have_rows('blog_posts') ) : the_row(); 

					// vars
					$image = get_sub_field('blog_post_image');
					$title = get_sub_field('blog_post_title');
					$content = get_sub_field('blog_post_text');	?>

					<div class="blog-wrapper">
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>">
						<div class="blog-text">
							<p><?php echo $title; ?></p>
							<p><?php echo $content; ?></p>
						</div>
					</div>

					<?php endwhile;

				else :

					// no rows found

				endif;

				?>
				</div>

			<?php 
				endwhile;
			endif; ?>

		<!-- End Blog Custom Fields -->

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
