<?php

namespace Craft\Config\Create;

use Craft\Config\Get\Config;

class XmlConfig{

    public $config_location;

    public function __construct( $location ){
        $this->config_location = $location;
        $this->message();
        new Config;
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
        $txt .= "\t<project\n";
        echo "Project name? ('winterfel') : ";
        $get_project_name = fopen ("php://stdin","r");
        $project_name = fgets($get_project_name);
        $project_name = trim(preg_replace('/\s\s+/', ' ', $project_name));
        $txt .= "\t\tname='$project_name'\n";
        echo "Version? : ";
        $get_project_version = fopen ("php://stdin","r");
        $project_version = fgets($get_project_version);
        $project_version = trim(preg_replace('/\s\s+/', ' ', $project_version));
        $txt .= "\t\tversion='$project_version'\n";
        echo "Author? ('Arya Stark') : ";
        $get_project_author = fopen ("php://stdin","r");
        $project_author = fgets($get_project_author);
        $project_author = trim(preg_replace('/\s\s+/', ' ', $project_author));
        $txt .= "\t\tauthor='$project_author'\n";
        $txt .= "\t/>\n";
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
        echo "Location of tests folder? (e.g. './tests/') : ";
        $get_tests = fopen ("php://stdin","r");
        $tests = fgets($get_tests);
        $tests = trim(preg_replace('/\s\s+/', ' ', $tests));
        $txt .= "\t\t<tests location='$tests'/>\n";
        $txt .= "\t</source>\n";
        $txt .= "</craft>\n";
        $generated_config = file_put_contents(
            $this->config_location,
            $txt.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}