
<div class="row">
        <ul id="menu">
            <div class="col-sm-3 col-sm-push-1"><li><a href="./index.php?page=accueil">Acceuil</a></li></div>
            <div class="col-sm-3 col-sm-push-1"><li><a href="./index.php?page=festivals">Festivals</a></li></div>
            <div class="col-sm-3 col-sm-push-1"><li><a href="<?php if(isset($_SESSION['client'])) { print './index.php?page=ticket_session'; } else{ print './index.php?page=ticket'; } ?>">Ticket</a></li></div>
            <div class="col-sm-3 col-sm-push-1"><li><a href="./index.php?page=contact">Contact</a></li></div>
        </ul>
</div>   
