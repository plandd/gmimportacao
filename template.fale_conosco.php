<?php 
/**
  * Template Name: Contato
  * @package WordPress
  */
global $plandd_option;
get_header(); 
?>
  <section id="single-content" class="small-16 left">
    <div class="row">
      <?php
        //Menu  
        get_sidebar();
      ?>
      <!-- coluna direita -->
      <div class="small-13 left">
        <header class="divide-20 column page-header">
          <h4 class="text-up ghost"><?php the_title(); ?></h4>
        </header>
        
        <div class="small-16 columns">
          <div class="divide-30 the-page-content">
            <?php 
              if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content();
              endwhile; endif;
            ?>
          </div>

          <section class="small-6 left">
            <header class="divide-20 post-header">
              <h5 class="ghost no-margin"><strong>Canais de atendimento</strong></h5>
            </header>
            <nav>
              <ul class="no-bullet small-16 left list-channels">
                <li class="divide-10">
                  <div class="small-2 left">
                    <h1 class="primary icon-icon_phone no-margin"></h1>
                  </div>
                  <div class="left pd-left-20 channel-data d-table">
                    <h6 class="text-up ghost no-margin">Compre pelo telefone</h6>
                    <p class="ghost font-medium"><?php echo $plandd_option['inst-tel-sell']; ?></p>
                  </div>
                </li>

                <li class="small-16 left">
                  <div class="small-2 left">
                    <h1 class="primary icon-icon_mail_2 no-margin"></h1>
                  </div>
                  <div class="left pd-left-20 channel-data d-table">
                    <h6 class="text-up ghost no-margin">Envie um e-mail</h6>
                    <p class="ghost font-medium no-margin"><?php echo $plandd_option['inst-email']; ?></p>
                  </div>
                </li>

                <li class="divide-10">
                  <div class="small-2 left">
                    <h1 class="primary icon-icon_ticket no-margin"></h1>
                  </div>
                  <div class="left pd-left-20 channel-data d-table" style="padding-top:14px;">
                    <?php $page = get_page_by_title('Minha conta'); ?>
                    <h6 class="text-up ghost no-margin"><a href="<?php echo get_page_link($page->ID); ?>" class="ghost text-up" title="Solicitar chamado">Solicitar chamado</a></h6>
                  </div>
                </li>
              </ul>
            </nav>
          </section>

          <section class="small-10 pd-left-20 left">
            <header class="divide-20 post-header">
              <h5 class="ghost no-margin"><strong>Envie uma mensagem para nós</strong></h5>
            </header>

            <form class="divide-20" id="support-form">
              <div class="small-16 left">
                <p class="ghost font-small no-margin">Departamento</p>
                <label>
                  <select name="departamento" title="Selecionar departamento" required class="bg-gradient small-6">
                    <option>Selecionar departamento</option>
                    <?php
                      if(isset($plandd_option['opt-multitext'])) {
                        foreach ($plandd_option['opt-multitext'] as $dep) {
                          $dept = explode(':', $dep);
                          $dep_name = trim($dept[0]);
                          $dep_email = trim($dept[1]);
                          printf('<option value="%s">%s</option>',$dep_email,$dep_name);
                        }
                      }
                    ?>
                  </select>
                </label>
              </div>
              <div class="small-8 left no-margin">
                
                <div class="nine-eight left">
                  <p class="ghost font-small no-margin">
                    <label class="ghost font-small no-margin" for="nome">Nome:</label>
                    <input class="bg-white ghost" type="text" name="nome" id="nome" title="Seu nome" required>
                  </p>
                  <p class="ghost font-small no-margin">
                    <label class="ghost font-small no-margin" for="email">E-mail:</label>
                    <input class="bg-white ghost" type="email" name="email" id="email" title="Seu email" required>
                  </p>
                  <p class="ghost font-small no-margin">
                    <label class="ghost font-small no-margin" for="telefone">Telefone:</label>
                    <input class="bg-white ghost" type="tel" name="telefone" id="telefone" title="Seu telefone" required>
                  </p>
                </div>
              </div>
              <div class="small-8 left no-margin">
                <div class="nine-eight right">
                  <p class="no-margin"><label class="ghost font-small no-margin" for="mensagem">Mensagem:</label></p>
                  <textarea name="mensagem" title="Sua mensagem" required id="mensagem" rows="10" class="small-16 left no-margin"></textarea>
                </div>
              </div>
              <div class="small-16 left">
                <button type="submit" class="button shape thin right text-up">Enviar</button>
              </div>
            </form>
          </section>
        </div>
      </div>

<?php get_footer(); ?>