<?php
/**
 * Checking we have Composer installed, and what version.
 */

namespace Craft\Config\Check;

class Composer{
     
    public $composer_version;

    public $composer_is_installed;

    public function __construct() {
        $this->composer_is_installed = $this->is_installed();
        if ( $this->composer_is_installed === true ) {
            $this->composer_version = $this->version();
        }
        echo $this->composer_version;
    }

    public function is_installed() {
        if( shell_exec( 'which composer' ) ){
            return true;
        } else {
            return false;
        };
    }

    public function version(){
        if( shell_exec( 'composer -v' ) ){
            return shell_exec( 'composer -v' );
        } else {
            echo 'Composer not installed, or cant get version?';
            die;
        };
    }
}