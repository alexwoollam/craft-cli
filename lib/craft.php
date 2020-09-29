<?php
/**
 * Welcome to craft, This is specific to the RBI/Proagrica MVC WordPress Framework.
 * 
 * @version 0.0.1
 */

namespace Craft;

require __DIR__ . '/../vendor/autoload.php';

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\OPTIONS;

use Craft\Make\Model;
use Craft\Make\Controller;

class Craft extends CLI {
    // Register Arguments.
    protected function setup( Options $options ) {
        $options->setHelp('Docker / Composer setup');
        $options->registerOption('version', 'print version', 'v');
        $options->registerOption('port', 'set a different port', 'p');
        
        $options->registerCommand('make:model', 'Make a model');
        $options->registerCommand('make:controller', 'Make a controller');
    }

    // Init.
    protected function main( Options $options ){
        switch ($options->getCmd()) {
            case 'make:model':
                $this->success('The make:model command was called');
                break;
            case 'make:controller':
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