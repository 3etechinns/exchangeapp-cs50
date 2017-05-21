<?php

class Controller {

    function __construct() {
        $this->view = new View();
    }
    
    public function loadModel($name) {
        $path = "models/{$name}_model.php";
        if (file_exists($path)) {
            require "models/{$name}_model.php";
            $model_name = "{$name}_model";
            $this->model = new $model_name;
        }
    }

}

