<?php
require_once (PATH_MODELS.'bd'.'.php');
require_once (PATH_MODELS.'photo'.'.php');

$bd = getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
$arr_cat = getCategories($bd);

$invalid_format = false;
$invalid_size = false;
$invalid_description = false;
$invalid_cat = false;

//SI PAS CONNECTE REDIRECT VERS ACCUEIL
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
    header('Location: ./');
    exit();
}

//SI APPEL DE LA PAGE AVEC LE FORM REMPLIT EN POST
if(isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] == 0) {
    $ext = '.'.pathinfo($_FILES['new_photo']['name'], PATHINFO_EXTENSION);

    if(!in_array($ext, AVAIBLE_EXT))
        $invalid_format = true;

    if($_FILES['new_photo']['size'] >= MAX_SIZE)
        $invalid_size = true;

    if(!isset($_POST['description']) || strlen($_POST['description']) < 1)
        $invalid_description = true;

    if(!isset($_POST['categorie']) || strlen($_POST['categorie']) < 1)
        $invalid_cat = true;


    if(!($invalid_description || $invalid_cat || $invalid_size || $invalid_format)) {
        $bool_cachee = 0;

        if (isset($_POST['cachee']))
            $bool_cachee = 1;

        if(!in_array($_POST['categorie'], $arr_cat)) {
            addCategorie($bd, $_POST['categorie']);
            $arr_cat = getCategories($bd);
        }

        $img = md5(uniqid($_FILES['new_photo']['tmp_name']));
        move_uploaded_file($_FILES['new_photo']['tmp_name'], PATH_IMAGES . $img . $ext);
        addPhoto($bd, $_SESSION['pseudo'], $img . $ext, $_POST['description'], $_POST['categorie'], $bool_cachee);

        header('Location: ./');
        exit();
    } else {

    }
}


echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"
      xmlns="http://www.w3.org/1999/html">';

require_once (PATH_VIEWS.'ajout_photo'.'.php');