<?php

namespace Craft\Config\Create;

class XmlConfig{

    public $config_location;

    public function __construct( $location ){
        $this->config_location = $location;
        $this->message();
    }

    public function message(){
        echo "Ok, lets create a new config file\n";
        echo "Is this ok? (Y/n)\n";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if ( trim( $line ) != "Y" ){
            echo "No worries!\n";
            exit;
        }
        echo "\n";
        echo "Cool, lets get this working...";
        $this->create_config();
    }

    public function create_config(){
        $txt = "<?xml version=\"1.0\"?>\n";
        $txt .= "<craft>\n";
        $txt .= "\t<source>\n";
        echo "Location of model folder? ('./src/model/') : ";
        $get_model = fopen ("php://stdin","r");
        $model = fgets($get_model);
        $model = trim(preg_replace('/\s\s+/', ' ', $model));
        $txt .= "\t\t<model location='$model'/>\n";
        echo "Location of view folder? ('./src/view/') : ";
        $get_view = fopen ("php://stdin","r");
        $view = fgets($get_view);
        $view = trim(preg_replace('/\s\s+/', ' ', $view));
        $txt .= "\t\t<view location='$view'/>\n";
        echo "Location of controller folder? ('./src/controller/') : ";
        $get_controller = fopen ("php://stdin","r");
        $controller = fgets($get_controller);
        $controller = trim(preg_replace('/\s\s+/', ' ', $controller));
        $txt .= "\t\t<controller location='$controller'/>\n";
        $txt .= "\t</source>\n";
        $txt .= "</craft>\n";
        $generated_config = file_put_contents(
            $this->config_location,
            $txt.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}