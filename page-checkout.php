<?php

if (!defined('ABSPATH'))
   exit; // Exit if accessed directly.

get_header('blank');

while (have_posts()) :
   the_post();
?>

   <main id="content" role="main">
      <div class="page-content">
         <?php the_content(); ?>
      </div>
   </main>
<?php
endwhile;
?>

<div class="bg-green-500 h-[12.375rem] py-8 px-12 flex flex-col justify-center">
   <div class="text-white">
      <h3 class="text-2xl font-font-medium mb-4 !text-white">Need help checking out?</h3>
      <div class="elementor-widget-container">
         <ul class="elementor-icon-list-items">
            <li class="elementor-icon-list-item">
               <span class="elementor-icon-list-icon">
                  <i aria-hidden="true" class="fas fa-phone-alt"></i> </span>
               <span class="elementor-icon-list-text">+1 (833) 444-2374</span>
            </li>
            <li class="elementor-icon-list-item">
               <span class="elementor-icon-list-icon">
                  <i aria-hidden="true" class="far fa-envelope"></i> </span>
               <span class="elementor-icon-list-text">support@hiberis.com</span>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="bg-gray-400 px-[4rem]">
   <div class="elementor-widget-container text-white text-center px-12">
      2023 © Hiberis. All Rights Reserved. Developed by <a href="https://3ww.com.br" target="_blank" rel="noopener" class="link-footer">3ww – Digital Solutions</a> </div>
</div>

<?php

get_footer('blank');
