<?php if ( have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( have_posts() ) : the_post();
		array_push($ids, get_the_ID());
	endwhile; // end of the loop.
	$ids = implode(',', $ids);
?>

	<?php
	echo flatsome_apply_shortcode( 'nt_post', array(
		'type'        => get_theme_mod( 'blog_style_type', 'row' ),
		'depth'       => get_theme_mod( 'blog_posts_depth', 0 ),
		'depth_hover' => get_theme_mod( 'blog_posts_depth_hover', 0 ),
		'text_align'  => get_theme_mod( 'blog_posts_title_align', 'center' ),
		'style'     => 'default',
		'columns'     => '2',
		'columns__md'     => '2',
		'columns__sm'     => '1',
		'excerpt_length'     => '34',
		'show_date'     => 'text',
		'readmore'     => 'Xem Thêm...',
		'readmore_color'     => 'secondary',
		'show_category'     => 'label',
		'image_height'     => '70%',
		'image_size'     => 'full',
		'readmore_style'     => 'link',
		'image_overlay'     => 'rgba(0, 0, 0, 0.244)',
		'ids'         => $ids,
	) );
	?>

<?php flatsome_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>
