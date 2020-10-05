<?php 

namespace Craft\Make;

class Controller {

    public $controller_name;
    
    public $camel_controller_name;

    public $controller_file;
    public $controller_test_file;

    public function __construct( $name = null) {
        if ( null == $name ) {
            echo 'Sorry, controller name can\'t be blank.';
            die;
        } else {
            $this->controller_name = $name;
            $this->check_case( $name );
            $this->controller_file = CONTROLLER_SRC . '/' . $this->camel_controller_name . '.php';
            $this->controller_test_file = TESTS_SRC . '/Controller/' . $this->camel_controller_name . '-test-case.php';
            echo $this->controller_test_file;
            die;
            
            $this->check_controller_doesnt_exist();
        }
    }

    public function check_case( $name ){
        if ( strpos( $name, '-' ) !== false ) {
            $this->camel_controller_name = $this->dashesToCamelCase( $name );
            $this->check_case( $this->camel_controller_name );
        } elseif ( strpos( $name, '_' ) !== false ) {
            $this->camel_controller_name = $this->snakeToCamelCase( $name );
            $this->check_case( $this->camel_controller_name );
        } else {
            $this->camel_controller_name = $name ;
        }
    }

    public function check_controller_doesnt_exist(){
        if ( ! file_exists ( $this->controller_file ) ){
            $this->make_controller();
            $this->make_test();
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
                $this->make_test();
            }
            die;
        }
    }

    public function delete_controller(){
        unlink( $this->controller_file );
    }

    public function make_controller(){
        $txt = "<?php\n";
        $txt .= "/**\n";
        $txt .= " * $this->camel_controller_name Controller\n";
        $txt .= " *\n";
        $txt .= " * @package projectname\n";
        $txt .= " */\n";
        $txt .= "\n";
        $txt .= "namespace App\\Controller;\n";
        $txt .= "\n";
        $txt .= "class $this->camel_controller_name {\n";
        $txt .= "\n";
        $txt .= "/**\n";
        $txt .= " * Class constructor.\n";
        $txt .= " */\n";
        $txt .= "\tpublic function __construct() {\n";
        $txt .= "\n";
        $txt .= "\t}\n";
        $txt .= "\n";
        $txt .= "}\n";




        $generated_controller = file_put_contents(
            $this->controller_file,
            $txt.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }

    
    public function make_test(){
        $txt = "<?php\n";
        $txt .= "/**\n";
        $txt .= " * $this->camel_controller_name Controller\n";
        $txt .= " *\n";
        $txt .= " * @package projectname\n";
        $txt .= " */\n";
        $txt .= "\n";
        $txt .= "namespace App\\Controller;\n";
        $txt .= "\n";
        $txt .= "class $this->camel_controller_name {\n";
        $txt .= "\n";
        $txt .= "/**\n";
        $txt .= " * Class constructor.\n";
        $txt .= " */\n";
        $txt .= "\tpublic function __construct() {\n";
        $txt .= "\n";
        $txt .= "\t}\n";
        $txt .= "\n";
        $txt .= "}\n";

        $generated_tests = file_put_contents(
            $this->controller_file,
            $txt.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }

    public function dashesToCamelCase($string, $capitalizeFirstCharacter = true) {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }

    public function snakeToCamelCase($string, $capitalizeFirstCharacter = true) {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }
}
