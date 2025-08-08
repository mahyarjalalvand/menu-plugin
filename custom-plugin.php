<?php 
/**
 * Plugin Name: custom plugin
 * Plugin URI: http://localhost/custom-plugin
 * Description: test plugin
 * Version: 1.0
 * Author: mahyar
 * Author URI: https://example.com
 * License: GPL2
 */

//[custom_menu name="menu-1"]


 function show_custom_menu($name){
    return wp_nav_menu(array(
        'menu' => $name,
        'echo' => true,
        'container' => 'nav',
        'container_class' => 'custom_menu_container'
    ));
 }

function show_custom_menu_shortcode($atts){    
    $atts = shortcode_atts(array (
        'name' => '',
    ) , $atts);
    if(empty($atts['name'])){
        echo 'نام منو وارد نشده' ;
    }
    echo show_custom_menu($atts['name']);
}
 add_shortcode('custom_menu' , 'show_custom_menu_shortcode');
 
 function register_custom_menu_elementor_widget($widgets_manager){
        require_once plugin_dir_path(__FILE__) . 'elementor-custom-menu-widget.php'; 
            $widgets_manager->register(new \Elementor_Custom_Menu_Widget());
}

function init_elementor_custom_widget() {
    if(did_action('elementor/loaded') ){
        add_action('elementor/widgets/register' , 'register_custom_menu_elementor_widget');
    }
}

 add_action('plugins_loaded' , 'init_elementor_custom_widget');

 function render_files() {
    wp_register_style('custom-menu-widget-css', plugins_url('custom-style.css', __FILE__ ),[],'1.0.0');
    wp_register_script('custom-menu-widget-js' , plugins_url('custom-scripts.js',__FILE__ ),[],'1.0.0' , true );
 }

 add_action( 'wp_enqueue_scripts', 'render_files' );
?>