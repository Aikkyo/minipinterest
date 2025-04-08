<?php

if(isset($_POST['deconnexion']))
{
    $_SESSION['logged']=false;
    $_SESSION['pseudo']='';

    header('Location: ./');
    exit();
}

require_once(PATH_VIEWS.'deconnexion.php');