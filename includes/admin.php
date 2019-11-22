<?php

/**
 * Register a custom menu page.
 */
function uiua_add_unavailable_page() {
    add_submenu_page(
            'options-general.php',__('Product out of stock Setting', 'uikar-unavailable'), __('Product out of stock Setting', 'uikar-unavailable'), 'manage_options', 'uiua', 'uiua_menu_page', plugins_url('uikar-form-builder/assets/img/icon.png'), 70
    );
}

add_action('admin_menu', 'uiua_add_unavailable_page');

/**
 * Display a custom menu page
 */
function uiua_menu_page() {
    ?>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); 
         $available = get_option('product_unavailable');
         if($available == 3)
            {
                $firstchecked = 'checked';
                $secondchecked = '';
                uiua_productsOut($available);
            }
            elseif($available == 2)
            {
                $firstchecked = '';
                $secondchecked = 'checked';
                uiua_productsOut($available);
            }
            else{
                $firstchecked = '';
                $secondchecked = '';   
            }?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Make All Products out of stock', 'uikar-unavailable'); ?></th>
                <td><input <?php echo($firstchecked);?> type="radio" name="product_unavailable" value="3" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Make All Products in stock', 'uikar-unavailable'); ?></th>
                <td><input <?php echo($secondchecked);?> type="radio" name="product_unavailable" value="2" /></td>
            </tr>
        </table>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="product_unavailable" />
        <div class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save', 'uikar-unavailable') ?>" />
        </div>
    </form>
    <?php
}
function uiua_productsOut($available)
{
    $children = get_posts( array(
        'posts_per_page'=> -1,
        'post_type'   => 'product',
        'post_status'  => 'publish'
    ) );
    if($available == 3)
    {
        $out_of_stock_staus = 'outofstock';
        foreach ( $children as $thischild ) {
            update_post_meta( $thischild->ID, '_stock_status', wc_clean( $out_of_stock_staus ) );//instock
        }
    }
    elseif($available == 2)
    {
        $out_of_stock_staus = 'instock';
        foreach ( $children as $thischild ) {
            update_post_meta( $thischild->ID, '_stock_status', wc_clean( $out_of_stock_staus ) );//instock
        }
    }
    
}