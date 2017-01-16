<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommandeBD
 *
 * @author Firewin
 */
class CommandeBD {
    private $_db;
    private $_commande = array();
    private $_variable = "valeur";
    private $_infoArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }
    public function getCommande_byNum($num_com) {

        try {
            $query = "select * from commande where id_achat = :num_com";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $num_com);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_commande[] = new Commande($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_commande;
    }
    
        public function getCommande() {
        try {
            $query = "SELECT * FROM commande";
            $resultset = $this->_db->prepare($query);
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
    
            public function getCommandebyFest($titre) {
        try {
            $query = "SELECT * FROM commande where titre=:titre";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':titre', $titre);
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