<?php 

namespace awr\utils;

define ( 'AWR_AJAX_CODE_SUCCESS', 1 );
define ( 'AWR_AJAX_CODE_FAILURE', 0 );

define ( 'AWR_AJAX_ACTION_KEEP', 'keep' );
define ( 'AWR_AJAX_ACTION_RELOAD', 'reload' );
define ( 'AWR_AJAX_ACTION_REDIRECT', 'redirect' );

class AjaxOutputter {

    private $action = AWR_AJAX_ACTION_KEEP;
    private $redirect_to = '';
    private $code = AWR_AJAX_CODE_SUCCESS;
    private $message = '';

    public function setAction ($action){
        $this->action = $action;
        return $this;
    }
    public function getAction(){
        return $this->action;
    }
    
    public function setRedirectTo ($redirect_to){
        $this->redirect_to = $redirect_to;
        return $this;
    }
    public function getRedirectTo(){
        return $this->redirect_to;
    }
    
    public function setCode ($code){
        if( $code != AWR_AJAX_CODE_SUCCESS and $code != AWR_AJAX_CODE_FAILURE)
            $code = AWR_AJAX_CODE_FAILURE;

        $this->code = $code;
        return $this;

    }
    public function getCode(){
        return $this->code;
    }
    
    public function setMessage ($message){
        $this->message = $message;
        return $this;
    }
    public function getMessage(){
        return $this->message;
    }

	
    public function generate () {

        // If no specific action is required, we keep the same page, otherwise, we reload the page or redirect to another page.
        if ( !$this->action )
            $this->action = AWR_AJAX_ACTION_KEEP;
        
        // If no specific page to redirect to, we keep the same page, otherwise, we redirect to that page.
        if ( $this->action == AWR_AJAX_ACTION_KEEP )
            $this->redirect_to = '';
        
        // If no specific page to redirect to, we redirect to the admin page.
        if ( $this->action == AWR_AJAX_ACTION_REDIRECT &&  $this->redirect_to == '')
            $this->redirect_to = admin_url();

        $output = array (

            'action'        => $this->action, // reload, redirect, keep
            'redirect_to'   => $this->redirect_to,
            'code'          => $this->code,
            'message'       => $this->message
        
        );

        if ($this->code != 1) {
            header("HTTP/1.1 400 Bad request");
            header("Content-Type: application/json");
        }

        echo json_encode($output);

        exit();
    }

}