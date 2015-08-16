<!-- ultimas noticias -->
<section id="last-blog" class="small-16 columns section-block no-margin">
  <div class="small-16 columns">
    <header class="section-header small-16 left">
      <h4 class="text-up no-margin ghost left">Últimas notícias</h4>
      <?php
        $cat = get_cat_ID('Notícias');
      ?>
      <a href="<?php echo esc_url( get_category_link($cat) ); ?>" class="right font-small white more-news" title="ver mais notícias">ver mais notícias</a>
    </header>

    <nav id="nav-blog-last" class="small-16 columns">
      <ul class="small-block-grid-4">
        <?php
          $args = array( 'posts_per_page' => 4, 'orderby' => 'date' );
          $posts = get_posts( $args );
          foreach ($posts as $post): setup_postdata( $post );
            global $post;
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'noticias.recentes');
            $th = (isset($thumb)) ? $thumb[0] : '';
        ?>
        <li>
          <figure class="small-16 left">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="d-block divide-10">
              <img src="<?php echo $th; ?>" alt="">
            </a>
            <figcaption class="small-16 left">
              <h5 class="divide-10"><a href="<?php the_permalink(); ?>" class="secondary" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
              <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">> leia mais</a></p>
            </figcaption>
          </figure>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</section>