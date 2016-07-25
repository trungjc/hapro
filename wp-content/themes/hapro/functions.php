<?php
/**
 * whispli functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package whispli
 */
define('COOKIE_DOMAIN',site_url());
define('COOKIEPATH','/');

// Check geoip
function whispli_get_new_root_relative_current( $language_code ) {
	global $wp_rewrite;
	$_root_relative_current = untrailingslashit( $_SERVER['REQUEST_URI'] );
	if ( '/' . $language_code == $_root_relative_current || '/' . $language_code . '/' == $_root_relative_current ) {
		$new_root_relative_current = '';
	} else {
		$new_root_relative_current = str_replace( '/' . $language_code . '/', '', $_root_relative_current );
	}

	return $new_root_relative_current;
}

if (!function_exists('whispli_check_geoip')) {
	function whispli_check_geoip() {
		if (function_exists('geoip_record_by_name')) {

            if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
            }else{

                $_root_relative_current = untrailingslashit( $_SERVER['REQUEST_URI'] );
                if ( ! isset( $_COOKIE['whispli_check_geoip'] ) && $_SERVER["REMOTE_ADDR"] != '127.0.0.1' && false === strpos($_root_relative_current,'wp-admin') && false === strpos($_root_relative_current,'wp-login.php')) {
                    setcookie( "whispli_check_geoip", true, time() + 86400 );
                    global $sitepress;
                    $main_language = array(
                        'native_name'      => __( 'All languages', 'sitepress' ),
                        'translated_name'  => __( 'All languages', 'sitepress' ),
                        'language_code'    => 'all',
                        'country_flag_url' => ICL_PLUGIN_URL . '/res/img/icon16.png',
                    );
                    if ( 'all' !== $sitepress->get_current_language() ) {
                        $language_details                 = $sitepress->get_language_details( $sitepress->get_current_language() );
                        $main_language['native_name']     = $language_details['display_name'];
                        $main_language['translated_name'] = $language_details['display_name'];
                        $main_language['language_code']   = $language_details['code'];
                    }
                    $language_code = $main_language['language_code'];

                    $record = geoip_record_by_name( $_SERVER["REMOTE_ADDR"] );
                    if ( ! empty( $record ) ) {
                        if ( $record['country_code3'] == 'CHE' && $language_code != 'sz' ) {
                            wp_redirect( site_url( '/sz/' . whispli_get_new_root_relative_current( $language_code ) ) );
                            exit();
                        } elseif ( $record['country_code3'] == 'NZL' && $language_code != 'nz' ) {
                            wp_redirect( site_url( '/nz/' . whispli_get_new_root_relative_current( $language_code ) ) );
                            exit();
                        } elseif ( $record['country_code3'] == 'GBR' && $language_code != 'gb' ) {
                            wp_redirect( site_url( '/gb/' . whispli_get_new_root_relative_current( $language_code ) ) );
                            exit();
                        } elseif ( $record['country_code3'] == 'AUS' ) {
                            wp_redirect( site_url( whispli_get_new_root_relative_current( $language_code ) ) );
                            exit();
                        } elseif ( $record['continent_code'] == 'EU' && $language_code != 'er' ) {
                            wp_redirect( site_url( '/er/' . whispli_get_new_root_relative_current( $language_code ) ) );
                            exit();
                        } elseif ( $language_code != 'us' ) {
                            wp_redirect( site_url( '/us/' . whispli_get_new_root_relative_current( $language_code ) ) );
                            exit();
                        }
                    }
                }

            }
		}
	}
}

add_action( 'init', 'whispli_check_geoip' );

if ( ! function_exists( 'whispli_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */


	function whispli_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on whispli, use a find and replace
		 * to change 'whispli' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'whispli', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header_right_menu'             => esc_html__( 'Header right Menu', 'whispli' ),
				'main_menu'            => esc_html__( 'menu top', 'whispli' ),
				'footer_primary_menu'          => esc_html__( 'Footer Primary Menu', 'whispli' ),
				
				'mobile_header_primary_menu'   => esc_html__( 'Mobile Header Primary Menu', 'whispli' ),
				'mobile_header_secondary_menu' => esc_html__( 'Mobile Header Secondary Menu', 'whispli' ),
				
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
		);

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'whispli_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
		// Homepage carousel image size
		add_image_size( 'homepage-carousel', 1345, 670, true );
	}
