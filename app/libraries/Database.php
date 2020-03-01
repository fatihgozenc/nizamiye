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

    // PREPARE STATEMENT WITH QUERY
    public function query($sql){
      $this->statement = $this->handler->prepare($sql);
    }

    // BIND VALUES
    public function bind($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
          break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
          break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
          break;
          default:
            $type = PDO::PARAM_STR;
        }
      }
      $this->statement->bindValue($param, $value, $type);
    }
    
    // EXECUTE THE PREPARED STATEMENT
    public function execute(){
      return $this->statement->execute();
    }

    // GET RESULT SET AS ARRAY OF OBJECTS
    public function resultSet(){
      $this->execute();
      return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // GET SINGLE RECORD AS OBJECT
    public function single(){
      $this->execute();
      return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // GET ROW COUNT
    public function rowCount(){
      return $this->statement->rowCount();
    }
  } 