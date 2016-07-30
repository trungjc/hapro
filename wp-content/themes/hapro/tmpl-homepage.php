<?php
/**
 * Template Name: Homepage
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
<?php get_header(); ?>

<?php
 $currentlang = get_bloginfo('language');
 if($currentlang=="en-US"):
   $other_page = 215;
?>
<?php else: 
  $other_page =91 ; 

  endif;  ?>
  <?php if( have_rows('slider', $other_page) ): ?> 
       <section class="home-slider">
       <style>
         .slider-main:not(.slick-initialized) {
          display: none;
         }
       </style>
          <div class="container">
              <div class="slider-wrapper"> 
                <div id="home-slider" class="slider-main">
                  <?php while( have_rows('slider', $other_page) ): the_row(); ?>
                    <?php $image = get_sub_field('image_slider'); ?>        
                    <div style="background-image:url('<?php echo $image['sizes']['large']  ?>');" class="slider-item">
                      <div class="description" >
                         <?php $caption= get_sub_field('caption'); echo $caption; ?>

                      </div>
                      <img src="<?php echo $image['sizes']['large'] ?>" alt="<?php echo $image['caption'] ?>" >
                    </div>          
                  <?php endwhile; ?>
                </div>
               <div class="slider-nav hidden-xs">
                  <div id="home-slider-nav">
                     <?php while( have_rows('slider', $other_page) ): the_row(); ?>
                        <?php $image_thumb= get_sub_field('image-thumb');?>
                        <div class="slider-control"><img src="<?php echo $image_thumb['sizes']['medium'] ?>" alt="<?php echo $image_thumb['caption'] ?>" /></div>
                    <?php endwhile; ?>  
                  </div>
                </div>     
              </div>
            </div>
          </section> 
  <?php endif; ?>
<!--end banner-->
<section class="main" id="main"> 
  <div class="container"> 
    <div class="col-xs-12">
      <?php  while ( have_posts() ) : the_post();?>
        <?php $acf_fields = get_fields(); ?>
          <?php if (!empty($acf_fields['box_intro'])) {?>     
            <section class="about-us-links">
                <div class="row">
                 <?php foreach($acf_fields['box_intro'] as $box_intro) { ?>
                  <div class="col-xs-12 col-sm-4">
                      <div class="item">
                        <a href="#">
                          <div class="icon">
                                <img src="<?php echo $box_intro['image-icon']['url'] ?>" alt="<?php echo $box_intro['image-icon']['caption'] ?>" />
                          </div>
                          <h3><?php echo $box_intro['heading'] ?></h3>
                         <div class="description">
                            <?php echo $box_intro['content'] ?>
                          </div>    
                        </a>     
                      </div>
                  </div>
                <?php }?>
              </div>
            </section>
        <?php }?>

         <?php if (!empty($acf_fields['text_widget'])) {?>
          <section class="home-news-block">
              <div class="row">
                 <?php the_field('text_widget'); ?>
              </div>
          </section>        
        <?php }?>


       <?php if (!empty($acf_fields['brand-logo'])) {?>
             <section class="brands  row">
               <div class="title">
                  <h2> <?php the_field('sologan'); ?></h2>
                </div>
                 <style>
               .brand-logo:not(.slick-initialized) {
                display: none;
               }
             </style>
                <div class="brands-list">
                  <div class="row">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                      <button id="slider-prev" class="slider-arrow slider-prev  hidden-xs"></button>
                      <div id="brands-slider" class="brand-logo">
                       <?php foreach($acf_fields['brand-logo'] as $brand_logo) {  ?>
                        <div class="brand">
                          <a href="<?php echo $brand_logo['link'] ?>">
                            <img src="<?php echo $brand_logo['logo-brand']['sizes']['medium'] ?>" alt="<?php echo $brand_logo['logo-brand']['caption'] ?>" />
                          </a>
                        </div>              
                         <?php }?>
                          
                      </div>
                      <button id="slider-next" class="slider-arrow slider-next hidden-xs"></button>
                    </div>
                  </div>
                </div>
            </section>
      <?php }?>
      </div>
  </div>
</section>

<?php endwhile;?>
<?php
get_footer();
?>