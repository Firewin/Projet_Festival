<?php/*
include ('./adm_liste_include.php');
include ('./admin/lib/php/adm_liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);
$com = new CommandeBD($cnx);
$_commande = $com->getLastCommande();
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, utf8_decode('Numéro de commande :'.$_commande[0]->id_achat), 0, 1);
$pdf->Ln(20);
$pdf->Cell(0, 10, utf8_decode('Vos informations'), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Nom : '.$_commande[0]->nom), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Prenom : '.$_commande[0]->prenom), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Email : '.$_commande[0]->email), 0, 1);
$pdf->Ln(20);
$pdf->Cell(0, 10, utf8_decode('Votre achat: '), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Festival : '.$_commande[0]->titre), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Type de tiket: '.$_commande[0]->description), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Quantité delandé : '.$_commande[0]->quantite), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Prix total de la commande : '.$_commande[0]->prix_total), 0, 1);*/
