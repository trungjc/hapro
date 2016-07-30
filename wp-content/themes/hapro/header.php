<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package whispli
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="X-UA-Compatiable" cotent="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon.png">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/icon.png"/>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png"/>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png"/>
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/icon.png"/>
	<link rel="icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png"/>
	<link rel="icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png"/>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<?php $locations = get_nav_menu_locations(); ?>
<?php
# Get menus
$main_menu = false;
if ( isset( $locations['main_menu'] ) ) {
	$main_menu = whispli_custom_nav_menu( 'main_menu' );
}
$mobile_header_primary_menu = false;
if ( isset( $locations['mobile_header_primary_menu'] ) ) {
	$mobile_header_primary_menu = whispli_custom_nav_menu( 'mobile_header_primary_menu' );
}
$mobile_header_secondary_menu = false;
if ( isset( $locations['mobile_header_primary_menu'] ) ) {
	$mobile_header_secondary_menu = whispli_custom_nav_menu( 'mobile_header_secondary_menu' );
}
$footer_primary_menu = false;
if ( isset( $locations['footer_primary_menu'] ) ) {
	$footer_primary_menu = whispli_custom_nav_menu( 'footer_primary_menu' );
}

 $currentlang = get_bloginfo('language');
?>
<body <?php body_class(); ?>>
	<header class="header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="top-links">
              <ul class="clearfix">
                <?php pll_the_languages(array('show_flags'=>1, 'show_names'=>1)); ?>
                 <?php if($currentlang=="en-US"):
					   $tuyendung = 139;
					   $contact = 137;
					    $name1= 'Recruitment';
					   $name2= 'Contact';
					?>
					<?php else: 
					  $tuyendung = 2;
					   $contact = 37; 
					   $name1= 'Tuyển dụng';
					   $name2= 'Liên hệ';

					  endif; ?>
                <li><a href="<?php echo get_page_link($tuyendung); ?>"><?php echo $name1 ?></a></li>
                <li><a href="<?php echo get_page_link($contact); ?>"><?php echo $name2 ?></a></li>
              </ul>
            </div>
          </div>
          <div class="header-bottom">
            <div class="col-xs-12 col-sm-6">
              <div class="logo">
              <h1 class="site-title"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive"></a></h1>
             

              </div>
            </div>
            <div class="col-xs-12 col-sm-6">

              <div class="search-box">
               <?php get_search_form(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
	<!-- END - Header =================================================================================== -->
	<nav class="navbar">
      <div class="container">
        <?php
			if ( count( $main_menu[0] ) > 0 ) {
				?>
				<button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<nav class="navbar-collapse bs-navbar-collapse collapse "><span class="icon-cross"></span>
					<ul class="nav navbar-nav">
						<?php foreach ( $main_menu[0] as $index => $parent_item ) { ?>
							<?php $has_sub = in_array( $parent_item->ID, array_keys( $main_menu[2] ) ); ?>
							<li class="<?php echo implode( ' ', $parent_item->classes ); ?>">
								<a <?php if ( $has_sub ) {
									echo 'href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
								} else {
									echo 'href=' . apply_filters( 'the_permalink', $parent_item->url ) . '';
								} ?>>
									<?php echo apply_filters( 'post_title', $parent_item->title ) ?>
								</a>
								<?php if ( count( $main_menu[1] ) > 0 && isset( $main_menu[1][$parent_item->ID] ) ) { ?>
									<ul class="dropdown-menu sub-menu">
										<?php if ( count( $main_menu[1][$parent_item->ID] ) > 0 ) { ?>
											<?php foreach ( $main_menu[1][$parent_item->ID] as $item ) { ?>
												<li class="<?php echo implode( ' ', $item->classes ); ?>">
													<a href="<?php echo apply_filters( 'the_permalink', $item->url ) ?>">
														<?php echo apply_filters( 'post_title', $item->title ) ?></a>
													</a>
												</li>
											<?php } ?>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
						<?php } ?>
					</ul>
					<!-- end navbar-nav-->
				</nav>
			<?php } ?>
			<!-- /end navbar-collapse -->
      </div>
    </nav>
     <main class="main-content">
	     