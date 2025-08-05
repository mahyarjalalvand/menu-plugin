<?php 
if( ! defined("ABSPATH") ) exit; 
class Elementor_Custom_Menu_Widget extends \Elementor\Widget_Base{
    public function get_name(){
        return 'custom_menu_widget';
    }
    public function get_title(){
        return 'Custom Menu';
    }
    public function get_icon(){
        return 'eicon-menu-bar';
    }
    public function get_categories(){
        return ['basic'];
    }
    protected function _register_controls(){
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'تنظیمات منو',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $menus = wp_get_nav_menus();
        $menu_options =[];

        foreach ($menus as $menu) {
            $menu_options[$menu->slug]= $menu->name;
        }


        $this->add_control(
            'menu_name',
            [
                'label' => 'نام منو',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => !empty($menu_options) ? array_key_first($menu_options) : '' ,
                'placeholder' => !empty($menu_options) ? '' : 'هیج منویی یافت نشد!' ,
            ]
        );
        $this->end_controls_section();
    }
    protected function render(){
        $settings = $this->get_settings_for_display();
        $menu_name = $settings['menu_name'];
        if(!empty($menu_name)){
            echo wp_nav_menu([
                'menu' => $menu_name,
                'echo' => false , 
                'container' => 'nav',
                'container_class' => 'custom_menu_container',
            ]);

        }else{
            echo 'نام منو وارد نشده';
        }
    }
}
?>