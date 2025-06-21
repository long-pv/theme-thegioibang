<?php
class ntProfile
{
    public function __construct()
    {
        // Thêm meta box
        add_action( 'add_meta_boxes', array($this, 'ntProfileMetabox') );
        add_action( 'save_post', array($this, 'ntProfileUpateMetabox') );
        add_action('delete_post', array($this, 'ntProfileDeleteMetabox') , 10);

    }

    
    //  Khai báo meta box
    public function ntProfileMetabox() {
        add_meta_box( 'ntprofile', 'Đường dẫn Sản Phẩm Tại', array( $this , 'ntProfileAddMetabox' ), 'product' );
    }
    
    //  @param $post là đối tượng WP_Post để nhận thông tin của post
    public function ntProfileAddMetabox( $post ) {
        require(NT_DIR_THEM_CHILD_INC . '/ntprofile/ntprofile-metabox.php');
    }
    
    //  Lưu dữ liệu meta box khi nhập vào
    public function ntProfileUpateMetabox( $post_id ) {
        if(isset($_POST['shopee'])) :
            $shopee = sanitize_text_field( $_POST['shopee'] );
            update_post_meta( $post_id, 'shopee', $shopee );
        endif;

        if(isset($_POST['lazada'])) :
            $lazada = sanitize_text_field( $_POST['lazada'] );
            update_post_meta( $post_id, 'lazada', $lazada );
        endif;
        
        if(isset($_POST['tiki'])) :
            $tiki = sanitize_text_field( $_POST['tiki'] );
            update_post_meta( $post_id, 'tiki', $tiki );
        endif;

       
    }

    // Hàm xóa metadata
    public function ntProfileDeleteMetabox($post_id) {
        delete_post_meta($post_id, 'shopee');
        delete_post_meta($post_id, 'lazada');
        delete_post_meta($post_id, 'tiki');
    }

}

new ntProfile();


