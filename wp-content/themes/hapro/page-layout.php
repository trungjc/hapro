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