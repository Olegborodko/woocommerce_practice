<?php

namespace awr\services;

use awr\models\CommonModel as CommonModel;

class CommonService {

	/* For Singleton Pattern */
    private static $_instance = null;
    private function __construct() {  
    }
 
    public static function get_instance() {
 
        if(is_null(self::$_instance)) {
            self::$_instance = new CommonService();  
        }

        return self::$_instance;
    }

    public function get_show_notifications () {
        return CommonModel::get_instance()->get_show_notifications();  
    }
    
    public function show_notifications( $show ) {
        return CommonModel::get_instance()->show_notifications( $show );
    }
    
    public function save_hidden_bloc ($bloc_id, $hidden) {
        return CommonModel::get_instance()->save_hidden_bloc ($bloc_id, $hidden);
    }
    
    public function get_hidden_blocs () {
        return CommonModel::get_instance()->get_hidden_blocs ();
    }
	
    public function get_system_infos () {
        return CommonModel::get_instance()->get_system_infos ();
    }
}