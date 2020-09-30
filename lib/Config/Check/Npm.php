<?php
/**
 * Checking we have NPM installed, and what version.
 */

namespace Craft\Config\Check;

class NPM{
     
    public $npm_version;

    public $npm_is_installed;

    public function __construct() {
        $this->npm_is_installed = $this->check_npm_is_installed();
        if ( $this->npm_is_installed === true ) {
            $this->npm_version = $this->check_npm_version();
        }
        echo $this->npm_version;
    }

    public function check_npm_is_installed() {
        if( shell_exec( 'which npm' ) ){
            return true;
        } else {
            return false;
        };
    }

    public function check_npm_version(){
        if( shell_exec( 'npm -v' ) ){
            return shell_exec( 'npm -v' );
        } else {
            echo 'NPM not installed, or cant get version?';
            die;
        };
    }
}