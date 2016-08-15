<?php
/**
 * Template Name: hệ thống bán lẻ
 *
 * @package    WordPress
 * @subpackage Whispli
 * @since      Whispli 1.0
 */
?>
    <?php get_header(); ?>
    <?php

global $post;     // if outside the loop
 $class_page = "";
if ( is_page() && $post->post_parent ) {
   $class_page = "sub_page";

} else {
   $class_page = "parent_page";
}
?>
    <section id="primary" class="content-area container hethongbanle">
        <main id="main" class="site-main row <?php echo $class_page; ?>" role="main">
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
                        <div class="container-grid">
                            <div class="clearfix">
                                <?php $i=0; foreach($acf_fields['item'] as $page_info) { ?>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="item">
                                       
                                            <a href="<?php echo $page_info['link'] ?>"><div  class="image-intro" style="background-image:url(<?php echo $page_info['feature-image']['sizes']['medium'] ?>)">
                                           		 <img style="opacity:0;visibility:hidden" src="<?php echo $page_info['feature-image']['sizes']['medium'] ?>" alt="<?php echo $page_info['feature-image']['caption'] ?>" />
                                           	</div></a>                                           	
                                            <h3><?php echo $page_info['title'] ?></h3>
                                           
                                             <?php
                                            	if(!empty($page_info['description'])) {
                                            ?>
                                             <div class="description"><?php echo $page_info['description'] ?></div>
                                            <?php } ?>
                                            <?php
                                            	if(!empty($page_info['full_description'])) {
                                            ?>
                                            <a class="more" href="javascript:void(0)" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">xem thêm</a>
							                  <div class="modal fade"  role="dialog"  id="myModal<?php echo $i; ?>" >
											    <div class="modal-dialog"> 
											                            
											 <!-- Modal content-->
											      <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title"><?php echo $page_info['title'] ?></h4>
											      </div>    
											        <div class="modal-body">
											        <div class="clearfix">
						  								<div class="media-lefts pull-left" style="max-width:220px;margin-bottom: 20px;margin-right:20px;">
														    <a href="#">
														     <img width="194" src="<?php echo $page_info['feature-image']['sizes']['medium'] ?>" alt="<?php echo $page_info['feature-image']['caption'] ?>" />
														    </a>
														  </div>
														  <div class="media-bodys">
														    <?php echo $page_info['full_description'] ?>
														  </div>
														</div>
															        
											         
											        </div>
											      </div>
											      
											    </div>
											  </div>

                                            <?php } ?>
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
