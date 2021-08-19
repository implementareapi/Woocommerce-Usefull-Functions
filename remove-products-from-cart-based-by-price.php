/* Remove products from cart and orders if price is = with number */

function filter_product_bundle($order_id){
    // get order object
    $order_to_edit = new WC_Order( $order_id );

    // get order items = each product in the order
    $items = $order_to_edit->get_items();

    foreach ( $items as $item ) {
        $product = wc_get_product( $item['product_id'] );
        $the_price = $product->get_price();


      

        if ( $the_price == '0' || $the_price == '100') { //remove products from cart and orders if a product have price 0 or 100
            $order_to_edit->remove_item( $item->get_id() );
        }
    }

    $order_to_edit->save();
}

add_filter('woocommerce_checkout_order_processed','filter_product_bundle', 999,1);
