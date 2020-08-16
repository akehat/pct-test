<?php

// load config
require_once('config/config.php');

// load helpers
require_once('helpers/url_helper.php');
require_once('helpers/session_helper.php');

// autoload core libraries
spl_autoload_register(function($classname){
    require_once('libraries/' . $classname . '.php');
});