<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts()
{
   wp_enqueue_style(
      'hello-elementor-child-style',
      get_stylesheet_directory_uri() . '/style.css',
      [
         'hello-elementor-theme-style',
      ],
      '1.0.0'
   );

   wp_enqueue_style(
      'maincss',
      get_stylesheet_directory_uri() . '/assets/css/main.css',
      [],
      '1.0',
   );

   wp_enqueue_style(
      'custom_woo',
      get_stylesheet_directory_uri() . '/assets/css/custom_woo.css',
      [],
      '1.0',
   );


   wp_enqueue_style('select2css', "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css");
   wp_enqueue_script('select2js', "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js");
   wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com');
   wp_enqueue_script('tailwindconfig', get_stylesheet_directory_uri() . '/assets/lib/tailwindconfig.js');
   wp_enqueue_script('alpinejs', "https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js#defer");
}

add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

/**
 * Remove the payment section from the WooCommerce checkout page after the order review.
 */
add_action('woocommerce_checkout_before_order_review_heading', 'remove_payment_section_on_checkout');
function remove_payment_section_on_checkout()
{
   // Remove the payment section from the checkout page.
   remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
}

add_filter('woocommerce_checkout_fields', 'remove_billing_email_field');

function remove_billing_email_field($fields)
{
   unset($fields['billing']['billing_email']);
   unset($fields['billing']['billing_company']);
   return $fields;
}

function adicionar_atributos_billing_fields($args, $key, $value)
{
   if (strpos($key, 'billing_') === 0)
   {
      $args['custom_attributes'] = array_merge($args['custom_attributes'], ['x-model' => $key]);
   }
   return $args;
}
add_filter('woocommerce_form_field_args', 'adicionar_atributos_billing_fields', 10, 3);

// add_filter('woocommerce_order_shipping_to_display_shipped_via', '__return_empty_string');
// remove_action( 'woocommerce_cart_totals', 'woocommerce_cart_totals_shipping', 10 );
// add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals_shipping', 20 );
function custom_cart_item_name($item_name, $cart_item, $cart_item_key)
{

   $product = $cart_item['data'];
   $item_name = $product->get_name();

   // Remove o nome da variação do item_name
   if ($product->is_type('variation'))
   {
      $variation_attributes = $product->get_variation_attributes();
      foreach ($variation_attributes as $attr)
      {
         foreach ($variation_attributes as $attr)
         {
            $item_name = str_replace($attr, '', $item_name);
         }
      }
      $item_name = str_replace(" -", "", rtrim($item_name));
      $variation_text = wc_get_formatted_variation($variation_attributes, true);

      $item_name .= '<small class="variation-info uppercase mt-2 mb-0 block">' . str_replace('size', '<b class="!text-xs font-bold">SIZE</b>', str_replace(':', '', $variation_text)) . '</small>';
   }

   return $item_name;
}
add_filter('woocommerce_cart_item_name', 'custom_cart_item_name', 10, 3);

function force_select2_on_checkout($checkout_fields)
{
   // Adicione a classe CSS "woocommerce-select2" ao campo de seleção de país
   $checkout_fields['billing']['billing_country']['class'][] = 'woocommerce-select2';
   return $checkout_fields;
}
add_filter('woocommerce_checkout_fields', 'force_select2_on_checkout');
