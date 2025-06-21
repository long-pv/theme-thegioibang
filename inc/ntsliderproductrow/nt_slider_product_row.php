<?php

class NtSliderProductRow {
	public function __construct () {

		add_action('ux_builder_setup', array($this, 'nt_shortcode_slider_product_row'));
		add_shortcode("ux_products_slider_row", array($this,"ux_products_slider_row"));
	} 

	// flatsome_ux_builder_template_nt
	public function flatsome_ux_builder_template_nt( $path ) {
		ob_start();
		include get_template_directory() . '/inc/builder/shortcodes/templates/' . $path;
		return ob_get_clean();
	}

	// Get path thumbnail ux
	public function flatsome_ux_builder_thumbnail_nt( $name ) {
		return get_template_directory_uri() . '/inc/builder/shortcodes/thumbnails/' . $name . '.svg';
	}

	public function ntLoopItem(int $nummer = 0, int $number_tru = 0) {
		$nt_arr = array();
		for ($i=0; $i <= $nummer; $i++ ) {
			$nt_arr[] = ($nummer * $i) - $number_tru;
		}

		return $nt_arr;
	}

	// Creat Shortcode Uxbuilder
	public function nt_shortcode_slider_product_row() {
		// Shortcode to display a single product
		$repeater_columns = '4';
		$repeater_type = 'slider';
		$repeater_col_spacing = 'small';
	
		$repeater_posts = 'products';
		$repeater_post_type = 'product';
		$repeater_post_cat = 'product_cat';
	
		$options = array(
		'style_options' => array(
			'type' => 'group',
			'heading' => __( 'Style' ),
			'options' => array(
				'style' => array(
					'type' => 'select',
					'heading' => __( 'Style' ),
					'default' => 'default',
					'options' => require( NT_DIR . '/values/box-layouts.php' )
				)
			),
		),
		'layout_options' => require( NT_DIR . '/commons/repeater-options.php' ),
		'layout_options_slider' => require( NT_DIR . '/commons/repeater-slider.php' ),
		'box_options' => array(
			'type'    => 'group',
			'heading' => __( 'Box' ),
			'options' => array(
				'show_cat' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Category' ),
					'default' => 'true',
				),
				'show_title' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Title' ),
					'default' => 'true',
				),
				'show_rating' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Rating' ),
					'default' => 'true',
				),
				'show_price' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Price' ),
					'default' => 'true',
				),
				'show_add_to_cart' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Add To Cart' ),
					'default' => 'true',
				),
				'show_quick_view' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Quick View' ),
					'default' => 'true',
				),
				'equalize_box' => array(
					'type'    => 'checkbox',
					'heading' => __( 'Equalize Items' ),
					'default' => 'false',
				),
			),
		),
		'post_options' => require( NT_DIR . '/commons/repeater-posts.php' ),
		'filter_posts' => array(
			'type' => 'group',
			'heading' => __( 'Filter Posts' ),
			'conditions' => 'ids == ""',
			'options' => array(
				'orderby' => array(
					'type' => 'select',
					'heading' => __( 'Order By' ),
					'default' => 'normal',
					'options' => array(
						'normal' => 'Normal',
						'title' => 'Title',
						'sales' => 'Sales',
						'rand' => 'Random',
						'date' => 'Date'
					)
				),
				'order' => array(
					'type' => 'select',
					'heading' => __( 'Order' ),
					'default' => 'desc',
					'options' => array(
						'asc' => 'ASC',
						'desc' => 'DESC',
					)
				),
				'show' => array(
					'type' => 'select',
					'heading' => __( 'Show' ),
					'default' => '',
					'options' => array(
						'' => 'All',
						'featured' => 'Featured',
						'onsale' => 'On Sale',
					)
				),
				'out_of_stock' => array(
					'type'    => 'select',
					'heading' => __( 'Out Of Stock' ),
					'default' => '',
					'options' => array(
						''        => 'Include',
						'exclude' => 'Exclude',
					),
				),
			)
		)
		);
	
		$box_styles = require( NT_DIR . '/commons/box-styles.php' );
		$options = array_merge($options, $box_styles);
	
		$options['image_options']['conditions'] = 'style !== "default"';
		$options['text_options']['conditions'] = 'style !== "default"';
		$options['layout_options']['options']['depth']['conditions'] = 'style !== "default"';
		$options['layout_options']['options']['depth_hover']['conditions'] = 'style !== "default"';
	
		$options['post_options']['options']['tags'] = array(
		'type' => 'select',
		'heading' => 'Tag',
		'conditions' => 'ids == ""',
		'default' => '',
		'config' => array(
			'placeholder' => 'Select...',
			'termSelect' => array(
				'post_type' => 'product',
				'taxonomies' => 'product_tag',
			),
		)
		);
	
		add_ux_builder_shortcode( 'ux_products_slider_row', array(
			'name' => 'Products Slider Row',
			'category' => __( 'Shop' ),
			'priority' => 1,
			'thumbnail' =>  $this->flatsome_ux_builder_thumbnail_nt( 'products' ),
			'presets' => array(
					array(
						'name' => __( 'Default' ),
						'content' => '[ux_products_slider_row]'
					)
			),
			'options' => $options
		) );
		
	}


	public function ux_products_slider_row($atts, $content = null, $tag = '' ) {
		$sliderrandomid = rand();
	
	  if ( ! is_array( $atts ) ) {
		$atts = array();
	  }
	
		extract(shortcode_atts(array(
			'_id' => 'product-grid-'.rand(),
			'title' => '',
			'ids' => '',
			'style' => 'default',
			'class' => '',
			'visibility' => '',
	
			// Ooptions
			'back_image' => true,
	
			// Layout
			'columns' => '4',
			'columns__sm' => '',
			'columns__md' => '',
			'col_spacing' => 'small',
			'type' => 'slider', // slider, row, masonery, grid
			'width' => '',
			'grid' => '1',
			'grid_height' => '600px',
			'grid_height__md' => '500px',
			'grid_height__sm' => '400px',
			'slider_nav_style' => 'reveal',
			'slider_nav_position' => '',
			'slider_nav_color' => '',
			'slider_bullets' => 'false',
			 'slider_arrows' => 'true',
			'auto_slide' => '',
			'infinitive' => 'true',
			'depth' => '',
			   'depth_hover' => '',
			 'equalize_box' => 'false',
			 // posts
			 'products' => '16',
			'cat' => '',
			'excerpt' => 'visible',
			'offset' => '',
			'filter' => '',
			// Posts Woo
			'orderby' => '', // normal, sales, rand, date
			'order' => '',
			'tags' => '',
			'show' => '', //featured, onsale
			'out_of_stock' => '', // exclude.
			// Box styles
			'animate' => '',
			'text_pos' => 'bottom',
			  'text_padding' => '',
			  'text_bg' => '',
			'text_color' => '',
			'text_hover' => '',
			'text_align' => 'center',
			'text_size' => '',
			'image_size' => '',
			'image_radius' => '',
			'image_width' => '',
			'image_height' => '',
			'image_hover' => '',
			'image_hover_alt' => '',
			'image_overlay' => '',
			'show_cat' => 'true',
			'show_title' => 'true',
			'show_rating' => 'true',
			'show_price' => 'true',
			'show_add_to_cart' => 'true',
			'show_quick_view' => 'true',
	
		), $atts));
	
		// Stop if visibility is hidden
	  if($visibility == 'hidden') return;
	
		$items                             = flatsome_ux_product_box_items();
		$items['cat']['show']              = $show_cat;
		$items['title']['show']            = $show_title;
		$items['rating']['show']           = $show_rating;
		$items['price']['show']            = $show_price;
		$items['add_to_cart']['show']      = $show_add_to_cart;
		$items['add_to_cart_icon']['show'] = $show_add_to_cart;
		$items['quick_view']['show']       = $show_quick_view;
		$items                             = flatsome_box_item_toggle_start( $items );
	
		ob_start();
	
		// if no style is set
		if(!$style) $style = 'default';
	
		$classes_box = array('box');
		$classes_image = array();
		$classes_text = array();
		$classes_repeater = array( $class );
	
		if ( $equalize_box === 'true' ) {
			$classes_repeater[] = 'equalize-box';
		}
	
		// Fix product on small screens
		if($style == 'overlay' || $style == 'shade'){
			if(!$columns__sm) $columns__sm = 1;
		}
	
		if($tag == 'ux_bestseller_products') {
			if(!$orderby) $atts['orderby'] = 'sales';
		} else if($tag == 'ux_featured_products'){
			$atts['show'] = 'featured';
		} else if($tag == 'ux_sale_products'){
			$atts['show'] = 'onsale';
		} else if($tag == 'products_pinterest_style'){
			$type = 'masonry';
			$style = 'overlay';
			$text_align = 'center';
			$image_size = 'medium';
			$text_pos = 'middle';
			$text_hover = 'hover-slide';
			$image_hover = 'overlay-add';
			$class = 'featured-product';
			$back_image = false;
			$image_hover_alt = 'image-zoom-long';
		} else if($tag == 'product_lookbook'){
			$type = 'slider';
			$style = 'overlay';
			$col_spacing = 'collapse';
			$text_align = 'center';
			$image_size = 'medium';
			$slider_nav_style = 'circle';
			$text_pos = 'middle';
			$text_hover = 'hover-slide';
			$image_hover = 'overlay-add';
			$image_hover_alt = 'zoom-long';
			$class = 'featured-product';
			$back_image = false;
		}
	
		// Fix grids
		if($type == 'grid'){
		  if(!$text_pos) $text_pos = 'center';
		  if(!$text_color) $text_color = 'dark';
		  if($style !== 'shade') $style = 'overlay';
		  $columns = 0;
		  $current_grid = 0;
		  $grid = flatsome_get_grid($grid);
		  $grid_total = count($grid);
		  flatsome_get_grid_height($grid_height, $_id);
		}
	
		// Fix image size
		if(!$image_size) $image_size = 'woocommerce_thumbnail';
	
		   // Add Animations
		if($animate) {$animate = 'data-animate="'.$animate.'"';}
	
	
		// Set box style
		if($class) $classes_box[] = $class;
		$classes_box[] = 'has-hover';
		if($style) $classes_box[] = 'box-'.$style;
		if($style == 'overlay') $classes_box[] = 'dark';
		if($style == 'shade') $classes_box[] = 'dark';
		if($style == 'badge') $classes_box[] = 'hover-dark';
		if($text_pos) $classes_box[] = 'box-text-'.$text_pos;
		if($style == 'overlay' && !$image_overlay) $image_overlay = true;
	
		if($image_hover) $classes_image[] = 'image-'.$image_hover;
		if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
		if($image_height)  $classes_image[] = 'image-cover';
	
		// Text classes
		if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
		if($text_align) $classes_text[] = 'text-'.$text_align;
		if($text_size) $classes_text[] = 'is-'.$text_size;
		if($text_color == 'dark') $classes_text[] = 'dark';
	
		$css_args_img = array(
		  array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
		  array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
		);
	
		$css_image_height = array(
		  array( 'attribute' => 'padding-top', 'value' => $image_height),
		);
	
		$css_args = array(
			array( 'attribute' => 'background-color', 'value' => $text_bg ),
			array( 'attribute' => 'padding', 'value' => $text_padding ),
		  );
	
		  // If default style
		  if($style == 'default'){
			  $depth = get_theme_mod('category_shadow');
			  $depth_hover = get_theme_mod('category_shadow_hover');
		  }
	
		// Repeater styles
		$repater['id'] = $_id;
		$repater['title'] = $title;
		$repater['tag'] = $tag;
		$repater['class'] = implode( ' ', $classes_repeater );
		$repater['visibility'] = $visibility;
		$repater['type'] = $type;
		$repater['style'] = $style;
		$repater['slider_style'] = $slider_nav_style;
		$repater['slider_nav_color'] = $slider_nav_color;
		$repater['slider_nav_position'] = $slider_nav_position;
		$repater['slider_bullets'] = $slider_bullets;
		  $repater['auto_slide'] = $auto_slide;
		$repater['row_spacing'] = $col_spacing;
		$repater['row_width'] = $width;
		$repater['columns'] = 1;
		$repater['columns__md'] = 1;
		$repater['columns__sm'] = 1;
		$repater['filter'] = $filter;
		$repater['depth'] = $depth;
		$repater['depth_hover'] = $depth_hover;
	
		get_flatsome_repeater_start($repater);
	
		?>
		<?php
	
			if(empty($ids)){
	
				// Get products
				$atts['products'] = $products;
				$atts['offset'] = $offset;
				$atts['cat'] = $cat;
	
				$products = ux_list_products($atts);
	
			} else {
				// Get custom ids
				$ids = explode( ',', $ids );
				$ids = array_map( 'trim', $ids );
	
				$args = array(
					'post__in' => $ids,
					'post_type' => 'product',
					'numberposts' => -1,
					'posts_per_page' => -1,
					'orderby' => 'post__in',
					'ignore_sticky_posts' => true,
				);
	
				$products = new WP_Query( $args );
			}
	
			if ( $products->have_posts() ) :  ?>
	
			 <?php while ( $products->have_posts() ) : $products->the_post();
			
			  	global $product; 
				$classes_col = array('col');
				$out_of_stock = ! $product->is_in_stock();
				if($out_of_stock) $classes[] = 'out-of-stock';

				if($type == 'grid'){
					if($grid_total > $current_grid) $current_grid++;
					$current = $current_grid-1;
					$classes_col[] = 'grid-col';
					if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];

					if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
						if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];
					// Set image size
					if($grid[$current]['size']) $image_size = $grid[$current]['size'];
				}
				
			  	if($style == 'default'):
					require( NT_DIR_THEM_CHILD_INC ."/ntsliderproductrow/nt_slider_product_frontend.php");
			  	endif;
			
			endwhile; // end of the loop. 
				
			endif;
			wp_reset_query();
	
		get_flatsome_repeater_end($repater);
		flatsome_box_item_toggle_end( $items );
	
		$content = ob_get_contents();
		ob_end_clean();
	
		return $content;
	}
	


}

$ntSliderRow = new NtSliderProductRow();






