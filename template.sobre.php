<?php 
/**
  * Template Name: Sobre
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
      <div class="small-10 left">
        <header class="divide-20 column page-header">
          <h4 class="text-up ghost"><?php the_title(); ?></h4>
        </header>
        
        <div class="small-16 columns">
          <div class="divide-30 the-page-content">
          <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post();
              the_content();
            endwhile; endif;
          ?>
          </div>
        </div>
      </div>

      <div class="small-3 left">
      <?php
        global $plandd_option;
        //include_once get_stylesheet_directory_uri() . "/includes/components/reconhecimentos.php";
        if(isset($plandd_option['list-winners'])):
      ?>
      <section id="testimonials" class="small-16 columns">
        <header class="divide-20 column page-header">
          <h4 class="text-up ghost">Reconhecimentos</h4>
        </header>

        <nav id="nav-testimonials-side" class="small-16 left">
          <?php
            $winners = $plandd_option['list-winners'];
            shuffle($winners);
            foreach ($winners as $win):
          ?>
          <figure class="small-16 left item">
            <a href="<?php echo $win['image']; ?>" data-lightbox="testimonials" class="d-block divide-10">
              <?php echo wp_get_attachment_image( $win['attachment_id'], 'slider.reconhecimentos' ); ?>
            </a>
            <figcaption class="small-16 left">
              <p class="font-small no-margin"><?php echo $win['description']; ?>.</p>
            </figcaption>
          </figure>
          <?php endforeach; ?>
        </nav>
      </section>
      <?php endif; ?>
      </div>

<?php get_footer(); ?>