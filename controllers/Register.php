<?php

class Register extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        if (Session::get('logged_in') === TRUE) {
            $this->view->render('login/portfolio');
            return FALSE;
        }
        $this->view->render('register/index');
    } 
    
    public function run() {
        
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmation'])) {
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmation'])) {
                if ($_POST['password'] === $_POST['confirmation']) {
                    $query = $this->model->register();
                    if ($query) {
                        $this->view->render('register/success');
                    } else {
                        $data['message'] = 'Username already taken, please try again!';
                        $this->view->render('templates/notice', $data);
                        return FALSE;
                    }
                } else {
                    $data['message'] = 'Passwords did not match, please try again!';
                    $this->view->render('templates/notice', $data);
                    return FALSE;
                }
            } else {
                $this->view->render('register/index');
                return FALSE;
            }
        } else {
            $this->view->render('register/index');
            return FALSE;
        }
    }
}
