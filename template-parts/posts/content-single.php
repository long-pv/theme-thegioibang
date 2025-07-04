<!-- <div class="heading_title">
	<?php //the_title(); ?>
</div> -->

<div class="post_info">
	<div class="date">
		<div class="icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 6V12L16 14M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
		</div>
		<div class="text">
			<?php echo get_the_date('d/m/Y'); ?>
		</div>
	</div>

	<div class="line"></div>

	<div class="social">
		<?php
		$share_link = get_permalink();
		?>
		<div class="text">
			Chia sẻ:
		</div>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" onclick="window.open(this.href, this.target, 'width=500,height=500'); return false;" class="social_share_post_facebook">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_4399_11108)">
					<path d="M20.9455 0H3.05455C2.24443 0 1.46749 0.321817 0.894656 0.894656C0.321817 1.46749 0 2.24443 0 3.05455V20.9455C0 21.7556 0.321817 22.5325 0.894656 23.1053C1.46749 23.6782 2.24443 24 3.05455 24H11.8184V14.014H9.82118V10.0197H11.8018V8.21455C11.8018 6.5808 12.5801 4.0284 16.0051 4.0284L19.0904 4.04078V7.46302H16.8498C16.4855 7.46302 15.9671 7.64444 15.9671 8.42258V10.0199H19.1414L18.777 14.0143H15.8127V24H20.9455C21.3466 24 21.7438 23.921 22.1144 23.7675C22.485 23.614 22.8217 23.389 23.1053 23.1053C23.389 22.8217 23.614 22.485 23.7675 22.1144C23.921 21.7438 24 21.3466 24 20.9455V3.05455C24 2.65342 23.921 2.25622 23.7675 1.88562C23.614 1.51503 23.389 1.1783 23.1053 0.894656C22.8217 0.611015 22.485 0.386019 22.1144 0.232513C21.7438 0.0790081 21.3466 0 20.9455 0Z" fill="#1877F2" />
				</g>
				<defs>
					<clipPath id="clip0_4399_11108">
						<rect width="24" height="24" fill="white" />
					</clipPath>
				</defs>
			</svg>
		</a>

		<a href="https://www.instagram.com/?url=<?php echo $share_link; ?>" onclick="window.open(this.href, this.target, 'width=500,height=500'); return false;" class="social_share_post_instagram">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_4399_11130)">
					<path d="M17.625 4.26562H6.375C5.21191 4.26562 4.26562 5.21191 4.26562 6.375V17.625C4.26562 18.7881 5.21191 19.7344 6.375 19.7344H17.625C18.7881 19.7344 19.7344 18.7881 19.7344 17.625V6.375C19.7344 5.21191 18.7881 4.26562 17.625 4.26562ZM12 16.9219C9.28638 16.9219 7.07812 14.7136 7.07812 12C7.07812 9.28638 9.28638 7.07812 12 7.07812C14.7136 7.07812 16.9219 9.28638 16.9219 12C16.9219 14.7136 14.7136 16.9219 12 16.9219ZM16.9219 8.48438C16.1466 8.48438 15.5156 7.85339 15.5156 7.07812C15.5156 6.30286 16.1466 5.67188 16.9219 5.67188C17.6971 5.67188 18.3281 6.30286 18.3281 7.07812C18.3281 7.85339 17.6971 8.48438 16.9219 8.48438Z" fill="#CE3727" />
					<path d="M12 8.48438C10.0616 8.48438 8.48438 10.0616 8.48438 12C8.48438 13.9384 10.0616 15.5156 12 15.5156C13.9384 15.5156 15.5156 13.9384 15.5156 12C15.5156 10.0616 13.9384 8.48438 12 8.48438Z" fill="#CE3727" />
					<path d="M20.4375 0H3.5625C1.62415 0 0 1.62415 0 3.5625V20.4375C0 22.3759 1.62415 24 3.5625 24H20.4375C22.3759 24 24 22.3759 24 20.4375V3.5625C24 1.62415 22.3759 0 20.4375 0ZM21.1406 17.625C21.1406 19.5634 19.5634 21.1406 17.625 21.1406H6.375C4.43665 21.1406 2.85938 19.5634 2.85938 17.625V6.375C2.85938 4.43665 4.43665 2.85938 6.375 2.85938H17.625C19.5634 2.85938 21.1406 4.43665 21.1406 6.375V17.625Z" fill="#CE3727" />
				</g>
				<defs>
					<clipPath id="clip0_4399_11130">
						<rect width="24" height="24" fill="white" />
					</clipPath>
				</defs>
			</svg>
		</a>

		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>&title=text" onclick="window.open(this.href, this.target, 'width=500,height=500'); return false;" class="social_share_post_linkedin">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_4399_11125)">
					<path d="M21.6 0H2.4C1.08 0 0 1.08 0 2.4V21.6C0 22.92 1.08 24 2.4 24H21.6C22.92 24 24 22.92 24 21.6V2.4C24 1.08 22.92 0 21.6 0ZM7.2 20.4H3.6V9.6H7.2V20.4ZM5.4 7.56C4.2 7.56 3.24 6.6 3.24 5.4C3.24 4.2 4.2 3.24 5.4 3.24C6.6 3.24 7.56 4.2 7.56 5.4C7.56 6.6 6.6 7.56 5.4 7.56ZM20.4 20.4H16.8V14.04C16.8 13.08 15.96 12.24 15 12.24C14.04 12.24 13.2 13.08 13.2 14.04V20.4H9.6V9.6H13.2V11.04C13.8 10.08 15.12 9.36 16.2 9.36C18.48 9.36 20.4 11.28 20.4 13.56V20.4Z" fill="#3B82F6" />
				</g>
				<defs>
					<clipPath id="clip0_4399_11125">
						<rect width="24" height="24" fill="white" />
					</clipPath>
				</defs>
			</svg>
		</a>
	</div>
