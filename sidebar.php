<aside id="sidebar" class="small-3 left">
  <nav class="search-menu small-16 columns">

    <!-- Fabricantes -->
    <ul class="no-bullet list-menu">
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
        $obj = get_queried_object();

        foreach ($grupos as $grupo) {
          $link = get_term_link($grupo);
          $name = $grupo->name;
          $active = ($obj && $name == $obj->name) ? 'class="current-term"' : '';

          printf('<li %s><a href="%s" title="%s">%s</a></li>',$active,$link,$name,$name);
        }
      ?>
    </ul>
  </nav>

  <?php
    //Reconhecimentos
    @require_once (dirname(__FILE__) . '/includes/components/reconhecimentos.php');
  ?>

</aside>