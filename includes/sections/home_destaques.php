<!-- home slider -->
<?php
  global $plandd_option;
  if(isset($plandd_option['list-sliders'])):
?>
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
    <?php
      foreach ($plandd_option['list-sliders'] as $slide):
        $th = wp_get_attachment_image_src( $slide['attachment_id'] , 'slider.home' );
    ?>
    <figure class="small-16 full-height" data-thumb="<?php echo $th[0]; ?>">
      <a href="<?php echo $slide['url']; ?>" class="abs small-16" title="<?php echo $slide['description']; ?>"></a>
    </figure>
    <?php endforeach; ?>
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
<?php endif; ?>

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