endif;
add_action( 'after_setup_theme', 'whispli_setup' );

function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer right', 'twentyfourteen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function whispli_scripts() {

	$version = '2.0';
wp_enqueue_style( 'whispli-vender-style', get_template_directory_uri() . '/assets/css/vendor.css' );
	wp_enqueue_style( 'whispli-primary-style', get_template_directory_uri() . '/assets/css/main.css' );

	wp_enqueue_style( 'whispli-style', get_stylesheet_uri() );

	wp_enqueue_script( 'whispli-vendor', get_template_directory_uri() . '/assets/js/vendor.js', array(), $version, true );

wp_enqueue_script( 'whispli-plugin', get_template_directory_uri() . '/assets/js/plugins.js', array(), $version, true );
	// About page Javascript
	if (is_404() ||  is_page_template( 'tmpl-about.php' ) || is_singular( 'product' ) || is_front_page() ) {
		
	}
	
	wp_register_script( 'whispli-main', get_template_directory_uri() . '/assets/js/main.js', array(), $version, true );
	wp_localize_script(
		'whispli-main',
		'whispli_localize',
		array(
			'ajaxurl'   => admin_url('admin-ajax.php'),
			'security' => wp_create_nonce( "whispli_ajax_nonce" ),
			'scrolltop' => false,
		)
	);


	wp_enqueue_script( 'whispli-main' );
}

add_action( 'wp_enqueue_scripts', 'whispli_scripts' );

/**
 * Custom body class
 */

add_filter( 'body_class', 'whispli_body_classes' );
function whispli_body_classes( $classes ) {
	// Remove default body classes
	$classes = [ ];
	if ( is_page_template( 'tmpl-blog.php' ) ) {
		$classes[] = 'blog category';
	}
	if ( is_page_template( 'tmpl-about.php' ) ) {
		$classes[] = 'about';
	}
	if ( is_page_template( 'tmpl-homepage.php' ) ) {
		$classes[] = 'home';
	}
	if ( is_page_template( 'single-product.php' ) || is_singular( 'product' ) ) {
		$classes[] = 'product';
	} elseif ( is_single() ) {
		$classes[] = 'blog-detail';
	}
	if ( is_page_template( 'tmpl-term.php' ) ) {
		$classes[] = 'full-terms-page tc-page';
	}
	if ( is_page_template( 'tmpl-informant-terms.php' ) ) {
		$classes[] = 'informant-terms-page tc-page';
	}
	if ( is_page_template( 'tmpl-contact.php' ) ) {
		$classes[] = 'contact-page';
	}
	if ( is_page_template( 'tmpl-partner.php' ) ) {
		$classes[] = 'partner';
	}
	return $classes;
}

/**
 * Define some page id
 */
define('BLOG_PAGE_ID', 264);
define('ABOUT_PAGE_ID', 2);

/**
 * Custom menu
 */
require get_template_directory() . '/inc/custom-menu.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom menu
 */
require get_template_directory() . '/inc/product-functions.php';


/**
 * Include Aqua resizer
 */
require get_template_directory() . '/inc/aq_resizer.php';

if ( ! function_exists( 'whispli_resize_image' ) ) {
	function whispli_resize_image( $url, $width = null, $height = null, $crop = true, $single = true, $upscale = true ) {
		if ( ! aq_resize( $url, $width, $height, $crop, $single, $upscale ) ) {
			return $url;
		}

		return aq_resize( $url, $width, $height, $crop, $single, $upscale );
	}
}

