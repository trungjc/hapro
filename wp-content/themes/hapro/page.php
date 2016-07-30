<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package whispli
 */

get_header(); ?>

	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12 ">
			
					<header class="page-header" >
						<?php 
					twentyfifteen_post_thumbnail();
				?>
						<div class="page-header-text">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>		
						
						</div>
					</header><!-- .page-header -->
					
		
	<div class="page-detail">
			<?php
			while ( have_posts() ) : the_post();

				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- <header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header>.entry-header -->

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'whispli' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->

				</article><!-- #post-## -->
				<?php

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?></div>
</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
