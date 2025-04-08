<?php
$is_logged = false;
$is_admin = false;
$pseudo = null;
$arr_cat = array();
$arr_photos = array();
$arr_pseudos = array();

//require_once(PATH_CONTROLLERS . 'connexion' . '.php');
require_once (PATH_MODELS.'photo'.'.php');
require_once (PATH_MODELS.'utilisateur'.'.php');
$bd = getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);

if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    $pseudo = $_SESSION['pseudo'];
    $is_logged = true;
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true)
        $is_admin = true;
}

if(isset($_GET['del_img'])) {
    $info_photo = getPhoto($bd, $_GET['del_img']);
    if($is_admin || $info_photo['utilisateur'] == $pseudo) {
        removePhoto($bd, $info_photo['nomFich']);
        unlink(PATH_IMAGES.$info_photo['nomFich']);
    }
}

$arr_cat = getCategories($bd);
$arr_pseudos = getAllUser($bd);

$cat_filtre = null;
$pseudo_filtre = null;

if(isset($_GET['categorie_filtre']) && in_array($_GET['categorie_filtre'], $arr_cat))
    $cat_filtre = $_GET['categorie_filtre'];

if(isset($_GET['pseudo_filtre']) && in_array($_GET['pseudo_filtre'], $arr_pseudos))
    $pseudo_filtre = $_GET['pseudo_filtre'];

if($is_admin)
    $arr_photos = getToutesPhotosAdmin($bd, $cat_filtre, $pseudo_filtre);
else if ($is_logged)
    $arr_photos = getToutesPhotosUser($bd, $pseudo, $cat_filtre, $pseudo_filtre);
else
    $arr_photos = getPhotos($bd, $cat_filtre, $pseudo_filtre);

require_once (PATH_VIEWS.'accueil'.'.php');