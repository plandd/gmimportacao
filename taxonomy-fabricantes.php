<?php 
$obj = get_queried_object();
$args = array( 
  'posts_per_page' => -1,
  'post_type' => 'produtos',
  'status' => 'publish',
  'tax_query' => array(
    array(
      'taxonomy' => $obj->taxonomy,
      'field' => 'slug',
      'terms' => $obj->slug
    )
  )
);
$posts = get_posts( $args );
$total = count($posts);

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

          <div class="divide-30"></div>

          <section id="content" class="small-16 columns">
            <header class="divide-20">
              <p class="font-small breadcrumb no-margin">
                Você está em: <?php the_breadcrumb(); ?>
                <span class="right ghost"><?php echo $total; ?> resultados encontrados</span>
              </p>
            </header>

            <nav id="list-products" class="small-16 columns">
              <ul class="small-block-grid-5">
                <?php
                  $i = 0;
                  foreach ($posts as $post): setup_postdata( $post );
                    $i++; if(16 == $i) break;
                    global $post;
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'produtos.lista');
                    $th = (!empty($thumb[0])) ? $thumb[0] : get_stylesheet_directory_uri() . '/images/imagem_padrao.jpg';
                ?>
                <li>
                  <figure>
                    <?php product_promo($post->ID); ?>
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
            <p class="small-16 columns text-center">
              <a href="#" title="Carregar mais produtos" class="button-ghost round req-posts" data-term="<?php echo $obj->term_id; ?>" data-total="15" data-tax="<?php echo $obj->taxonomy; ?>" <?php if(isset($term->slug)) echo 'data-brand="'. $term->slug .'"'; ?> >Carregar mais produtos</a>
            </p>
          </section>
          
        </div><!-- //coluna direita -->

<?php get_footer(); ?>