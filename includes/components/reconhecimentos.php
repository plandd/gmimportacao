<?php
  global $plandd_option;
  //include_once get_stylesheet_directory_uri() . "/includes/components/reconhecimentos.php";
  if(isset($plandd_option['list-winners'])):
?>
<section id="testimonials" class="small-16 columns section-block">
  <header class="section-header no-margin small-16 left">
    <h4 class="text-up no-margin ghost left">Reconhecimentos</h4>
  </header>

  <nav id="nav-testimonials" class="small-16 left white-panel">
    <?php
      $winners = $plandd_option['list-winners'];
      shuffle($winners);
      foreach ($winners as $win):
    ?>
    <figure class="small-16 left item">
      <a href="<?php echo $win['image']; ?>" data-lightbox="testimonials" class="d-block divide-10">
        <?php echo wp_get_attachment_image( $win['attachment_id'], 'slider.reconhecimentos' ); ?>
      </a>
      <figcaption class="small-16 left">
        <p class="font-small no-margin"><?php echo $win['description']; ?>.</p>
      </figcaption>
    </figure>
    <?php endforeach; ?>
  </nav>
</section>
<?php endif; ?>