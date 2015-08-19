<?php 
/**
  * Template Name: Meu pedido
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
          <header class="small-16 columns page-header">
            <h4 class="text-up ghost"><?php the_title(); ?></h4>
          </header>
          
          <div class="small-16 columns">
            <?php if ( is_user_logged_in() ): ?>
            
            <!-- items no carrinho -->
            <div id="cart-for-checkout" class="small-16 columns bg-white">
              <header class="divide-10 columns ghost">
                <p class="small-10 left font-regular">Produto(s) no carrinho</p>
                <p class="small-3 left font-regular text-center">Quantidade</p>
                <p class="small-3 left font-regular text-center">Remover</p>
              </header>
              
              <nav class="small-16 left">
                <ul class="no-bullet no-margin small-16 left">
                <?php
                  $items = get_user_meta( $current_user->ID, 'user_cart', true );
                  $count = count($items);
                  if($items):
                  foreach ($items as $key => $value):
                    $item = get_post( $key );
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'medium');
                    $th = (!empty($thumb[0])) ? $thumb[0] : get_stylesheet_directory_uri() . '/images/imagem_padrao.jpg';
                    if($value > 0):

                      ?>
                      <li class="divide-10">
                        <div class="small-10 left">
                          <figure class="small-3 columns td-cart-list">
                            <div class="small-16 d-table-cell">
                              <a href="<?php echo get_permalink($item->ID); ?>" title="<?php echo get_the_title( $item->ID ); ?>">
                                <img src="<?php echo $th; ?>" alt="" class="small-16 left">
                              </a>
                            </div>
                          </figure>
                          <div class="small-10 columns td-cart-list end">
                            <p class="small-16 d-table-cell">
                              <a href="<?php echo get_permalink($item->ID); ?>" title="<?php echo get_the_title( $item->ID ); ?>" class="ghost"><?php echo get_the_title( $item->ID ); ?></a>
                            </p>
                          </div>
                        </div>

                        <div class="small-3 left td-cart-list">
                          <div class="d-table-cell small-16 text-center">
                            <div class="change_cart_quantity d-iblock">
                              <span class="rem_item">-</span>
                              <span class="total_item"><input type="text" value="<?php echo $value; ?>"></span>
                              <span class="add_item">+</span>
                            </div>
                          </div>
                        </div>

                        <div class="small-3 left td-cart-list">
                          <div class="d-table-cell small-16 text-center">
                            <h3 class="no-margin">
                              <a href="#" data-user="<?php echo $current_user->ID; ?>" data-item="<?php echo $item->ID; ?>" title="Excluir <?php echo get_the_title( $item->ID ); ?>" class="remove_item icon-icon_fechar"></a>
                            </h3>
                          </div>
                        </div>

                        <div class="info-check" data-item="<?php echo $item->ID; ?>" data-qtd="<?php echo $value; ?>"></div>
                      </li>
                      <?php
                    endif;
                  endforeach;
                  else:
                    echo '<p class="secondary small-16 columns">Seu carrinho está vazio</p>';
                  endif;
                ?>
                </ul>
              </nav>
              
              <?php if($count > 0): ?>
              <footer class="divide-20 column ghost">
                <p class="font-small no-margin">Verifique acima a quantidade correta de cada produto.</p>
                <p class="font-small no-margin">Atenção: os produtos acima poderão sofrer alterações de quantidade dependendo do estoque no momento do fechamento do pedido</p>
              </footer>

              <header class="divide-10 columns ghost">
                <h5 class="ghost text-up no-margin">Escolha como pretende fazer o pagamento</h5>
              </header>

              <nav class="small-16 left">
                <ul class="inline-list pay-form">
                  <li>
                    <label class="font-regular no-margin ghost"><input type="radio" checked="checked" name="pagamento" value="Depósito bancário" class="left"><span class="left">Depósito bancário</span></label>
                  </li>

                  <li>
                    <label class="font-regular no-margin ghost"><input type="radio" name="pagamento" value="Dinheiro" class="left"><span class="left">Dinheiro</span></label>
                  </li>

                  <li>
                    <label class="font-regular no-margin ghost"><input type="radio" name="pagamento" value="Boleto bancário" class="left"><span class="left">Boleto bancário</span></label>
                  </li>
                </ul>
              </nav>

              <nav class="small-16 columns">
                <a href="#" class="button secondary shape thin left text-up submit_new_items" title="Adicionar mais produtos" data-user="<?php echo $current_user->ID; ?>"><strong>Adicionar mais produtos</strong></a>

                <a href="#" class="button shape thin right text-up send-cart" data-pay="" title="Enviar pedido"><strong>Enviar pedido</strong></a>
              </nav>
              <?php endif; ?>
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
<?php get_footer(); ?>