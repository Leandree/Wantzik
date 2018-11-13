<?php
class Commentaire{
 
    // database connection and table name
    private $conn;
    private $table_name = "commentaire";
 
    // object properties
    public $id;
    public $idUtilisateur;
    public $idSession;
    public $date;
    public $nbLike;
    public $textCom;
 
    public function __construct($db){
        $this->conn = $db;
    }
 

    function create(){
     
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    idUtilisateur=:idUtilisateur, idSession=:idSession, date=:date, nbLike=:nbLike, textCom=:textCom";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->idUtilisateur=htmlspecialchars(strip_tags($this->idUtilisateur));
        $this->idSession=htmlspecialchars(strip_tags($this->idSession));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->nbLike=htmlspecialchars(strip_tags($this->nbLike));
        $this->textCom=htmlspecialchars(strip_tags($this->textCom));
     
        // bind values
        $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);
        $stmt->bindParam(":idSession", $this->idSession);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":nbLike", $this->nbLike);
        $stmt->bindParam(":textCom", $this->textCom);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

        
}
?>