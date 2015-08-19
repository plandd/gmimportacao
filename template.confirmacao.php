<?php 
/**
  * Template Name: Confirmação
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
          <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post();
              the_content();
            endwhile; endif;
          ?>
          </div>
        </div>
      </div>

      <script>
        jQuery(document).ready(function($) {
          function reload() {
            window.location.href = '<?php echo home_url(); ?>';
          };

          setTimeout(reload,3000);
        });
      </script>

<?php get_footer(); ?>