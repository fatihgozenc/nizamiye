<?php
  /*
   * PDO DATABASE CLASS
   * CONNECT TO DATABASE
   * CREATE PREPARED STATEMENTS
   * BIND VALUES
   * RETURN ROWS AND RESULTS
   */
  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;

    private $handler;
    private $statement;
    private $error;

    public function __construct(){
      // SET DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;
      $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ];

      // CREATE PDO INSTANCE
      try {
        $this->handler = new PDO($dsn, $this->user, $this->pass, $options);
      } catch(PDOException $err){
        $this->error = $err->getMessage();
        echo $this->error;
      }
    }
  } 