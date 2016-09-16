<?php
/**
* Category Template: giao diện sản xuất
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
			<?php
				$category = get_category( get_query_var( 'cat' ) );
				$parent_cat = $category->category_parent;
				$cat_id = $category->cat_ID;
				//print_r()
			?>
			<header class="page-header" >
				<div class="page-header-text">
					<h1 class="entry-title">			
					<?php if(!empty($parent_cat)) { ?>
						<?php echo get_cat_name($parent_cat); ?>
					<?php } else { ?>
						<?php printf( __( '%s', 'slidingdoor' ), '<span>' . single_cat_title( '', false ) . '</span>' );?>
					<?php } ?>	
					</h1>			
				</div>			
			</header><!-- .page-header -->
			<div class="clearfix body-content category-special">
				<div class="sidebar-left col-md-3 col-xs-12 col-sm-5">
					<?php if ( is_active_sidebar( 'sidebar-sx' ) ) : ?>
						<div id="widget-area" class="widget-area menu-sub-page" role="complementary">
							<?php dynamic_sidebar( 'sidebar-sx' ); ?>
						</div><!-- .widget-area -->
					<?php endif; ?>
				</div>	
				<!--sidebar-left -->
				<div class="col-md-9 col-xs-12 col-sm-7">			
				 
				<?php if ( have_posts() ) : ?>
					<div class="category-grid page-detail ">
						<?php custom_breadcrumbs(); ?>
						<h1 class="page-title"><?php
						printf( __( '%s', 'slidingdoor' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						?></h1>
						<div class=" category-des media">
							<div class="pull-left">
								<?php echo do_shortcode('[wp_custom_image_category  size="full" term_id="'.$cat_id.'" ]');  ?>
							</div>				
							<div class="page-header-text ">
								
								<?php
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</div>
						</div>
							<?php //neu category bang 56 thi hien thi ra list category
					if ($cat_id==56) { ?>
						<?php
						$args = array('parent' => $cat_id,'hide_empty'       => 0,);
						$categories = get_categories( $args );
						echo "<div class='row category-parent'>";
						foreach($categories as $category) { 
							echo "<div class='col-xs-12 col-md-3'><div class='img-image-cat'>";
						   echo do_shortcode('[wp_custom_image_category  size="full" term_id="'.$category->cat_ID.'" ]'); 
						    echo "</div>";
						    echo '<h3 class="title-cat"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </h3></div> ';
						   
						} 
						 echo "</div>";
						?>
						
				<?php	}  else { ?>



						<div class="row list-product">	
							<?php
							// Start the Loop.
							while ( have_posts() ) : the_post(); ?>
							<div class="col-xs-12 col-sm-4 col-md-3">
								<article id="post-<?php the_ID(); ?>" <?php post_class('list-post'); ?> >													<?php if ( has_post_thumbnail() ) : ?>
									<div class="image">
										<a class="image-intro " href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php the_post_thumbnail_url(); ?>"/>
										</a>
									</div>
									<?php else :  ?>
									<div class="image">
										<a class="image-intro " href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/no-image-300x300.gif"/>
										</a>
									</div>
									<?php endif; ?>
									<h3 class="the-title">
									<a class="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
									</h3><!-- .entry-header -->		
									</article><!-- #post-## -->
								</div>
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
					<!--end page-detail-->
					<?php	
						}		
					else :
						get_template_part( 'content', 'none' );
					endif;
					//ket thuc check category san xuat
					?>
				</div>
				<!--col-md-9 col-xs-12 col-sm-7-->
			</div>
			<!--body-content-->				
			
		</div>
	</main><!-- .site-main -->
</section><!-- .content-area -->
<?php get_footer(); ?>