<?php

/*  Default fonts
/*-------------------*/
    
    function globax_enovathemes_fonts_url() {
        $font_url = '';
        if ( 'off' !== _x( 'on', 'Google font: on or off', 'globax' ) ) {
            $font_url = add_query_arg( 'family', urlencode( 'Montserrat:400,500,600,700|Roboto:400,500,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
        }
        return $font_url;
    }

/*  Enovathemes title
/*-------------------*/

    add_filter( 'wp_title', 'globax_enovathemes_filter_wp_title' );
    function globax_enovathemes_filter_wp_title( $title ) {
        global $page, $paged;

        if ( is_feed() ){
            return $title;
        }
            
        $site_description = get_bloginfo( 'description' );

        $filtered_title = $title . get_bloginfo( 'name' );
        $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
        $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( esc_html__( 'Page %s', 'globax'), max( $paged, $page ) ) : '';

        return $filtered_title;
    }

/*  Post format chat
/*-------------------*/

    function globax_enovathemes_post_chat_format($content) {
        global $post;
        if (has_post_format('chat')) {
            $chatoutput = "<ul class=\"chat\">\n";
            $split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);

            foreach($split as $haystack) {
                if (strpos($haystack, ":")) {
                    $string = explode(":", trim($haystack), 2);
                    $who = strip_tags(trim($string[0]));
                    $what = strip_tags(trim($string[1]));
                    $row_class = empty($row_class)? " class=\"chat-highlight\"" : "";
                    $chatoutput = $chatoutput . "<li><span class='name'>$who:</span><p>$what</p></li>\n";
                } else {
                    $chatoutput = $chatoutput . $haystack . "\n";
                }
            }

            $content = $chatoutput . "</ul>\n";
            return $content;
        } else { 
            return $content;
        }
    }
    add_filter( "the_content", "globax_enovathemes_post_chat_format", 9);

/*  Get the widget
/*-------------------*/

    if( !function_exists('globax_enovathemes_get_the_widget') ){
  
        function globax_enovathemes_get_the_widget( $widget, $instance = '', $args = '' ){
            ob_start();
            the_widget($widget, $instance, $args);
            return ob_get_clean();
        }
        
    }

/*  Modify img tags
/*-------------------*/

    function globax_enovathemes_modify_product_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
        
        if ('product' == get_post_type($post_id)) {
            $src  = wp_get_attachment_image_src($post_thumbnail_id, $size);
            $html = '<div class="image-container"><div class="image-preloader"></div><img src="' . $src[0] . '" /></div>';
        }

        return $html;

    }
    add_filter('post_thumbnail_html', 'globax_enovathemes_modify_product_thumbnail_html', 99, 5);

/*  Post image overlay
/*-------------------*/

    function globax_enovathemes_post_image_overlay($post_id){

        $output = '';

        $output .='<div class="post-image-overlay">';
            $output .='<a class="overlay-read-more" href="'.get_the_permalink($post_id).'" title="'.esc_attr__("Read more about", 'globax').' '.esc_attr(get_the_title($post_id)).'"></a>';
        $output .='</div>';

        return $output;
    }

