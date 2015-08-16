<aside id="sidebar" class="small-3 left">
  <nav class="search-menu small-16 columns">

    <!-- Fabricantes -->
    <ul class="no-bullet list-menu active">
      <?php
        show_brands_menu();
      ?>
    </ul>

    <!-- Grupos -->
    <ul class="no-bullet list-menu">
      <?php
        $grupos = get_terms( 'grupos', array(
          'orderby'    => 'name',
          'hide_empty' => true,
        ) );
        foreach ($grupos as $grupo) {
          $link = get_term_link($grupo);
          $name = $grupo->name;
          printf('<li><a href="%s" title="%s">%s</a></li>',$link,$name,$name);
        }
      ?>
    </ul>
  </nav>

  <?php
    //Reconhecimentos
    @require_once (dirname(__FILE__) . '/includes/components/reconhecimentos.php');
  ?>

</aside>