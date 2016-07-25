<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package whispli
 */

get_header(); ?>

<?php
while ( have_posts() ) : the_post();
	$acf_fields = get_fields();
	$blog_page = icl_object_id(BLOG_PAGE_ID,'page', true );
	?>
	<section class="main">
		<div class="site-body-header">
			<div class="container-fluid">
				<?php if(!empty($acf_fields['hero_image'])) {?>
					<div class="hero-banner feature-image-container">
						<div class="hero-image">
							<div class="item purple-overlay">
								<img src="<?php echo whispli_resize_image($acf_fields['hero_image']['url'], 1360, 641)?>" alt="" />
								<!--<div class="visible-xs-block " style="background-image: url('<?php echo whispli_resize_image($acf_fields['hero_image']['url'], 1360, 641)?>')"></div>-->
							</div>
						</div>
					</div>
				<?php }?>
				<!-- END - hero =================================================================================== -->
			</div>
		</div>
		<div class="page-blocks">
			<div class="container-fluid">
				<div class="site-body">
					<!-- END - hero =================================================================================== -->
					<div class="container " id="content">
						<div class="row single-content">
							<div id="primary" class="col-md-8 col-sm-7 col-xs-12  main-content">
								<article class="post type-post format-standard">
									<header class="entry-header">
										<span class="entry-date"><?php the_date('j M Y')?></span>|
										<span class="entry-author"><?php echo _e('by', 'whispli')?>: <?php the_author()?></span>
										<h1 class="entry-title"><?php the_title(); ?></h1>
									</header>
									<div class="entry-content">
										<?php the_content();?>
									</div>
									<footer class="entry-meta row">
										<nav class="nav-single hidden-xs col-md-6 col-xs-12">
                                            <span class="nav-previous"><a class="btn btn-default btn-border-dark read-more" href="<?php echo get_permalink($blog_page);?>"><?php echo _e('Go Back', 'whispli');?>
													<span class="icon-arrow"></span></a>
                                            </span>
										</nav>
										<div class="share-post col-md-6 col-xs-12">
											<div class="pull-right">
												<div class="share-title pull-left">Share</div>
												<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ef3722431aa8e44" async="async"></script>
												<div class="addthis_toolbox addthis_default_style pull-left">
													<a class="addthis_button_facebook"><i class="icon-facebook"></i></a>
													<a class="addthis_button_twitter"><i class="icon-twitter"></i></a>
													<a class="addthis_button_linkedin"><i class="icon-linkedin2"></i></a>
												</div>
											</div>
										</div>
									</footer>
								</article>
							</div>
							<div id="secondary" class="col-md-4  col-sm-5 col-xs-12 sidebar">
								<aside class="widget widget_action " id="search-3">
									<div class="panel">
										<div class="panel-body">
											<div class="cat-img">
												<?php if(!empty($acf_fields['product_link'])) {?>
													<a href="<?php echo get_permalink($acf_fields['product_link']->ID)?>"><img src="<?php echo get_template_directory_uri()?>/assets/img/blog/fraudsec-cat.png" alt=""></a>
												<?php }else {?>
													<a href="<?php echo get_permalink(ABOUT_PAGE_ID); ?>"><img src="<?php echo get_template_directory_uri()?>/assets/img/blog/fraudsec-cat.png" alt=""></a>
												<?php }?>
											</div>
											<?php if(!empty($acf_fields['product_link'])) {?>
												<div class="more-post">
													<a href="<?php echo get_permalink($acf_fields['product_link']->ID)?>" class="btn btn-default btn-border-dark read-more"><?php echo _e('MORE ABOUT', 'whispli')?> <?php echo get_the_title($acf_fields['product_link']->ID);?>
														<span class="icon-arrow"></span></a>
												</div>
											<?php }?>
											<div class="nav-previous">
												<a href="<?php echo get_permalink($blog_page);?>" class="btn btn-default btn-border-dark read-more"><?php echo _e('GO BACK', 'whispli');?>
													<span class="icon-arrow"></span></a>
											</div>
										</div>
									</div>
								</aside>
							</div>
						</div>
					</div>
				</div>
				<!-- END -site-body =================================================================================== -->
			</div>
			<!-- END -container-fluid =================================================================================== -->
			<!-- end main ====================================-->
			<section class="widget-footer">
				<?php echo whispli_footer_featured_post();?>
			</section>
			<!-- END - widget-bottom =================================================================================== -->
		</div>
	</section>
	<!-- END - Main =================================================================================== -->
	<?php
endwhile; // End of the loop.
?>

<?php
get_footer();
