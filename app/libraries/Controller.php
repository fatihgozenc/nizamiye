<?php
  /*
   * BASE CONTROLLER
   * LOADS THE MODELS AND VIEWS
   */
  class Controller {
    // LOAD MODEL
    public function model($model){
      // REQUIRE MODEL FILE
      require_once '../app/models/' . $model . '.php';

      // INSTANTIATE MODEL
      return new $model();
    }

    // LOAD VIEW
    public function view($view, $data = []){
      // CHECK VIEW FILE
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        die('View does not exist.');
      }
    }
  }