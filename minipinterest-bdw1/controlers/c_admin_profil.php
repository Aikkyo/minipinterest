<?php
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
    header('Location: ./');
    exit();
}
if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == false) {
    header('Location: ./');
    exit();
}
$link=getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
require_once(PATH_MODELS.'utilisateur.php');
$arr_profil = getUserNumberPhoto($link);
$arr_category = getCategoryNumberPhoto($link);
$nbr_cat = getNumberOfCategories($link);
$nbr_users = getNumberOfUsers($link);
require_once(PATH_VIEWS.'admin_profil'.'.php');