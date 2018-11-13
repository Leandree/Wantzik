<?php
class Session{
 
    // database connection and table name
    private $conn;
    private $table_name = "session";
 
    // object properties
    public $id;
    public $sessionName;
    public $loginSession;
    public $idUtilisateur;
 
    public function __construct($db){
        $this->conn = $db;
    }
 

    function create(){
     
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sessionName=:sessionName, loginSession=:loginSession, idUtilisateur=:idUtilisateur";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->sessionName=htmlspecialchars(strip_tags($this->sessionName));
        $this->loginSession=htmlspecialchars(strip_tags($this->loginSession));
        $this->idUtilisateur=htmlspecialchars(strip_tags($this->idUtilisateur));
     
        // bind values
        $stmt->bindParam(":sessionName", $this->sessionName);
        $stmt->bindParam(":loginSession", $this->loginSession);
        $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    // read products
       function verifLogin($keywords){
        
           // select all query
           $query = "SELECT
                       loginSession
                   FROM
                       " . $this->table_name . " 
                       WHERE loginSession = ? ";
        
           // prepare query statement
           $stmt = $this->conn->prepare($query);
        
            // sanitize
            $keywords=htmlspecialchars(strip_tags($keywords));
         
            // bind
            $stmt->bindParam(1, $keywords);
         
            // execute query
            $stmt->execute();
         
            return $stmt;
       }

        
}
?>