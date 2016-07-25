<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package whispli
 */

get_header(); ?>

	<section class="hero-section-area hero-section-no-product">
		<div class="container-fluid">
			<div class="hero-banner parallax-bg">
				<div class="hero-caption">
					<div class="container-fluid">
						<div class="inner col-md-12">
							<h2 class="heading"><?php echo __( '404 Not Found', 'whispli' ) ?></h2>
							<p><?php echo __(
									'Sorry, whatever you were looking for is no longer here,
								or you typed the wrong URL.', 'whispli'
								) ?><br /><?php echo __( 'Please double-check and try again.', 'whispli' ) ?></p>
							<div class="button-container">
								<div class="btn-group" role="group">
									<a class="btn btn-default btn-primary" href="<?php echo icl_get_home_url(); ?>"><?php echo __( 'back to homepage', 'whispli' ); ?>
										<span class="icon-arrow"></span></a>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hero-image">
					<div class="item purple-overlay parallax">
						<div class="parallax-img" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/404.jpg'); "></div>
						<!-- image for mobile-->
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
