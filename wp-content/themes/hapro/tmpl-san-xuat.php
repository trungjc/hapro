<?php
/**
 * Template Name: sản xuất
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
    <?php get_header(); ?>

    <section id="primary" class="content-area container sx">
        <main id="main" class="site-main row " role="main">
            <div class="col-xs-12">
                <header class="page-header">
                    <?php 
                twentyfifteen_post_thumbnail();
              ?>
                    <h1 class="page-header-text">
                    <?php
          echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent );
            ?>
                    </h1>
                </header>
                <!-- .page-header -->
                <div class="page-detail">
                    <?php custom_breadcrumbs(); ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <?php  while ( have_posts() ) : the_post();?>
                    <?php $acf_fields = get_fields();?>
                    <?php if (!empty($acf_fields['item'])) {?>
                    <section class="page-grid">
                        <div class="container-grid sanxuatgrid">
                            <div class="clearfix">
                                <?php $i=0; foreach($acf_fields['item'] as $page_info) { ?>
                                <div class="col-xs-12 col-sm-3 col-md-2">
                                    <div class="item">
                                       <h3><?php echo $page_info['title'] ?></h3>
                                            <a href="<?php echo $page_info['link'] ?>"><div  class="image-intro" style="background-image:url(<?php echo $page_info['feature-image']['sizes']['medium'] ?>)">
                                               <img style="opacity:0;visibility:hidden" src="<?php echo $page_info['feature-image']['sizes']['medium'] ?>" alt="<?php echo $page_info['feature-image']['caption'] ?>" />
                                            </div></a>                                            
                                            
                                           
                                    </div>
                                </div>
                                <?php $i++; }?>
                            </div>
                        </div>
                    </section>
                    <?php }?>
                    <?php endwhile; // End of the loop.?>
                </div>
            </div>
        </main>
        <!-- .site-main -->
    </section>
    <!-- .content-area -->
    <?php
get_footer();
?>
