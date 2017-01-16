<h2 class="txtOrange">Commandes</h2>
<?php
$flag = false;
if (isset($_GET['id_fest'])) {
    if (isset($_GET['id_fest'])) {
        $ticket = new TicketBD($cnx);
        $liste_t = $ticket->getTicket($_GET['id_fest']);
        $nbrT = count($liste_t);
        $fest = new FestivalBD($cnx);
        $liste_f = $fest->getFestivalbyID($_GET['id_fest']);
        $nbrF = count($liste_f);
        creationPanier();
        ajouterArticle($_GET['id_fest']);
        $flag = true;
    }
} else {
    if (isset($_SESSION['panier'])) {
        $ticket = new TicketBD($cnx);
        $liste_t = $ticket->getTicket($_SESSION['panier']);
        $nbrT = count($liste_t);
        $fest = new FestivalBD($cnx);
        $liste_f = $fest->getFestivalbyID($_SESSION['panier']);
        $nbrF = count($liste_f);
        $flag = true;
    }
}

if (isset($_GET['submit_duree'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($choix_duree != -1) {
        $pos = $choix_duree;
    }
}

if (isset($_POST['submit_commande'])) {
    $id_cli = $_SESSION['client'];
    $id_ticket = $_POST['id_ticket'];
    $quantite = $_POST['quantite'];
    $prix_total = $_POST['prix'] * $quantite;
    $data = new AchatBD($cnx);
    $num_com = $data->ajoutAchat($id_cli, $id_ticket, $prix_total, $quantite);
    viderPanier();
    $flag = false;
    $message = "Achat confirmer";
    print "message : " . $message;
    ?>
    </br><a href="http://localhost/projects/Projet_Festival/pdf_commande.php?id_com=<?php print $num_com; ?>">Téléchargez votre bon de commande</a>
    <?php
}

if ($flag) {
    ?>
    <div class="row">
        <div class="col-sm-4">
            <span class="txtGras">Votre commande : </span>
            <div>
                <span class="txtGras">Entrée pour <?php print $liste_f[0]->titre; ?></span>
            </div>
        </div>
        <div class="col-sm-4">
            <span class="txtGras"><label class="control-label">Durée : </label></span>
            <div class="description-ticket">
                <?php
                if (isset($pos)) {
                    print $liste_t[$pos]->description;
                }
                ?>
            </div>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                <select name="choix_duree" id="choix_duree">
                    <option value="-1">Choisissez</option>
                    <?php
                    for ($i = 0; $i < $nbrT; $i++) {
                        ?>                    
                        <option value="<?php print $i ?>">
                            <?php
                            if ($liste_t[$i]->type) {
                                print('1 journée');
                            } else {
                                print('Festival entier');
                            }
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <input type="hidden" name="id_fest" value="<?php print $_SESSION['panier']; ?>" id="id_fest"/>
                <input type="submit" name="submit_duree" value="" id="submit_duree"/>
            </form>
        </div>
    </div>
    <div class="container">

        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_commande" class="form-horizontal">
            <div class="row">
                <div class="col-sm-4"> 
                    <span class="txtGras"><label class="control-label">Quantité : </label></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"> 
                    <input type="number" id="quantite" name="quantite" value="1"/>
                </div>
            </div>
            <td class="centrer"><input type="hidden" name="id_ticket" id="id_ticket" value="<?php print $liste_t[$pos]->id_ticket; ?>"/></td>
            <td class="centrer"><input type="hidden" name="prix" id="prix" value="<?php print $liste_t[$pos]->prix; ?>"/></td>
            </tr>
            </table>
            <?php
            if (isset($pos)) {
                ?>
                <input type="submit" name="submit_commande" id="submit_commande" value="Valider"/>
                <?php
            } else {
                ?>
                <span class="txtRouge">Veuillez entrez une durée pour onfirmez votre commande</span>
                <?php
            }
            ?>
        </form>
    </div>
    <?php
} else {
    ?>
    <p><br/>Veuillez d'abord choisir <a href="./index.php?page=festivals">ici</a></p>
    <?php
}

         