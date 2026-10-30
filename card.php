<?php

class Card{
    function __construct()
    {
        add_action('init',array($this,'create_card'));
        add_action('add_meta_boxes',array($this, 'add_db_data'));
        add_action('save_post',array($this,'save_data_db'));
    }

    public function create_card(){
        register_post_type('bs_card',array(
                'label' => 'Add Bootstrap Card',
                'description' => 'Card for usage',
                'public' => true,
                'supports' => array('title','editor','thumbnail'),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => false,
                'menu_position' => 20,
                'show_in_admin_bar' => false,
                'show_in_nav_menus' => false,
                'can_export' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-table-row-before',
                // 'register_meta_box_cb' => array($this, 'fetch_metadata')
        )
        );
        
    }

    public function add_db_data(){
        add_meta_box(
            'css_id_meta_box',
            'Short Info',
            array($this,'inner_metadata'),
            'bs_card',
            'side',
            'high',

        );
    }

    public function inner_metadata( $post ){

        $post_id = $post->ID;
        require FILE_PATH_CARD_PLUGIN . 'table.php';
    }

    public function save_data_db( $id ){
        if ( get_post_type( $id ) !== 'bs_card' ) {
        return;
    }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        {
        return;
        }

        if (!isset($_POST['bs_card_nonce']) || !wp_verify_nonce($_POST['bs_card_nonce'], 'save_bs_card_action')) {
            return;
        }

        if ( wp_is_post_revision( $id ) || wp_is_post_autosave( $id ) ) {
        return;
        }

        if ( isset($_POST['card_title']) && isset($_POST['card_span_text']) && isset($_POST['card_paragraph_text']) && isset($_POST['card_button_url']) && isset($_POST['card_button_text'])) {
            $l_t = sanitize_text_field($_POST['card_title']);
            $s_t = sanitize_text_field($_POST['card_span_text']);
            $p_t = sanitize_text_field($_POST['card_paragraph_text']);
            $u_t = esc_url($_POST['card_button_url']);
            $b_t = sanitize_text_field($_POST['card_button_text']);

           
            update_post_meta($id,'card_title',$l_t);
            

           
            update_post_meta($id,'card_span_text',$s_t);
            

          
            update_post_meta($id,'card_paragraph_text',$p_t);
            

            
            update_post_meta($id,'card_button_url',$u_t);
            


            update_post_meta($id,'card_button_text',$b_t);
            

            
        }
    }
}

   

?>