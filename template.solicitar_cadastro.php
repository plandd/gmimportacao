<?php 
/**
  * Template Name: Solicitar cadastro
  * @package WordPress
  */
global $plandd_option;
if ( is_user_logged_in() ) {
  global $current_user;
  get_currentuserinfo();
}
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
          <h4 class="text-up ghost">Cadastre-se ou identifique-se</h4>
        </header>
        
        <div class="small-16 columns">
          <div class="divide-30">
          <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post();
              the_content();
            endwhile; endif;
          ?>
          </div>

          <div class="divide-20">
            <form action="" class="small-8 left request-gmi-account">
              <header class="divide-10 post-header">
                <h5 class="ghost text-up no-margin"><strong>Quero ser revendedor</strong></h5>
              </header>
              <p class="font-small ghost">Solicite seu cadastro através do formulário abaixo e seja um'parceiro GMI.</p>
              
              <!-- nome -->
              <p class="small-10 left no-margin">
                <label for="nome" class="ghost font-regular">Nome/Razão Social:*</label>
                <input type="text" name="nome" id="nome" title="Seu nome" required class="small-16 left">
              </p>

              <!-- cnpj -->
              <p class="small-6 pd-left-20 left no-margin">
                <label for="cnpj" class="ghost font-regular">CNPJ:*</label>
                <input type="text" name="cnpj" id="cnpj" title="Seu CNPJ" required class="cnpj small-16 left">
              </p>
              
              <!-- email -->
              <p class="small-10 left">
                <label for="email" class="ghost font-regular">E-mail:*</label>
                <input type="email" name="email" id="email" title="Seu email" required class="small-16 left">
              </p>
              
              <!-- telefone -->
              <p class="small-6 pd-left-20 left">
                <label for="telefone" class="ghost font-regular">Telefone:*</label>
                <input type="tel" name="telefone" id="telefone" title="Seu telefone" required class="phone small-16 left">
              </p>

              <p class="small-16 left text-right">
                <button type="submit" class="button thin shape text-up">Solicitar cadastro</button>
              </p>
            </form>

            <?php
              if ( ! is_user_logged_in() ):
            ?>
            <form action="" class="small-7 right login-form-alt">
              <header class="divide-10 post-header">
                <h5 class="ghost text-up no-margin"><strong>Já possuo cadastro</strong></h5>
              </header>
              <p class="font-small ghost">Solicite seu cadastro através do formulário abaixo e seja um'parceiro GMI.</p>
              
              <!-- login -->
              <p class="small-16 left no-margin">
                <label for="cnpj_login" class="ghost font-regular">CNPJ:*</label>
                <input type="text" name="cnpj" id="cnpj_login" title="Seu CNPJ" required class="small-16 left">
              </p>
              <!-- senha -->
              <p class="small-16 left">
                <label for="senha" class="ghost font-regular">Senha:*</label>
                <input type="password" name="senha" id="senha" title="Sua senha" required class="small-16 left">
              </p>

              <p class="small-16 left text-right">
                <button type="submit" class="button thin shape text-up">Prosseguir</button>
              </p>
            </form>
            <?php endif; ?>
          </div>
        </div>
      </div>

<?php get_footer(); ?>