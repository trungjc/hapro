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
	<footer class="footer">
      <div class="container">
        <div class="row footer-wrapper">
          <div class="col-xs-12">
            <div class="footer-logo"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer-logo.png" alt="Footer Logo"></a></div>
          </div>
          <div class="col-xs-12 col-sm-4">
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
          <div class="col-xs-12 col-sm-4">
            <div class="footer-block">
              <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
					<div id="widget-area" class="widget-area" role="complementary">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div><!-- .widget-area -->
				<?php endif; ?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
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
    </footer>

<?php wp_footer(); ?>
<?php if (!empty(get_option('google_analytic')))  {?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo get_option('google_analytic')?>', 'auto');
		ga('send', 'pageview');

	</script>
<?php } ?>
</body>
</html>
