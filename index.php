<?php get_header(); ?>

    <section id="home-content" class="small-16 left">
      <div class="row">
        
        <?php  
          get_sidebar();
        ?>
        
        <!-- coluna direita -->
        <div class="small-13 left">
<?php

//$clientes = new GMI_Clientes('wpgmi');
//$clientes->update_users_by_file( dirname(__FILE__) . "/clientes.csv" );
//CODIGO,NOMEPRODUTO,GRUPO,FABRICANTE,DESCRICAO_COMPLEMENTAR,REFERENCIA,PRECO


?>
          <!-- home slider -->
          <section id="home-slider" class="small-16 columns rel">
            <nav class="small-16 left rel cycle-slideshow"
              data-cycle-fx="scrollHorz" 
              data-cycle-timeout="6000"
              data-cycle-slides="> figure"
              data-cycle-next=".prev-slider"
              data-cycle-prev=".next-slider"
              data-cycle-pager=".slider-pager"
              data-cycle-pager-template="<span></span>"
            >
              <figure class="small-16 full-height" data-thumb="http://die-markengestalter.de/uploads/projekte/reetec/ree_4.jpg">
              </figure>

              <figure class="small-16 full-height" data-thumb="http://gmimportacao.com.br/slideshow/img1.jpg">
              </figure>
            </nav>

            <!-- navegar -->
            <a href="#" class="small-1 abs nav-slider prev-slider d-table">
              <div class="d-table-cell small-16 text-center">
                <i class="icon-icon_left_5"></i>
              </div>
            </a>
            <a href="#" class="small-1 abs nav-slider next-slider d-table">
              <div class="d-table-cell small-16 text-center">
                <i class="icon-icon_right_5"></i>
              </div>
            </a>

            <!-- paginar -->
            <div class="small-16 abs slider-pager text-center"></div>
          </section>
          
          <!-- newsletter -->
          <section class="small-16 columns">
            <div id="newsletter" class="small-16 left">
              <div class="d-table-cell small-16 text-center">
                <div class="small-8 left col-left">
                  <i class="icon-icon_newsletter ghost left"></i>
                  <hgroup class="text-left left">
                    <p class="text-up ghost no-margin font-small">Assine nossa newsletter</p>
                    <h4 class="text-up ghost no-margin lh-small font-medium">E receba várias novidades da GMI!</h4>
                  </hgroup>
                </div>

                <div class="small-8 left col-right">
                  <form class="form-newsletter small-16 left">
                    <input type="email" name="email" class="small-12 left" placeholder="Digite seu melhor email" required title="Seu e-mail">
                    <button type="submit" class="small-4 left button secondary shape text-up">Assinar</button>
                  </form>
                </div>
              </div>
            </div>
          </section>
          
          <!-- Distribuidores oficiais -->
          <section id="partners-slider" class="small-16 columns section-block">
            <header class="section-header small-16 left">
              <h4 class="text-up no-margin ghost left">Distribuidor oficial</h4>
              <nav class="right nav-partners">
                <a href="#" class="d-block prev-partner icon-icon_left_4" title="Anterior"></a>
                <a href="#" class="d-block next-partner icon-icon_right_4" title="Próximo"></a>
              </nav>
            </header>

            <nav id="list-partners" class="small-12 left">
              <figure class="item">
                <a href="#"><img src="media/asus.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/greatek.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/intelbras.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/linkone.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/ragtek.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/asus.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/greatek.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/intelbras.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/linkone.png" alt=""></a>
              </figure>
              <figure class="item">
                <a href="#"><img src="media/ragtek.png" alt=""></a>
              </figure>
            </nav>
          </section>

          <!-- Produtos em destaques -->
          <section id="popular-products" class="small-16 columns section-block">
            <header class="section-header small-16 left">
              <h4 class="text-up no-margin ghost left">Produtos em destaque</h4>
            </header>
            
            <nav id="list-products" class="small-16 columns">
              <ul class="small-block-grid-5">
                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd1.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Gabinete GMI V4">Gabinete GMI V4</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd2.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Estabilizador APC Microsol 115V">Estabilizador APC Microsol 115V</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd3.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Placa Mãe GMI G31 CPU LGA775">Placa Mãe GMI G31 CPU LGA775</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd4.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Fonte GMI 700W REAL">Fonte GMI 700W REAL</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>
                
                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd1.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Gabinete GMI V4">Gabinete GMI V4</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd2.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Estabilizador APC Microsol 115V">Estabilizador APC Microsol 115V</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd3.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Placa Mãe GMI G31 CPU LGA775">Placa Mãe GMI G31 CPU LGA775</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd4.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Fonte GMI 700W REAL">Fonte GMI 700W REAL</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd1.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Gabinete GMI V4">Gabinete GMI V4</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd2.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Estabilizador APC Microsol 115V">Estabilizador APC Microsol 115V</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd3.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Placa Mãe GMI G31 CPU LGA775">Placa Mãe GMI G31 CPU LGA775</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd4.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Fonte GMI 700W REAL">Fonte GMI 700W REAL</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd1.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Gabinete GMI V4">Gabinete GMI V4</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd2.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Estabilizador APC Microsol 115V">Estabilizador APC Microsol 115V</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure>
                    <div class="small-16 abs frame-white"></div>
                    <a href="#" title="" class="product-thumb d-iblock small-16 left"><img src="media/pd3.jpg" alt=""></a>
                    <figcaption class="small-16 left">
                      <h2 class="small-16 left font-medium font-regular"><a href="#" title="Placa Mãe GMI G31 CPU LGA775">Placa Mãe GMI G31 CPU LGA775</a></h2>
                      <p class="no-margin small-16 left text-center"><a href="#" title="" class="button secondary round font-small text-up no-margin">Detalhes</a></p>
                    </figcaption>
                  </figure>
                </li>
              </ul>
            </nav>
          </section>

          <!-- sobre a empresa -->
          <section id="corp-skills" class="small-16 columns section-block">
            <nav class="small-16 columns">
              <ul class="small-block-grid-3">
                <li>
                  <a href="#" class="small-16 left d-table">
                    <div class="d-table-cell small-16 text-center">
                      <span class="primary d-block icon-icon_seguranca"></span>
                      <article class="text-left">
                        <p class="lh-small no-margin secondary">Faça seu pedido</p>
                        <h3 class="lh-small no-margin text-up">Com segurança</h3>
                      </article>
                    </div>
                  </a>
                </li>

                <li>
                  <a href="#" class="small-16 left d-table">
                    <div class="d-table-cell small-16 text-center">
                      <span class="primary d-block icon-icon_group"></span>
                      <article class="text-left">
                        <p class="lh-small no-margin secondary">Faça parte da equipe</p>
                        <h3 class="lh-small no-margin text-up">Seja revendedor</h3>
                      </article>
                    </div>
                  </a>
                </li>

                <li>
                  <a href="#" class="small-16 left d-table">
                    <div class="d-table-cell small-16 text-center">
                      <span class="primary d-block icon-icon_certificado"></span>
                      <article class="text-left">
                        <p class="lh-small no-margin secondary">Padrão de qualidade</p>
                        <h3 class="lh-small no-margin text-up">Reconhecido</h3>
                      </article>
                    </div>
                  </a>
                </li>
              </ul>
            </nav>
          </section>
        </div><!-- //coluna direita -->

        <!-- ultimas noticias -->
        <section id="last-blog" class="small-16 columns section-block no-margin">
          <div class="small-16 columns">
            <header class="section-header small-16 left">
              <h4 class="text-up no-margin ghost left">Últimas notícias</h4>
              <a href="#" class="right font-small white more-news" title="ver mais notícias">ver mais notícias</a>
            </header>

            <nav id="nav-blog-last" class="small-16 columns">
              <ul class="small-block-grid-4">
                <li>
                  <figure class="small-16 left">
                    <a href="#" title="" class="d-block divide-10">
                      <img src="media/news1.jpg" alt="">
                    </a>
                    <figcaption class="small-16 left">
                      <h5 class="divide-10"><a href="#" class="secondary">A GMI Distribuidora firma sua mais nova parceira em 2015</a></h5>
                      <p><a href="#" title="">> leia mais</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure class="small-16 left">
                    <a href="#" title="" class="d-block divide-10">
                      <img src="media/news2.jpg" alt="">
                    </a>
                    <figcaption class="small-16 left">
                      <h5 class="divide-10"><a href="#" class="secondary">A GMI Distribuidora firma sua mais nova parceira em 2015</a></h5>
                      <p><a href="#" title="">> leia mais</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure class="small-16 left">
                    <a href="#" title="" class="d-block divide-10">
                      <img src="media/news3.jpg" alt="">
                    </a>
                    <figcaption class="small-16 left">
                      <h5 class="divide-10"><a href="#" class="secondary">A GMI Distribuidora firma sua mais nova parceira em 2015</a></h5>
                      <p><a href="#" title="">> leia mais</a></p>
                    </figcaption>
                  </figure>
                </li>

                <li>
                  <figure class="small-16 left">
                    <a href="#" title="" class="d-block divide-10">
                      <img src="media/news4.jpg" alt="">
                    </a>
                    <figcaption class="small-16 left">
                      <h5 class="divide-10"><a href="#" class="secondary">A GMI Distribuidora firma sua mais nova parceira em 2015</a></h5>
                      <p><a href="#" title="">> leia mais</a></p>
                    </figcaption>
                  </figure>
                </li>
              </ul>
            </nav>
          </div>
        </section>
      
<?php get_footer(); ?>