<?php
/**
 * WP Post Template: giao diện sản xuất
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area special-post  container">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12 ">
			<?php 
					$category = get_the_category(); 
					//var_dump($category);
					$root = get_category($category[0]->parent);
					$cat_name_root=$root->name;
					$parent = get_category($category[0]->term_id);
					
					$cat_id=$parent->term_id;
					$cat_name=$parent->name;
				?>
					<header class="page-header" >
						<div class="page-header-text">
							<h1 class="page-title"><?php echo $cat_name ?></h1>		
						
						</div>
					</header><!-- .page-header -->

					<div class="clearfix body-content">
					<div class="sidebar-left col-md-3 col-xs-12 col-sm-5">
						<?php if ( is_active_sidebar( 'sidebar-sx' ) ) : ?>
							<div id="widget-area" class="widget-area menu-sub-page" role="complementary">
								<?php dynamic_sidebar( 'sidebar-sx' ); ?>
							</div><!-- .widget-area -->
						<?php endif; ?>
					</div>	
			<div class="col-md-9 col-xs-12 col-sm-7">
				<div class="page-detail">
					
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
			 if(function_exists('bcn_display'))
			    {
			    	echo '<div  class="breadcrumbs" id="breadcrumbs">';
			        bcn_display();
			        echo '</div>';
			    }
			    ?>
			
				
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 


				<header class="entry-header">
					<?php
						if ( is_single() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
						endif;
					?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
						/* translators: %s: Name of current post */
						the_content( sprintf(
							__( 'Continue reading %s', 'twentyfifteen' ),
							the_title( '<span class="screen-reader-text">', '</span>', false )
						) );

					?>
				</div><!-- .entry-content -->


			</article><!-- #post-## -->

			<?php // End the loop.
			endwhile;
			?>
			<?php 
joints_related_posts_default() ;
			?>
			</div>
			</div>
		</div>
	</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