/*  Project image overlay
/*-------------------*/

    function globax_enovathemes_project_image_overlay($post_id, $project_post_layout){

        $values              = get_post_custom( get_the_ID() );
        $project_link        = isset( $values['project_link'][0] ) ? $values["project_link"][0] : "";
        $project_link_active = isset( $values['project_link_active'][0] ) ? $values["project_link_active"][0] : "false";

        $output = '';

        $output .='<div class="post-image-overlay">';
            
            $output .='<div class="post-image-overlay-content">';
                $output .='<a class="overlay-read-more" href="'.get_the_permalink($post_id).'" title="'.esc_attr__("Read more about", "globax").' '.esc_attr(get_the_title($post_id)).'"></a>';
                if (has_post_thumbnail()){
                    $project_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "full" );
                }
                if ( '' != the_title_attribute( 'echo=0' ) && $project_post_layout == "project-with-overlay"){
                     $output .='<h4 class="post-title">';

                        if ($project_link_active == "true") {
                            if (!empty($project_link)){
                                $output .='<a href="'.esc_url($project_link).'" target="_blank" title="'.esc_attr__("Read more about", "globax").' '.the_title_attribute( 'echo=0' ).'" rel="bookmark">';
                                    $output .=the_title_attribute( 'echo=0' );
                                $output .='</a>';
                            } else {
                                $output .='<a href="'.get_the_permalink().'" title="'.esc_attr__("Read more about", "globax").' '.the_title_attribute( 'echo=0' ).'" rel="bookmark">';
                                     $output .=the_title_attribute( 'echo=0' );
                                $output .='</a>';
                            }
                        } else {
                            $output .='<a href="'.get_the_permalink().'" target="_blank" title="'.esc_attr__("Read more about", "globax").' '.the_title_attribute( 'echo=0' ).'" rel="bookmark">';
                                    $output .=the_title_attribute( 'echo=0' );
                            $output .='</a>';  
                        }

                     $output .='</h4>';
                }
            $output .='</div>';

        $output .='</div>';

        return $output;
    }

/*  Product image overlay
/*-------------------*/

    function globax_enovathemes_product_image_overlay($post_id){
        global $globax_enovathemes;

        $output = '';

        $output .='<div class="post-image-overlay">';
            $output .='<a class="overlay-read-more" href="'.get_the_permalink().'" title="'.esc_attr__("Go to", "globax").' '.the_title_attribute( 'echo=0' ).'"></a>';
        $output .='</div>';

        return $output;

    }

