<?php 
/**
  * Template Name: Minha conta
  * @package WordPress
  */
global $plandd_option;
if ( is_user_logged_in() ) {
  global $current_user;
  get_currentuserinfo();
  $vendedor = get_user_meta($current_user->ID, 'planDD_vendedor', true);
  $limite = get_user_meta($current_user->ID, 'planDD_limite', true);
  $compra = get_user_meta($current_user->ID, 'planDD_compra', true);
  $cnpj = get_user_meta($current_user->ID, 'planDD_cnpj', true);
  $telefone = get_user_meta($current_user->ID, 'planDD_telefone', true);
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
            <h4 class="text-up ghost"><?php the_title(); ?></h4>
          </header>
          
          <div class="small-16 columns">
            <?php if ( is_user_logged_in() ): ?>
            <article class="panel-advice divide-30">
              <header class="small-16 left">
                <p class="ghost text-up divide-10"><strong>Área exclusiva para parceiros</strong></p>
                <p class="small-8 left no-margin ghost font-normal">
                  Bem vindo <strong class="text-up"><?php echo $current_user->first_name .' '. $current_user->last_name; ?></strong> à sua área exclusiva<br>
                  Aqui você terá acesso a promoções e conteúdo exclusivos
                </p>
                <div class="small-8 left no-margin meta-data">
                  <p class="small-5 left no-margin font-normal">
                    Vendedor<br>
                    <span class="ghost"><?php echo $vendedor; ?></span>
                  </p>
                  <p class="small-5 left no-margin font-normal">
                    Limite de crédito<br>
                    <span class="ghost">R$ <?php echo $limite; ?></span>
                  </p>
                  <p class="small-5 left no-margin font-normal">
                    Última compra<br>
                    <span class="ghost"><?php echo $compra; ?></span>
                  </p>
                </div>
              </header>
            </article>

            <div class="small-16 left">
              
              <div class="small-16 left bg-gradient">
                <ul class="tabs" data-tab>
                  <li class="tab-title active"><a href="#panel1"><strong>Dados Cadastrais</strong></a></li>
                  <!--<li class="tab-title"><a href="#panel2"><strong>Promoções</strong></a></li>-->
                  <li class="tab-title"><a href="#panel2"><strong>Solicitar suporte</strong></a></li>
                  <li class="tab-title"><a href="#panel3"><strong>Entre em contato</strong></a></li>
                  <li class="tab-title"><a href="#panel4"><strong>Perguntas frequentes</strong></a></li>
                </ul>
              </div> 
              <div class="tabs-content small-16 column bg-white">
                <div class="divide-20"></div>
                <div class="content active" id="panel1">
                  <?php
                    $page = get_page_by_title('Fale conosco');
                  ?>
                  <p class="small-16 columns">Para atualizar seus dados entre em contato com nossa central de atendimento. <a href="<?php echo get_page_link($page->ID); ?>" class="text-up">Solicitar alterações</a></p>

                  <div class="small-12 left">
                    <form novalidate id="update-pass" class="small-12 columns">
                      <p class="small-8 left no-margin">
                        <span class="nine-eight left">
                          <label for="nome" class="ghost font-small">Nome</label>
                          <input type="text" disabled="disabled" placeholder="<?php echo $current_user->first_name .' '. $current_user->last_name; ?>">
                        </span> 
                      </p>
                      <p class="small-8 left no-margin">
                        <span class="nine-eight right">
                          <label for="nome" class="ghost font-small">CNPJ</label>
                          <input type="text" disabled="disabled" placeholder="<?php echo $cnpj; ?>">
                        </span>
                      </p>
                      <p class="small-8 left no-margin">
                        <span class="nine-eight left">
                          <label for="nome" class="ghost font-small">E-mail</label>
                          <input type="text" disabled="disabled" placeholder="<?php echo $current_user->user_email; ?>">
                        </span> 
                      </p>
                      <p class="small-8 left no-margin">
                        <span class="nine-eight right">
                          <label for="nome" class="ghost font-small">Telefone</label>
                          <input type="text" disabled="disabled" placeholder="<?php echo $telefone; ?>">
                        </span>
                      </p>
                      <p class="small-8 left no-margin">
                        <span class="nine-eight left">
                          <label for="nome" class="ghost font-small">Senha</label>
                          <input type="password" disabled="disabled" value="00000000000000">
                        </span> 
                      </p>
                      <p class="small-8 left no-margin">
                        <span class="nine-eight right">
                          <label for="nome" class="ghost font-small">Nova senha</label>
                          <input type="password" name="password" required title="Sua senha">
                        </span>
                      </p>
                      <div class="divide-20"></div>
                      <p class="divide-20">
                        <button type="submit" class="button shape text-up" title="Atualizar senha"><strong>Atualizar senha</strong></button>
                      </p>
                      <input type="hidden" name="id_usuario" value="<?php echo $current_user->ID; ?>">
                    </form>
                  </div>
                </div>
                <!--<div class="content" id="panel2">
                  
                </div> promocoes-->
                
                <div class="content" id="panel2">
                  <p class="small-16 columns">Obtenha ajuda sobre os serviços e garantia. Encontre links para manuais do usuário, especificações, e contato do suporte da GMI Distribuidora</p>

                  <p class="divide-20 column">
                    <button data-reveal-id="rma" class="button shape text-up" title="Suporte RMA"><strong>Suporte RMA</strong></button>
                  </p>

                  <div id="rma" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                    <form id="form1" name="form1" method="post" action="<?php echo home_url('/rma'); ?>/enviaForm.php">
  
                     <table width="1000" border="0" cellpadding="1" cellspacing="1">
                      <tbody><tr>
                        <td colspan="7" align="center"><strong>SOLICITAÇÃO DE SUPORTE<hr></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right"><strong>Razão Social</strong></td>
                        <td colspan="4"><input type="text" name="nomeCliente" id="nomeCliente" size="50" value="<?php echo $current_user->first_name . ' ' . $current_user->last_name; ?>"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right"><strong>CNPJ</strong></td>
                        <td colspan="4"><input type="text" value="<?php echo $cnpj; ?>" name="cnpj" id="cnpj" size="20" maxlength="18" class=""></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right"><strong>Telefone para contato</strong></td>
                        <td colspan="4"><input type="text" value="<?php echo $telefone; ?>" name="telefone" id="telefone" size="20" maxlength="14"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right"><strong>Email</strong></td>
                        <td colspan="3"><input type="text" name="email" value="<?php echo $current_user->user_email; ?>" id="email" size="50"></td>
                        <td align="right"><strong>Data</strong></td>
                        <td><input type="text" id="data" name="data" size="8" readonly="readonly"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                       <tr>
                         <td width="60" rowspan="2" align="center"><strong>Codigo GM</strong></td>
                         <td width="241" rowspan="2" align="center"><strong>Nome Produto</strong></td>
                         <td width="90" rowspan="2" align="center"><strong>Nº de Série</strong></td>
                         <td width="120" rowspan="2" align="center"><strong>Data/Lacre/GMi</strong></td>
                         <td width="72" rowspan="2" align="center"><strong>NFe</strong></td>
                         <td width="60" rowspan="2" align="center"><strong>Data Emissão</strong></td>
                         <td width="243" rowspan="2" align="center"><strong>Defeito Apresentado</strong></td>
                         
                       </tr>
                       <tr>
                         
                       </tr>
                       <tr id="tmp">
                         <td align="center"><label for="codigoGm2"></label>
                         <input name="codigoGm[]" type="text" id="codigoGm2" size="5"></td>
                         <td align="center"><label for="nomeProduto"></label>
                         <input name="nomeProduto[]" type="text" id="nomeProduto" size="30" maxlength="50"></td>
                         <td align="center"><label for="nSerie"></label>
                         <input name="nSerie[]" type="text" id="nSerie" size="15"></td>
                         <td align="center"><label for="dataLacre"></label>
                         <input name="dataLacre[]" type="text" id="dataLacre" size="8" maxlength="10"></td>
                         <td align="center"><label for="NFe"></label>
                         <input name="NFe[]" type="text" id="NFe" size="10" class=""></td>
                         <td align="center"><label for="dataEmissao"></label>
                         <input name="dataEmissao[]" type="text" id="dataEmissao" size="8" maxlength="10"></td>
                         <td align="center"><label for="defeitoApresentado"></label>
                         <input name="defeitoApresentado[]" type="text" id="defeitoApresentado" size="40"></td>
                       </tr>
                     </tbody></table>
                      <div align="right" class="btns"><input type="button" name="addProduto" id="tmpAddRow" value="Adicionar Produto"> 
                      <input type="button" name="removeProduto" id="tmpRemoveRow" value="Remover Produto"> 
                      <input type="submit" name="enviar" id="enviar" value="Finalizar"></div>
                     
                   </form>
                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                  </div>
                </div>

                <div class="content" id="panel3">
                  <div class="small-10 columns">
                    <header class="primary-header divide-20">
                      <h6 class="text-up ghost no-margin">Envie uma mensagem para nós</h6>
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
                            <input class="disabled bg-white ghost" type="text" name="nome" id="nome" title="Seu nome" value="<?php echo $current_user->first_name .' '. $current_user->last_name; ?>">
                          </p>
                          <p class="ghost font-small no-margin">
                            <label class="ghost font-small no-margin" for="email">E-mail:</label>
                            <input class="disabled bg-white ghost" type="email" name="email" id="email" title="Seu email" value="<?php echo $current_user->user_email ; ?>">
                          </p>
                          <p class="ghost font-small no-margin">
                            <label class="ghost font-small no-margin" for="telefone">Telefone:</label>
                            <input class="disabled bg-white ghost" type="tel" name="telefone" id="telefone" title="Seu telefone" value="<?php echo $telefone ; ?>">
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
                        <button type="submit" class="button shape right text-up">Enviar</button>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="content" id="panel4">
                  <nav class="small-16 columns faq-list">
                    <ul class="no-bullet small-16 left">
                    
                      <?php
                        if(isset($plandd_option['list-faq'])):
                          foreach ($plandd_option['list-faq'] as $faq):
                      ?>
                      <li>
                        <span class="divide-10">
                          <i class="icon-icon_up_2 primary left"></i>
                          <i class="icon-icon_down_2 primary left"></i>
                          <strong><?php echo $faq['title']; ?></strong>
                        </span>
                        <div class="small-16 left">
                          <p class="divide-10"><?php echo $faq['description']; ?></p>
                        </div>
                      </li>
                      <?php endforeach; endif; ?>
                    </ul>
                  </nav>
                </div>
              </div>

            </div>
            <?php else: ?>
              <p class="primary small-16 columns">Você deve estar logado para acessar esta página</p>
              <p>
                <form class="small-6 left login-form-alt">
                  <p><input type="text" name="cnpj" placeholder="CNPJ" class="small-16 left"></p>
                  <p><input type="password" name="senha" placeholder="SENHA" class="small-16 left"></p>
                  <p><button type="submit" class="text-up small-16 no-margin font-normal" title="Fazer login">Fazer login</button></p>
                  <p><button class="text-up small-16 request-account secondary no-margin font-normal" title="Solicitar cadastro">Solicitar cadastro</button></p>
                </form>
              </p>
            <?php endif; ?>
          </div>
        </div>
  <script>
    jQuery(document).ready(function($) {
      $(function(){

        var currentTime = new Date()
        var month = currentTime.getMonth() + 1;
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();
        
        var date = day + "/" + month + "/" + year;


        $('[name=data]').val(date);

      });

      var i = 0;
      $('input#tmpAddRow').click(function($e) {
          
          $e.preventDefault();
          if(i<=8){
             i++;
             $('tr#tmp').clone(true).removeAttr('id').appendTo('tbody');
          }
        }
      );

      $('#tmpRemoveRow').click(
        function($e) {
          $e.preventDefault();
          if(i>0){
             $('tr:last-child').remove();
             i--;
          }    
        }
      );

      $('tr input[type=text]').focus(
        function() {
          $(this).addClass('myFocused');   
        }
      ).blur(
        function() {
          $(this).removeClass('myFocused');
        }
      );
    });
  </script>
<?php get_footer(); ?>