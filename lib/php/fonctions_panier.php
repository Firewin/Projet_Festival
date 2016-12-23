<?php

function creationPanier() {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = null;
    }
    return true;
}

function ajouterArticle($id_fest) {

    if (creationPanier()) {
        if ($_SESSION['panier'] != $id_fest) {
            $_SESSION['panier'] = $id_fest;
        }
    } else {
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }
}

