<?php
  // LOAD CONFIG
  require_once 'config/config.php';
  
  // AUTOLOAD CORE LIBRARIES
  spl_autoload_register(function($classname){
    require_once 'libraries/' . $classname . '.php';
  });