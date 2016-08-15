<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12">
				<?php if ( have_posts() ) : ?>
				<?php 
					$category = get_category( get_query_var( 'cat' ) );
					$parent_cat = $category->category_parent;
					//print_r($parent_cat);
					$cat_id = $category->cat_ID; 
				?>
					<header class="page-header" >
						<?php echo do_shortcode('[wp_custom_image_category  size="full" term_id="'.$cat_id.'" ]');  ?>
						<div class="page-header-text">
							<h1 class="page-title">
							<?php printf( __( '%s', 'slidingdoor' ), '<span>' . single_cat_title( '', false ) . '</span>' );?>
								
							</h1>		
						<?php

							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
						</div>
					</header><!-- .page-header -->
				<div class="category-grid clearfix">
				<?php custom_breadcrumbs(); ?>
				<h1 class="page-title"><?php
				printf( __( '%s', 'slidingdoor' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>		
					<div class="row">
					<?php
					// Start the Loop.
					while ( have_posts() ) : the_post(); ?>

						
						<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3 col-xs-12'); ?> >
						
								<?php if ( has_post_thumbnail() ) : ?>
								<a class="image-intro" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php the_post_thumbnail_url(); ?>"/>
								</a>
							<?php else :  ?>
								<a class="image-intro" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/no-image-300x300.gif"/>
								</a>
							<?php endif; ?>
						
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_excerpt(); ?>
								<?php
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
								?>
							</div><!-- .entry-content -->
							<?php
							 $currentlang = get_bloginfo('language');
							 if($currentlang=="en-US"):
							   $more = 'read more';
							?>
							<?php else: 
							  $more = 'đọc thêm';

							  endif;  ?>
							  <div class="cleafix"><a class="more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $more; ?> &raquo;</a></div>
							
						</article><!-- #post-## -->

				<?php	// End the loop.
			endwhile; ?>
		</div>	
		<?php	// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) ); ?>
		</div>
		
		

<?php
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
</div>
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
