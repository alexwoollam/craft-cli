<?php
/**
 * Checking we have Node installed, and what version.
 */

namespace Craft\Config\Check;

class Node{
     
    public $node_version;

    public $node_is_installed;

    public function __construct() {
        $this->node_is_installed = $this->check_node_is_installed();
        if ( $this->node_is_installed === true ) {
            $this->node_version = $this->check_node_version();
        }
        echo $this->node_version;
    }

    public function check_node_is_installed() {
        if( shell_exec( 'which node' ) ){
            return true;
        } else {
            return false;
        };
    }

    public function check_node_version(){
        if( shell_exec( 'node -v' ) ){
            return shell_exec( 'node -v' );
        } else {
            echo 'Node not installed, or cant get version?';
            die;
        };
    }
}