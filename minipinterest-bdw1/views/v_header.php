<?php
$is_logged = isset($_SESSION['logged']) && $_SESSION['logged'] == true;
?>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="css/pinterest.css">

<!-- Compiled and minified JavaScript -->
<script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<header>
    <div class="row">
        <nav class="nav-extended red accent-4">
            <div class="nav-wrapper">
                <a href="./" class="brand-logo">Accueil</a>
                <ul class="right hide-on-med-and-down">
                    <?php
                    if($is_logged) {
                        echo '
                    <li>
                        <a href="./?page=ajout_photo">Ajout d\'une photo</a>
                    </li>';
                        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true)
                            echo '
                    <li>
                        <a href="./?page=admin_profil">Statistiques du site </a>
                    </li>';
                        echo '
                    <li>
                        <a href="./?page=user_profil">Mon profil</a>
                    </li>';
                    }
                     ?>
                </ul>
            </div>



<?php
require_once (PATH_MODELS.'bd'.'.php');
if($is_logged)
    require_once(PATH_CONTROLLERS . 'deconnexion' . '.php');
else
    require_once(PATH_CONTROLLERS . 'connexion' . '.php');
?>
