<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12 ">
			<?php 
					$category = get_the_category(); 
					//var_dump($category);
					$root = get_category($category[0]->parent);
					$cat_name_root=$root->name;
					$parent = get_category($category[0]->term_id);
					//print_r($parent);
					$cat_id=$parent->term_id;
					$cat_name=$parent->name;
				?>
					<header class="page-header" >
						<?php twentyfifteen_post_thumbnail(); //echo do_shortcode('[wp_custom_image_category  size="full" term_id="'.$cat_id.'" ]');  ?>
						<div class="page-header-text">
							<h1 class="page-title"><?php echo $cat_name ?></h1>		
						<?php

							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
						</div>
					</header><!-- .page-header -->
				<div class="page-detail">
					
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
			custom_breadcrumbs();
			echo "<h1 class='page-title'>".$cat_name .'</h1>';
				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );


				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( '', 'twentyfifteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( '', 'twentyfifteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '', 'twentyfifteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( '', 'twentyfifteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );

			// End the loop.
			endwhile;
			?>
			<div class="back"><a href="<?php  $category_link = get_category_link( $cat_id ); echo esc_url($category_link); ?>" title="Category Name">Back</a></div>
			</div>
			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
