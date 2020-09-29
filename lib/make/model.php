<?php 

namespace Craft\Make;

class Model {
    public function __construct( $message = null) {
        if ( null == $message ) {
            echo 'Sorry, model name can\'t be blank.';
            die;
        } else {
            echo MODEL_SRC;
            return;
        }
    }
}