if ( ! function_exists( 'whispli_language_selector' ) ) {
	function whispli_language_selector() {
		global $sitepress;
		$active_languages = $sitepress->get_ls_languages();
		$active_languages = apply_filters( 'wpml_active_languages_access', $active_languages, array( 'action' => 'read' ) );

		if ( $active_languages ) {
			/**
			 * @var $main_language bool|string
			 * @used_by menu/language-selector.php
			 */
			foreach ( $active_languages as $k => $al ) {
				if ( $al['active'] == 1 ) {
					unset( $active_languages[$k] );
					break;
				}
			}
		} else {
			return '';
		}


		$main_language = array(
			'native_name'      => __( 'All languages', 'sitepress' ),
			'translated_name'  => __( 'All languages', 'sitepress' ),
			'language_code'    => 'all',
			'country_flag_url' => ICL_PLUGIN_URL . '/res/img/icon16.png',
		);
		if ( 'all' !== $sitepress->get_current_language() ) {
			$language_details                 = $sitepress->get_language_details( $sitepress->get_current_language() );
			$main_language['native_name']     = $language_details['display_name'];
			$main_language['translated_name'] = $language_details['display_name'];
			$main_language['language_code']   = $language_details['code'];

			$flag = $sitepress->get_flag( $main_language['language_code'] );
			if ( isset( $flag->from_template ) && $flag->from_template && isset( $flag->flag ) ) {
				$wp_upload_dir                     = wp_upload_dir();
				$main_language['country_flag_url'] = $wp_upload_dir['baseurl'] . '/flags/' . $flag->flag;
			} else {
				if ( isset( $flag->flag ) ) {
					$main_language['country_flag_url'] = ICL_PLUGIN_URL . '/res/flags/' . $flag->flag;
				} else {
					$main_language['country_flag_url'] = ICL_PLUGIN_URL . '/res/img/icon16.png';
				}
			}
		}

		$language_selector = '<li class="switch-language parent-menu">';

		$settings = get_option( 'icl_sitepress_settings' );
		if ( $main_language ) {
			$language_selector .= '<a class="dropdown-toggle" href="#" data-toggle="dropdown"> <img width="19" style="top:5px;" src="' . $main_language['country_flag_url'] . '" alt="' . $main_language['language_code'] . '"></a>';
		}

		if ( ! empty( $active_languages ) ) {

			$language_selector .= '<ul class="dropdown-menu">';
			$active_languages_ordered = $sitepress->order_languages( $active_languages );
			foreach ( $active_languages_ordered as $lang ) {
				$language_selector .= '<li><a href="' . $lang['url'] . '" title="' . ( $settings['icl_lso_display_lang'] ? esc_attr( $lang['translated_name'] ) : esc_attr( $lang['native_name'] ) ) . '">' . ( $settings['icl_lso_display_lang'] ? esc_attr( $lang['translated_name'] ) : esc_attr( $lang['native_name'] ) ) . '<img style="top:5px;" src="' . $lang['country_flag_url'] . '" alt="' . $lang['language_code'] . '"></a></li>';
			}
			$language_selector .= '</ul>';
		}

		$language_selector .= '</li>';
		echo $language_selector;
	}
}

if ( ! function_exists( 'whispli_remove_p_wrapper' ) ) {
	function whispli_remove_p_wrapper( $str ) {
		return preg_replace( '!^<p>(.*?)</p>$!i', '$1', $str );
	}
}

if(!function_exists('whispli_load_product_blogs')) {
	function whispli_load_product_blogs($cate_id) {
		if ($cate_id == 'all' || intval($cate_id) == 1) {
			$posts = get_posts( array( 'posts_per_page' => -1 ) );
		} else {
			$posts = get_posts(array('posts_per_page' => -1, 'category' => $cate_id));
		}
		global $post;
		ob_start();
		if(!empty($posts)) {
			?>
			<div id="posts-area">
				<?php foreach($posts as $i=>$post) { ?>
					<?php setup_postdata( $post );?>
						<article class="post type-post fraudsec-category post-item-feature <?php if($i%2==0) {echo 'even';} else{echo 'odd';}?>" data-myorder="<?php echo $i+1?>">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="feature-image">
									<?php $product_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) ?>
									<img src="<?php echo whispli_resize_image($product_thumbnail_src[0], 470, 336); ?>" alt="">
									<div class="visible-sm-block" style="background-image: url('<?php echo $product_thumbnail_src[0]; ?>')"></div>
								</div>
							<?php } else {?>
								<div class="feature-image">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog_placeholder.png" alt="">
									<div class="visible-sm-block" style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/blog_placeholder.png')"></div>
								</div>
							<?php } ?>
							<?php
							if($cate_id != 'all') {
								$cate = get_category( $cate_id );
							} else {
								$cates = get_the_category();
								if (!empty($cates)) {
									$cate = $cates[0];
								} else {
									$cate = false;
								}
							}
							?>
							<div class="post-content">
								<header class="entry-header">
									<?php if(!empty($cate)) {?>
										<div class="cat-links"><span><?php echo $cate->name?></span></div>
									<?php }?>
									<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
									<div class="posted-on"><?php the_date('j M Y')?></div>
								</header>
								<div class="entry-content">
									<?php the_excerpt();?>
								</div>
								<a class="btn btn-default btn-border-dark read-more" href="<?php the_permalink()?>"><?php echo _e('Read more','whispli');?>
									<span class="icon-arrow"></span></a>
							</div>
						</article>
				<?php }
				wp_reset_postdata();?>
			</div>
			<?php
		}
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}

