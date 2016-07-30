<?php /* Template Name: Sitemap */ get_header(); ?>
	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			<div class="col-xs-12 ">
			<header class="page-header" >						
				<div class="page-header-text">
					<h1 class="page-title">Sitemap</h1>	
				
				</div>
			</header><!-- .page-header -->
<div class="page-detail">
				<!-- This section shows a list of pages -->
				<h2 id="pages">Pages</h2>
				<ul>
				<?php
				// Add pages you'd like to exclude in the exclude here
				wp_list_pages(
				  array(
				    'exclude' => '',
				    'title_li' => '',
				  )
				);
				?>
				</ul>

				<!-- This section shows a list of posts by category -->
				<h2 id="posts">Categories</h2>
				<ul>
				<?php
				// Add categories you'd like to exclude in the exclude here
				$cats = get_categories('exclude=');
				foreach ($cats as $cat) { /*print_r($cat);*/
					 $category_link = get_category_link( $cat->cat_ID );
				  echo "<li><a href='".$category_link."'>".$cat->cat_name."</a>";
				  
				  echo "</li>";
				}
				?>
				</ul>

</div>
</div>
</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>