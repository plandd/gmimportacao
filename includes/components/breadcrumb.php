<?php
/**
 * Breadcrumb
 * @return {String} Caminho da pagina corrente
 */
function the_breadcrumb() {
     
    // Settings
    $separator  = '>';
    $id         = 'breadcrumb';
    $class      = 'breadcrumbs';
    $home_title = get_bloginfo('name');
    $obj = get_queried_object();
     
    // Get the query & post information
    global $post,$wp_query;
    $category = get_categories();
     
    // Build the breadcrums
    // echo '<ul id="' . $id . '" class="' . $class . ' inline-list">';
     
    // Do not display on the homepage
    if ( !is_front_page() ) {
         
        // Home page
        echo '<span class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">Página principal</a></span>';
        echo '<i class="separator separator-home"> ' . $separator . ' </i>';
         
        if ( is_singular() ) {
             echo '<span><a href="'. get_post_type_archive_link( $obj->post_type ) .'">'. ucwords($obj->post_type) .'</a></span>';
             echo '<i class="separator"> ' . $separator . ' </i>';
             echo '<span>'. $obj->post_title .'</span>';
            
        } else if ( is_single() ) {

        	// Single post (Only display the first category)
            echo '<span class="item-cat item-cat-' . $category->term_id . ' item-cat-' . $category->category_nicename . '"><a class="bread-cat bread-cat-' . $category->term_id . ' bread-cat-' . $category->category_nicename . '" href="' . get_category_link($category->term_id ) . '" title="' . $category->cat_name . '">' . $category->cat_name . '</a></span>';
            echo '<i class="separator separator-' . $category->term_id . '"> ' . $separator . ' </i>';
            echo '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></span>';

        } else if ( is_category() ) {
             
            // Category page
            echo '<span class="item-current item-cat-' . $category->term_id . ' item-cat-' . $category->category_nicename . '"><span class="bread-current bread-cat-' . $category->term_id . ' bread-cat-' . $category->category_nicename . '">' . $category->cat_name . '</span></span>';
             
        } else if ( is_page() ) {
             
            // Standard page
            if( $post->post_parent ){
                 
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                 
                // Get parents in the right order
                $anc = array_reverse($anc);
                 
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<span class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></span>';
                    $parents .= '<i class="separator separator-' . $ancestor . '"> ' . $separator . ' </i>';
                }
                 
                // Display parent pages
                echo $parents;
                 
                // Current page
                echo '<span class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></span>';
                 
            } else {
                 
                // Just display current page if not parents
                echo '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></span>';
                 
            }
             
        } else if ( is_tag() ) {
             
            // Tag page
             
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
             
            // Display the tag name
            echo '<span class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><span class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</span></span>';
         
        } elseif ( is_day() ) {
             
            // Day archive
             
            // Year link
            echo '<span class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></span>';
            echo '<i class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </i>';
             
            // Month link
            echo '<span class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></span>';
            echo '<i class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </i>';
             
            // Day display
            echo '<span class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></span>';
             
        } else if ( is_month() ) {
             
            // Month Archive
             
            // Year link
            echo '<span class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></span>';
            echo '<i class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </i>';
             
            // Month display
            echo '<span class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></span>';
             
        } else if ( is_year() ) {
             
            // Display year archive
            echo '<span class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></span>';
             
        } else if ( is_author() ) {
             
            // Auhor archive
             
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
             
            // Display author name
            echo '<span class="item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></span>';
         
        } else if ( get_query_var('paged') ) {
             
            // Paginated archives
            echo '<span class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></span>';
             
        } else if ( is_search() ) {
         
            // Search results page
            echo '<span class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span></span>';
         
        } elseif (  taxonomy_exists('grupos') || taxonomy_exists('fabricantes') ) {
            //var_dump($obj);
            $tax = get_taxonomy( $obj->taxonomy );
            //var_dump($tax);

            echo '<span>Produtos</span>';
            echo '<i class="separator"> ' . $separator . ' </i>';
            echo '<span>'. ucwords($tax->name) .'</span>';
            echo '<i class="separator"> ' . $separator . ' </i>';
            echo '<span>'. ucwords($obj->name) .'</span>';

        } elseif ( is_404() ) {
             
            // 404 page
            echo '<span>' . 'Error 404' . '</span>';
        }
         
    }
     
}
?>