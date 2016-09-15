<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package whispli
 */

?>
     
 </main>
 <!--end main-content-->
 <footer. id="footer">
 	<div class="container">
	  	<div class="container-inner clearfix">
	 		<div class="col-xs-12"> 			
				<div class="footer">
			        <div class="footer-wrapper ">
				         <div class="row">			         	
				          <div class="col-xs-12 col-sm-3">
				            <div class="footer-block">
				                <?php if ( has_nav_menu( 'footer_primary_menu' ) ) : ?>
								<nav class="footer-links block-list" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'footer_primary_menu',
											'menu_class'     => 'primary-menu-footer',
										 ) );
									?>
								</nav><!-- .main-navigation -->
							<?php endif; ?>
				            </div>
				          </div>
				          <div class="col-xs-12 col-sm-6">
				            <div class="footer-block">
				            <div class="footer-logo"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-footer.png" alt="Footer Logo"></a></div>
				              <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
									<div id="widget-area" class="widget-area" role="complementary">
										<?php dynamic_sidebar( 'sidebar-3' ); ?>
									</div><!-- .widget-area -->
								<?php endif; ?>
				            </div>
				          </div>
				          <div class="col-xs-12 col-sm-3">
				            <div class="footer-block">
				              <div class="follow-us-contact">
				              <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
									<div id="widget-area" class="widget-area" role="complementary">
										<?php dynamic_sidebar( 'sidebar-4' ); ?>
									</div><!-- .widget-area -->
								<?php endif; ?>
				            </div>
				          </div>
				        </div>
				         </div>
			      </div><!--footer -wapper-->

			         <div class="row footer-bottom">
				        
				         	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				         		 <div class="col-xs-12 col-sm-4">
									<div id="widget-area-footer-left" class="widget-area" role="complementary">
										<?php dynamic_sidebar( 'sidebar-2' ); ?>
									</div><!-- .widget-area -->
									 </div>
								<?php endif; ?>	
				        
			         	
						<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
							<div class="col-xs-12 col-sm-8">	
								<?php dynamic_sidebar( 'sidebar-5' ); ?>
								</div>
						<?php endif; ?>
						
			         </div>
	 		</div>
	 	</div>
 	</div>
 </footer>

<?php wp_footer(); ?>

</body>
</html>
