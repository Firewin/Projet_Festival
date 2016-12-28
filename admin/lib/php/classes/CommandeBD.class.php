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

    public function __construct($cnx) {
        $this->_db = $cnx;
    }
    public function getLastCommande() {

        try {
            $query = "select * from commande where id_achat = (Select max(id_achat) from commande)";
            $resultset = $this->_db->prepare($query);
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
}