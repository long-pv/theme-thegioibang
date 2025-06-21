<?php
$shopee = get_post_meta( $post->ID, 'shopee', true );
$lazada = get_post_meta( $post->ID, 'lazada', true );
$tiki = get_post_meta( $post->ID, 'tiki', true );
?>

<p>
    <label for="shopee">Shopee: </label>
    <input type="url" id="shopee"  class="postbox" name="shopee" value="<?php echo esc_attr( $shopee ); ?>" />
</p>

<p>
    <label for="lazada">Lazada: </label>
    <input type="url" id="lazada"  class="postbox" name="lazada" value="<?php echo esc_attr( $lazada ); ?>" />
</p>

<p>
    <label for="tiki">Tiki: </label>
    <input type="url" id="tiki"  class="postbox" name="tiki" value="<?php echo esc_attr( $tiki ); ?>" />
</p>

<style>
    #ntprofile  .postbox {
        margin-bottom: 0;
        width: 100%;
    }
    #ntprofile  p {
        display: flex;
        align-items: center;
    }
    #ntprofile  label {
        min-width: 300px;
        display: inline-block;
        font-weight: 700;
    }
    #ntprofile  textarea.postbox {
        padding: 10px;
    }
</style>