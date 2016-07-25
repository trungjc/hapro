<?php
/**
 * Template Name: Product
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php $acf_fields = get_fields(); ?>
	<?php $has_product = 0; ?>
	<?php if ( have_rows( 'content' ) ) { ?>
		<?php if ( $acf_fields['layout_type'] == 'holding' ) { ?>
			<?php foreach ( $acf_fields['content'] as $row ) { ?>
				<?php if ( $row['acf_fc_layout'] == 'carousel' ) { ?>
					<section class="hero-section hero-section-no-product">
						<div class="container-fluid">
							<div class="hero-banner parallax-bg">
								<div class="hero-caption">
									<div class="container-fluid">
										<div class="inner col-md-12">
											<?php if ( ! empty( $row['icon'] ) ) { ?>
												<img class="logo-img" src="<?php echo $row['icon']['url'] ?>" alt="">
											<?php } ?>
											<?php if ( ! empty( $row['sub_title'] ) ) { ?>
												<h2 class="sub-heading"><?php $row['sub_title']; ?></h2>
											<?php } ?>
											<h2 class="heading"><?php echo $row['title'] ?></h2>
											<?php echo $row['description']; ?>
											<?php if ( ! empty( $row['links'] ) ) { ?>
												<div class="button-container">
													<div class="btn-group" role="group">
														<?php unset( $i );
														unset( $link ); ?>
														<?php if ( $acf_fields['layout_type'] == 'holding' ) { ?>
															<?php $button_colour = array( 'btn btn-default btn-primary', 'btn btn-default btn-secondary' ); ?>
														<?php } else { ?>
															<?php $button_colour = array( 'btn btn-default btn-black', 'btn btn-default btn-light-blue' ); ?>
														<?php } ?>
														<?php foreach ( $row['links'] as $i => $link ) { ?>
															<?php
															if ( $link['type'] != 'none' ) {
																if ( $link['type'] == 'internal' ) {
																	$href = $link['internal_link'];
																} else {
																	$href = $link['external_link'];
																}
																$is_video_url = strpos( $href, 'youtube' ) || strpos( $href, 'vimeo' );
																?>
																<a target="<?php echo $link['target'] ?>" <?php if ( $i > 0 && $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_1'] ) ) {
																	echo 'onMouseOver="this.style.background=\'#00517c\';this.style.borderColor=\'#00517c\'" onMouseOut="this.style.background=\'' . $acf_fields['colour_1'] . '\';this.style.borderColor=\'' . $acf_fields['colour_1'] . '\'" style="background: ' . $acf_fields['colour_1'] . ';border-color: ' . $acf_fields['colour_1'] . ';"';
																} ?> href="<?php echo $href ?>" class="<?php echo $button_colour[$i];
																if ( false != $is_video_url ) {
																	echo ' popup-media';
																} ?>"><?php echo whispli_remove_p_wrapper( $link['block'] ) ?></a>
															<?php } ?>
														<?php } ?>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if ( ! empty( $row['image'] ) ) { ?>
									<div class="hero-image">
										<div class="item purple-overlay parallax">
											<div class="parallax-img " style="background-image: url('<?php echo whispli_resize_image( $row['image']['url'], 1345, 730 ) ?>')">
											</div>
											<!-- image for mobile-->
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</section>
				<?php } ?>
			<?php } ?>
		<?php } else { ?>
			<section class="main">
				<?php foreach ( $acf_fields['content'] as $row ) { ?>
					<?php if ( $row['acf_fc_layout'] == 'carousel' ) { ?>
						<div class="site-body-header">
							<div class="container-fluid">
								<div class="hero-section in-view ">
									<div class="slideshow">
										<div class="slideshow-inner">
											<div class="hero-caption">
												<div class="container-fluid">
													<div class="inner col-md-12">
														<?php if ( ! empty( $row['icon'] ) ) { ?>
															<img class="logo-img" src="<?php echo $row['icon']['url'] ?>" alt="">
														<?php } ?>
														<?php if ( ! empty( $row['sub_title'] ) ) { ?>
															<h2 class="sub-heading"><?php $row['sub_title']; ?></h2>
														<?php } ?>
														<h2 class="heading"><?php echo $row['title'] ?></h2>
														<?php echo $row['description']; ?>
														<?php if ( ! empty( $row['links'] ) ) { ?>
															<div class="button-container">
																<div class="btn-group" role="group">
																	<?php unset( $i );
																	unset( $link ); ?>
																	<?php if ( $acf_fields['layout_type'] == 'holding' ) { ?>
																		<?php $button_colour = array( 'btn btn-default btn-primary', 'btn btn-default btn-secondary' ); ?>
																	<?php } else { ?>
																		<?php $button_colour = array( 'btn btn-default btn-black', 'btn btn-default btn-light-blue' ); ?>
																	<?php } ?>
																	<?php foreach ( $row['links'] as $i => $link ) { ?>
																		<?php
																		if ( $link['type'] != 'none' ) {
																			if ( $link['type'] == 'internal' ) {
																				$href = $link['internal_link'];
																			} else {
																				$href = $link['external_link'];
																			}
																			$is_video_url = strpos( $href, 'youtube' ) || strpos( $href, 'vimeo' );
																			?>
																			<a target="<?php echo $link['target'] ?>" <?php if ( $i > 0 && $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_1'] ) ) {
																				echo 'onMouseOver="this.style.background=\'#00517c\';this.style.borderColor=\'#00517c\'" onMouseOut="this.style.background=\'' . $acf_fields['colour_1'] . '\';this.style.borderColor=\'' . $acf_fields['colour_1'] . '\'" style="background: ' . $acf_fields['colour_1'] . ';border-color: ' . $acf_fields['colour_1'] . ';"';
																			} ?> href="<?php echo $href ?>" class="<?php echo $button_colour[$i];
																			if ( false != $is_video_url ) {
																				echo ' popup-media';
																			} ?>"><?php echo whispli_remove_p_wrapper( $link['block'] ) ?></a>
																		<?php } ?>
																	<?php } ?>
																</div>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
											<?php if ( ! empty( $row['image'] ) ) { ?>
												<div class="slideshow-image" id="slideshow-image">
													<div class="item blue-overlay ">
														<div class="img" style="background-image: url('<?php echo whispli_resize_image( $row['image']['url'], 1345, 578 ) ?>')"></div>
													</div>
												</div>
											<?php } ?>

										</div>
									</div>
								</div>
							</div>
							<!-- END - hero-section =================================================================================== -->
						</div>
					<?php } ?>
					<?php if ( $row['acf_fc_layout'] == 'secondary_menu' ) { ?>
						<!-- END - hero-section =================================================================================== -->
						<section class="secondary-menu">
							<div class="container-fluid">
								<div class="navbar-header">
									<!-- end mobile-navbar-collapse-->
									<h2 class="logo">
										<a title="logo" href="<?php echo icl_get_home_url(); ?>"><img height="83" alt="logo" src="<?php echo get_template_directory_uri() ?>/assets/img/fraudsec-logo.png"></a>
									</h2>
									<!-- end logo-->
								</div>
								<nav class="navbar-secondary clearfix">
									<ul class="nav navbar-nav">
										<?php unset( $i ); ?>
										<?php foreach ( $row['menu'] as $i => $node ) { ?>
											<li class="<?php if ( $i == 0 ) {
												echo 'hidden-xs';
											} ?>">
												<a href="<?php echo $node['link'] ?>"><?php echo $node['label'] ?></a>
											</li>
										<?php } ?>
									</ul>
									<ul class="nav navbar-nav  pull-right hidden-xs <?php echo $row['facebook'] ?>">
										<?php
										$facebook_link = ( ! empty( $row['facebook'] ) ) ? $row['facebook'] : get_option( 'facebook_link' );
										$twitter_link  = ( ! empty( $row['twitter'] ) ) ? $row['twitter'] : get_option( 'twitter_link' );
										$linkedin_link = ( ! empty( $row['linkedin'] ) ) ? $row['linkedin'] : get_option( 'linkedin_link' );
										?>
										<li>
											<a target="_blank" href="<?php echo $facebook_link; ?>"><span class="icon-facebook"></span></a>
										</li>
										<li>
											<a target="_blank" href="<?php echo $twitter_link; ?>"><span class="icon-twitter"></span></a>
										</li>
										<li>
											<a target="_blank" href="<?php echo $linkedin_link; ?>"><span class="icon-linkedin2"></span></a>
										</li>
									</ul>
									<!-- end navbar-nav-->
								</nav>
							</div>
						</section>
					<?php } ?>
				<?php } ?>
				<!-- end site-body-header-->
				<div class="page-blocks">
					<div class="container-fluid">
						<div class="site-body">
							<?php unset( $row ); ?>
							<?php foreach ( $acf_fields['content'] as $row ) { ?>
								<?php if ( $row['acf_fc_layout'] == 'text_block' ) { ?>
									<?php $has_product ++; ?>
									<div class="hero-statement first-statement" style="background: <?php echo $row['background_colour'] ?> url('<?php echo whispli_resize_image( $row['background_image']['url'] ) ?>') no-repeat center center">
										<div class="container">
											<div class="row">
												<div class="col-md-12">
													<?php echo whispli_remove_p_wrapper( $row['description'] ); ?>
												</div>
											</div>
										</div>
									</div>
									<!--end hero-statement-->
								<?php } ?>
								<!--end hero-statement-->
								<?php if ( $row['acf_fc_layout'] == 'info_grid_block' ) { ?>
									<?php $has_product ++; ?>
									<div class="how-it-work">
										<div class="container">
											<div class="row">
												<?php if ( ! empty( $row['items'] ) ) { ?>
													<h2 class="heading"><?php echo $row['title'] ?></h2>
													<?php foreach ( $row['items'] as $i => $item ) { ?>
														<div class="col-md-6 col-xs-12">
															<div class="media panel panel-default">
																<div class="panel-body">
																	<?php if ( ! empty( $item['icon'] ) ) { ?>
																		<div class="media-left media-middle">
														<span class="">
														<img width="79" height="80" class="media-object" src="<?php echo whispli_resize_image( $item['icon']['url'], 79, 80 ) ?>" alt="">
													</span>
																		</div>
																	<?php } ?>
																	<div class="media-body">
																		<h3 class="media-heading">
																			<span><?php echo $i + 1; ?>.</span>
																			<?php echo $item['title'] ?></h3>
																		<?php echo $item['description'] ?>
																	</div>
																</div>
															</div>
														</div>
													<?php } ?>
												<?php } ?>
											</div>
										</div>
									</div>
									<!--end how-it-work-->
								<?php } ?>
								<?php if ( $row['acf_fc_layout'] == 'background_image_block' ) { ?>
									<?php $has_product ++; ?>
									<div class="beyond-fraud">
										<div class="hero-banner">
											<div class="hero-caption">
												<div class="container">
													<div class="row">
														<div class="inner col-md-12">
															<h3><?php echo $row['title'] ?></h3>
															<?php echo $row['description'] ?>
															<?php
															$button_link = '';
															if ( $row['button_link_type'] != 'none' ) {
																if ( $row['button_link_type'] == 'internal' ) {
																	$button_link = $row['internal_button_link'];
																} else {
																	$button_link = $row['external_button_link'];
																}
															}
															?>
															<?php if ( $row['button_link_type'] != 'none' ) { ?>
																<div class="button-container">
																	<div role="group" class="btn-group">
																		<a <?php if ( $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_1'] ) ) {
																			echo 'onMouseOver="this.style.background=\'#00517c\';this.style.borderColor=\'#00517c\'" onMouseOut="this.style.background=\'' . $acf_fields['colour_1'] . '\';this.style.borderColor=\'' . $acf_fields['colour_1'] . '\'" style="background: ' . $acf_fields['colour_1'] . ';"';
																		} ?> target="<?php echo $row['button_link_target'] ?>" class="btn btn-default btn-light-blue" href="<?php echo $button_link; ?>"><?php echo whispli_remove_p_wrapper( $row['button_text'] ); ?></a>
																	</div>
																</div>
															<?php } ?>
														</div>
													</div>
												</div>
											</div>
											<div class="hero-image">
												<div class="item blue-overlay parallax">
													<div class="parallax-img" style="background-image: url('<?php echo whispli_resize_image( $row['image']['url'], 1390, 528 ) ?>')"></div>
												</div>
											</div>
										</div>
									</div>
									<!--end beyond-fraud-->
									<div class="hero-statement statement" style="background: <?php echo $row['background_colour'] ?> url('<?php echo whispli_resize_image( $row['icon']['url'] ) ?>') no-repeat center center;">
										<div class="container">
											<div class="row">
												<div class="col-md-12">
													<ul>

														<?php foreach ( $row['links'] as $item ) { ?>
															<?php
															if ( $item['type'] != 'none' ) {
																$href = '';
																if ( $item['type'] == 'internal' ) {
																	$href = $item['internal_link'];
																} else {
																	$href = $item['external_link'];
																}
																?>
																<li>
																	<a target="<?php echo $item['target'] ?>" href="<?php echo $href; ?>" class=""><?php echo whispli_remove_p_wrapper( $item['block'] ) ?></a>
																</li>
															<?php } ?>
														<?php } ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<!--end statement-->
								<?php } ?>
								<?php if ( $row['acf_fc_layout'] == 'pricing_block' ) { ?>
									<?php $has_product ++; ?>
									<div class="pricing" id="pricing">
										<div class="container">
											<div class="row">
												<div class="col-md-12 col-xs-12  center price-heading">
													<h2><?php echo $row['title'] ?></h2>
													<p><?php echo $row['small_title'] ?></p>
												</div>
												<div class="price-inner price-<?php echo count( $row['prices'] ) ?>-column">
													<?php foreach ( $row['prices'] as $item ) { ?>
														<div class="pricing-column <?php if ( $item['highlight'] == true ) {
															echo 'highlight';
														} ?>">
															<div class="box-heading" <?php if ( $item['highlight'] == true && $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_2'] ) ) {
																echo 'style="background: ' . $acf_fields['colour_2'] . ';border-color:' . $acf_fields['colour_2'] . '"';
															} ?>>
																<div class="title"><?php echo $item['title'] ?></div>
																<div class="price-box">
																	<span class="price"><?php echo $item['price'] ?></span>
																	<span class="currency"><?php echo $item['currency'] ?></span>
																</div>
																<div class="description"><?php echo whispli_remove_p_wrapper( $item['description'] ) ?></div>
															</div>
															<?php if ( ! empty( $item['features'] ) ) { ?>
																<ul class="price-list">
																	<?php foreach ( $item['features'] as $line ) { ?>
																		<li class="clearfix"><?php echo $line['title'] ?>
																			<div class="pull-right value" <?php if ( $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_1'] ) ) {
																				echo 'style="color: ' . $acf_fields['colour_1'] . ';"';
																			} ?>>
																				<?php if ( $line['text_or_tickcross'] == 'text' ) { ?>
																					<?php echo $line['text'] ?>
																				<?php } elseif ( $line['text_or_tickcross'] == 'tick' ) { ?>
																					<span class="icon-checkmark"></span>
																				<?php } elseif ( $line['text_or_tickcross'] == 'cross' ) { ?>
																					<span class="icon-cross"></span>
																				<?php } ?>
																			</div>
																		</li>
																		<?php ?>
																	<?php } ?>
																</ul>
															<?php } ?>
															<?php
															unset( $href );
															$href = '';
															if ( $item['link_get_started_type'] != 'none' ) {
																if ( $item['link_get_started_type'] == 'internal' ) {
																	$href = $item['internal_link_get_started'];
																} else {
																	$href = $item['external_link_get_started'];
																}
																?>
																<a <?php if ( $item['highlight'] == true && $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_1'] ) ) {
																	echo 'onMouseOver="this.style.background=\'#00517c\';this.style.borderColor=\'#00517c\'" onMouseOut="this.style.background=\'' . $acf_fields['colour_1'] . '\';this.style.borderColor=\'' . $acf_fields['colour_1'] . '\'" style="background: ' . $acf_fields['colour_1'] . ';border-color: ' . $acf_fields['colour_1'] . ';"';
																} ?> target="<?php echo $item['link_get_started_target']; ?>" href="<?php echo $href; ?>" class="btn btn-default <?php if ( false === $item['highlight'] ) {
																	echo 'btn-black';
																} ?>"><?php echo $item['link_get_started_text']; ?></a>
															<?php } ?>
														</div>
													<?php } ?>
												</div>
												<?php if ( ! empty( $row['helper'] ) ) { ?>
													<div class="col-md-12 col-xs-12 center ">
														<div class="pricing-footer">
															<?php echo whispli_remove_p_wrapper( $row['helper'] ); ?>
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
									<!--end pricing-->
								<?php } ?>
								<?php if ( $row['acf_fc_layout'] == 'background_image_block_2' ) { ?>
									<?php $has_product ++; ?>
									<div class="fraud-costs">
										<div class="container">
											<div class="row">
												<div class="col-md-12">
													<div class="hero-banner">
														<?php if ( ! empty( $row['icon'] ) && ! empty( $row['icon']['url'] ) ) { ?>
															<div class="heading-img">
																<img src="<?php echo whispli_resize_image( $row['icon']['url'], 132, 132 ) ?>" alt="">
															</div>
														<?php } ?>
														<div class="hero-caption">
															<div class="container">
																<div class="row">
																	<div class="inner col-md-12">
																		<h3><?php echo $row['title'] ?></h3>
																		<?php echo $row['description'] ?>
																	</div>
																</div>
															</div>
														</div>
														<div class="hero-image">
															<div class="item blue-overlay parallax">
																<div class="parallax-img" style="background-image: url('<?php echo whispli_resize_image( $row['image']['url'], 940, 353 ) ?>')"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end fraud costs-->
									<div class="final-statement">
										<div class="container">
											<div class="row">
												<div class="col-md-12 center">
													<h5><?php echo $row['statement'] ?></h5>
													<?php
													unset( $href );
													$href = '';
													if ( $row['button_link_type'] != 'none' ) {
														if ( $row['button_link_type'] == 'internal' ) {
															$href = $row['internal_button_link'];
														} else {
															$href = $row['external_button_link'];
														}
														?>
														<a target="<?php echo $row['button_link_target'] ?>" class="btn btn-default btn-border-dark" href="<?php echo $href ?>"><?php echo $row['button_text'] ?></a>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<!--end Final statement-->
								<?php } ?>
							<?php } ?>
						</div>
						<!-- end sitebody-->
					</div>

					<!--page-blocks-->
					<section class="bottom-brand-widget">
						<div class="container">
							<?php unset( $row ); ?>
							<?php foreach ( $acf_fields['content'] as $row ) { ?>
								<?php if ( $row['acf_fc_layout'] == 'quote_block' ) { ?>
									<?php $has_product ++; ?>
									<div class="testimonial row">
										<div class="col-md-12 col-xs-12">
											<div class="testimonial-content">
												<div class="quote">
													<?php echo whispli_remove_p_wrapper( $row['quote'] ) ?>
												</div>
												<p class="name"><?php echo whispli_remove_p_wrapper( $row['quote_by'] ) ?></p>
											</div>
										</div>
									</div>
								<?php } ?>

								<?php if ( $row['acf_fc_layout'] == 'image_grid_block' ) { ?>
									<?php $has_product ++; ?>
									<div class="brand-post row">
										<div class="col-md-12 col-xs-12">
											<h2 class="title"><?php echo $row['title'] ?></h2>
											<?php if ( ! empty( $row['images'] ) ) { ?>
												<ul class="feature-logo clearfix">
													<?php foreach ( $row['images'] as $item ) { ?>
														<li>
															<a href="<?php echo $item['link'] ?>"><img src="<?php echo $item['image']['url'] ?>" alt="" /></a>
														</li>
													<?php } ?>
												</ul>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</section>
				</div>
			</section>
		<?php } ?>

		<!-- end main ====================================-->
	<?php } ?>

	<script type="text/javascript">
		<?php if ( $acf_fields['layout_type'] != 'holding' && ! empty( $acf_fields['colour_1'] )) {?>
		var pricingHeadingLink = document.querySelector('.pricing .price-heading a');
		console.log(pricingHeadingLink);
		if (pricingHeadingLink) {
			pricingHeadingLink.style.color = '<?php echo $acf_fields['colour_1'];?>';
		}
		<?php }?>
	</script>
	<?php if ( $has_product == 0 ) { ?>
		<script type="text/javascript">
			var body = document.querySelector('body');
			if (body) {
				body.className += ' no-product';
			}
			var heroSection = document.querySelector('#hero-section');
			if (heroSection) {
				heroSection.className += ' hero-section-no-product';
				var heroImage = heroSection.querySelector('.hero-image');
				console.log(heroImage);
				if (heroImage) {
					console.log(heroImage.className);
					heroImage.className = heroImage.className.replace(/\bblue-overlay\b/, '');
					heroImage.className += 'purple-overlay';
				}
			}
			var mainElm = document.querySelector('.main');
			if (mainElm) {
				mainElm.parentNode.removeChild(mainElm);
			}
			var bottomBrandElm = document.querySelector('.bottom-brand-widget');
			if (bottomBrandElm) {
				bottomBrandElm.parentNode.removeChild(bottomBrandElm);
			}
		</script>
	<?php } ?>
<?php endwhile; // End of the loop.?>
<?php
get_footer();
?>
