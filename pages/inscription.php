<?php
if (isset($_GET['submit'])) {
    //print "ici";
    if ($_GET['password'] == $_GET['password2']) {
        $data = new ClientBD($cnx);
        $retour = $data->ajoutClient($_GET['nom'], $_GET['prenom'], $_GET['pays'], $_GET['adresse'], $_GET['email1'], $_GET['telephone'], $_GET['password']);
        var_dump($retour);
        if ($retour == -1) {
            $message = "Erreur";
            print "message : " . $message;
        } else {
            if ($retour == -2) {
                $message = "Deja inscrit";
                print "message : " . $message;
            } else {
                $message = "Inscrit!";
                print "message : " . $message;
            }
        }
    } else {
        $message = "Erreur dans les mots de passe!";
                print "message : " . $message;
    }
}
?>
<section id="message"><?php if (isset($message)) print $message; ?></section>
<div class="container">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get" id="form_inscription">
        <div class="row">
            <div class="col-sm-2"><label for="nom">Nom :</label></div>
            <div class="col-sm-4">
                <input type="text" name="nom" id="nom"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="prenom">Prénom :</label></div>
            <div class="col-sm-4">
                <input type="text" name="prenom" id="prenom"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="pays">Pays :</label></div>
            <div class="col-sm-4">
                <input type="text" name="pays" id="pays"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="adresse">Adresse :</label></div>
            <div class="col-sm-4">
                <input type="text" name="adresse" id="adresse"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="email1">Email :</label></div>
            <div class="col-sm-4">
                <input type="text" name="email1" id="email1" placeholder="aaa@aaa.aa"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="email2">Confirmez Email :</label></div>
            <div class="col-sm-4">
                <input type="text" name="email2" id="email2" placeholder="aaa@aaa.aa"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="telephone">Telephone :</label></div>
            <div class="col-sm-4">
                <input type="text" name="telephone" id="telephone" placeholder="xxx/xx.xx.xx"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="password">Mot de passe :</label></div>
            <div class="col-sm-4">
                <input type="password" name="password" id="password"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><label for="password2">Confirmer le mot de passe :</label></div>
            <div class="col-sm-4">
                <input type="password" name="password2" id="password2"/>
            </div>
        </div>
        <input type="submit" name="submit" id="submit" value="Valider"/>
    </form>
</div>