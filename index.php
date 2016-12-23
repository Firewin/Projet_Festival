<!doctype html>
<?php
include ('./admin/lib/php/adm_liste_include.php');
include ('./lib/php/fonctions_panier.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

session_start();
?>

<html>
    <head>
        <title classe=txtOrange>Festif'Consult - Votre guichet en ligne</title>     
        <link rel="stylesheet" type="text/css" href="./admin/lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./admin/lib/css/festivals_style.css"/> 
        <script src="admin/lib/js/jquery-3.1.1.js"></script>
        <script src="admin/lib/js/jquery-validation-1.15.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="admin/lib/js/messagesJqueryVal.js" type="text/javascript"></script>
        <script src="admin/lib/css/bootstrap-3.3.7/dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="admin/lib/js/functionsJqueryVal.js" type="text/javascript"></script>
        <script src="admin/lib/js/functionsDetailsFest.js" type="text/javascript"></script>
        <script src="admin/lib/js/functionsDetailCom.js" type="text/javascript"></script>
        <script src="admin/lib/js/functionsJqueryAdmin.js" type="text/javascript"></script>
        <meta charset='UTF-8'/>
    </head>

    <body>
        <header>
            <div class="container">

                <?php
                if (file_exists('./lib/php/header_client.php')) {
                    include ('./lib/php/header_client.php');
                }
                ?>


                <nav>
                    <?php
                    if (file_exists('./lib/php/menu_client.php')) {
                        include ('./lib/php/menu_client.php');
                    }
                    ?>   
                </nav>
            </div>
        </div>
    </header>

    <div class="container"> 
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (isset($_SESSION['client'])) {
                    ?>
                    <a href="./index.php?page=disconnect">
                        <?php
                        print "Déconnexion";
                    } else {
                        ?>
                    </a>
                    <a href="./index.php?page=client_connect">
                        <?php
                        print "Connexion";
                        ?>
                    </a>
                    <?php
                }
                ?>
                <a href="./index.php?page=inscription">Inscription</a>
                <a href="./admin/index.php" class="pull-right ecart10">Administration</a>
            </div>
        </div>
        <section id="main">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Bienvenue chez Festif'Consult</h2>
                </div>
            </div>
            <?php
            if (!isset($_SESSION['page'])) {
                $_SESSION['page'] = "accueil";
            }
            if (isset($_GET['page'])) {
                $_SESSION['page'] = $_GET['page'];
            }
            $path = './pages/' . $_SESSION['page'] . '.php';
            if (file_exists($path)) {
                include ($path);
            } else {
                ?>
                <span class="txtGras txtRouge">Oups!La page demandée n'existe pas</span>
                <meta http-refresh: Content="1;url=index.php?page=accueil"/>
                <?php
            }
            ?> 
            <footer class="footer">
                <?php
                if (file_exists('./admin/lib/php/footer.php')) {
                    include ('./admin/lib/php/footer.php');
                }
                ?>  
            </footer>
        </section>
    </div>


</body>
</html>
