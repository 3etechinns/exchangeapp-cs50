<?php

class Login_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function run() {
        $query = $this->db->prepare("SELECT id, password FROM users WHERE username = :username");
        $query->execute(array(
            ':username' => $_POST['username']
        ));
        
        $count = $query->rowCount();
        if($count === 1) {
            $data = $query->fetchAll();
            $id = $data[0][0];
            $hash = $data[0][1];
        } else {
            return FALSE;
        }
        
        if (password_verify($_POST['password'], $hash)) {
            Session::set('logged_in', TRUE);
            Session::set('id', $id);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}