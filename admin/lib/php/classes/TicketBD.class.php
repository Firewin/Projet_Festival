<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TicketBD
 *
 * @author Effy
 */
class TicketBD {
    
    
        private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getTicket($id_fest) {
        try {
            $query = "SELECT * FROM ticket where id_f=:id_fest";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id_fest);
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
    
        public function ajoutTicket($id_f, $description, $prix, $type) {
        $retour = array();
        try {
            $query = "INSERT INTO ticket (id_f, description, prix, type) VALUES (:id_f,:description,:prix,:type)";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id_f', $id_f);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':prix', $prix);
            $sql->bindValue(':type', $type);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

    public function __toString() {
        return $this->_variable . " " . $this->_db;
    }
}
