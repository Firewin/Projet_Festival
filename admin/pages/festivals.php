<?php
$fest = new FestivalBD($cnx);

if (isset($_GET['submit_pays'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($choix_pays != 1) {
        $liste_fp = $fest->getFestivalbyPays($choix_pays);
        $nbrF = count($liste_fp);
    }
} else {
    $liste_f = $fest->getFestival();
    $nbrF = count($liste_f);
}

if (isset($_GET['delete'])) {
    $data = new FestivalBD($cnx);
    $retour = $data->deleteFestival($_GET['del_id_fest']);
    if ($retour == 1) {
        $message = 'Suppression du festival réussi';
        print 'Message : ' . $message;
    } else {
        $message = 'Erreur';
        print 'Message : ' . $message;
    }
}

if (isset($_FILES['image_f']) AND $_FILES['image_f']['error'] == 0) {
    $flag = true;
    print $_FILES['image_f'];
    $extensions_valides = array('jpg', 'jpeg', 'png');
    $extension_upload = strtolower(substr(strrchr($_FILES['image_f']['name'], '.'), 1));
    if (!in_array($extension_upload, $extensions_valides)) {
        print 'Extension incorrecte';
        $flag = false;
    }
    if ($_FILES['image_f']['error'] > 0) {
        $erreur = "Erreur lors du transfert";
        $flag = false;
    }
    if ($flag) {
        $dossier = 'images/';
        $fichier = basename($_FILES['image_f']['name']);
        $resultat = move_uploaded_file($_FILES['image_f']['tmp_name'], $dossier . $fichier);
        if ($resultat) {
            print 'Transfert de la nouvelle image réussi';
            $path_image = $dossier . $fichier;
        }
    }
}

if (isset($_POST['save_modif'])) {
    print 'ii' . $path_image;
    if (!isset($path_image)) {
        $path_image = $_POST['path'];
    }
    $data = new FestivalBD($cnx);
    $retour = $data->updateFestival($_POST['update_id_fest'], $_POST['titre'], $_POST['pays'], $_POST['date_f'], $_POST['description'], $path_image);
    if ($retour == 1) {
        $message = 'Mise ajour du festival réussi';
        print 'Message : ' . $message;
    } else {
        $message = 'erreur';
        print 'Message : ' . $message;
    }
}

$liste_p = $fest->getPays();
$nbrP = count($liste_p);
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
    <div class="col-sm-3">
        <a href="index.php?page=ajouter_festivals" class="txtGrasOrange">Ajouter un festival</a>
    </div>
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
        print $liste_f[$i]->titre;
        ?></h3>
                        <div class="detail_fest">
                            <form method="get" name="supp_fest" action="<?php print $_SERVER['PHP_SELF']; ?>">
                                <div class="row">
                                    <div class="col-sm-4 col-sm-push-8">
                                        <input type="hidden" name="del_id_fest" value="<?php print $liste_f[$i]->id_fest; ?>"/>
                                        <input type="submit"  name="delete" onclick="return confirm('Vous allez supprimer le festival suivant : <?php print $liste_f[$i]->titre; ?> ')" value="Supprimer" />
                                    </div>
                                </div>
                            </form>
                            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_update_f" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-sm-2"><label for="titre">Titre :</label></div>
                                    <div class="col-sm-4">
                                        <input type="text" id="titre" name="titre" value="<?php print $liste_f[$i]->titre; ?>"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2"><label for="pays">Pays :</label></div>
                                    <div class="col-sm-4">
                                        <input type="text" id="pays" name="pays" value="<?php print $liste_f[$i]->pays; ?>"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2"><label for="date_f">Date :</label></div>
                                    <div class="col-sm-4">
                                        <input type="date" id="date_f" name="date_f" value="<?php print $liste_f[$i]->date_f; ?>"/>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-2"><label for="description">Description :</label></div>
                                    <div class="col-sm-4">
                                        <textarea name="description" id="description" rows="6" cols="20" class="txtOrange"><?php print $liste_f[$i]->description; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"><label for="image_f">Modifier l'image (résolution recomendée 1200 x 400):</label></div>
                                    <div class="col-sm-4">
                                        <input type="file" id="image_f" name="image_f" />
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="hidden" name="path" value="<?php print $liste_f[$i]->image_fest; ?>"/>
                                        <input type="hidden" name="update_id_fest" value="<?php print $liste_f[$i]->id_fest; ?>"/>
                                        <input type="submit" name="save_modif" id="save_modif" value="Enregistrer les modification" class="pull-right"/>           

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
    <?php
}
?>

    </div> 
</div>   