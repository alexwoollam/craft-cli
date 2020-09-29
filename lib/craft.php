<?php
/**
 * Welcome to craft, This is specific to the RBI/Proagrica MVC WordPress Framework.
 * 
 * @version 0.0.1
 */

namespace Craft;

include_once( __DIR__ . '/Config/Get/Composer.php' );

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\OPTIONS;

use Craft\Config\Get\Config;
use Craft\Make\Model;
use Craft\Make\Controller;

class Craft extends CLI {

    // Register Arguments.
    protected function setup( Options $options ) {

        new Config;

        $options->setHelp('¬¬¬¬¬¬¬¬¬¬ CRAFT v0.0.1 ¬¬¬¬¬¬¬¬¬¬');

        $options->registerOption('version', 'print version', 'v');
        $options->registerOption('port', 'set a different port', 'p');
        
        $options->registerCommand('start', 'Start the server');
        $options->registerCommand('install', 'Install the server');
        $options->registerCommand('make:model', 'Make a model');
        $options->registerArgument('model_name', 'Name of the model', true, 'make:model');
        $options->registerCommand('make:controller', 'Make a controller');
    }

    // Init.
    protected function main( Options $options ){
        switch ($options->getCmd()) {
            case 'make:model':
                $model_name = $options->getArgs();
                new Model( $model_name[0] );
                $this->success('The model \'' . $model_name[0] . '\' was created.');
                break;
            case 'make:controller':
                new Controller;
                $this->success('The make:controller command was called');
                break;
            default:
                $this->error('No known command was called, we show the default help instead:');
                echo $options->help();
                exit;
        }
    }
}

$cli = new Craft;
$cli->run();