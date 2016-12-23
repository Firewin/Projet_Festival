<?php
if (!isset($_SESSION['admin'])) {
    //print "<span class='txt150 txtGras txtRouge'>Acc&egrave;s r&eacute;serv&eacute;</span>";
    ?>
    <meta http-equiv="refresh": Content="1;url=../index.php"/>
    <?php
    exit();
}
