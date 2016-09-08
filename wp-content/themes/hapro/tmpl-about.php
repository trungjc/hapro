<?php
/**
 * Template Name: template page list
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
<?php get_header(); ?>

	<section id="primary" class="content-area container ">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12 ">
			
					<header class="page-header" >
					<?php 
					
					$image = get_field( 'banner_image');
					if(!empty($image)) { ?>
						<div class="post-thumbnail" >
							<img  class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo $image['url'] ?>">	
						</div>		
					<?php }
					?>
				
					<div class="page-header-text">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>		
					
					</div>
				</header><!-- .page-header -->	
					<div class="page-detail">

<?php custom_breadcrumbs(); ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					<?php

			$args = array(
			    'post_type'      => 'page',
			    'posts_per_page' => -1,
			    'post_parent'    => $post->ID,
			    'order'          => 'ASC',
			    'orderby'        => 'menu_order'
			 );


			$parent = new WP_Query( $args );

			if ( $parent->have_posts() ) : ?>

			    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

			        <div id="parent-<?php the_ID(); ?>" class="parent-page">
						<div class="row">
<div class="col-xs-12 col-md-4">
							<a href="<?php the_permalink(); ?>" >
								<?php echo get_the_post_thumbnail( $page->ID ,'medium' ); ?>
							</a></div>
							<div class="col-xs-12 col-md-8">					
					            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					            <div><?php $tomtat= get_field( 'tomtat'); echo $tomtat ?></div>
							</div>
						</div>


			        </div>

			    <?php endwhile; ?>

			<?php endif; wp_reset_query(); ?>
			</div></div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();?>