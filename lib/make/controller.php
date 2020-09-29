<?php 

namespace Craft\Make;

class Controller {

    public $controller_name;

    public $controller_file;

    public function __construct( $name = null) {
        if ( null == $name ) {
            echo 'Sorry, controller name can\'t be blank.';
            die;
        } else {
            $this->controller_name = $name;
            $this->controller_file = CONTROLLER_SRC . '/' . $name . '.php';
            $this->check_controller_doesnt_exist();
        }
    }

    public function check_controller_doesnt_exist(){
        if ( ! file_exists ( $this->controller_file ) ){
            $this->make_controller();
        } else {
            echo "This controller already exists... overwrite? !!CAN'T BE UNDONE!!  (Y/n)";
            $handle = fopen ("php://stdin","r");
            $line = fgets($handle);
            if ( trim( $line ) != "Y" ){
                echo "Ok, lets leave it be!\n";
                exit;
            } else {
                $this->delete_controller();
                $this->make_controller();
            }
            die;
        }
    }

    public function delete_controller(){
        unlink( $this->controller_file );
    }

    public function make_controller(){
        $txt = '<?php';
        $generated_controller = file_put_contents(
            $this->controller_file,
            $txt.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}
