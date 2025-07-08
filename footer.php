<?php

/**
 * The template for displaying the footer.
 *
 * @package flatsome
 */

global $flatsome_opt;
?>

<div class="hotline-phone-ring-wrap">
    <div class="hotline-phone-ring">
        <!-- <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle"> -->
            <a href="https://zalo.me/<?= the_field('cta_zalo_oa', 'option') ?>" target="_blank">
                <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_Zalo.png" alt=""> -->
                <img src="<?php echo TGB_IMG_URL . 'zalo.png' ?>" alt="">
            </a>
        </div>
    </div>
</div>
<div class="call">
    <div class="hotline-phone-ring">
        <!-- <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle"> -->
            <div class="call_pop">
                <a id="callnowbutton" href="#popup_call">
                    <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/call.png" alt=""> -->
                    <img src="<?php echo TGB_IMG_URL . 'phone.png' ?>" alt="">
                </a>
            </div>
        <!-- </div> -->
    </div>
</div>
<div id="popup_call" class="lightbox-by-id lightbox-content mfp-hide lightbox-white " style="max-width:500px ;padding:20px">
    <?= the_field('list_phone', 'option') ?>
</div>
</main><!-- #main -->

<footer id="footer" class="footer-wrapper">

    <?php do_action('flatsome_footer'); ?>

</footer><!-- .footer-wrapper -->
<!-- <script type="text/javascript">
(function($) {
  $(function() { //on DOM ready 
        $("#scroller").simplyScroll();
  });
 })(jQuery);
</script> -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>

</html>