<?php 

namespace Craft\Make;

class Model {

    public $model_name;

    public $model_file;

    public function __construct( $name = null) {
        if ( null == $name ) {
            echo 'Sorry, model name can\'t be blank.';
            die;
        } else {
            $this->model_name = $name;
            $this->model_file = MODEL_SRC . '/' . $name . '.php';
            $this->check_model_doesnt_exist();
        }
    }

    public function check_model_doesnt_exist(){
        if ( ! file_exists ( $this->model_file ) ){
            $this->make_model();
        } else {
            echo "This model already exists... overwrite? !!CAN'T BE UNDONE!!  (Y/n)";
            $handle = fopen ("php://stdin","r");
            $line = fgets($handle);
            if ( trim( $line ) != "Y" ){
                echo "Ok, lets leave it be!\n";
                exit;
            } else {
                $this->delete_model();
                $this->make_model();
            }
            die;
        }
    }

    public function delete_model(){
        unlink( $this->model_file );
    }

    public function make_model(){
        $txt = '<?php';
        $generated_model = file_put_contents(
            $this->model_file,
            $txt.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}
