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


//add_filter('woocommerce_form_field_args', 'add_custom_css_class_to_fields', 10, 3);

function add_custom_css_class_to_fields($args, $key, $value)
{

   if ($key === 'billing_state')
   {
      $args['class'] = [];
      $args['class'][] = 'form-row-first';
      $args['class'][] = 'address-field';
   }

   if ($key === 'billing_postcode')
   {
      $args['class'] = [];
      $args['class'][] = 'form-row-last';
      $args['class'][] = 'address-field';
   }

   return $args;
}
