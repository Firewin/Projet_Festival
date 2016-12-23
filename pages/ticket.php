<h2 class="txtOrange">Commandes</h2>
<?php
$flag = false;
if (isset($_GET['id_fest'])) {
    $ticket = new TicketBD($cnx);
    $liste_t = $ticket->getTicket($_GET['id_fest']);
    $nbrT = count($liste_t);
    $fest = new FestivalBD($cnx);
    $liste_f = $fest->getFestivalbyID($_GET['id_fest']);
    $nbrF = count($liste_f);

    if (isset($_SESSION['client'])) {
        ajouterArticle($_GET['id_fest']);
    }
    $flag = true;
} else {
    if (isset($_SESSION['client'])) {
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
}

if (isset($_GET['submit_duree'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($choix_duree != -1) {
        $pos = $choix_duree;
    }
}

if(isset($_POST['submit_commande'])){
    if (isset($_SESSION['client'])) {
        
    }
}
    
if ($flag) {
    ?>
    <div class="row">
        <div class="col-sm-4">
            <span class="txtGras">Votre commande : </span>
            <div>
                <span class="txtGras">Entrée pour <?php print $liste_f[0]->nom; ?></span>
                <div class="description-ticket">
                    <?php
                    if (isset($pos)) {
                        print $liste_t[$pos]->description;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <span class="txtGras"><label class="control-label">Durée : </label></span>
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
                <input type="hidden" name="id_fest" value="<?php
                if (isset($_SESSION['client'])) {
                    print $_SESSION['panier'];
                } else {
                    print $_GET['id_fest'];
                }
                ?>" id="id_fest"/>
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

            <?php
            if (!isset($_SESSION['client'])) {
                ?>
                <table>
                    <tr>
                        <td class="centrer"><label>Email</label></td>
                        <td class="centrer"><input type="text" name="email1_com" id="email1_com"/></td>
                    </tr>
                    <tr>
                        <td class="centrer"><label>Confirmez Email</label></td>
                        <td class="centrer"><input type="text" name="email2_com" id="email2_com"/></td>
                    </tr>
                    <tr>
                        <td class="centrer"><label>Nom</label></td>
                        <td class="centrer"><input type="text" name="nom_com" id="nom_com"/></td>
                    </tr>
                    <tr>
                        <td class="centrer"><label>Prénom</label></td>
                        <td class="centrer"><input type="text" name="prenom_com" id="prenom_com"/></td>
                    </tr>
                    <tr>
                        <td class="centrer"><label>Pays</label></td>
                        <td class="centrer"><input type="text" name="pays_com" id="pays_com"/></td>
                    </tr>
                    <tr>
                        <td class="centrer"><label>Adresse</label></td>
                        <td class="centrer"><input type="text" name="adresse_com" id="adresse_com"/></td>
                    </tr>
                    <tr>
                        <td class="centrer"><label>Telephone</label></td>
                        <td class="centrer"><input type="text" name="telephone_com" id="telephone_com"/></td>
                    </tr>

                </table>
                <?php
            }
            ?>
            <input type="submit" name="submit_commande" id="submit_commande" value="Valider"/>
        </form>
    </div>
    <?php
} else {
    ?>
    <p><br/>Veuillez d'abord choisir <a href="./index.php?page=festivals">ici</a></p>
    <?php
}
    



