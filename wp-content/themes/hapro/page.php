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
<?php  $parent_page_id= wp_get_post_parent_id( $post_ID ); ?>
	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12 ">			
				<header class="page-header" >	
					<div class="page-header-text">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					
					</div>
				</header><!-- .page-header -->	
				<?php if(!empty($parent_page_id)) {
							include_once 'sub-page-layout.php';
					} else {
							include_once 'page-layout.php';					
					} ?>		
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
