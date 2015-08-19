<?php 
//var_dump($obj);
get_header();
?>

    <section id="home-content" class="small-16 left">
      <div class="row">
        
        <?php
          //Menu  
          get_sidebar();
        ?>
        
        <!-- coluna direita -->
        <div class="small-13 left">

          <section id="content" class="small-16 columns">
            <header class="divide-20">
              <p class="font-small breadcrumb no-margin">
                Você está em: <?php the_breadcrumb(); ?>
              </p>
            </header>

            <nav id="list-products" class="small-16 columns">
              <ul class="small-block-grid-5">
                <?php
                  if ( have_posts() ) : while ( have_posts() ) : the_post();
                    global $post;
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'produtos.lista');
                    $th = (!empty($thumb[0])) ? $thumb[0] : get_stylesheet_directory_uri() . '/images/imagem_padrao.jpg';
                ?>
                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="product-thumb d-iblock small-16 left"><img src="<?php echo $th; ?>" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>Gabinete GMI V4"><?php the_title(); ?></a></h2>
                      <p class="no-margin small-16 left text-center"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button secondary round font-small text-up no-margin">Leia mais</a></p>
                    </figcaption>
                  </figure>
                </li>
                <?php  endwhile; endif; ?>
              </ul>
            </nav>
            <!--<p class="small-16 columns text-center">
              <a href="#" title="Mais notícias" class="button-ghost round req-posts">Mais notícias</a>
            </p>-->
          </section>
          
        </div><!-- //coluna direita -->

<?php get_footer(); ?>