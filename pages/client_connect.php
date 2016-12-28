<?php
if (isset($_POST['submit_email'])) {
   $log = new ClientBD($cnx);
    $retour = $log->isClient($_POST['email'], $_POST['password']);
    var_dump($retour);
    if ($retour != 0) {
        $_SESSION['client'] = $retour;        
        $message = "Authentifié!";
        print "message : " . $message;
?>
        <meta http-equiv="refresh" content="1;url=http://localhost/projects/Projet_Festival/index.php?page=accueil" />
<?php
    } else {
        $message = "Données incorrectes";
    }
}
?>
<section id="message"><?php if (isset($message)) print $message; ?></section>
<div class="container" id="inline">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_">    
        <div class="row">
            <div class="col-sm-offset-1 txt150">Authentifiez-vous<br/><br/></div>
        </div>
        <div class="row">
            <div class="col-sm-2 txtRouge txtGras">Email : </div>
            <div class="col-sm-4"><input type="text" id="login_" name="email" /></div><br/><br/>
        </div>
        <div class="row">
            <div class="col-sm-2 txtRouge txtGras">Mot de passe :</div>
            <div class="col-sm-4"><input type="password" id="password_" name="password" /></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><br/>
                <input type="submit" name="submit_email" id="submit_login_" value="Login" />&nbsp;&nbsp;&nbsp;
                <input type="reset" id="annuler" value="Annuler" />
            </div>
        </div>            
    </form>
</div>




