<?php
/**
 * Checking we have Docker-Compose installed, and what version.
 */

namespace Craft\Config\Check;

class DockerCompose{
     
    public $docker_compose_version;

    public $docker_compose_is_installed;

    public function __construct() {
        $this->docker_compose_is_installed = $this->check_docker_compose_is_installed();
        if ( $this->docker_compose_is_installed === true ) {
            $this->docker_compose_version = $this->check_docker_compose_version();
        }
        echo $this->docker_compose_version;
    }

    public function check_docker_compose_is_installed() {
        if( shell_exec( 'which docker-compose' ) ){
            return true;
        } else {
            return false;
        };
    }

    public function check_docker_compose_version(){
        if( shell_exec( 'docker-compose -v' ) ){
            return shell_exec( 'docker-compose -v' );
        } else {
            echo 'Docker-Compose not installed, or cant get version?';
            die;
        };
    }
}