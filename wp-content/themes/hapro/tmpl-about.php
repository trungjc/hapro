<?php
/**
* Template Name: giao diện 2 cột
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
				<div class="page-header-text">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>				
				</div>
			</header><!-- .page-header -->
			<div class="body-content clearfix">
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
				<div class="sidebar-left col-md-3 col-xs-12 col-sm-5">
					<ul class="menu-sub-page">
					<li class="parent active"><a href="<?php echo get_page_link($parent_page_id); ?>"><?php echo get_the_title( $parent_page_id ); ?></a></li>
					<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</li>

					<?php endwhile; ?>
					</ul>
				<?php wp_reset_query(); ?>
				</div>
				<div class="col-md-9 col-xs-12 col-sm-7">
					<div class="page-detail">
				<?php custom_breadcrumbs(); ?>
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>	

					<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
									
					<div id="parent-<?php the_ID(); ?>" class="parent-page">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-5">
								<a href="<?php the_permalink(); ?>" >
									<?php echo get_the_post_thumbnail( $page->ID ,'medium' ); ?>
								</a>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-7">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<div><?php $tomtat= get_field( 'tomtat'); echo $tomtat ?></div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				<?php endif; wp_reset_query(); ?>
				</div>
				</div>
			</div>
				
		</div>
	</main><!-- #main -->
</section><!-- #primary -->
<?php get_footer();?>