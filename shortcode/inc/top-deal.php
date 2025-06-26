<?php
// ===============================
// Shortcode: [tgb_top_deal]
// ===============================
add_shortcode('tgb_top_deal', function () {
    ob_start();
?>
    <div class="tgb_top_deal">
        <div class="grid_row">
            <div class="grid_col-lg-3">
                <div class="heading">
                    <div class="sub_title">
                        <span class="text">
                            Top deal
                        </span>
                        <span class="dot"></span>
                        <span class="text">
                            Siêu rẻ
                        </span>
                    </div>

                    <h2 class="title">
                        Đơn hàng đầu tiên,
                        <br>
                        <span>GIẢM GIÁ</span> chớp nhoáng
                    </h2>

                    <a href="#" class="btn_link">Khám phá ngay</a>
                </div>
            </div>

            <div class="grid_col-lg-9">
                <div class="product_slider">
                    <?php for ($i = 0; $i < 10; $i++) : ?>
                        <div>
                            <div class="product_item product_item_sale">
                                <img class="icon_sale" src="<?php echo TGB_IMG_URL . 'icon_sale.png'; ?>" alt="">

                                <a href="#" class="img_wrap">
                                    <img src="<?php echo TGB_IMG_URL . 'img2.png'; ?>" alt="">
                                </a>
                                <div class="content">
                                    <a href="#">
                                        <h3 class="title">
                                            Bảng Di Động New - 5 cải tiến <?php echo $i; ?>
                                        </h3>
                                    </a>

                                    <div class="price">
                                        ₫300,000
                                    </div>

                                    <div class="discount">
                                        <div class="cent">
                                            -10%
                                        </div>
                                        <div class="old_price">
                                            ₫400,000
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
