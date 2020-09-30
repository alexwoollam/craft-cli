<?php
/**
 * Checking we have Docker installed, and what version.
 */

namespace Craft\Config\Check;

class Docker{
     
    public $docker_version;

    public $docker_is_installed;

    public function __construct() {
        $this->docker_is_installed = $this->check_docker_is_installed();
        if ( $this->docker_is_installed === true ) {
            $this->docker_version = $this->check_docker_version();
        }
        echo $this->docker_version;
    }

    public function check_docker_is_installed() {
        if( shell_exec( 'which docker' ) ){
            return true;
        } else {
            return false;
        };
    }

    public function check_docker_version(){
        if( shell_exec( 'docker -v' ) ){
            return shell_exec( 'docker -v' );
        } else {
            echo 'Docker not installed, or cant get version?';
            die;
        };
    }
}