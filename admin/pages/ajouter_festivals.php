<?php
$path_image = null;
if (isset($_FILES['ajout_image_f']) AND $_FILES['ajout_image_f']['error'] == 0) {
    $flag = true;
    $extensions_valides = array('jpg', 'jpeg', 'png');
    $extension_upload = strtolower(substr(strrchr($_FILES['ajout_image_f']['name'], '.'), 1));
    if (!in_array($extension_upload, $extensions_valides)) {
        print 'Extension incorrecte';
        $flag = false;
    }
    if ($_FILES['ajout_image_f']['error'] > 0) {
        $erreur = "Erreur lors du transfert";
        $flag = false;
    }
    if ($flag) {
        $dossier = 'images/';
        $fichier = basename($_FILES['ajout_image_f']['name']);
        $resultat = move_uploaded_file($_FILES['ajout_image_f']['tmp_name'], $dossier.$fichier);
        if ($resultat) {
            print 'Transfert de la nouvelle image réussi';
            $path_image = $dossier . $fichier;
        }
    }
}else {
    print 'Erreur';
}


if(isset($_POST['ajout_fest'])){
    
    $true = true;
    $false = 'false';
    $data = new FestivalBD($cnx);
    $retour = $data->ajoutFestival($_POST['ajout_titre'], $_POST['ajout_pays'], $_POST['ajout_date_f'], $_POST['ajout_description'], $path_image);
    
    $t1 = new TicketBD($cnx);
    $rt1 = $t1->ajoutTicket($retour, $_POST['ajout_description_t1'], $_POST['ajout_prix1'], $true);
    
    $t2 = new TicketBD($cnx);
    $rt2 = $t2->ajoutTicket($retour, $_POST['ajout_description_t2'], $_POST['ajout_prix2'], $false);
    
    if ($retour == -1) {
        $message = "Erreur";
        print "message : " . $message;
    } else {
        if ($retour == -2) {
            $message = "Titre déjà présent!";
            print "message : " . $message;
        } else {
            $message = "Festival ajouter!";
            print "message : " . $message;
        }
    }
}
?>

<div class="row">
    <div class="col-sm-6 col-sm-push-3">
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_ajout_f" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-2"><label for="ajout_titre">Titre :</label></div>
                <div class="col-sm-4">
                    <input type="text" id="ajout_titre" name="ajout_titre"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="ajout_pays">Pays :</label></div>
                <div class="col-sm-4">
                    <input type="text" id="ajout_pays" name="ajout_pays"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="ajout_date_f">Date :</label></div>
                <div class="col-sm-4">
                    <input type="date" id="ajout_date_f" name="ajout_date_f"/>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2"><label for="ajout_description">Description :</label></div>
                <div class="col-sm-4">
                    <textarea name="ajout_description" id="ajout_description" rows="6" cols="20" class="txtOrange"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="ajout_image_f">Modifier l'image (résolution recomendée 1200 x 400):</label></div>
                <div class="col-sm-4">
                    <input type="file" id="ajout_image_f" name="ajout_image_f"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><span class="txtGrasOrange">Ticket 1 journée :</span></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="ajout_prix1">Prix :</label></div>
                <div class="col-sm-4">
                    <input type="number" id="ajout_prix1" name="ajout_prix1"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="ajout_description_t1">Description :</label></div>
                <div class="col-sm-4">
                    <textarea name="ajout_description_t1" id="ajout_description_t1" rows="6" cols="20" class="txtOrange"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><span class="txtGrasOrange">Ticket festival entier :</span></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="ajout_prix2">Prix :</label></div>
                <div class="col-sm-4">
                    <input type="number" id="ajout_prix2" name="ajout_prix2"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="ajout_description_t2">Description :</label></div>
                <div class="col-sm-4">
                    <textarea name="ajout_description_t2" id="ajout_description_t2" rows="6" cols="20" class="txtOrange"></textarea>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-sm-4">
                    <input type="submit" name="ajout_fest" id="ajout_fest" value="Ajouter le festivals"/>           
                </div>
            </div>
        </form>
    </div>
</div>