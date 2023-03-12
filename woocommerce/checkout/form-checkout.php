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

<div class="grid grid-cols-12">

   <div class="col-span-8">
      <form id="checkout-form" name="checkout" method="post" class="checkout woocommerce-checkout mt-8" x-data="checkoutForm" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
         <div class="flex flex-col justify-center max-w-md mx-auto my-16 space-y-10">
            <div class="border-b-2 border-green-500 pb-2" :class="{'border-green-500': currentStep === 1, 'border-gray-200': currentStep !== 1  }">
               <span>1. Email de Contato</span>
            </div>



            <div class="w-full" x-show="currentStep === 1">
               <div class="flex flex-col space-y-4">
                  <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110">
                     <label for="billing_email" class="">Email address&nbsp;
                        <abbr class="required" title="required">*</abbr></label>
                     <span class="woocommerce-input-wrapper">
                        <input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="gustavo.santos1601@outlook.com" autocomplete="email username">
                     </span>
                  </p>
               </div>

               <div class="flex justify-end mt-6">
                  <button type="button" class="bg-gray-500 px-4 py-2 text-gray-500 font-semibold tracking-wide">
                     Cancelar
                  </button>
                  <button type="button" class="ml-2 px-4 py-2 bg-green-500 text-white font-semibold tracking-wide rounded-lg hover:bg-green-400" x-on:click="nextStep()">
                     Continuar
                  </button>
               </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-2" :class="{'border-green-500': currentStep === 2, 'border-gray-200': currentStep !== 2  }">
               <span>2. Dados de Entrega</span>
            </div>
            <div class="w-full" x-show="currentStep === 2">
               <div class="flex flex-col space-y-4">
                  <?php do_action('woocommerce_checkout_billing'); ?>
               </div>

               <div class="flex justify-between mt-6">
                  <button type="button" class="bg-gray-500 px-4 py-2 text-gray-500 font-semibold tracking-wide" x-on:click="prevStep()">
                     Voltar
                  </button>
                  <button type="button" class="ml-2 px-4 py-2 bg-green-500 text-white font-semibold tracking-wide rounded-lg hover:bg-green-400" x-on:click="nextStep()">
                     Continuar
                  </button>
               </div>
            </div>
            <div class="border-b-2 border-gray-200 pb-2" :class="{'border-green-500': currentStep === 3, 'border-gray-200': currentStep !== 3  }">
               <span>3. Pagamento</span>
            </div>
            <div class="w-full" x-show="currentStep === 3">
               <div class="flex flex-col space-y-4">
                  <?php woocommerce_checkout_payment(); ?>
               </div>

               <div class="flex justify-between mt-6">
                  <button type="button" class="bg-gray-500 px-4 py-2 text-gray-500 font-semibold tracking-wide" x-on:click="prevStep()">
                     Voltar
                  </button>
                  <button type="submit" class="ml-2 px-4 py-2 bg-green-500 text-white font-semibold tracking-wide rounded-lg hover:bg-green-400">
                     Finalizar Pedido
                  </button>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="col-span-4">
      <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

      <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

      <?php do_action('woocommerce_checkout_before_order_review'); ?>

      <div id="order_review" class="woocommerce-checkout-review-order">
         <?php do_action('woocommerce_checkout_order_review'); ?>
      </div>
      <?php do_action('woocommerce_checkout_after_order_review'); ?>
   </div>
</div>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
