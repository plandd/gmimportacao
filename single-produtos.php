<?php 
$obj = get_queried_object();
global $post;
$terms = wp_get_post_terms( $post->ID, 'fabricantes');
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
            <div class="divide-20"></div>
            <header class="divide-20">
              <p class="font-small breadcrumb no-margin">
                Você está em: <?php the_breadcrumb(); ?>
              </p>
            </header>

            <article class="divide-40">
              
              <figure class="small-7 left">
                <?php
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                $th = (!empty($thumb[0])) ? $thumb[0] : get_stylesheet_directory_uri() . '/images/imagem_padrao.jpg';
                ?>
                <img src="<?php echo $th; ?>" alt="" class="small-16 left">
              </figure>

              <div class="small-9 left pd-left-20 font-normal">
                <header class="divide-20 post-header">
                  <h5 class="font-regular no-margin"><?php the_title(); ?></h5>
                </header>
                <?php
                  $custom_fields = get_post_custom($post->ID);
                  
                  if(null != $custom_fields['produto_codigo'][0])
                    printf('<p><strong>Código: </strong>%s</p>',$custom_fields['produto_codigo'][0]);

                  if(null != $custom_fields['produto_ref'][0])
                    printf('<p><strong>Referência do produto: </strong>%s</p>',$custom_fields['produto_ref'][0]);

                  echo "<p><strong>Fabricante</strong>: {$terms[0]->name}</p>";

                  if(null != $custom_fields['produto_descricao'][0])
                    echo get_field('produto_descricao',$post->ID);

                  if ( is_user_logged_in() ) {
                    global $current_user;
                    $cart = new PlanDD_Cart($post->ID,$current_user->ID);
                    $cart->show_controls_qtd();
                  }
                ?>
              </div>
              <div class="divide-30"></div>

              <header class="divide-20 post-header">
                <p class="primary font-regular no-margin"><strong>Especificações técnicas</strong></p>
              </header>

              <nav class="divide-30">
                <ul class="small-16 left">
                  <?php
                    $especs = get_field('produto_espcs',$post->ID);
                    if($especs) {
                      foreach ($especs as $esp) {
                        printf('<li>%s</li>',$esp['produto_espc']);
                      }
                    }
                  ?>
                </ul>
              </nav>

              <header class="divide-20 page-header">
                <h4 class="text-up ghost">Produtos relacionados</h4>
              </header>

              <nav id="list-products" class="small-16 columns">
                <ul class="small-block-grid-5">
                <?php
                  $args = array( 'posts_per_page' => 5, 'post_type' => 'produtos', 'taxonomy' => $obj->taxonomy, 'orderby' => 'rand' );
                  $planos = get_posts( $args );
                  foreach ($planos as $post): setup_postdata( $post );
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
                        <p class="no-margin small-16 left text-center"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                      </figcaption>
                    </figure>
                  </li>
                <?php endforeach; ?>
                </ul>
              </nav>

            </article>

          </section>
          
        </div><!-- //coluna direita -->

<?php get_footer(); ?>