
<div class="body-content clearfix">
	<?php
	$args = array(
	'post_type'      => 'page',
	'posts_per_page' => -1,
	'post_parent'    => $parent_page_id,
	'order'          => 'ASC',
	'orderby'        => 'menu_order'
	);
	$parent = new WP_Query( $args );
	if ( $parent->have_posts() ) : ?>
	<div class="sidebar-left col-md-3 col-xs-12 col-sm-5">
		<ul class="menu-sub-page">
			<li class="parent"><a href="<?php echo get_page_link($parent_page_id); ?>"><?php echo get_the_title( $parent_page_id ); ?></a></li>
		<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</li>

		<?php endwhile; ?>
		</ul>
	<?php endif; wp_reset_query(); ?>
	</div>
	<div class="col-md-9 col-xs-12 col-sm-7">
		<div class="page-detail">
	<?php custom_breadcrumbs(); ?>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<?php while ( have_posts() ) : the_post();?>
	
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
			<?php endwhile; // End of the loop.?>
		</div>
	</div>
</div>
