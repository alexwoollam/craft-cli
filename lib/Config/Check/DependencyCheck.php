<?php
/**
 * Dependency checker.
 */

namespace Craft\Config\Check;

class DependencyCheck{
    
    public function composer(){
        $check = new Composer;
        $check->is_installed();
    }

    public function composer_version(){
        $check = new Composer;
        $check->version();
    }

    public function docker(){
        $check = new Docker;
        $check->is_installed();
    }

    public function docker_version(){
        $check = new Docker;
        $check->version();
    }

    public function docker_compose(){
        $check = new DockerCompose;
        $check->is_installed();
    }

    public function docker_compose_version(){
        $check = new DockerCompose;
        $check->version();
    }

    public function node(){
        $check = new Node;
        $check->is_installed();
    }

    public function node_version(){
        $check = new Node;
        $check->version();
    }

    public function npm(){
        $check = new NPM;
        $check->is_installed();
    }

    public function npm_version(){
        $check = new NPM;
        $check->version();
    }


}