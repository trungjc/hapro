<?php
/**
 * Template Name: danh sách category
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
<?php get_header(); ?>

    <section id="primary" class="content-area container hethongbanle">
        <main id="main" class="site-main row " role="main">
            <div class="col-xs-12">
                <header class="page-header"> 
                     <?php the_title( '<h1 class="page-header-text">', '</h1>' ); ?>
                </header>
                <!-- .page-header -->
                <div class="page-detail">
                    <?php custom_breadcrumbs(); ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <?php  while ( have_posts() ) : the_post();?>

                    <?php $acf_fields = get_fields();
                      $cat = $acf_fields['list_category'];  
                    ?>

                    <?php 
                    if (!empty($cat)) {
                    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    $custom_args = array(
                        'post_type' => 'post',
                        'cat' => $cat,
                        'posts_per_page' => 8,
                        'paged' => $paged
                      );
                    $custom_query = new WP_Query( $custom_args );

                    ?>
                    <?php if ( $custom_query->have_posts() ) : ?>
                    <div class="list-item">
                      <div class="rows">
                          <!-- the loop -->
                          <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                            <div class="item">
                              
                              <?php
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($custom_query->ID), 'medium');                                      
                              $alt_text = get_post_meta(get_post_thumbnail_id($custom_query->ID) , '_wp_attachment_image_alt', true);
                               ?>
                               <?php if(!empty($thumb[0])) { ?>
                                <a  class="img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-image:url(<?php  echo $thumb[0] ?>)">
                                          <img  style="display:none" src="<?php echo $thumb[0] ?>" alt='<?php echo $alt_text ?>' />
                                       </a>
                               <?php } else { ?>
                               <a class="no-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                          no image
                                       </a>

                               <?php } ?>
                               
                               <h3 class="heading"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  class="" ><?php the_title(); ?></a></h3>
                               <div><?php  the_excerpt() ?></div>
                            </div>
                          <?php endwhile; ?>
                          <!-- end of the loop -->
                          <!-- pagination here -->
                    </div>
                  </div>
                      <?php
                        if (function_exists(custom_pagination)) {
                          echo "<div class='clearfix'>";
                          custom_pagination($custom_query->max_num_pages,"",$paged);
                          echo "</div>";
                        }
                      ?>
                    <?php wp_reset_postdata(); ?>
                    
                  <?php else:  ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                  <?php endif; ?>

                    <?php } endwhile; // End of the loop.?>
                </div>
            </div>
        </main>
        <!-- .site-main -->
    </section>
    <!-- .content-area -->
    <?php
get_footer();
?>