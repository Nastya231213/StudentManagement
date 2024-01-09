<?php

require "app.php";
require "database.php";
require "config.php";
require "controller.php";
require "model.php";
require "helper_functions.php";

spl_autoload_register(function($class_name){
    require "../private/models/".ucfirst($class_name).".php";
});