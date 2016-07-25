<?php
/**
 * Template Name: Blog
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
<?php get_header(); ?>
<?php  while ( have_posts() ) : the_post();?>
	<?php $acf_fields = get_fields();?>
	<section class="main">
		<div class="site-body-header">
			<section class="hero-section-area parallax-bg">
				<div class="container-fluid">
					<div class="hero-section in-view">
						<div class="slideshow">
							<div class="slideshow-inner">
								<div class="hero-caption">
									<div class="container-fluid">
										<div class="inner col-md-12">
											<h2 class="heading"><?php echo whispli_remove_p_wrapper($acf_fields['hero_title'])?></h2>
											<p><?php echo $acf_fields['view_from_products_label']?></p>
											<div class="action-container">
												<div class="form-group select-box ">
													<select class="form-control" id="FilterSelect">
														<option  value="all"  selected=""><?php echo _e('All Products', 'whispli')?></option>
														<?php $categories = get_categories(array('hide_empty' => 1)); ?>
														<?php foreach($categories as $cate) {?>
															<option  value="<?php echo $cate->term_id;?>"><?php echo $cate->name?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php if(!empty($acf_fields['image'])) {?>
									<div class="hero-image">
										<div class="item purple-overlay parallax">
											<div class="parallax-img" style="background-image: url('<?php echo whispli_resize_image($acf_fields['image']['url'], 1345, 578);?>')"></div>
										</div>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- END - hero-section =================================================================================== -->
		</div>
		<!-- end site-body-header-->
		<div class="page-blocks">
			<div class="container-fluid">
				<div class="site-body">
					<!-- END - hero =================================================================================== -->
					<div class="container category-container">
						<div class="row">
							<div class="col-md-12">
								<div class="posts clearfix" id="posts">
									<?php $posts = get_posts( array( 'posts_per_page' => 4 ) );?>
									<?php global $post;?>
									<?php if(!empty($posts)) {?>
										<?php foreach($posts as $i=>$post) { ?>
											<?php setup_postdata( $post );?>
											<article class="post type-post fraudsec-category post-item-feature <?php if($i%2==0) {echo 'even';} else{echo 'odd';}?>" data-myorder="<?php echo $i+1?>">
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="feature-image">
														<?php $product_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) ?>
														<img src="<?php echo whispli_resize_image($product_thumbnail_src[0],470, 334,true,true,true); ?>" alt="">
														<div class="visible-sm-block" style="background-image: url('<?php echo $product_thumbnail_src[0]; ?>')"></div>
													</div>
												<?php } else {?>
													<div class="feature-image">
														<img src="<?php echo get_template_directory_uri()?>/assets/img/blog_placeholder.png" alt="">
														<div class="visible-sm-block" style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/blog_placeholder.png')"></div>
													</div>
												<?php } ?>
												<?php $cates = get_the_category(); ?>
												<div class="post-content">
													<header class="entry-header">
														<?php if(!empty($cates)) {?>
															<div class="cat-links"><span><?php echo $cates[0]->name?></span></div>
														<?php }?>
														<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
														<div class="posted-on"><?php the_date('j M Y')?></div>
													</header>
													<div class="entry-content">
														<?php echo truncateExtract(get_the_excerpt()); ?>
													</div>
													<a class="btn btn-default btn-border-dark read-more" href="<?php the_permalink()?>"><?php echo _e('Read more','whispli');?>
														<span class="icon-arrow"></span></a>
												</div>
											</article>
										<?php }
										wp_reset_postdata();?>
									<?php }?>
								</div>
								<?php if (count($posts) > 4) {?>
									<div class="load-more center">
										<a id="load-more-button" class="btn btn-default btn-border-dark " href="javascript:void(0)" data-filter="all"><?php echo _e('Load more','whispli') ?> <span class="icon-arrow"></span></a>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<!-- END -site-body =================================================================================== -->
			</div>
			<!-- END -container-fluid =================================================================================== -->
	</section>
	<!--end page-blocks-->
	<!-- END - Main =================================================================================== -->
<?php endwhile; // End of the loop.?>
<?php
get_footer();
?>
