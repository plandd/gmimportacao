<?php 
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
          <div class="divide-30 the-page-content">
          <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post();
              the_content();
            endwhile; endif;
            //$file = file_get_contents('http://67.23.244.7/~gmimportadmin/wp-content/uploads/2015/08/CONSULTA-PRODUTO-SITE-2.csv');
            //var_dump(htmlentities($file));
          ?>
          </div>
        </div>
      </div>

<?php get_footer(); ?>