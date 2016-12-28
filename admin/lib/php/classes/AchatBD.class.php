<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AchatBD
 *
 * @author Effy
 */
class AchatBD {

    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($db) {
        $this->_db = $db;
    }
    public function ajoutAchat($id_cli, $id_ticket, $prix_total, $quantite) {
        $retour = array();
        try {
            $query = "select ajout_achat(:id_cli, :id_ticket, :prix_total, :quantite) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id_cli', $id_cli);
            $sql->bindValue(':id_ticket', $id_ticket);
            $sql->bindValue(':prix_total', $prix_total);
            $sql->bindValue(':quantite', $quantite);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }
}
