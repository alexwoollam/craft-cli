<?php

namespace Craft\Config\Get;

use Craft\Config\Create\XmlConfig;

class Config {

    public $config;

    public $model_src;
    public $view_src;
    public $controller_src;

    public function __construct(){
        
        $this->config = str_replace( 'vendor', '', CRAFT_ROOT );
        $this->config .= 'craft.xml';

        $this->check_config_exists();
        
    }

    public function check_config_exists(){
        if ( file_exists( $this->config ) ){
            $this->get_config_settings();
            $this->set_config_global();
        } else {
            echo 'The config file \'craft.xml\' does not exist. please create one at the root dir of your project.';
            new XmlConfig( $this->config );
        }
    }

    public function get_config_settings(){
        
        $xml = file_get_contents( $this->config );
        $settings = new \SimpleXMLElement($xml);
        
        foreach( $settings->source->model->attributes() as $location ){
            $this->model_src = $location;
        };
        foreach( $settings->source->view->attributes() as $location ){
            $this->view_src = $location;
        };
        foreach( $settings->source->controller->attributes() as $location ){
            $this->controller_src = $location;
        };
        foreach( $settings->source->tests->attributes() as $location ){
            $this->tests_src = $location;
        };

    }

    public function set_config_global(){
        define( 'MODEL_SRC', $this->model_src );
        define( 'VIEW_SRC', $this->view_src );
        define( 'CONTROLLER_SRC', $this->controller_src );
        define( 'TESTS_SRC', $this->tests_src );
    }
}