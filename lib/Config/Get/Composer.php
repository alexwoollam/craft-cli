<?php
/**
 * Get Composer..
 */

namespace Craft\Config\Get;

class Composer {

    public $is_dep;

    public $autoload_location;

    public function __construct() {
        $this->get_folder_structure();
        $this->require_composer( $this->autoload_location );
        $this->set_global_definition();
    }

    public function get_folder_structure() {
        if ( is_dir ( 'alexwoollam/craft/lib' )   ) {
            $this->is_dep = true;
            $this->autoload_location = str_replace( '/alexwoollam/craft/lib/Config/Get', '', __DIR__ );
            $this->autoload_location .= '/autoload.php';
        } else {
            $this->is_dep = false;
            $this->autoload_location = str_replace( '/lib/Config/Get', '/vendor', __DIR__ );
            $this->autoload_location .= '/autoload.php';
        }
    }

    public function require_composer( $autoload_location ){
        if( file_exists( $autoload_location ) ) {
            require $autoload_location;
        } else {
            echo 'Could not find composer, is it installed? ';
            if ( ! null == $autoload_location ) {
                echo 'persumed location: ' . $autoload_location;
            }
            die;
        }        
    }

    public function set_global_definition() {
        define( 'CRAFT_ROOT', str_replace( '/autoload.php', '', $this->autoload_location ) );
    }
}

new Composer;