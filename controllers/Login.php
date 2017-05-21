<?php

class Login extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        if (Session::get('logged_in') === TRUE) {
            $this->view->render('login/portfolio');
            return FALSE;
        }
        
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $query = $this->model->run();
                if ($query === TRUE) {
                    $data['user'] = $_POST['username'];
                    $this->view->render('templates/welcome', $data);
                } else {
                    $data['message'] = 'Wrong username/password';
                    $this->view->render('templates/notice', $data);
                    return FALSE;
                }
            } else {
                $this->view->render('index/index');
                return FALSE;
            }
        } else {
            $this->view->render('index/index');
            return FALSE;
        }
    }
}

