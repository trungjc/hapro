<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3 col-xs-12'); ?>>
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
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->


</article><!-- #post-## -->
