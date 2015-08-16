<?php get_header(); ?>

    <section id="home-content" class="small-16 left">
      <div class="row">
        
        <?php
          //Menu  
          get_sidebar();
        ?>
        
        <!-- coluna direita -->
        <div class="small-13 left">

          <?php
            // Destaques
            require_once (dirname(__FILE__) . '/includes/sections/home_destaques.php');

            // Distribuidores oficiais
            require_once (dirname(__FILE__) . '/includes/sections/distribuidores.php');

            // Produtos em destaque
            require_once (dirname(__FILE__) . '/includes/sections/produtos_destaques.php');

            // Institucional
            require_once (dirname(__FILE__) . '/includes/sections/links_institucionais.php');
          ?>
          
        </div><!-- //coluna direita -->

        <?php
          // Ultimas noticias
          require_once (dirname(__FILE__) . '/includes/sections/ultimas_noticias.php');
        ?>

<?php get_footer(); ?>