<?php
Session::init();
require 'config.php';    
require 'helpers/helpers.php';    

function __autoload($class) {
    require "libs/$class.php";
}

$application = new Application();
