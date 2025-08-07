<?php
// ===============================
// Shortcode: [tgb_footer_main]
// ===============================
add_shortcode('tgb_footer_main', function () {
    ob_start();

    $company_name = get_field('company_name', 'option') ?? null;
    $short_introduction = get_field('short_introduction', 'option') ?? null;
    $customer_support = get_field('customer_support', 'option') ?? null;
    $about_us = get_field('about_us', 'option') ?? null;
    $copyright = get_field('copyright', 'option') ?? '';
    $facebook = get_field('connect_with_us_facebook', 'option') ?? '';
    $instagram = get_field('connect_with_us_instagram', 'option') ?? '';
    $youtube = get_field('connect_with_us_youtube', 'option') ?? '';
    $showroom = get_field('showroom', 'option') ?? [];
?>

    <div class="tgb_footer_main">
        <div class="footer_menu_main">
            <div class="grid_row">
                <div class="grid_col-lg-4">
                    <div class="footer_main_col_1">
                        <a href="#" class="logo">
                            <img src="<?php echo TGB_IMG_URL . 'logo_footer.svg'; ?>" alt="logo">
                        </a>
                        <div class="intro">
                            <?php if ($company_name) : ?>
                                <div class="title">
                                    <?php echo $company_name; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($short_introduction) : ?>
                                <div class="desc">
                                    <?php echo $short_introduction; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="grid_col-lg-8">
                    <div class="grid_row grid_row_1">
                        <div class="grid_col-lg-4">
                            <?php if ($customer_support) : ?>
                                <div class="footer_menu">
                                    <div class="title">
                                        <?php _e('Hỗ trợ khách hàng'); ?>
                                    </div>
                                    <div class="content">
                                        <?php echo $customer_support; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="grid_col-lg-4">
                            <?php if ($about_us) : ?>
                                <div class="footer_menu">
                                    <div class="title">
                                        <?php _e('Về Chúng tôi'); ?>
                                    </div>
                                    <div class="content">
                                        <?php echo $about_us; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="grid_col-lg-4">
                            <?php
                            if ($facebook || $instagram || $youtube) :
                            ?>
                                <div class="footer_menu" style="margin-bottom: 24px;">
                                    <div class="title">
                                        <?php _e('Kết nối với chúng tôi'); ?>
                                    </div>
                                    <div class="social">
                                        <?php if ($facebook) : ?>
                                            <a href="<?php echo $facebook; ?>" class="link">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_6181_1623)">
                                                        <path d="M21.4455 0.361816H3.55455C2.74443 0.361816 1.96749 0.683634 1.39466 1.25647C0.821817 1.82931 0.5 2.60625 0.5 3.41636V21.3073C0.5 22.1174 0.821817 22.8943 1.39466 23.4672C1.96749 24.04 2.74443 24.3618 3.55455 24.3618H12.3184V14.3759H10.3212V10.3815H12.3018V8.57636C12.3018 6.94262 13.0801 4.39022 16.5051 4.39022L19.5904 4.4026V7.82483H17.3498C16.9855 7.82483 16.4671 8.00625 16.4671 8.7844V10.3818H19.6414L19.277 14.3761H16.3127V24.3618H21.4455C21.8466 24.3618 22.2438 24.2828 22.6144 24.1293C22.985 23.9758 23.3217 23.7508 23.6053 23.4672C23.889 23.1835 24.114 22.8468 24.2675 22.4762C24.421 22.1056 24.5 21.7084 24.5 21.3073V3.41636C24.5 3.01523 24.421 2.61803 24.2675 2.24744C24.114 1.87684 23.889 1.54011 23.6053 1.25647C23.3217 0.972831 22.985 0.747835 22.6144 0.59433C22.2438 0.440824 21.8466 0.361816 21.4455 0.361816Z" fill="#1877F2" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_6181_1623">
                                                            <rect width="24" height="24" fill="white" transform="translate(0.5 0.361816)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($instagram) : ?>
                                            <a href="<?php echo $instagram; ?>" class="link">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_6181_1625)">
                                                        <path d="M18.125 4.62744H6.875C5.71191 4.62744 4.76562 5.57373 4.76562 6.73682V17.9868C4.76562 19.1499 5.71191 20.0962 6.875 20.0962H18.125C19.2881 20.0962 20.2344 19.1499 20.2344 17.9868V6.73682C20.2344 5.57373 19.2881 4.62744 18.125 4.62744ZM12.5 17.2837C9.78638 17.2837 7.57812 15.0754 7.57812 12.3618C7.57812 9.64819 9.78638 7.43994 12.5 7.43994C15.2136 7.43994 17.4219 9.64819 17.4219 12.3618C17.4219 15.0754 15.2136 17.2837 12.5 17.2837ZM17.4219 8.84619C16.6466 8.84619 16.0156 8.21521 16.0156 7.43994C16.0156 6.66467 16.6466 6.03369 17.4219 6.03369C18.1971 6.03369 18.8281 6.66467 18.8281 7.43994C18.8281 8.21521 18.1971 8.84619 17.4219 8.84619Z" fill="#B11E1C" />
                                                        <path d="M12.5 8.84619C10.5616 8.84619 8.98438 10.4235 8.98438 12.3618C8.98438 14.3002 10.5616 15.8774 12.5 15.8774C14.4384 15.8774 16.0156 14.3002 16.0156 12.3618C16.0156 10.4235 14.4384 8.84619 12.5 8.84619Z" fill="#B11E1C" />
                                                        <path d="M20.9375 0.361816H4.0625C2.12415 0.361816 0.5 1.98596 0.5 3.92432V20.7993C0.5 22.7377 2.12415 24.3618 4.0625 24.3618H20.9375C22.8759 24.3618 24.5 22.7377 24.5 20.7993V3.92432C24.5 1.98596 22.8759 0.361816 20.9375 0.361816ZM21.6406 17.9868C21.6406 19.9252 20.0634 21.5024 18.125 21.5024H6.875C4.93665 21.5024 3.35938 19.9252 3.35938 17.9868V6.73682C3.35938 4.79846 4.93665 3.22119 6.875 3.22119H18.125C20.0634 3.22119 21.6406 4.79846 21.6406 6.73682V17.9868Z" fill="#B11E1C" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_6181_1625">
                                                            <rect width="24" height="24" fill="white" transform="translate(0.5 0.361816)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($youtube) : ?>
                                            <a href="<?php echo $youtube; ?>" class="link">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_6181_1629)">
                                                        <path d="M10.7056 9.4873L15.3856 12.3619C13.8078 13.33 12.2765 14.2709 10.7056 15.235V9.4873Z" fill="#CE3727" />
                                                        <path d="M22.2732 0.361816H2.72682C2.13623 0.361816 1.56983 0.596427 1.15222 1.01404C0.734611 1.43165 0.5 1.99805 0.5 2.58863L0.5 22.135C0.5 22.7256 0.734611 23.292 1.15222 23.7096C1.56983 24.1272 2.13623 24.3618 2.72682 24.3618H22.2732C22.8638 24.3618 23.4302 24.1272 23.8478 23.7096C24.2654 23.292 24.5 22.7256 24.5 22.135V2.58863C24.5 1.99805 24.2654 1.43165 23.8478 1.01404C23.4302 0.596427 22.8638 0.361816 22.2732 0.361816ZM19.6495 15.9714C19.3495 16.8932 18.3568 17.4536 17.4432 17.5818C14.157 17.9309 10.843 17.9309 7.55682 17.5818C6.64318 17.4536 5.64773 16.9 5.35045 15.9714C4.88274 13.5882 4.88274 11.1368 5.35045 8.75364C5.65045 7.83045 6.64318 7.27136 7.55682 7.14318C10.843 6.79409 14.157 6.79409 17.4432 7.14318C18.3568 7.27136 19.3523 7.825 19.6495 8.75364C20.1173 11.1368 20.1173 13.5882 19.6495 15.9714Z" fill="#CE3727" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_6181_1629">
                                                            <rect x="0.5" y="0.361816" width="24" height="24" rx="3" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="footer_menu">
                                <div class="title">
                                    Chứng nhận bởi
                                </div>
                                <div class="social">
                                    <a href="#" class="link">
                                        <img src="<?php echo TGB_IMG_URL . 'bo_cong_thuong.png'; ?>" alt="bo cong thuong">
                                    </a>
                                    <a href="#" class="link">
                                        <img src="<?php echo TGB_IMG_URL . 'dcma.png'; ?>" alt="dcma">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($showroom) :
        ?>
            <div class="showroom">
                <div class="grid_row">
                    <?php foreach ($showroom as $item): ?>
                        <div class="grid_col-lg-4">
                            <div class="item">
                                <div class="title">
                                    <div class="icon">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.86866 15.8218L7 22.3618L11.5884 19.6088C11.7381 19.519 11.8129 19.4741 11.8928 19.4565C11.9634 19.441 12.0366 19.441 12.1072 19.4565C12.1871 19.4741 12.2619 19.519 12.4116 19.6088L17 22.3618L16.1319 15.8189M16.4259 4.6107C16.5803 4.98422 16.8768 5.28111 17.25 5.43612L18.5589 5.9783C18.9325 6.13303 19.2292 6.42981 19.384 6.80336C19.5387 7.17691 19.5387 7.59662 19.384 7.97017L18.8422 9.27817C18.6874 9.65188 18.6872 10.072 18.8427 10.4456L19.3835 11.7532C19.4602 11.9382 19.4997 12.1365 19.4997 12.3368C19.4998 12.5371 19.4603 12.7354 19.3837 12.9204C19.3071 13.1055 19.1947 13.2736 19.0531 13.4152C18.9114 13.5568 18.7433 13.6691 18.5582 13.7457L17.2503 14.2875C16.8768 14.4419 16.5799 14.7384 16.4249 15.1116L15.8827 16.4206C15.728 16.7941 15.4312 17.0909 15.0577 17.2456C14.6841 17.4004 14.2644 17.4004 13.8909 17.2456L12.583 16.7039C12.2094 16.5495 11.7899 16.5498 11.4166 16.7047L10.1077 17.2461C9.73434 17.4005 9.31501 17.4004 8.94178 17.2458C8.56854 17.0912 8.27194 16.7947 8.11711 16.4216L7.57479 15.1123C7.42035 14.7387 7.12391 14.4418 6.75064 14.2868L5.44175 13.7447C5.06838 13.59 4.77169 13.2934 4.61691 12.9201C4.46213 12.5467 4.46192 12.1272 4.61633 11.7537L5.1581 10.4457C5.31244 10.0722 5.31213 9.6526 5.15722 9.27928L4.61623 7.9694C4.53953 7.78439 4.50003 7.58607 4.5 7.38579C4.49997 7.18551 4.5394 6.98718 4.61604 6.80214C4.69268 6.6171 4.80504 6.44898 4.94668 6.30738C5.08832 6.16578 5.25647 6.05348 5.44152 5.97689L6.74947 5.4351C7.12265 5.28079 7.41936 4.98472 7.57448 4.61186L8.11664 3.30292C8.27136 2.92938 8.56813 2.63259 8.94167 2.47786C9.3152 2.32313 9.7349 2.32313 10.1084 2.47786L11.4164 3.01965C11.7899 3.174 12.2095 3.17369 12.5828 3.01878L13.8922 2.4787C14.2657 2.32406 14.6853 2.32409 15.0588 2.47879C15.4322 2.63349 15.729 2.93019 15.8837 3.30364L16.426 4.61296L16.4259 4.6107Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <?php echo $item['title']; ?>
                                    </div>
                                </div>

                                <div class="list">
                                    <?php
                                    $city = $item['city'] ?? '';
                                    if ($city):
                                        foreach ($city as $item_2) :
                                    ?>
                                            <div class="item">
                                                <div class="grid_row">
                                                    <div class="grid_col-3">
                                                        <div class="city">
                                                            <?php echo $item_2['title']; ?>:
                                                        </div>
                                                    </div>
                                                    <div class="grid_col-9">
                                                        <div class="address">
                                                            <?php
                                                            $list = $item_2['list'] ?? '';
                                                            if ($list) :
                                                                foreach ($list as $item_3) :
                                                                    if ($item_3['address'] && $item_3['phone']) :
                                                            ?>
                                                                        <div class="item">
                                                                            <div class="content">
                                                                                <?php echo $item_3['address']; ?>
                                                                            </div>

                                                                            <div class="phone">
                                                                                <?php echo $item_3['phone']; ?>
                                                                            </div>
                                                                        </div>
                                                            <?php
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="bottom">
            <div class="grid_row">
                <div class="grid_col-lg-8">
                    <div class="copyright">
                        <?php echo $copyright; ?>
                    </div>
                </div>
                <div class="grid_col-lg-4">
                    <div class="footer_location">
                        <?php echo do_shortcode('[nc_change_location]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