/*  Pagination
/*-------------------*/

    function globax_enovathemes_post_nav_num($class, $alignment){
        if( is_singular() ){
            return;
        }

        global $wp_query;
        $big = 999999;

        ?>

        <?php if ($class == 'project'): ?>
            <?php

                $class = 'project-navigation';

                $projects_per_page   = (isset($GLOBALS['globax_enovathemes']['project-per-page']) && !empty($GLOBALS['globax_enovathemes']['project-per-page'])) ? $GLOBALS['globax_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );
                $total = (empty($projects_per_page)) ? $wp_query->max_num_pages : ceil($wp_query->found_posts/$projects_per_page);
            
                if (is_tax()) {
                    $class .= ' tax';
                }
            ?>
            <?php if ($projects_per_page < $wp_query->found_posts): ?>
                <nav class="enovathemes-navigation <?php echo esc_attr($class); ?> <?php echo esc_attr($alignment); ?>"><?php echo paginate_links(array(
                    'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
                    'format'    => '?paged=%#%',
                    'total'     => $total,
                    'current'   => max(1, get_query_var('paged')),
                    'show_all'  => false,
                    'end_size'  => 2,
                    'mid_size'  => 3,
                    'prev_next' => true,
                    'prev_text' => '',
                    'next_text' => '',
                    'type'      => 'list'));?></nav>
            <?php endif; ?> 
        <?php elseif ($class == 'product'): ?>
            <?php

                $class = 'product-navigation';

                $products_per_page   = (isset($GLOBALS['globax_enovathemes']['product-per-page']) && !empty($GLOBALS['globax_enovathemes']['product-per-page'])) ? $GLOBALS['globax_enovathemes']['product-per-page'] : get_option( 'posts_per_page' );
                $total = (empty($products_per_page)) ? $wp_query->max_num_pages : ceil($wp_query->found_posts/$products_per_page);
            
                if (is_tax()) {
                    $class .= ' tax';
                }
            ?>
            <?php if ($products_per_page < $wp_query->found_posts): ?>
                <nav class="enovathemes-navigation <?php echo esc_attr($class); ?> <?php echo esc_attr($alignment); ?>"><?php echo paginate_links(array(
                    'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
                    'format'    => '?paged=%#%',
                    'total'     => $total,
                    'current'   => max(1, get_query_var('paged')),
                    'show_all'  => false,
                    'end_size'  => 2,
                    'mid_size'  => 3,
                    'prev_next' => true,
                    'prev_text' => '',
                    'next_text' => '',
                    'type'      => 'list'));?></nav>
            <?php endif; ?> 
        <?php else: ?>

            <?php $class = 'post-navigation'; ?>

            <nav class="enovathemes-navigation <?php echo esc_attr($class); ?> <?php echo esc_attr($alignment); ?>"><?php echo paginate_links(array(
                'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
                'format'    => '?paged=%#%',
                'total'     => $wp_query->max_num_pages,
                'current'   => max(1, get_query_var('paged')),
                'show_all'  => false,
                'end_size'  => 2,
                'mid_size'  => 3,
                'prev_next' => true,
                'prev_text' => '',
                'next_text' => '',
                'type'      => 'list'));?></nav> 
        <?php endif; ?>
        
    <?php }

/*  Simple pagination
/*-------------------*/
    
    function globax_enovathemes_post_nav($post_type,$post_id){

            global $globax_enovathemes;

            $single_nav_mob = "false";

            if ($post_type == "post") {
                $post_prev_text = esc_html__('Previous post', 'globax');
                $post_next_text = esc_html__('Next post', 'globax');
            } elseif ($post_type == "product") {
                $post_prev_text = esc_html__('Previous product', 'globax');
                $post_next_text = esc_html__('Next product', 'globax');
            }

            $prev_post = get_adjacent_post(false, '', true);
            $next_post = get_adjacent_post(false, '', false);

            
        ?>
        <nav class="post-single-navigation <?php echo esc_attr($post_type) ?> mob-hide-false et-clearfix">  
          <?php if(!empty($next_post)) {echo '<a rel="prev" href="' . get_permalink($next_post->ID) . '" title="' .esc_attr__('Go to', 'globax').' '.$next_post->post_title . '"></a>'; } ?>
          <?php if(!empty($prev_post)) {echo '<a rel="next" href="' . get_permalink($prev_post->ID) . '" title="' .esc_attr__('Go to', 'globax').' '.$prev_post->post_title . '"></a>'; } ?>
        </nav>
        <?php 
    }

/*  Excerpt
/*-------------------*/

    function globax_enovathemes_excerpt($limit) {
        
        $excerpt = get_the_excerpt();
        $limit++;

        $output = "";

        if ( mb_strlen( $excerpt ) > $limit ) {
            $subex = mb_substr( $excerpt, 0, $limit - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

            if ( $excut < 0 ) {
                $output .= mb_substr( $subex, 0, $excut );
            } else {
                $output .= $subex;
            }

            $output .= '[...]';

        } else {
            $output .= $excerpt;
        }

        return $output;
    }

/*  Not found
/*-------------------*/

    function globax_enovathemes_not_found($post_type){

        $output = '';

        $output .= '<p class="enovathemes-not-found">';

        switch ($post_type) {

            case 'gallery':
                $output .= esc_html__('No media found.', 'globax');
                break;

            case 'project':
                $output .= esc_html__('No project found.', 'globax');
                break;

            case 'products':
                $output .= esc_html__('No products found.', 'globax');
                break;

            case 'general':
                $output .= esc_html__('No search results found. Try a different search', 'globax');
                break;
            
            default:
                $output .= esc_html__('No posts found.', 'globax');
                break;
        }

        $output .= '</p>';

        return $output;
    }

/*  Hex to rgba
/*-------------------*/

    function globax_enovathemes_hex_to_rgba($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        return 'rgba('.implode(",", $hex).','.$o.')';
    }

/*  Hex to rgb shade
/*-------------------*/

    function globax_enovathemes_hex_to_rgb_shade($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        $hex[0] -= $o;
        $hex[1] -= $o;
        $hex[2] -= $o;
        return 'rgb('.implode(",", $hex).')';
    }
?>