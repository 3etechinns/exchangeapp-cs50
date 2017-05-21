<?php

class Index extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        if(Session::get('logged_in') === TRUE) {
            $this->view->render('login/portfolio');
        } else {
            $this->view->render('index/index');
        }
    }
    
    public function logout() {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
        
        //redirect
        header('Location: '.URL);
    }
}
