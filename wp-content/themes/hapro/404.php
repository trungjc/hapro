<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package whispli
 */

get_header(); ?>
	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">

			<div class="col-xs-12 ">
			<header class="page-header" >
						
						<div class="page-header-text">
							<h1 class="page-title"><?php echo __( 'Lỗi  404', 'whispli' ) ?></h1>		
						
						</div>
					</header><!-- .page-header -->
				<div class="page-detail">
							
							<p><?php echo __(
									'Xin lỗi trang bạn đang tìm kiếm không tồn tại, or bị sai địa chỉ IP, ', 'whispli'
								) ?><br /><?php echo __( 'Xin vui lòng thử lại', 'whispli' ) ?></p>
							</div>
			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->


<?php
get_footer();
