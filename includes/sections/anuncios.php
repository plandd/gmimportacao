<!-- anuncios -->
<?php
  global $plandd_option;
  if(isset($plandd_option['list-ads'])):
?>
<section id="anouncemments" class="small-16 columns section-block no-margin">
  <ul class="small-block-grid-8">
    <?php
		foreach ($plandd_option['list-ads'] as $slide):
		$th = wp_get_attachment_image_src( $slide['attachment_id'] , 'anuncios.rodape' );
	?>
    <li>
		<a href="<?php echo $slide['url']; ?>" target="_blank" title="<?php $slide['description']; ?>">
			<img src="<?php echo $th[0]; ?>" alt="<?php $slide['title']; ?>">
		</a>
    </li>
	<?php endforeach; ?>
  </ul>
</section>
<?php endif; ?>