<?php

class Register_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function register() {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = $this->db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $query->execute(array(
            ':username' => $username,
            ':password' => $password
        ));
        if ($query->rowCount() === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

}

