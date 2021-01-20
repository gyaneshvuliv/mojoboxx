<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class et_scm_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
      {
           globax_enovathemes_global_variables();
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = $data_attr = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           if (! empty( $item->backimg )) {
              $data_attr   .= ' data-mmb="'.esc_url($item->backimg) . '"';
           }

           if (! empty( $item->megamenu )) {
              $data_attr   .= ' data-mm="'.esc_attr($item->megamenu) . '"';
           }

           if (! empty( $item->megamenucol )) {
              $data_attr   .= ' data-mmc="'.esc_attr($item->megamenucol) . '"';
           }

           if (! empty( $item->megamenuwidth )) {
              $data_attr   .= ' data-mmw="'.esc_attr($item->megamenuwidth) . '"';
           }


           // Button styles

            $button_styles      = '';
            $button_styles_data = '';

            if ($item->button == 'true') {

              $data_attr   .= ' data-button="true"';

              if (! empty( $item->buttonradius )) {
                $button_styles .= 'border-radius:'.$item->buttonradius.'px;';
                $button_styles_data .= 'border-radius:'.$item->buttonradius.'px;';
              }

              if (! empty( $item->buttontext )) {
                $button_styles .= 'color:'.$item->buttontext.' !important;';
              }

              if (! empty( $item->buttonback )) {
                $button_styles .= 'background-color:'.$item->buttonback.' !important;';
              } else {
                $button_styles .= 'background-color:transparent !important;';
              }

              if (! empty( $item->buttonborder )) {
                $button_styles .= 'box-shadow:inset 0 0 0 2px '.$item->buttonborder.' !important;';
              } else {
                $button_styles .= 'box-shadow:none !important;';
              }

              if (! empty( $item->buttontexthov )) {
                $button_styles_data .= 'color:'.$item->buttontexthov.' !important;';
              }

              if (! empty( $item->buttonbackhov )) {
                $button_styles_data .= 'background-color:'.$item->buttonbackhov.' !important;';
              } else {
                $button_styles_data .= 'background-color:transparent !important;';
              }

              if (! empty( $item->buttonborderhov )) {
                $button_styles_data .= 'box-shadow:inset 0 0 0 2px '.$item->buttonborderhov.' !important;';
              } else {
                $button_styles_data .= 'box-shadow:none !important;';
              }

            }


           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .' '.$data_attr.'>';

           $attributes  = ! empty( $item->attr_title )   ? ' title="'.esc_attr($item->attr_title).'"' : '';
           $attributes .= ! empty( $item->target )       ? ' target="'.esc_attr($item->target).'"' : '';
           $attributes .= ! empty( $item->xfn )          ? ' rel="'.esc_attr($item->xfn).'"' : '';
           $attributes .= ! empty( $item->url )          ? ' href="'.esc_url($item->url).'"' : '';
           $attributes .= ! empty( $button_styles )      ? ' style="'.esc_attr($button_styles).'"' : '';
           $attributes .= ! empty( $button_styles_data ) ? ' data-hover="'.esc_attr($button_styles_data).'"' : '';
           $attributes .= ($item->button == 'true')      ? ' class="menu-item-button"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
	           $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
              $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
              if (! empty( $item->ltext )) {

                $label_color = (! empty( $item->lcolor )) ? esc_attr($item->lcolor) : "#fd8c40"; 
                $item_output .= '<span class="label" data-labelc="'.$label_color.'" style="background-color:'.$label_color.'">';
                  $item_output .= esc_attr($item->ltext);
                $item_output .= '</span>';

              }

              if (! empty( $item->icon )) {
                $item_output .= '<span class="'.esc_attr($item->icon).'"></span>';
              }

              $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}