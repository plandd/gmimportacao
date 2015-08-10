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
    <div id="mo-adv" class="small-16 abs full-height"></div>
    <!-- cabeçalho -->
    <header id="header" class="small-16 left rel">
      <nav class="nav-top small-16 left">
        <div class="row rel">
          <div class="d-table small-16 columns">
            <div class="small-16 d-table-cell">
              <ul class="inline-list no-margin small-16 columns">
                <li><a href="tel:5583986616331">Televendas: ligue +55 (83) 3030-5454</a></li>
                <li><a href="#">Atendimento</a></li>
                <li><a href="#">Meus pedidos</a></li>
                <li><a href="#">Seja um revendedor GMI</a></li>
              </ul>
            </div>
          </div>
          <!-- redes sociais -->
          <div class="social-top top abs">
            <h4><a href="#" class="icon-icon_facebook"></a></h4>
            <h4><a href="#" class="icon-icon_twitter"></a></h4>
            <h4><a href="#" class="icon-icon_insta"></a></h4>
          </div>
        </div>
      </nav>

      <div class="brand-section row">
        <figure class="logo small-4 columns d-table">
          <h1 class="no-margin">
            <a href="#" title="Página principal" class="left d-block"><img src="images/logo.png" alt="GM Importação"></a>
          </h1>
        </figure>
        <div class="small-10 columns d-table">
          <div class="small-16 d-table-cell">
            <!-- busca -->
            <form action="" class="search-form small-8 left">
              <label for="s"><span class="icon-icon_busca icon-search ghost"></span></label>
              <label><input id="s" type="text" placeholder="Busca por marca, fabricante ou produto" title="Busca por marca, fabricante ou produto"></label>
              <input type="submit" value="Buscar" class="right button secondary text-up">
            </form>

            <!-- oferta da semana -->
            <h1 class="week-offer left rel">
              <a href="#" title="Oferta da semana" class="button no-margin">
                Oferta da semana
                <span class="icon-icon_down_3 secondary font-medium"></span>
              </a>

              <figure class="week-feature abs">
                  <a href="#"><img src="http://blog.batecabeca.com.br/wp-content/uploads/2013/03/banner-ofertas.jpg" alt=""></a>
              </figure>
            </h1>

            <!-- Carrinho de pedidos -->
            <h1 class="shop-car right no-margin rel">
              <a href="#" title="Seu carrinho de pedidos secondary" class="rel">
                <span class="icon-carshop icon-icon_carrinho  left"></span>
                <span class="icon-chevron-down icon-icon_down_2 left secondar"></span>
                <span class="qtd-cart bg-primary abs">0</span>
              </a>

              <nav class="items-cart abs">
                <div class="small-16 left d-table no-items">
                  <span class="icon-carshop icon-icon_carrinho abs"></span>
                  <div class="d-table-cell small-16">
                    <hgroup class="no-margin right small-11 rel">
                      <h4 class="font-regular primary no-margin">Seu carrinho está vazio</h4>
                      <h6 class="font-regular no-margin">Adicione produtos para fazer seu pedido</h6>
                    </hgroup>
                  </div>
                </div>
              </nav>
            </h1>
          </div>
        </div>
      </div>
    </header>

    <!-- menu principal -->
    <nav id="main-menu" class="small-16 left rel">
      <div class="row rel">
        
        <div class="small-3 columns rel main-items">
            <a href="#" title="Pesquisar por fabricantes" class="active choose-search rel">
              <div class="small-16 left">
                <small>Pesquisar por</small>
                <span><strong>Fabricantes</strong></span>
              </div>
              <span class="small-16 abs text-center">
                <i class="icon-icon_down_3"></i>
              </span>
            </a>

            <a href="#" title="Pesquisar por fabricantes" class="choose-search rel">
              <div class="small-16 left">
                <small>Pesquisar por</small>
                <span><strong>Grupos</strong></span>
              </div>
              <span class="small-16 abs text-center">
                <i class="icon-icon_down_3"></i>
              </span>
            </a>
        </div>

        <ul class="inline-list main-items left">
          <li><a href="#">Destaques</a></li>
          <li><a href="#">Novos produtos</a></li>
          <li><a href="#">Promoção</a></li>
        </ul>
        
        <ul class="inline-list main-items right partner-login">
          <li>
            <a href="#" title="Área do parceiro"><span class="icon-icon_perfil rel"></span> Área do parceiro</a>
            <div class="bg-white partner-form abs">
              <header class="divide-20">
                <h6 class="ghost no-margin font-lite">Faça seu login e para ter acesso aos seus dados</h6>
              </header>
              <form class="small-16 left">
                <p><input type="text" name="cnpj" placeholder="CNPJ" class="small-16 left"></p>
                <p><input type="password" name="senha" placeholder="SENHA" class="small-16 left"></p>
                <p><button type="submit" class="text-up small-16 no-margin font-normal" title="Fazer login">Fazer login</button></p>
                <p><button class="text-up small-16 request-account secondary no-margin font-normal" title="Solicitar cadastro">Solicitar cadastro</button></p>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>