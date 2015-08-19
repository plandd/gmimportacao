<?php 
/**
  * Template Name: FAQ
  * @package WordPress
  */
get_header(); 
?>
  <section id="single-content" class="small-16 left">
    <div class="row">
      <?php
        //Menu  
        get_sidebar();
      ?>
      <!-- coluna direita -->
      <div class="small-13 left">
        <header class="divide-20 column page-header">
          <h4 class="text-up ghost"><?php the_title(); ?></h4>
        </header>
        
        <div class="small-16 columns">
          <div class="divide-30">
          <nav class="small-16 columns faq-list">
              <ul class="no-bullet small-16 left">
                <?php
                  if(isset($plandd_option['list-faq'])):
                    foreach ($plandd_option['list-faq'] as $faq):
                ?>
                <li>
                  <span class="divide-10">
                    <i class="icon-icon_up_2 primary left"></i>
                    <i class="icon-icon_down_2 primary left"></i>
                    <strong><?php echo $faq['title']; ?></strong>
                  </span>
                  <div class="small-16 left">
                    <p class="divide-10"><?php echo $faq['description']; ?></p>
                  </div>
                </li>
                <?php endforeach; endif; ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>

<?php get_footer(); ?>