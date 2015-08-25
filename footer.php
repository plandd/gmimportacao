     <?php
        // Ultimas noticias
        require_once (dirname(__FILE__) . '/includes/sections/anuncios.php');
      ?>

      </div><!-- //row -->
    </section>
    
    <!-- footer -->
    <footer id="footer" class="small-16 left white rel">
      <a href="#" title="Voltar ao topo" class="return-to-top text-center"><span class="icon-icon_up_2"></span></a>
      <div class="row">
        
        <section class="small-5 columns">
          <header class="header-footer divide-20 rel d-table">
            <h1 class="no-margin left abs">
              <a href="<?php echo home_url(); ?>" title="Página principal" class="white"><span class="icon-icon_gm_pb"></span></a>
            </h1>
            <p class="no-margin d-table-cell font-black text-up"><i>Distribuindo qualidade</i></p>
          </header>

          <address class="divide-20 rel">
            <?php
              global $plandd_option;
              //Localização
              if(!empty($plandd_option['inst-rua']))
                printf('<p>%s</p>',$plandd_option['inst-rua']);
              
              if(!empty($plandd_option['inst-comp']) && !empty($plandd_option['inst-bairro']))
                printf('<p>%s - %s</p>',$plandd_option['inst-comp'],$plandd_option['inst-bairro']);
              
              if(!empty($plandd_option['inst-cidade']))
                printf('<p>%s</p>',$plandd_option['inst-cidade']);
              
              if(!empty($plandd_option['inst-cep']))
                printf('<p>CEP: %s</p>',$plandd_option['inst-cep']);
              
              if(!empty($plandd_option['inst-mapa']))
                printf('<p class="font-small"><a href="%s" target="_blank" title="ver no mapa">ver no mapa</a></p>',$plandd_option['inst-mapa']);
            ?>
            <span class="icon-icon_local white abs"></span>
          </address>
          <?php
            if(!empty($plandd_option['inst-tel']))
                printf('<p class="tel small-16 left rel divide-10"><span class="abs icon-icon_phone"></span><a href="#">%s</a></p>',$plandd_option['inst-tel']);
            
            if(!empty($plandd_option['inst-email']))
                printf('<p class="tel small-16 left rel no-margin"><span class="abs icon-icon_mail_2"></span><a href="mailto:%s">%s</a></p>',$plandd_option['inst-email'],$plandd_option['inst-email']);
          ?>
        </section>

        <nav class="custom-nav small-3 columns">
          <header class="divide-10">
            <h5 class="white text-up no-margin">Institucional</h5>
          </header>
          <ul>
            <?php
              $defaults = array(
                'theme_location'  => 'corporate',
                'menu'            => 'Menu institucional',
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
        </nav>

        <nav class="custom-nav small-3 columns">
          <header class="divide-10">
            <h5 class="white text-up no-margin">Dúvidas</h5>
          </header>
          <ul>
            <?php
              $defaults = array(
                'theme_location'  => 'questions',
                'menu'            => 'Menu dúvidas',
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
        </nav>

        <section class="footer-info small-4 columns">
          <hgroup class="divide-30 rel">
            <h5 class="white text-up no-margin">Compre pelo telefone</h5>
            <p class="white no-margin font">Televendas: <strong><?php echo $plandd_option['inst-tel-sell']; ?></strong></p>
            <span class="abs icon-icon_phone white"></span>
          </hgroup>

          <h5 class="white text-up rel divide-20 get-ticket">
            <?php $page = ( is_user_logged_in() ) ? get_page_by_title('Minha conta') : get_page_by_title('Solicitar cadastro'); ?>
            <span class="icon-icon_ticket left"></span><a href="<?php echo get_page_link($page->ID); ?>" title="Solicitar chamado">Solicitar chamado</a>
          </h5>

          <nav class="footer-social small-16 left">
            <ul class="inline-list">
              <li>GMI na internet:</li>
              <?php
              if(!empty($plandd_option['inst-facebook']))
                printf('<li><h3 class="lh-small no-margin"><a href="%s" target="_blank" title="Siga-nos no Facebook" class="icon-icon_facebook"></a></h3>',$plandd_option['inst-facebook']);

               if(!empty($plandd_option['inst-twitter']))
                printf('<li><h3 class="lh-small no-margin"><a href="%s" target="_blank" title="Siga-nos no Twitter" class="icon-icon_twitter"></a></h3>',$plandd_option['inst-twitter']);

               if(!empty($plandd_option['inst-instagram']))
                printf('<li><h3 class="lh-small no-margin"><a href="%s" target="_blank" title="Siga-nos no Instagram" class="icon-icon_insta"></a></h3>',$plandd_option['inst-instagram']);
              ?>
            </ul>
          </nav>
        </section>

      </div>
    </footer>

    <section id="credits" class="small-16 left">
      <div class="row">
        <p class="small-16 left text-center d-table">
          <span class="d-table-cell">* Preços, estoque e condições exclusivos para revendedores GMI devidamente cadastrados, podendo sofrer alterações sem prévia notificação.</span>
        </p>

        <p class="small-16 left d-table">
          <span class="d-table-cell small-16">
            <span class="left" style="line-height:50px;">© 2006 - <?php echo date('Y'); ?> GMI Comércio e Importação LTDA - Todos os direitos reservados</span>
            <span class="right">
              <a href="http://plandd.cc" target="_blank" title="Desenvolvido por Plan - Design e Desenvolvimento" class="icon-icon_plan ghost"></a>
            </span>
          </span>
        </p>
      </div>
    </section>

    <?php wp_footer(); ?>
  </body>
</html>