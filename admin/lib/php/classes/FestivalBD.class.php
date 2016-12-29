<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FestivalBD
 *
 * @author Effy
 */
class FestivalBD extends Festival {

    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getFestival() {
        try {
            $query = "SELECT * FROM festival";
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

    public function getFestivalbyPays($pays) {
        try {
            $query = "SELECT * FROM festival where pays=:pays";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $pays);
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

    public function getFestivalbyID($id) {
        try {
            $query = "SELECT * FROM festival where id_fest=:id";
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

    public function getPays() {
        try {
            $query = "SELECT DISTINCT pays FROM festival";
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

    public function updateFestival($id_fest, $titre, $pays, $date, $description, $image) {
        $retour = array();
        try {
            $query = "select update_festival(:id_fest,:titre,:pays,:date,:description,:image) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id_fest', $id_fest);
            $sql->bindValue(':titre', $titre);
            $sql->bindValue(':pays', $pays);
            $sql->bindValue(':date', $date);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':image', $image);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

    public function deleteFestival($id_fest) {
        $retour = array();
        try {
            $query = "select delete_festival(:id_fest) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id_fest', $id_fest);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

    public function ajoutFestival($titre, $pays, $date_f, $description, $image_f) {
        $retour = array();
        try {
            $query = "select ajout_festival(:titre, :pays, :date_f, :description, :image_f) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':titre', $titre);
            $sql->bindValue(':pays', $pays);
            $sql->bindValue(':date_f', $date_f);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':image_f', $image_f);
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
