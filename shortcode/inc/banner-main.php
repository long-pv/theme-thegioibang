<?php
// ===============================
// Shortcode: [tgb_banner_main]
// ===============================
add_shortcode('tgb_banner_main', function () {
    ob_start();

    $image_1 = get_field('banner_main_image_1', 'option') ?? '';
    $image_1_link = get_field('banner_main_image_1_link', 'option') ?? '';
    $image_2 = get_field('banner_main_image_2', 'option') ?? '';
    $image_2_link = get_field('banner_main_image_2_link', 'option') ?? '';
    $image_3 = get_field('banner_main_image_3', 'option') ?? '';
    $image_3_link = get_field('banner_main_image_3_link', 'option') ?? '';
?>
    <div class="tgb_banner_main">
        <div class="show_pc">
            <div class="grid_row">
                <div class="grid_col-lg-8">
                    <?php if ($image_1) : ?>
                        <div class="img_wrap large">
                            <?php echo $image_1_link ? '<a target="_blank" href="' . $image_1_link . '">' : ''; ?>
                            <img src="<?php echo $image_1; ?>" alt="banner 1">
                            <?php echo $image_1_link ? '</a>' : ''; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="grid_col-lg-4">
                    <div class="grid_row">
                        <?php if ($image_2) : ?>
                            <div class="grid_col-12">
                                <div class="img_wrap small">
                                    <?php echo $image_2_link ? '<a target="_blank" href="' . $image_2_link . '">' : ''; ?>
                                    <img src="<?php echo $image_2; ?>" alt="banner 2">
                                    <?php echo $image_2_link ? '</a>' : ''; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($image_3) : ?>
                            <div class="grid_col-12">
                                <div class="img_wrap small">
                                    <?php echo $image_3_link ? '<a target="_blank" href="' . $image_3_link . '">' : ''; ?>
                                    <img src="<?php echo $image_3; ?>" alt="banner 3">
                                    <?php echo $image_3_link ? '</a>' : ''; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="show_mb">
            <div class="banner_main_slider">
                <?php if ($image_1) : ?>
                    <div>
                        <div class="img_wrap small">
                            <?php echo $image_1_link ? '<a target="_blank" href="' . $image_1_link . '">' : ''; ?>
                            <img src="<?php echo $image_1; ?>" alt="banner 1">
                            <?php echo $image_1_link ? '</a>' : ''; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($image_2) : ?>
                    <div>
                        <div class="img_wrap small">
                            <?php echo $image_2_link ? '<a target="_blank" href="' . $image_2_link . '">' : ''; ?>
                            <img src="<?php echo $image_2; ?>" alt="banner 2">
                            <?php echo $image_2_link ? '</a>' : ''; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($image_3) : ?>
                    <div>
                        <div class="img_wrap small">
                            <?php echo $image_3_link ? '<a target="_blank" href="' . $image_3_link . '">' : ''; ?>
                            <img src="<?php echo $image_3; ?>" alt="banner 3">
                            <?php echo $image_3_link ? '</a>' : ''; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
