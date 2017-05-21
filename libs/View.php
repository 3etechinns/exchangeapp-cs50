<?php

class View {

    public function render($file_path, array $data = array()) {
        extract($data);
        require 'views/templates/header.php';
        require "views/$file_path.php";
        require 'views/templates/footer.php';
    }

}

