<h2 class="txtOrange">Commandes</h2>
<?php
$flag = null;
if (isset($_GET['id_fest'])) {
    $ticket = new TicketBD($cnx);
    $liste_t = $ticket->getTicket($_GET['id_fest']);
    $nbrT = count($liste_t);
    $fest = new FestivalBD($cnx);
    $liste_f = $fest->getFestivalbyID($_GET['id_fest']);
    $nbrF = count($liste_f);

    if (isset($_SESSION['client'])) {
        creationPanier();
        ajouterArticle($_GET['id_fest']);
    }
    $flag = true;
}
if (isset($_GET['submit_duree'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($choix_duree != -1) {
        $pos = $choix_duree;
    }
}
if (isset($_POST['submit_commande'])) {
    if ($_POST['password_com'] == $_POST['password_com2']) {
        $id_cli = $_POST['id_cli'];
        $id_ticket = $_POST['id_ticket'];
        $quantite = $_POST['quantite'];
        $prix_total = $_POST['prix'] * $quantite;
        if ($id_cli == null) {
            $data = new ClientBD($cnx);
            $id_cli = $data->ajoutClient($_POST['nom_com'], $_POST['prenom_com'], $_POST['pays_com'], $_POST['adresse_com'], $_POST['email1_com'], $_POST['telephone_com'], $_POST['password_com']);
        }
        $_SESSION['client'] = $id_cli;
        $data = new AchatBD($cnx);
        $num_com = $data->ajoutAchat($id_cli, $id_ticket, $prix_total, $quantite);
        $message = "Achat confirmer";
        print "message : " . $message;
        ?>
        </br><a href="http://localhost/projects/Projet_Festival/pdf_commande.php" targer="_blank">Téléchargez votre bon de commande</a>
        <?php
    } else {
        $message = "Erreur de mot de passe";
        print "message : " . $message;
    }
}
if ($flag) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="container">
                    <span class="txtGras">Votre commande : </span>
                    <div>
                        <span class="txtGras">Entrée pour <?php print $liste_f[0]->titre; ?></span>
                    </div>
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
                        <input type="hidden" name="id_fest" value="<?php print $_GET['id_fest']; ?>" id="id_fest"/>
                        <input type="submit" name="submit_duree" value="" id="submit_duree"/>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="container">

                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_commande" class="form-horizontal">
                        <div class="row"> 
                            <div class="col-sm-3">
                                <span class="txtGras"><label class="control-label">Quantité : </label></span>
                                <input type="number" id="quantite" name="quantite" value="1"/>
                            </div>
                            <div class="col-sm-3">
                                <table>
                                    <tr>
                                        <td class="centrer"><label>Email</label></td>
                                        <td class="centrer"><input type="text" name="email1_com" id="email1_com" placeholder="aaa@aaa.aa"/></td>
                                    </tr>
                                    <tr>
                                        <td class="centrer"><label>Confirmez Email</label></td>
                                        <td class="centrer"><input type="text" name="email2_com" id="email2_com" placeholder="aaa@aaa.aa"/></td>
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
                                        <td class="centrer"><input type="text" name="telephone_com" id="telephone_com" placeholder="xxx/xx.xx.xx"/></td>
                                    </tr>

                                    <span class="txtGras" id="detail_confirm_com">En appuyant sur le bouton "Commander" vous acceptez de vous inscrire sur notre site affin de facilité vos future commandes.</span>
                                    <span class="txtGras" id="confirm_com">Votre adresse email est deja inscrite sur notre site, veuillez indiquer votre mot de passe pour finaliser la commande</span>
                                    <tr>
                                        <td class="centrer"><label>Password</label></td>
                                        <td class="centrer"><input type="password" name="password_com" id="password_com"/></td>
                                    </tr>
                                    <tr>
                                        <td class="centrer"><label>Password</label></td>
                                        <td class="centrer"><input type="password" name="password_com2" id="password_com2"/></td>
                                    </tr>
                                    <tr>
                                        <td class="centrer"><input type="hidden" name="id_cli" id="id_cli"/></td>

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
                            </div>
                        </div>
                    </form>              
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <p><br/>Veuillez d'abord choisir <a href="./index.php?page=festivals">ici</a></p>
    <?php
}






    