<?php
if (isset($_POST['submit'])) {
    print "ici";
    $data = new ClientBD($cnx);
    $retour = $data->ajoutClient($_POST['nom'], $_POST['prenom'], $_POST['pays'], $_POST['adresse'], $_POST['email'], $_POST['telephone'], $_POST['password']);
    var_dump($retour);
    if ($retour == -1) {
        $message = "Erreur";
        print "message : " . $message;
    } else {
        if ($retour == -2) {
            $message = "Deja nscrit";
            print "message : " . $message;
        } else {
            $message = "Inscrit!";
            print "message : " . $message;
        }
    }
}
?>
<section id="message"><?php if (isset($message)) print $message; ?></section>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_inscription">
    <table>
        <tr>
            <td class="centrer"><label>Nom</label></td>
            <td class="centrer"><input type="text" name="nom" id="nom"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Prénom</label></td>
            <td class="centrer"><input type="text" name="prenom" id="prenom"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Pays</label></td>
            <td class="centrer"><input type="text" name="pays" id="pays"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Adresse</label></td>
            <td class="centrer"><input type="text" name="adresse" id="adresse"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Email</label></td>
            <td class="centrer"><input type="text" name="email1" id="email1" placeholder="aaa@aaa.aa"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Confirmez Email</label></td>
            <td class="centrer"><input type="text" name="email2" id="email2" placeholder="aaa@aaa.aa"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Telephone</label></td>
            <td class="centrer"><input type="text" name="telephone" id="telephone" placeholder="xxx/xx.xx.xx"/></td>
        </tr>
        <tr>
            <td class="centrer"><label>Password</label></td>
            <td class="centrer"><input type="password" name="password" id="password"/></td>
        </tr>
    </table>
    <input type="submit" name="submit" id="submit" value="Valider"/>
</form>