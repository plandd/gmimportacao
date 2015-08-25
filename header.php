<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php bloginfo('name'); ?> | <?php is_home()?bloginfo('description'):wp_title(''); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" type="image/vnd.microsoft.icon"/>
    <link rel="icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" type="image/x-ico"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,900,400italic,300,700,400' rel='stylesheet' type='text/css'>
    <script>
      //<![CDATA[
      var getData = {
        'urlDir':'<?php bloginfo('template_directory');?>/',
        'ajaxDir':'<?php echo stripslashes(get_admin_url()).'admin-ajax.php';?>',
        'apiKey' : '<?php echo get_option('jt_api_key');?>'
      }
      //]]>
    </script>
    <?php wp_head(); ?>
  </head>
  <body>
  <div id="teste" class="small-16 columns"></div>
    <?php global $plandd_option; ?>
    <div id="ajax-loader">
      <div class="d-table-cell small-16 text-center">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/primary_loader.gif" alt="" class="">
        <h6 class="msg">Aguarde...</h6>
      </div>
    </div>

    <div id="mo-adv" class="small-16 abs full-height"></div>
    
    <!-- cabeçalho -->
    <header id="header" class="small-16 left rel" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg-1.jpg);">
      <nav class="nav-top small-16 left">
        <div class="row rel">
          <div class="d-table small-16 columns">
            <div class="small-16 d-table-cell">
              <ul class="inline-list no-margin small-16 columns">
                <?php
                  if(!empty($plandd_option['inst-tel-sell']))
                    printf('<li><a href="tel:%s">Televendas: %s</a></li>',$plandd_option['inst-tel-sell'],$plandd_option['inst-tel-sell']);

                  $page = get_page_by_title('Fale conosco');
                  if(isset($page))
                    printf('<li><a href="%s" title="Atendimento">Atendimento</a></li>',get_page_link($page->ID));

                  $page = get_page_by_title('Solicitar cadastro');
                  if(isset($page))
                    printf('<li><a href="%s" title="Seja um revendedor GMI">Seja um revendedor GMI</a></li>',get_page_link($page->ID));
                ?>
              </ul>
            </div>
          </div>
          <!-- redes sociais -->
          <div class="social-top top abs">
            <?php
              if(!empty($plandd_option['inst-facebook']))
                printf('<h4><a href="%s" target="_blank" title="Siga-nos no Facebook" class="icon-icon_facebook"></a></h4>',$plandd_option['inst-facebook']);

               if(!empty($plandd_option['inst-twitter']))
                printf('<h4><a href="%s" target="_blank" title="Siga-nos no Twitter" class="icon-icon_twitter"></a></h4>',$plandd_option['inst-twitter']);

               if(!empty($plandd_option['inst-instagram']))
                printf('<h4><a href="%s" target="_blank" title="Siga-nos no Instagram" class="icon-icon_insta"></a></h4>',$plandd_option['inst-instagram']);
            ?>
          </div>
        </div>
      </nav>

      <div class="brand-section row">
        <figure class="logo small-4 columns d-table">
          <h1 class="no-margin">
            <a href="<?php echo home_url(); ?>" title="Página principal" class="left d-block"><img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="GM Importação"></a>
          </h1>
        </figure>
        <div class="small-10 columns d-table">
          <div class="small-16 d-table-cell">
            <!-- busca -->
            <form action="<?php echo home_url(); ?>" class="search-form small-8 left" method="get">
              <label for="s"><span class="icon-icon_busca icon-search ghost"></span></label>
              <label><input id="s" name="s" type="text" placeholder="Busca por marca, fabricante ou produto" title="Busca por marca, fabricante ou produto"></label>
              <input type="submit" value="Buscar" class="right button secondary text-up">
            </form>

            <?php
              if(!empty($plandd_option['week-offer']['url'])):
            ?>
            <!-- oferta da semana -->
            <h1 class="week-offer left rel">
              <a href="<?php echo $plandd_option['offer-link']; ?>" title="Oferta da semana" class="button no-margin">
                Oferta da semana
                <span class="icon-icon_down_3 secondary font-medium"></span>
              </a>

              <figure class="week-feature abs">
                  <a href="<?php echo $plandd_option['offer-link']; ?>"><img src="<?php echo $plandd_option['week-offer']['url']; ?>" alt=""></a>
              </figure>
            </h1>
            <?php endif; ?>
            
            <?php
              if ( is_user_logged_in() ):
                global $current_user;
                $page = get_page_by_title('Meu pedido');
                $cart = new PlanDD_Cart($post->ID,$current_user->ID);
            ?>
            <h1 class="shop-car right no-margin rel">
              <a href="<?php echo get_page_link($page->ID); ?>" title="Seu carrinho de pedidos" class="rel">
                <span class="icon-carshop icon-icon_carrinho  left"></span>
                <span class="icon-chevron-down icon-icon_down_2 left secondar"></span>
                <span class="qtd-cart bg-primary abs"><?php $cart->get_total_items_cart(); ?></span>
              </a>
              <div id="item-list-user">
                <?php echo $cart->list_items_cart(); ?>
              </div>
            </h1>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </header>

    <!-- menu principal -->
    <nav id="main-menu" class="small-16 left rel">
      <div class="row rel">
        
        <div class="small-3 columns rel main-items">
            <a href="#" title="Pesquisar por fabricantes" class="choose-search rel">
              <div class="small-16 left">
                <span>
                  <small>Pesquisar por</small>
                  <strong class="white">Fabricantes</strong>
                </span>
              </div>
              <span class="small-16 abs text-center">
                <i class="icon-icon_down_3"></i>
              </span>
            </a>

            <a href="#" title="Pesquisar por fabricantes" class="choose-search rel">
              <div class="small-16 left">
                <span>
                  <small class="gohst">Pesquisar por</small>
                  <strong class="white">Grupos</strong>
                </span>
              </div>
              <span class="small-16 abs text-center">
                <i class="icon-icon_down_3"></i>
              </span>
            </a>
        </div>

        <ul class="inline-list main-items left">
          <?php
            $defaults = array(
              'theme_location'  => 'main',
              'menu'            => 'Menu principal',
              'container'       => '',
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => '',
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'main_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '%3$s',
              'depth'           => 0,
              'walker'          => '',
            );
            wp_nav_menu($defaults);
          ?>
        </ul>
        
        <?php
          if ( !is_user_logged_in() ):
        ?>
        <ul class="inline-list main-items right partner-login">
          
          <li>
            <a href="#" title="Área do parceiro"><span class="icon-icon_perfil rel"></span> Área do parceiro</a>
            <div class="bg-white partner-form abs">
              <header class="divide-20">
                <h6 class="ghost no-margin font-lite">Faça seu login e para ter acesso aos seus dados</h6>
              </header>
              <form class="small-16 left" id="login-form">
                <p><input type="text" name="cnpj" placeholder="CNPJ" class="small-16 left"></p>
                <p><input type="password" name="senha" placeholder="SENHA" class="small-16 left"></p>
                <p><button type="submit" class="text-up small-16 no-margin font-normal" title="Fazer login">Fazer login</button></p>
                <?php $page = get_page_by_title('Solicitar cadastro'); ?>
                <p><a href="<?php echo get_page_link($page->ID); ?>" style="color:white!important;" class="button thin shape text-up small-16 request-account secondary no-margin font-normal" title="Solicitar cadastro">Solicitar cadastro</a></p>
              </form>
            </div>
          </li>
        </ul>
        <?php
          else:
          $page = get_page_by_title('Minha conta');
        ?>
        <ul class="inline-list main-items right user-options">
          <li><a href="<?php echo get_page_link( $page->ID , false, true ); ?>"><span class="icon-icon_menu left primary"></span> Minha conta</a></li>
          <li><a href="<?php echo wp_logout_url( home_url() ); ?>" class="left"><span class="icon-icon_sair left primary"></span> Sair</a></li>
        </ul>
        <?php
          endif;
        ?>
      </div>
    </nav>