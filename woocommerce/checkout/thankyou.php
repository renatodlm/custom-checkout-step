<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-order">


   <div class="thankyou-page !py-14">
      <div class="order-details">
         <div class="mt-4">
            <?php
            if ($order) :

               do_action('woocommerce_before_thankyou', $order->get_id());
            ?>

               <?php if ($order->has_status('failed')) : ?>

                  <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

                  <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                     <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                     <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                     <?php endif; ?>
                  </p>

               <?php else : ?>

                  <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                                                                                  ?></p>

                  <ul class="flex flex-wrap w-full mb-8">

                     <li class="flex-grow bg-gradient-to-t from-gray-200 to-transparent !p-4">
                        <?php esc_html_e('Order number:', 'woocommerce'); ?>
                        <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                 ?></strong>
                     </li>

                     <li class="flex-grow bg-gradient-to-t from-gray-200 to-transparent !p-4">
                        <?php esc_html_e('Date:', 'woocommerce'); ?>
                        <strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                 ?></strong>
                     </li>

                     <?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
                        <li class="flex-grow bg-gradient-to-t from-gray-200 to-transparent !p-4">
                           <?php esc_html_e('Email:', 'woocommerce'); ?>
                           <strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    ?></strong>
                        </li>
                     <?php endif; ?>

                  </ul>

               <?php endif; ?>

               <?php //do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id());
               ?>
               <?php //do_action('woocommerce_thankyou', $order->get_id());
               ?>

               <div class="order-details">
                  <h2 class="text-left mb-4 text-lg font-medium"><?php _e('Order Details', 'woocommercecho e') ?></h2>
                  <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

                     <tbody>
                        <?php
                        foreach ($order->get_items() as $item_id => $item)
                        {
                           $product = $item->get_product();
                           $product_name = $product->get_name();
                           $product_total = $order->get_formatted_line_subtotal($item);
                        ?>
                           <tr class="woocommerce-table__line-item order_item">
                              <td class="woocommerce-table__product-name product-name"><?php echo $product_name ?></td>
                              <td class="woocommerce-table__product-table product-total"><?php echo $product_total ?></td>
                           </tr>
                        <?php
                        }
                        ?>
                        <tr class="woocommerce-table__line-item order_item">
                           <td class="woocommerce-table__product-name product-name"><?php _e('Shipping', 'woocommerce') ?></td>
                           <td class="woocommerce-table__product-table product-total font-light text-xs"><strong class="font-bold text-base"><?php echo get_woocommerce_currency_symbol($order->get_currency()) . ' ' . $order->get_shipping_total(); ?></strong> by <?php echo $order->get_shipping_method() ?></td>
                        </tr>

                        <tr class="woocommerce-table__line-item order_item">
                           <td class="woocommerce-table__product-name product-name"><?php _e('Payment method', 'woocommerce') ?></td>
                           <td class="woocommerce-table__product-table product-total">
                              <strong><?php echo $order->get_payment_method_title(); ?></strong>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            <?php else : ?>

               <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                                                                               ?></p>

            <?php endif; ?>
         </div>
         <div class="order-totals">
            <div><strong><?php esc_html_e('Total:', 'woocommerce'); ?></strong></div>
            <div> <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                           ?></strong></div>
         </div>
      </div>
      <div class="delivery-details">
         <h2 class="mb-4 text-lg font-bold">Delivery Details</h2>
         <p class="mb-2">Thank you for choosing our store! We hope you love your new products. Here are the details of your delivery:
         </p>
         <?php
         $shipping_address = $order->get_address('shipping');
         $shipping_method = $order->get_shipping_method();
         $shipping_address_data = array();

         foreach ($shipping_address as $key => $value)
         {
            if (!empty($value))
            {
               $shipping_address_data[] = $value;
            }
         }
         // $shipping_address_data = array_slice($shipping_address_data, 2);
         ?>

         <ul class="mt-4">
            <li><strong>Shipping Address:</strong> <?php echo implode(', ', $shipping_address_data) ?></li>
            <li><strong>Delivery Method:</strong> <?php echo $shipping_method; ?></li>
         </ul>
      </div>
      <a href="/" class="back-to-shop mt-12">Back to Shop</a>
   </div>
</div>
