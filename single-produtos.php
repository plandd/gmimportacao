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
            <header class="divide-20">
              <p class="font-small breadcrumb no-margin">
                Você está em: <?php the_breadcrumb(); ?>
              </p>
            </header>

            <article class="divide-40">
              
              <figure class="small-7 left">
                <?php
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
                $th = (!empty($thumb[0])) ? $thumb[0] : get_stylesheet_directory_uri() . '/images/imagem_padrao.jpg';
                ?>
                <img src="<?php echo $th; ?>" alt="" class="small-16 left">
              </figure>

              <div class="small-9 left pd-left-20 font-normal">
                <header class="divide-20 post-header">
                  <h5 class="font-regular no-margin"><?php the_title(); ?></h5>
                </header>
                <p><strong>Código do produto: </strong><?php echo $post->ID; ?></p>
                <?php
                  $custom_fields = get_post_custom($post->ID);
                  if(null != $custom_fields['produto_ref'][0])
                    printf('<p><strong>Referência do produto: </strong>%s</p>',$custom_fields['produto_ref'][0]);
                  echo "<p><strong>Fabricante</strong>: {$terms[0]->name}</p>";

                  if(null != $custom_fields['produto_descricao'][0])
                    printf('<p class="divide-30">%s</p>',$custom_fields['produto_descricao'][0]);

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

            </article>

          </section>
          
        </div><!-- //coluna direita -->

<?php get_footer(); ?>