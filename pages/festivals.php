<?php
$fest = new FestivalBD($cnx);
$liste_f = $fest->getFestival();
$nbrF = count($liste_f);

$liste_p = $fest->getPays();
$nbrP = count($liste_p);

if (isset($_GET['submit_pays'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($choix_pays != 1) {
        $liste_fp = $fest->getFestivalbyPays($choix_pays);
        $nbrF = count($liste_fp);
    }
}
?>
<div class="row">
    <div class="col-sm-3">
        <span class="txtGras">Choisissez votre pays :</span>
    </div>
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="col-sm-3">
            <select name="choix_pays" id="choix_pays">
                <option value="1">Choisissez</option>
                <?php
                for ($i = 0; $i < $nbrP; $i++) {
                    ?>                    
                    <option value="<?php print $liste_p[$i]->pays; ?>">
                        <?php print $liste_p[$i]->pays; ?>
                    </option>
                    <?php
                }
                ?>
            </select>

        </div>
        <div class="col-sm-3">
            <input type="submit" name="submit_pays" value="" id="submit_pays"/>
        </div> 
    </form>
</div>
<?php
if (isset($liste_fp)) {
    $liste_f = $liste_fp;
}
?>
<div class="row">
    <div class="col-sm-12">
        <?php
        for ($i = 0; $i < $nbrF; $i++) {
            ?>
            <img class=img-responsive src="<?php print $liste_f[$i]->image_fest; ?>" alt="ImageFest">
            <div class="row">
                <div class="col-sm-6 col-sm-push-3">

                    <div>
                        <h3 class="nom_fest"><?php
                            print utf8_encode($liste_f[$i]->titre);
                            ?></h3>

                        <div class="detail_fest">
                            <?php
                            print ('<br/>Lieu : ');
                            print utf8_encode($liste_f[$i]->pays);
                            print ('<br/>Date : ');
                            print utf8_encode($liste_f[$i]->date_f);
                            print ('<br/>Description : ');
                            print $liste_f[$i]->description;
                            ?>
                            <a class="txtOrange txtGras" href ="./index.php?id_fest=<?php print $liste_f[$i]->id_fest; ?>&page=<?php if(isset($_SESSION['client'])) { print 'ticket_session'; } else{ print 'ticket'; } ?>">
                                Acheter ici !
                            </a>
                        </div>
                    </div>
                </div> 
            </div>

            <?php
        }
        ?>

    </div> 
</div>   