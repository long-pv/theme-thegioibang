<?php
// ===============================
// Shortcode: [tgb_featured]
// ===============================
add_shortcode('tgb_featured', function () {
    ob_start();
?>
    <div class="tgb_featured">
        <div class="grid_row">
            <div class="grid_col-lg-6">
                <div class="featured_inner">
                    <img class="pattern" src="<?php echo TGB_IMG_URL . 'pt_1.png'; ?>" alt="">
                    <div class="heading">
                        <h2 class="title">
                            Sản phẩm bán chạy
                        </h2>
                        <div class="desc">
                            Tạo xu hướng với bảng xếp hạng dựa trên dữ liệu
                        </div>

                        <a href="#" class="btn_link">
                            <span class="text">
                                Xem thêm
                            </span>
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="list_product">
                        <?php for ($i = 0; $i < 10; $i++) : ?>
                            <div>
                                <div class="product_item">
                                    <a href="#" class="img_wrap">
                                        <img src="<?php echo TGB_IMG_URL . 'img2.png'; ?>" alt="">
                                    </a>
                                    <div class="content" data-mh="content">
                                        <a href="#">
                                            <h3 class="title" data-mh="title">
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
            <div class="grid_col-lg-6">
                <div class="featured_inner featured_inner_even">
                    <img class="pattern" src="<?php echo TGB_IMG_URL . 'pt_2.png'; ?>" alt="">
                    <div class="heading">
                        <h2 class="title">
                            Sản phẩm mới
                        </h2>
                        <div class="desc">
                            Luôn dẫn đầu với những sản phẩm mới nhất
                        </div>

                        <a href="#" class="btn_link">
                            <span class="text">
                                Xem thêm
                            </span>
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="list_product">
                        <?php for ($i = 0; $i < 10; $i++) : ?>
                            <div>
                                <div class="product_item">
                                    <a href="#" class="img_wrap">
                                        <img src="<?php echo TGB_IMG_URL . 'img2.png'; ?>" alt="">
                                    </a>
                                    <div class="content" data-mh="content">
                                        <a href="#">
                                            <h3 class="title" data-mh="title">
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
    </div>
<?php
    return ob_get_clean();
});
