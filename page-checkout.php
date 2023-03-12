<?php

if (!defined('ABSPATH'))
   exit; // Exit if accessed directly.

get_header('blank');

while (have_posts()) :
   the_post();
?>

   <main id="content" class="px-[4rem]" role="main">
      <?php if (apply_filters('hello_elementor_page_title', true)) : ?>
         <header class="page-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
         </header>
      <?php endif; ?>
      <div class="page-content">
         <?php the_content(); ?>
         <div class="post-tags">
            <?php the_tags('<span class="tag-links">' . __('Tagged ', 'hello-elementor'), null, '</span>'); ?>
         </div>
         <?php wp_link_pages(); ?>
      </div>

      <?php comments_template(); ?>
   </main>

   <?/*

   <div x-data="checkoutForm">
      <div class="mb-8" x-init="console.log(currentStep)">
         <h2 class="text-lg font-medium mb-2">Etapa {{ currentStep }}: {{ stepTitle }}</h2>
         <div class="h-2 bg-gray-300 rounded"></div>
      </div>

      <!-- Step 1: E-mail -->
      <div x-show="currentStep === 1">
         <form id="step1-form">
            <div class="mb-4">
               <label for="billing_email" class="block text-gray-700 font-medium mb-2">Endereço de E-mail</label>
               <input type="email" name="billing_email" id="billing_email" class="form-input w-full" required>
            </div>
            <button type="button" class="btn-primary" x-on:click="nextStep()">Próximo</button>
         </form>
      </div>

      <!-- Step 2: Dados de entrega -->
      <div x-show="currentStep === 2">
         <form id="step2-form">
            <div class="mb-4">
               <label for="billing_first_name" class="block text-gray-700 font-medium mb-2">Primeiro nome</label>
               <input type="text" name="billing_first_name" id="billing_first_name" class="form-input w-full" required>
            </div>
            <div class="mb-4">
               <label for="billing_last_name" class="block text-gray-700 font-medium mb-2">Último nome</label>
               <input type="text" name="billing_last_name" id="billing_last_name" class="form-input w-full" required>
            </div>
            <button type="button" class="btn-secondary mr-2" x-on:click="prevStep()">Voltar</button>
            <button type="button" class="btn-primary" x-on:click="nextStep()">Próximo</button>
         </form>
      </div>

      <!-- Step 3: Pagamento -->
      <div x-show="currentStep === 3">
         <form id="step3-form">
            <div class="mb-4">
               <label for="card_number" class="block text-gray-700 font-medium mb-2">Número do Cartão de Crédito</label>
               <input type="text" name="card_number" id="card_number" class="form-input w-full" required>
            </div>
            <div class="mb-4">
               <label for="expiration_date" class="block text-gray-700 font-medium mb-2">Data de Validade</label>
               <input type="text" name="expiration_date" id="expiration_date" class="form-input w-full" required>
            </div>
            <button type="button" class="btn-secondary mr-2" x-on:click="prevStep()">Voltar</button>
            <button type="submit" class="btn-primary">Enviar</button>
         </form>
      </div>
   </div>

*/ ?>

<?php
endwhile;

get_footer('blank');
