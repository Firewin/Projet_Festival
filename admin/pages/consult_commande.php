<?php
$com = new CommandeBD($cnx);
$liste_com = $com->getCommande();
$nbr = count($liste_com);

$fest = new FestivalBD($cnx);
$liste_f = $fest->getFestival();
$nbrF = count($liste_f);

if (isset($_GET['submit_titre'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($choix_titre != 1) {
        print $choix_titre;
        $liste_fcom = $com->getCommandebyFest($choix_titre);
        $nbr = count($liste_fcom);
    }
}
?>
<div class="row">
    <div class="col-sm-3">
        <span class="txtGras">Afficher les commandes pour :</span>
    </div>
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="col-sm-3">
            <select name="choix_titre" id="choix_titre">
                <option value="1">Choisissez</option>
                <?php
                for ($i = 0; $i < $nbrF; $i++) {
                    ?>                    
                    <option value="<?php print $liste_f[$i]->titre; ?>">
                        <?php print $liste_f[$i]->titre; ?>
                    </option>
                    <?php
                }
                ?>
            </select>

        </div>
        <div class="col-sm-3">
            <input type="submit" name="submit_titre" value="" id="submit_titre"/>
        </div> 
    </form>
</div>
<?php
if (isset($liste_fcom)) {
    $liste_com = $liste_fcom;
}
?>
<div class="container">
    <?php
    for ($i = 0; $i < $nbr; $i++) {
        ?>
        <div class="row">
            <div class="col-sm-1">
                <span class="txtGras"><?php print $liste_com[$i]->id_achat; ?></span>
            </div>
            <div class="col-sm-1">
                <span class="txtGras"><?php print $liste_com[$i]->id_cli; ?></span>
            </div>
            <div class="col-sm-1">
                <span class="txtGras"><?php print $liste_com[$i]->nom; ?></span>
            </div>
            <div class="col-sm-1">
                <span class="txtGras"><?php print $liste_com[$i]->prenom; ?></span>
            </div>
            <div class="col-sm-2">
                <span class="txtGras"><?php print $liste_com[$i]->email; ?></span>
            </div>
            <div class="col-sm-2">
                <span class="txtGras"><?php print $liste_com[$i]->titre; ?></span>
            </div>
            <div class="col-sm-2">
                <span class="txtGras"><?php print $liste_com[$i]->description; ?></span>
            </div>
            <div class="col-sm-1">
                <span class="txtGras"><?php print $liste_com[$i]->quantite; ?></span>
            </div>
            <div class="col-sm-1">
                <span class="txtGras"><?php print $liste_com[$i]->prix_total; ?></span>
            </div>
        </div>   
        <?php
    }
    ?>
</div>