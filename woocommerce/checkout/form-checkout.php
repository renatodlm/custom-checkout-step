<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH'))
{
   exit;
}

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in())
{
   echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
   return;
}
?>
<form id="checkout-form" name="checkout" method="post" class="!p-0 !m-0 checkout woocommerce-checkout mt-8 lg:px-4" x-data="checkoutForm" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
   <div class="grid lg:grid-cols-12 gap-[4rem] custom-form-checkout">

      <div class="col-span-1 lg:col-span-8 p-4 lg:p-12">
         <div class="my-8">
            <div class="max-w-[9.375rem] mb-8">
               <?php echo get_custom_logo() ?>
            </div>
            <h1 class="text-[2.5rem] font-medium ml-4">Checkout</h1>
         </div>
         <div class="flex flex-col justify-center max-w-[60rem] mr-auto my-16 space-y-10 max-w-full">
            <div class="pb-2 flex justify-between items-center">
               <span class="flex items-center gap-4"><span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm bg-gray-300" :class="{'bg-green-500': step1completed, 'bg-gray-300': !step1completed }">
                     <svg class="hidden" :class="{'block': step1completed, 'hidden': !step1completed }" width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 6.5L6.5 11.5L16.5 1.5" stroke="#fff" stroke-width="2"></path>
                     </svg>
                     <span x-text="step1completed ? '' : '1'">1</span>
                  </span>Contact information</span>
               <a @click="setStep(1)" class="text-green-500 font-light !underline hidden cursor-pointer" :class="{'block': step1completed, 'hidden': !step1completed }">Edit</a>
            </div>
            <div class="w-full" x-show="currentStep === 1">
               <div class="flex flex-col space-y-4">
                  <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110">
                     <label for="billing_email" class="">Email address&nbsp;
                        <abbr class="required" title="required">*</abbr></label>
                     <span class="woocommerce-input-wrapper">
                        <input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" autocomplete="email" x-model="billing_email">
                     </span>
                  </p>
                  <div class="form-group custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input" id="billing_emailsignup" name="billing_emailsignup" value="true" checked="">
                     <label for="billing_emailsignup">
                        Stay up to date with exclusive offers and news. Unsubscribe anytime.
                     </label>
                  </div>
               </div>

               <div class="flex justify-end mt-6">
                  <div class="flex flex-col gap-2 justify-end">
                     <button type="button" class="border-none rounded-[0.1875rem] px-4 py-2 bg-green-500 min-w-[18.75rem] text-white font-medium tracking-wide rounded-lg hover:bg-green-400" x-on:click="nextStep()">
                        Continue to shipping
                     </button>
                     <p class="text-xs font-light max-w-[18.75rem]">By clicking continue you agree to Hiberis's <a href="<?php echo get_home_url() . '\/shipping-policy/' ?>" target="_blank">Shipping policy</a> and <a href="<?php echo get_home_url() . '\/privace-policy/' ?>" target="_blank">privacy policy</a>.</p>
                  </div>
               </div>
            </div>
            <ul class="px-12 py-4 !mt-0" x-show="step1completed && currentStep !== 1">
               <li class="text-sm font-light" x-text="billing_email" :class="{'hidden' : billing_email.length === 0}"></li>
            </ul>

            <div class="pb-2 flex justify-between items-center">
               <span class="flex items-center gap-4"><span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm bg-gray-300" :class="{'bg-green-500': step2completed, 'bg-gray-300': !step2completed }">
                     <svg class="hidden" :class="{'block': step2completed, 'hidden': !step2completed }" width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 6.5L6.5 11.5L16.5 1.5" stroke="#fff" stroke-width="2"></path>
                     </svg>
                     <span x-text="step2completed ? '' : '2'">2</span>
                  </span>Shipping</span>
               <a @click="setStep(2)" class="text-green-500 font-light !underline hidden cursor-pointer" :class="{'block': step2completed, 'hidden': !step2completed }">Edit</a>
            </div>

            <div class="w-full" x-show="currentStep === 2">
               <div class="flex flex-col space-y-4">
                  <?php do_action('woocommerce_checkout_billing'); ?>
               </div>

               <div class="flex justify-end mt-6">
                  <button type="button" class="border-none rounded-[0.1875rem] ml-2 px-4 py-2 bg-green-500 min-w-[18.75rem] text-white font-medium tracking-wide rounded-lg hover:bg-green-400" x-on:click="nextStep()">
                     Next: Payment
                  </button>
               </div>
               <?php ?>

               <?php ?>

            </div>

            <ul class="px-12 py-4 !mt-0 grid grid-cols-1 gap-1" x-show="step2completed && currentStep !== 2">
               <li class="col-span-1 text-sm font-light" x-text="billing_first_name" :class="{'hidden' : billing_first_name.length === 0}"></li>
               <li class="col-span-1 text-sm font-light" x-text="billing_last_name" :class="{'hidden' : billing_last_name.length === 0}"></li>
               <li class="col-span-1 text-sm font-light" x-text="billing_address_1" :class="{'hidden' : billing_address_1.length === 0}"></li>
               <li class="col-span-1 text-sm font-light" x-text="billing_address_2" :class="{'hidden' : billing_address_2.length === 0}"></li>
               <li class="col-span-1 text-sm font-light" x-text="billing_city" :class="{'hidden' : billing_city.length === 0}"></li>
               <li class="col-span-1 text-sm font-light flex gap-3">
                  <span x-text="billing_country" :class="{'hidden' : billing_country.length === 0}"></span>
                  <span x-text="billing_state" :class="{'hidden' : billing_state.length === 0}"></span>
                  <span x-text="billing_postcode" :class="{'hidden' : billing_postcode.length === 0}"></span>
               </li>
               <li class="col-span-1 text-sm font-light" x-text="billing_phone" :class="{'hidden' : billing_phone.length === 0}"></li>
            </ul>

            <div class="pb-2 flex justify-between items-center">
               <span class="flex items-center gap-4"><span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm bg-gray-300" :class="{'bg-green-500': step3completed, 'bg-gray-300': !step3completed }">
                     <svg class="hidden" :class="{'block': step3completed, 'hidden': !step3completed }" width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 6.5L6.5 11.5L16.5 1.5" stroke="#fff" stroke-width="2"></path>
                     </svg>
                     <span x-text="step3completed ? '' : '3'">3</span>
                  </span>Payment</span>
            </div>
            <div class="w-full" x-show="currentStep === 3">
               <div class="flex flex-col space-y-4">
                  <?php woocommerce_checkout_payment(); ?>
               </div>

            </div>
         </div>
      </div>
      <div class="col-span-1 lg:col-span-4 bg-gray-100">
         <div class="h-full">
            <div class="p-4 lg:p-12">
               <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

               <h3 id="order_review_heading" class="text-xl font-bold"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

               <?php do_action('woocommerce_checkout_before_order_review'); ?>

               <div id="order_review" class="woocommerce-checkout-review-order">
                  <?php do_action('woocommerce_checkout_order_review'); ?>
               </div>
               <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </div>
            <div class="bg-gradient-to-b from-gray-200 to-transparent p-4 lg:p-12">
               <h2 class="text-base font-semibold mb-8 text-center">The Luxury Mattress You Have Been Dreaming About It.</h2>
               <div class="grid grid-cols-2 text-green-500 text-center gap-4">
                  <div class="col-span-1">
                     <svg class="w-8 h-8 mb-4 mx-auto" fill="#007b6f" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"></path>
                     </svg>
                     <h4 class="text-xs font-light">Orthopedic Therapeutic</h4>
                  </div>
                  <div class="col-span-1">
                     <svg class="w-8 h-8 mb-4 mx-auto" fill="#007b6f" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M11.38 2.019a7.5 7.5 0 1 0 10.6 10.6C21.662 17.854 17.316 22 12.001 22 6.477 22 2 17.523 2 12c0-5.315 4.146-9.661 9.38-9.981z"></path>
                     </svg>
                     <h4 class="text-xs font-light">100-Nights Risk-Free Trial</h4>
                  </div>

                  <div class="col-span-1">
                     <svg class="w-8 h-8 mb-4 mx-auto" fill="#007b6f" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M5 4.604v9.185a4 4 0 0 0 1.781 3.328L12 20.597l5.219-3.48A4 4 0 0 0 19 13.79V4.604L12 3.05 5 4.604zM3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM12 13.5l-2.939 1.545.561-3.272-2.377-2.318 3.286-.478L12 6l1.47 2.977 3.285.478-2.377 2.318.56 3.272L12 13.5z"></path>
                     </svg>
                     <h4 class="text-xs font-light">10-Years Limited Non-Prorated Warranty</h4>
                  </div>
                  <div class="col-span-1">
                     <svg class="w-8 h-8 mb-4 mx-auto" fill="#007b6f" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M17 8h3l3 4.056V18h-2.035a3.5 3.5 0 0 1-6.93 0h-5.07a3.5 3.5 0 0 1-6.93 0H1V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2zm0 2v3h4v-.285L18.992 10H17z"></path>
                     </svg>
                     <h4 class="text-xs font-light">Free Delivery</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
