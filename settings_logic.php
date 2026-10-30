<?php

class Settingscard{
    public static $op;

    public function __construct()
    {
        self::$op = get_option( 'bs_card_options' );
        add_action('admin_init',array($this,'initializing_admin'));
    }

    public function initializing_admin(){
        register_setting( 'card_group', 'bs_card_options',array($this,'validation_func'));
        add_settings_section(
            'bs_card_main_section',
            'Usage Instructions',
            null,
            'card_pg_1'
        );

        add_settings_section(
            'bs_card_secondary_section1',
            'Plugin Options',
            null,
            'card_pg_2'
        );

        add_settings_field(
            'short_code_1',
            'Short Code',
            array($this,'shortcode_call'),
            'card_pg_1',
            'bs_card_main_section'
        );

        add_settings_field(
            'display_type',
            'Number of Columns per row',
            array($this,'display_type'),
            'card_pg_2',
            'bs_card_secondary_section1'
        );

        add_settings_field(
            'num_cards',
            'Number of Cards',
            array($this,'num_of_cards'),
            'card_pg_2',
            'bs_card_secondary_section1'
        );

        add_settings_field(
            'short_info',
            'Display Shortinfo',
            array($this,'toggle_info'),
            'card_pg_2',
            'bs_card_secondary_section1'
        );

        add_settings_field(
            'bg_color',
            'Background color',
            array($this,'change_bg'),
            'card_pg_2',
            'bs_card_secondary_section1'
        );


    }

    public function shortcode_call(){
        ?>
            <span> Write the shortcode [bs_card] to display it.</span>
        <?php
    }

    public function toggle_info(){
        ?>

            <input 
            type="checkbox" 
            name="bs_card_options[short_info]" 
            id="short_info"
            class=""
            value="1"
            <?php
            if (isset(self::$op['short_info'])){
                checked("1",self::$op['short_info'],true);
            }
            ?>
            
            >
            <label for="short_info">Display Short Info in Card</label>
        <?php
    }

    public function display_type(){
        ?>
            <input type="number" name="bs_card_options[display_type]" id="display_type" class="" value="<?php echo isset(self::$op['display_type'])? esc_attr(self::$op['display_type']) : '';?>">

        <?php
    }

    public function change_bg(){
        $bg_color = isset(self::$op['bg_color']) ? self::$op['bg_color'] : '#FFFFFF';
        ?>
            <label for="bg_color">Background Color</label>
            <input type="color" name="bs_card_options[bg_color]" id="bg_color" class="" value="<?php echo esc_attr($bg_color);?>">
        <?php
    }

    public function num_of_cards(){
        ?>
            <input type="number" name="bs_card_options[num_cards]" id="num_cards" class="" value="<?php echo isset(self::$op['num_cards'])? esc_attr(self::$op['num_cards']) : '';?>">
        <?php
    }



    public function validate_func($args){
        $args_from_input = array(); 
        foreach( (array) $args as $a => $b ){
            switch($a){
                case 'short_info':
                    $args_from_input[$a] = absint($b);
                break;
                case 'display_type':
                    $args_from_input[$a] = absint($b);
                break;
                case 'bg_color':
                    $args_from_input[$a] = sanitize_hex_color($b);
                break;
                case 'num_cards':
                    $args_from_input[$a] = absint($b);
                break;  
                default:
                    $args_from_input[$a] = sanitize_text_field($b);
                break;    
        }
        
    }
    return $args_from_input;
}
}