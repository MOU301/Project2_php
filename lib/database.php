<?php 
class database{
   private $host=DB_host;
   private $db_name=DB_name;
   private $user=DB_user;
   private $pass=DB_pass;
   private $stmt;
   private $conn;
   private $error;
   
//    constractor
   public function __construct(){
    $dsn="mysql:host=".$this->host.";dbname=".$this->db_name;
    $option=array(
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION   
    );
    try{
        $this->conn=new PDO($dsn,$this->user,$this->pass,$option);
    }
    catch(PDOException $e){
        echo "thre are  connection error :".$e->getMessage();
    }
   }


   public function query($q){
    $this->stmt=$this->conn->prepare($q);
   }
   public function bind($param,$value,$type=null){
    if(is_null($type)){
        switch(true){
            case is_null($value):
               $type=PDO::PARAM_NULL;
               break;
            case is_bool($value) :
                $type=PDO::PARAM_BOOL;
                break;
            case is_int($value):
                $type=PDO::PARAM_INT;
                break;
            default :
            $type=PDO::PARAM_STR;
            }
    }
$this->stmt->bindValue($param,$value,$type);
   }
   public function execute(){
    return $this->stmt->execute();
   }
   public function ResutSet(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
   }
   public function Single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
   }
   public function rowCount(){
    $this->execute();
    return $this->stmt->rowCount();
   }
   
}


?>