<?php
  global $plandd_option;
  if(isset($plandd_option['list-partners'])):
?>
<section id="partners-slider" class="small-16 columns section-block">
  <header class="section-header small-16 left">
    <h4 class="text-up no-margin ghost left">Distribuidor oficial</h4>
    <nav class="right nav-partners">
      <a href="#" class="d-block prev-partner icon-icon_left_4" title="Anterior"></a>
      <a href="#" class="d-block next-partner icon-icon_right_4" title="Próximo"></a>
    </nav>
  </header>

  <nav id="list-partners" class="small-12 left">
    <?php
      $partners = $plandd_option['list-partners'];
      shuffle($partners);
      $i = 0;
      foreach ($partners as $win):
        if(15 == $i) break;
        $th = wp_get_attachment_image_src( $win['attachment_id'] , 'slider.distribuidores' );
    ?>
    <figure class="item">
      <a href="<?php echo $win['url']; ?>"><img src="<?php echo $th[0]; ?>" alt=""></a>
    </figure>
  </nav>
  <?php $i++; endforeach; ?>
</section>
<?php endif; ?>