add_action( 'wp_ajax_nopriv_load_blog_content', 'whispli_load_blog_content' );


if (!function_exists('whispli_load_blog_content')) {
	function whispli_load_blog_content() {
		check_ajax_referer('whispli_ajax_nonce','security');
		if (isset($_POST['bloghash']) && !empty($_POST['bloghash'])) {
			echo whispli_load_product_blogs($_POST['bloghash']);
		}
		exit();
	}
}

add_filter( 'admin_init', 'whispli_general_settings_register_fields' );
if (!function_exists('whispli_general_settings_register_fields')) {
	function whispli_general_settings_register_fields() {
		register_setting( 'general', 'facebook_link', 'esc_attr' );
		add_settings_field( 'facebook_link', '<label for="facebook_link">' . __( 'Facebook', 'whispli' ) . '</label>', 'whispli_general_settings_facebook_link', 'general' );

		register_setting( 'general', 'twitter_link', 'esc_attr' );
		add_settings_field( 'twitter_link', '<label for="twitter_link">' . __( 'Twitter', 'whispli' ) . '</label>', 'whispli_general_settings_twitter_link', 'general' );

		register_setting( 'general', 'linkedin_link', 'esc_attr' );
		add_settings_field( 'linkedin_link', '<label for="linkedin_link">' . __( 'Linkedin', 'whispli' ) . '</label>', 'whispli_general_settings_linkedin_link', 'general' );

		register_setting( 'general', 'footer_quote', 'esc_attr' );
		add_settings_field( 'footer_quote', '<label for="footer_quote">' . __( 'Footer Quote', 'whispli' ) . '</label>', 'whispli_general_settings_footer_quote', 'general' );

		register_setting( 'general', 'google_analytic', 'esc_attr' );
		add_settings_field( 'google_analytic', '<label for="google_analytic">' . __( 'Google Analytics', 'whispli' ) . '</label>', 'whispli_general_settings_google_analytic', 'general' );
	}
}
if (!function_exists('whispli_general_settings_facebook_link')) {
	function whispli_general_settings_facebook_link() {
		$value = esc_attr( get_option( 'facebook_link' ) );
		echo '<input type="text" style="width: 80%;" id="facebook_link" class="regular-text" name="facebook_link" value="' . $value . '" />';

	}
}

if (!function_exists('whispli_general_settings_twitter_link')) {
	function whispli_general_settings_twitter_link() {
		$value = esc_attr( get_option( 'twitter_link' ) );
		echo '<input type="text" style="width: 80%;" id="twitter_link" class="regular-text" name="twitter_link" value="' . $value . '" />';

	}
}

if (!function_exists('whispli_general_settings_linkedin_link')) {
	function whispli_general_settings_linkedin_link() {
		$value = esc_attr( get_option( 'linkedin_link' ) );
		echo '<input type="text" style="width: 80%;" id="linkedin_link" class="regular-text" name="linkedin_link" value="' . $value . '" />';
	}
}

