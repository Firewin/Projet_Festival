<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientBD
 *
 * @author Effy
 */
class ClientBD {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function ajoutClient($nom, $prenom, $pays, $adresse, $email, $telephone, $password) {
        $retour = array();
        try {
            $query = "select ajout_client(:nom,:prenom,:pays,:adresse,:email,:telephone,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':nom', $nom);
            $sql->bindValue(':prenom', $prenom);
            $sql->bindValue(':pays', $pays);
            $sql->bindValue(':adresse', $adresse);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':telephone', $telephone);
            $sql->bindValue(':password', $password);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

    function isClient($login, $password) {
        $retour = array();
        try {
            $query = "select client_connexion(:email,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':email', $_POST['email']);
            $sql->bindValue(':password', $_POST['password']);
            $sql->execute();
            //2 manières et 2 récup. différentes de la valeur
            //$retour[] = $sql->fetchAll(PDO::FETCH_ASSOC); // récupérer : print $auth[0][0]['verifier_connexion'];  
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

    public function getClientbyID($id) {
        try {
            $query = "SELECT * FROM client where id_cli=:id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Festival($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

}
