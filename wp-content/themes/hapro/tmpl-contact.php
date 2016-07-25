<?php
/**
 * Template Name: Contact
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
											<h2 class="heading"><?php echo $acf_fields['title'] ?></h2>
										</div>
									</div>
								</div>
								<div class="hero-image">
									<div class="item purple-overlay parallax">
										<div class="parallax-img" style="background-image: url('<?php echo whispli_resize_image( $acf_fields['image']['url'] ) ?>'); "></div>
									</div>
								</div>
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
					<div class="container content-page">
						<div class="row">
							<div class="col-md-5 col-xs-12 col-md-push-7">
								<?php the_content(); ?>
								<ul class="social">
									<li>
										<a target="_blank" href="<?php echo get_option('facebook_link')?>"><span class="icon-facebook"></span></a>
									</li>
									<li>
										<a target="_blank" href="<?php echo get_option('twitter_link')?>"><span class="icon-twitter"></span></a>
									</li>
									<li>
										<a target="_blank" href="<?php echo get_option('linkedin_link')?>"><span class="icon-linkedin2"></span></a>
									</li>
								</ul>
							</div>
							<div class="col-md-6 col-xs-12 col-md-pull-5">
								<?php
								if (!empty($acf_fields['short_code'])) {
									echo do_shortcode($acf_fields['short_code']);
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end page-blocks-->
	</section>
	<!-- END - Main =================================================================================== -->

	<script type="text/javascript">
		var errorMessages = false;
		<?php if (have_rows('error_messages')) {?>
			<?php
				$messages = array();
				foreach ($acf_fields['error_messages'] as $message) {
					$messages[$message['field']] = $message['message'];
				}
			?>
			errorMessages = <?php echo json_encode($messages); ?>;
		<?php }?>
		if (false !== errorMessages) {
			for (var key in errorMessages) {
				var inputElm = document.querySelector('[name="'+key+'"]');
				if(inputElm) {
					if (inputElm.hasAttribute('aria-required') && inputElm.getAttribute('aria-required') == 'true') {
						inputElm.setAttribute('data-validation', 'required');
					}
					inputElm.setAttribute('data-validation-error-msg-required', errorMessages[key]);
				}
			}
		}
		var emailElm = document.querySelector('input[type="email"]');
		if (emailElm) {
			if (emailElm.hasAttribute('aria-required') && inputElm.getAttribute('aria-required') == 'true') {
				emailElm.setAttribute('data-validation', 'required,email');
			} else {
				emailElm.setAttribute('data-validation', 'email');
			}
		}
		var wpc7ErrorMessage = document.querySelector('.wpcf7-validation-errors');
		if (wpc7ErrorMessage) {
			wpc7ErrorMessage.style.display = 'none';
		}
		var wpc7SuccessMessage = document.querySelector('.wpcf7-mail-sent-ok');
		if (wpc7SuccessMessage) {
			wpc7SuccessMessage.style.display = 'none';
		}
	</script>
<?php endwhile; // End of the loop.?>
<?php
get_footer();
?>