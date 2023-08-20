<?php 

namespace awr\endpoints;

use awr\utils\AjaxOutputter as AjaxOutputter;
use awr\services\CommonService as CommonService;

/*if (class_exists('CommonController')) {
    exit(0);
}*/

class CommonController extends AbstractController {

    /* For Singleton Pattern */
    private static $_instance = null;
    private function __construct() {  
    }
 
    public static function get_instance() {
 
        if(is_null(self::$_instance)) {
            self::$_instance = new CommonController();  
        }

        return self::$_instance;
    }

    public function change_nav_menu () {

        $this->check();

        if ( ! isset( $_REQUEST['nav_anchor'] ) || empty( $_REQUEST['nav_anchor'] ) ) {
            return;
        }

        $nav_anchor = $_REQUEST['nav_anchor'];

        $_SESSION['nav_anchor'] = $nav_anchor;

        //var_dump($_SESSION);


        (new AjaxOutputter())
                    ->setCode(1)
                    ->setAction('keep')
                    ->setMessage('ok')
                    ->generate();
    }

    public function save_hidden_bloc () {

        $this->check();

        //echo $_REQUEST['bloc_id'];
        //echo $_REQUEST['hidden'];

        if ( ! isset( $_REQUEST['bloc_id'] ) || empty( $_REQUEST['bloc_id'] ) ) {
            return;
        }
        if ( ! isset( $_REQUEST['hidden'] ) ) {
            return;
        }

        $bloc_id    = $_REQUEST['bloc_id'];
        $hidden     = $_REQUEST['hidden'];

        //echo 'ok';

        CommonService::get_instance()->save_hidden_bloc( $bloc_id, $hidden);

        (new AjaxOutputter())
                    ->setCode(1)
                    ->setAction('keep')
                    ->setMessage('ok')
                    ->generate();

        wp_die();
    }

    public function show_notifications () {

        $this->check();

        // On : 1/0
        $show = $_REQUEST["show"];

        CommonService::get_instance()->show_notifications( $show );
        echo 1;
        
        wp_die();

    }

    public function run () {

        $this->check();

        //
    }

    public function get_system_infos () {

        $this->check();

        $array = CommonService::get_instance()->get_system_infos();

        $output = '<table id="awr-system-infos">';
        foreach ( $array as $title => $infos ) {

            $output .= '<tr><th colspan="2">' . $title . '</th></tr>';
            
            foreach ( $infos as $key => $value ) {

                $output .= '<tr><td>' . $key . '</td><td>';

                if ( is_array ($value) ) {
                    
                    $output .= '<ul>';

                    foreach ( $value as $item ) {
                        $output .= '<li>' . $item . '</li>';
                    }

                    $output .= '</ul>';
                } else {
                    $output .= $value;
                }

                $output .= '</td></tr>';
            }

        }

        $output .= '</table>';

        echo $output;
        
        wp_die();

    }

}