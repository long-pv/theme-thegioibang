<div class="col <?php echo implode(' ', $col_class); ?>" <?php echo $animate;?>>
    <div class="col-inner">
    
        <div class="box <?php echo $classes_box; ?> box-blog-post has-hover">
    <?php if(has_post_thumbnail()) { ?>
                <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
					<a href="<?php the_permalink() ?>" class="plain">
                    <div class="<?php echo $classes_image; ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                        <?php the_post_thumbnail($image_size); ?>
                        <!-- <?php if($image_overlay){ ?><div class="overlay" style="background-color: <?php echo $image_overlay;?>">
							<?php if($show_category !== 'false') { ?>
								<h5 class="post-title is-<?php echo $title_size; ?> <?php echo $title_style;?>"><?php the_title(); ?></h5>
							<?php } ?>
						</div><?php } ?> -->
                        <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                    </div>
                    <?php if($post_icon && get_post_format()) { ?>
                        <div class="absolute no-click x50 y50 md-x50 md-y50 lg-x50 lg-y50">
                            <div class="overlay-icon">
                                <i class="icon-play"></i>
                            </div>
                        </div>
                    <?php } ?>
					</a>
                </div>
    <?php } ?>
            <div class="box-text <?php echo $classes_text; ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
            <div class="box-text-inner blog-post-inner">

            <?php do_action('flatsome_blog_post_before'); ?>
			
			<?php if($show_category !== 'false') { ?>
				<p class="cat-label <?php if($show_category == 'label') echo 'tag-label'; ?> ">
				<?php
					foreach((get_the_category()) as $cat) {
					echo '<span>' . $cat->cat_name . '</span> ';
				} ?>
				</p>
			<?php } ?>

            <a href="<?php the_permalink() ?>" class="plain">
                <?php if($show_category == 'false') { ?>
               
                <?php } ?>
                 <h3 class="post-title is-<?php echo $title_size; ?> <?php echo $title_style;?>"><?php the_title(); ?></h3>
                <?php if($show_excerpt !== 'false') { ?>
                <p class="from_the_blog_excerpt <?php if($show_excerpt !== 'visible'){ echo 'show-on-hover hover-'.$show_excerpt; } ?>"><?php
                    $the_excerpt  = get_the_excerpt();
                    $excerpt_more = apply_filters( 'excerpt_more', ' [...]' );
                    echo flatsome_string_limit_words($the_excerpt, $excerpt_length) . $excerpt_more;
                ?>
                </p>
                
                <?php if($readmore) { ?>
                    <button href="<?php echo get_the_permalink(); ?>" class="button <?php echo $readmore_color; ?> is-<?php echo $readmore_style; ?> is-<?php echo $readmore_size; ?> mb-0">
                        <?php echo $readmore ;?>
                    </button>
                <?php } ?>
            </a>
            
            <div class="flex-row">
                <div class="flex-col">
                    <div class="blog-like">
                        <?php if((!has_post_thumbnail() && $show_date !== 'false') || $show_date == 'text') {?>
							<div class="post-meta"> <?php echo get_the_date(); ?></div>
						<?php } ?>
                    </div>
                </div>
                <div class="flex-col blog-share text-right"><i class="fas fa-share-alt"></i>
                    <?php echo do_shortcode( '[share]' ); ?>
                </div>
            </div>

            <?php } ?>
            

            <?php do_action('flatsome_blog_post_after'); ?>

            </div>
            </div>

            <?php if(has_post_thumbnail() && ($show_date == 'badge' || $show_date == 'true')) {?>
            <?php if(!$badge_style) $badge_style = get_theme_mod('blog_badge_style', 'outline'); ?>
                <div class="badge absolute top post-date badge-<?php echo $badge_style; ?>">
                    <div class="badge-inner">
                        <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span><br>
                        <span class="post-date-month is-xsmall"><?php echo get_the_time('M', get_the_ID()); ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>