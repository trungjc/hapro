<?php
/**
 * Template Name: About
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
			<div class="container-fluid">
				<div class="hero-section in-view">
					<div class="slideshow">
						<div class="slideshow-inner" >
							<div class="hero-caption">
								<div class="container-fluid">
									<div class="inner col-md-12">
										<h2 class="heading"><?php echo $acf_fields['carousel_title'] ?></h2>
										<?php echo $acf_fields['carousel_content']?>
									</div>
								</div>
							</div>
							<?php if (!empty($acf_fields['carousel_image'])) {?>
							<div class="slideshow-image" id="slideshow-image">
								<div class="item purple-overlay ">
									<div class="img" style="background-image: url('<?php echo whispli_resize_image($acf_fields['carousel_image']['url'], 1345, 578)?>')"></div>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			<!-- END - hero-section =================================================================================== -->
		</div>
		<!-- end site-body-header-->
		<div class="page-blocks">
			<div class="container-fluid">
				<div class="site-body">
					<?php if (!empty($acf_fields['story_items'])) {?>
						<div class="below-hero">
							<div class="container">
								<?php foreach($acf_fields['story_items'] as $item) {?>
									<div class="panel">
										<div class="panel-body">
											<?php if(!empty($item['icon'])) {?>
												<div class="img-heading">
													<img src="<?php echo whispli_resize_image($item['icon']['url'],110,110)?>" alt="">
												</div>
											<?php }?>
											<h5><?php echo $item['title']?></h5>
											<?php echo $item['description']?>
										</div>
									</div>
								<?php }?>
							</div>
						</div>
					<?php }?>
					<!-- end below-hero-->
					<div class="one-platform">
						<div class="container">
							<div class="row">
								<div class="center col-md-12 col-xs-12">
									<h2 class="heading"><?php echo $acf_fields['story_title']?></h2>
									<?php echo $acf_fields['story_description']?>
								</div>
							</div>
						</div>
					</div>
					<!-- end one-platform-->
					<div class="what-will">
						<div class="hero-banner">
							<div class="hero-caption">
								<div class="container">
									<div class="row">
										<div class="col-md-7 col-sm-7 col-xs-12">
											<h3><?php echo $acf_fields['white_labelling_title']?></h3>
											<?php echo $acf_fields['white_labelling_description']?>
											<?php
											if ($acf_fields['link_type'] == 'internal'){
												$link = $acf_fields['white_labelling_internal_link'];
											} else {
												$link = $acf_fields['white_labelling_external_link'];
											}
											?>
											<a target="<?php echo $acf_fields['white_labelling_link_target']?>" href="<?php echo $link; ?>" class="btn btn-default btn-with-border"><?php echo whispli_remove_p_wrapper($acf_fields['link_block'])?></a>
										</div>
										<?php if (!empty($acf_fields['white_labelling_features'])) {?>
											<div class="col-md-4 col-sm-5  col-xs-12 col-md-push-1">
												<div class="list-items">
													<?php foreach($acf_fields['white_labelling_features'] as $item) {?>
														<div class="item">
															<h5><?php echo $item['title']?></h5>
															<?php echo $item['description']?>
														</div>
														<?php ?>
													<?php }?>
												</div>
												<!-- end list-item-->
											</div>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="hero-image">
								<div class="item dark-blue-overlay parallax">
									<!-- <img class="hidden-xs" src="img/about/item1.png" alt=""> -->
									<div class="parallax-img" style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/about/item1.png')"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- end what-will-->
					<?php if (!empty($acf_fields['people'])) {?>
						<div class="who-are-we">
							<div class="container">
								<div class="row">
									<h2 class="heading"><?php echo _e('who we are.','whispli')?></h2>
									<?php foreach($acf_fields['people'] as $person) {?>
										<div class="col-md-4 col-sm-4  col-xs-12 ">
											<?php if(!empty($person)) {?>
												<div class="avatar">
													<img src="<?php echo whispli_resize_image($person['image']['url'], 140, 140)?>" alt="">
												</div>
											<?php }?>

											<div class="title">
												<h5><?php echo $person['name']?></h5>
												<span class="job-title"><?php echo $person['position']?></span>
											</div>
											<div class="content">
												<?php echo $person['bio']?>
											</div>
										</div>
									<?php }?>
								</div>
							</div>
						</div>
					<?php }?>
					<!--end Final statement-->
				</div>
			</div>
			<!-- end site body-->
			<section class="widget-footer">
				<?php whispli_footer_featured_post();?>
			</section>
			<!-- END - widget-bottom =================================================================================== -->
		</div>
		<!-- end page-blocks ===================================================================================-->
	</section>
	<!-- end main ====================================-->

<?php endwhile; // End of the loop.?>
<?php
get_footer();
?>