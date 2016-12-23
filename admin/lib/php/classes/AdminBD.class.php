<?php

class AdminBD extends Admin {

    private $_db;
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    function isAdmin($login,$password) {
        $retour=array();
        try {
            $query="select verifier_connexion(:nom_user,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':nom_user',$_POST['login']);
            $sql->bindValue(':password',$_POST['password']);  
            $sql->execute();
            //2 manières et 2 récup. différentes de la valeur
            //$retour[] = $sql->fetchAll(PDO::FETCH_ASSOC); // récupérer : print $auth[0][0]['verifier_connexion'];  
            $retour = $sql->fetchColumn(0);     
        } catch(PDOException $e) {
            print "Echec de la requ&ecirc;te.".$e;
        }
        return $retour;
    }
}
