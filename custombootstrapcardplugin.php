<?php

/* 
Plugin Name: Bootstrap card
Plugin URI: localhost
Description: This is a plugin for Bootstrap Card Layout that can be used with predefined number of cards in a single row and others. 
Version: 1.0
Author: Karthick M
Author URI: https://karthickfreelancing.com/
*/

if ( ! defined( 'ABSPATH' )){
    die('This acts as a plugin, please visit the plugins in dashboard to use this.');
}

class Plugin{

    private $file_call_variable;
    function __construct($file_path)
    {

        
        $this->file_call_variable = $file_path;
        $this->constants();
        $this->depends();
        register_activation_hook($this->file_call_variable,array($this,'start'));
        register_deactivation_hook($this->file_call_variable,array($this,'stop'));
        add_action('admin_menu',array($this,'side_menu'));
        add_action('wp_enqueue_scripts',array($this,'css_register'));
        require_once( FILE_PATH_CARD_PLUGIN . 'settings_logic.php' );
        require_once( FILE_PATH_CARD_PLUGIN . 'shortcodes.php' );
        $settings_obj = new Settingscard();
        $shortcodes_obj = new Shortcodeforcard();
    }

    private function depends(){
        require_once(FILE_PATH_CARD_PLUGIN . 'card.php');
        $post = new Card();
    }
    public function constants()
    {
        define('FILE_PATH_CARD_PLUGIN', plugin_dir_path($this->file_call_variable));
        define('URL_PATH',plugin_dir_url($this->file_call_variable));
    }

    public function start(){    
        flush_rewrite_rules(false);
        
    }

    public function stop(){
        flush_rewrite_rules(false);
        unregister_post_type('bs_card');
    }

    public function side_menu(){
        add_menu_page(
            'All options',
            'Settings_BS_Card',
            'manage_options',
            'admin_menu_bs_card',
            array($this,'settings_page'),
            'dashicons-table-row-before',
            5
        );

        add_submenu_page(
            'admin_menu_bs_card',
            'Add Bootstrap Card',
            'Add Bootstrap Card',
            'manage_options',
            'edit.php?post_type=bs_card',
            null,
        );

        add_submenu_page(
            'admin_menu_bs_card',
            'Add New Post',
            'Add New Post',
            'manage_options',
            'edit.php?post-new.php?post_type=bs_card',
            null,
        );
    }

    public function settings_page(){
        if ( ! current_user_can('manage_options') ){
            return ;
        }

        if( isset( $_GET['settings-updated'] )){
            add_settings_error('bs_card_options','bs_card_message','Settings Saved','success');
        }
        settings_errors('bs_card_options');
        require(FILE_PATH_CARD_PLUGIN . 'settings_plugin_html.php');
    }

    
    public function css_register(){
        wp_register_style('stylesheet_bootstrap',URL_PATH . 'extras/bootstrap.min.css',array(),'1.0','all');
        wp_register_style('stylesheet_customcss',URL_PATH . 'extras/customcss.css',array(),'1.0','all');
    }
}

$test = new Plugin(__FILE__);
