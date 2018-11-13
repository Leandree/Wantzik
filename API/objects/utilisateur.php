<?php
class Utilisateur{
 
    // database connection and table name
    private $conn;
    private $table_name = "utilisateur";
 
    // object properties
    public $id;
    public $pseudo;
    public $passwd;
    public $mail;
 
    public function __construct($db){
        $this->conn = $db;
    }
 

    function create(){
     
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    pseudo=:pseudo, passwd=:passwd, mail=:mail";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->pseudo=htmlspecialchars(strip_tags($this->pseudo));
        $this->passwd=htmlspecialchars(strip_tags($this->passwd));
        $this->mail=htmlspecialchars(strip_tags($this->mail));
     
        // bind values
        $stmt->bindParam(":pseudo", $this->pseudo);
        $stmt->bindParam(":passwd", $this->passwd);
        $stmt->bindParam(":mail", $this->mail);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }


    function verifMailPasswd($mailsent, $passwdsent){
        
           // select all query
           $query = "SELECT
                       id, pseudo, mail
                   FROM
                       " . $this->table_name . " 
                       WHERE mail = ? AND passwd = ? ";
        
           // prepare query statement
           $stmt = $this->conn->prepare($query);
        
            // sanitize
            $mailsent=htmlspecialchars(strip_tags($mailsent));
            $passwdsent=htmlspecialchars(strip_tags($passwdsent));
         
            // bind
            $stmt->bindParam(1, $mailsent);
            $stmt->bindParam(2, $passwdsent);
         
            // execute query
            $stmt->execute();
         
            return $stmt;
       }


        
}
?>