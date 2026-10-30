<?php

class Shortcodeforcard{
    public function __construct()
    {
        add_shortcode('bs_card',array($this,'shortcode_logic'));
    }

    public function shortcode_logic($args = array(),$text=null,$identifier = ''){
        $args = array_change_key_case((array)$args,CASE_LOWER);
        $settings_values = get_option('bs_card_options',array());
        $card_bg_color = $settings_values['bg_color'] ?? '#FFFFFF';
        $card_toggle_info = !empty($settings_values['short_info']);
        $card_num_cards = intval($settings_values['num_cards'] ?? 2);
        $card_display_type = $settings_values['display_type'] ?? 'col-md-3';
        extract (shortcode_atts(
            array(
                'id' => '',
                'card_title' => '',
                'card_span_text' => '',
                'card_paragraph_text' => '',
                'card_button_url' => '',
                'card_button_text' => '',
                'orderby' => 'date'
            ),
            $args,
            $identifier
        ));


        $f_t = "Fallback title";
        $f_s_t = "Fallback span text";
        $f_p_t = "Fallback paragraph text";
        $f_b_url = "www.dummyurl.com";
        $f_b_t = "Fallback button text";
        $f_i = URL_PATH . 'extras/img1.jpg';

        $card_image = '';

        if (!empty($id)){
            $queries = array(
                'post_type' => 'bs_card',
                'p' => intval($id),
                'posts_per_page' => 1
            );
        }else{
            $queries = array(
            'post_type' => 'bs_card',
            'posts_per_page' => $card_num_cards,
            'orderby' => 'date',
            'order' => 'DESC'
            );
        }



        $card_list = new WP_Query($queries);

        ob_start();
        wp_enqueue_style('stylesheet_bootstrap');
        wp_enqueue_style('stylesheet_customcss');
        if ($card_list -> have_posts()):
            echo '<div class = "row g-4">';
            while ($card_list-> have_posts()):
                $card_list->the_post();
                $post_id = get_the_ID();

                if(has_post_thumbnail($post_id)){
                        $card_image = get_the_post_thumbnail_url($post_id,'large');
                    }else{
                        $card_image = $f_i;
                    }

                $title = get_post_meta($post_id, 'card_title', true);
                $span_text = get_post_meta($post_id, 'card_span_text', true);
                $paragraph_text = get_post_meta($post_id, 'card_paragraph_text', true);
                $button_url = get_post_meta($post_id, 'card_button_url', true);
                $button_text = get_post_meta($post_id, 'card_button_text', true);

                $display_title          = !empty($card_title) ? $card_title : (!empty($title) ? $title : $f_t);
                $display_span_text      = !empty($card_span_text) ? $card_span_text : (!empty($span_text) ? $span_text : $f_s_t);
                $display_paragraph_text = !empty($card_paragraph_text) ? $card_paragraph_text : (!empty($paragraph_text) ? $paragraph_text : $f_p_t);
                $display_button_url     = !empty($card_button_url) ? $card_button_url : (!empty($button_url) ? $button_url : $f_b_url);
                $display_button_text    = !empty($card_button_text) ? $card_button_text : (!empty($button_text) ? $button_text : $f_b_t);

                $card_title = $display_title;
                $card_span_text = $display_span_text;
                $card_paragraph_text = $display_paragraph_text;
                $card_button_url = $display_button_url;
                $card_button_text = $display_button_text;

                echo '<div class = "' . esc_attr($card_display_type) . '" style="flex: 0 0 auto; width: 25%;">';
                echo '<div style="width: 100%; max-width: 100%;">';
                include(FILE_PATH_CARD_PLUGIN . 'card_html.php');
                echo '</div>';
                echo '</div>';
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        endif;
        

        return ob_get_clean();
    }
}

?>