<?php
/*
Template name: Page - Full Width - Parallax Title
*/
get_header(); ?>
<div class="parallax-title mb">
<?php while ( have_posts() ) : the_post(); ?>
	<?php ob_start(); ?>
	<header class="entry-header dark text-center relative">
		<h1 class="entry-title is-larger">
			<strong><?php the_title(); ?></strong>
		</h1>
		<?php if( has_excerpt() ) { ?>
		<div class="lead">
			<?php echo do_shortcode(get_the_excerpt()); ?>
		</div>
		<?php } ?>
	</header>
	<?php 
	$bg = '#333';
	if( has_post_thumbnail() ) $bg = get_post_thumbnail_id();
	$header_html = ob_get_contents();
	$header_html = '[page_header height="230px" align="center" title_case="uppercase" bg="'.$bg.'" bg_size="original"]';
	ob_end_clean();
	echo do_shortcode($header_html); ?>
<?php endwhile; // end of the loop. ?>
</div>

<div id="content" role="main">
	<div class="row row-main">
		<div class="large-12 col">
			<div class="col-inner">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>
				
				<?php endwhile; // end of the loop. ?>
				
			</div><!-- .col-inner -->
		</div><!-- .large-12 -->
	</div><!-- .row -->
			
</div>
<?php get_footer(); ?>