if (!function_exists('whispli_general_settings_footer_quote')) {
	function whispli_general_settings_footer_quote() {
		$value = esc_attr( get_option( 'footer_quote' ) );
		echo '<textarea type="text" style="width: 80%;" rows="5" id="footer_quote" name="footer_quote" value="">' . $value . '</textarea>';
	}
}

if (!function_exists('whispli_general_settings_google_analytic')) {
	function whispli_general_settings_google_analytic() {
		$value = esc_attr( get_option( 'google_analytic' ) );
		echo '<input type="text" style="width: 80%;" id="google_analytic" class="regular-text" name="google_analytic" value="' . $value . '" />';
	}
}

add_filter( 'whitelist_options', 'whispli_whitelist_options' );
function whispli_whitelist_options( $whitelist_options ) {
	$whitelist_options['general'][] = 'facebook_link';
	$whitelist_options['general'][] = 'twitter_link';
	$whitelist_options['general'][] = 'linkedin_link';
	$whitelist_options['general'][] = 'footer_quote';
	$whitelist_options['general'][] = 'google_analytic';

	return $whitelist_options;
}

if (!function_exists('whispli_footer_featured_post')) {
	function whispli_footer_featured_post() {
		$posts = wp_get_recent_posts( array( 'post_status' => 'publish', 'suppress_filters' => false, 'numberposts' => 3 ) );
		$post_item_class = array('light-blue','','dark-blue');
		if ( count( $posts ) > 0 ) {
			?>
			<div class="feature-post">
				<?php foreach ( $posts as $i => $post ) { ?>
					<div class="col-3 <?php if ( $i == 0 ) {echo 'first-column';} ?> <?php echo $post_item_class[$i]?>" <?php if ($i== 1) {echo 'style="background-color:#441e74"';}?>>
						<div class="post-item ">
							<?php if ( has_post_thumbnail( $post['ID'] ) ) { ?>
								<?php $product_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post['ID'] ), 'full' ) ?>
								<div class="img-feature" style="background-image:url(<?php echo whispli_resize_image( $product_thumbnail_src[0], 475, 406 ) ?>)"></div>
							<?php } else {?>
								<div class="img-feature" style="background-image:url('<?php echo get_fields()?>/assets/img/blog_footer_widget_placeholder.png')"></div>
							<?php } ?>
							<?php $cates = get_the_category( $post['ID'] ); ?>
							<div class="content-item">
								<h3 class="heading">
									<?php if ( ! empty( $cates ) ) { ?>
										<span><?php echo $cates[0]->name ?></span>
									<?php } ?>
									<?php echo get_the_title( $post['ID'] ); ?>
								</h3>
								<div class="date"><?php echo get_the_date( 'j M Y', $post['ID'] ) ?></div>
								<p class="excerpt"><?php echo truncateExtract($post['post_excerpt']); ?></p>
							</div>
							<a href="<?php echo get_the_permalink( $post['ID'] ) ?>" class="btn btn-default"><?php echo __( 'read more', 'whispli' ) ?>
								<span class="icon-arrow"></span></a>
						</div>
					</div>
				<?php }?>
			</div>
			<?php
		}
	}
}

add_filter('wp_nav_menu_footer-secondary-menu_items','add_item_to_footer_secondary_menu');

if (!function_exists('add_item_to_footer_secondary_menu')) {
	function add_item_to_footer_secondary_menu($items) {
		return $items .= '<li>'.__('ABN 25 605 003 825', 'whispli').'</li>';
	}
}

function whispli_wpcf7_form_elements($html) {
	function overfly_replace_include_blank($name, $text, &$html) {
		$matches = false;
		preg_match('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $html, $matches);
		if ($matches) {
			$select = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $matches[0]);
			$html = preg_replace('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $select, $html);
		}
	}
	overfly_replace_include_blank('countrylist', 'Country*', $html);
	overfly_replace_include_blank('inquiry_type', 'Inquiry Type*', $html);
	overfly_replace_include_blank('products', 'Products*', $html);
	return $html;
}
add_filter('wpcf7_form_elements', 'whispli_wpcf7_form_elements');

function truncateExtract($text){
    $text = (strlen($text) > 140) ? substr($text,0,strrpos( substr( $text, 0, 120), ' ' )).'[...]' : $text;
    return $text;
}