</div>

<div class="entry-content single-page">

	<?php the_content(); ?>

	<?php
	wp_link_pages();
	?>


</div>

<?php /*
<div class="row">
	<div class="large-6 col">
		<?php if (get_theme_mod('blog_single_footer_meta', 1)) : ?>
			<footer class="entry-meta">
				<?php
				$category_list = get_the_category_list(__(', ', 'flatsome'));
				$tag_list = get_the_tag_list('', __(', ', 'flatsome'));
				// But this blog has loads of categories so we should probably display them here.
				if ('' != $tag_list) {
					$meta_text = __('Tags: %2$s.', 'flatsome');
				} else {
				}
				printf($meta_text, $category_list, $tag_list, get_permalink(), the_title_attribute('echo=0'));
				?>
			</footer>
		<?php endif; ?>
	</div>
	
	<div class="large-6 col">
		<?php if (get_theme_mod('blog_share', 1)) {
			// SHARE ICONS
			echo '<div class="blog-share text-right">';
			echo do_shortcode('[share]');
			echo '</div>';
		} ?>
	</div>
</div>
*/ ?>

<?php /* if (get_theme_mod('blog_author_box', 1)) : ?>
	<div class="entry-author author-box">
		<div class="flex-row align-top">
			<div class="flex-col mr circle">
				<div class="blog-author-image">
					<?php
					$user = get_the_author_meta('ID');
					echo get_avatar($user, 90);
					?>
				</div>
			</div>
			<div class="flex-col flex-grow">
				<h5 class="author-name uppercase pt-half">
					<?php echo esc_html(get_the_author_meta('display_name')); ?>
				</h5>
				<p class="author-desc small"><?php echo esc_html(get_the_author_meta('user_description')); ?></p>
			</div>
		</div>
	</div>
<?php endif; */ ?>

<?php /* if (get_theme_mod('blog_single_next_prev_nav', 1)) :
	flatsome_content_nav('nav-below');
endif; */ ?>