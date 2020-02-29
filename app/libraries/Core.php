<?php
 /*
  * APP CORE CLASS
  * CREATES URL & LOADS CORE CONTROLLER
  * URL FORMAT - /controller/method/params
  */
  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      // print_r($this->getUrl());
      $url = $this->getUrl();
      // LOOK IN CONTROLLERS FOR FIRST VALUE
      if(isset($url[0])){ 
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
          // IF EXISTS, SET AS CONTROLLER
          $this->currentController = ucwords($url[0]);
          // UNSET 0 INDEX
          unset($url[0]);
        }
      }
      // REQUIRE THE CONTROLLER
      require_once '../app/controllers/' . $this->currentController . '.php';

      // INSTANTIATE CONTROLLER
      $this->currentController = new $this->currentController;

      // CHECK FOR SECOND PART OF URL
      if(isset($url[1])){
        // CHECK TO SEE IF METHOD EXISTS IN CONTROLLER
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          // UNSET 1 INDEX
          unset($url[1]);
        }
      }

      // GET PARAMS
      $this->params = $url ? array_values($url) : [];

      // CALL A CALLBACK WITH ARRAY OF PARAMS
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  }
  