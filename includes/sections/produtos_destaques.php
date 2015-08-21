<section id="popular-products" class="small-16 columns section-block">
  <header class="section-header small-16 left">
    <h4 class="text-up no-margin ghost left">Confira nossos produtos</h4>
  </header>
  
  <nav id="list-products" class="small-16 columns">
    <ul class="small-block-grid-5">
      <?php
        $args = array( 'posts_per_page' => 15, 'post_type' => 'produtos', 'orderby' => 'rand' );
        $planos = get_posts( $args );
        foreach ($planos as $post): setup_postdata( $post );
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
</section>