<?php
require_once (PATH_MODELS.'bd'.'.php');
require_once (PATH_MODELS.'photo'.'.php');

$photo = null;
$arr_cat = array();
$is_edit = false;
$is_legitime = false;

$invalid_format = false;
$invalid_size = false;

if(isset($_GET['photo'])) {
    $bd = getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
    $photo = getPhoto($bd, $_GET['photo']);
} else {
    header('Location: ./');
    exit();
}

if(isset($_GET['edit']) && $_GET['edit'] == true)
    $is_edit = true;

if (isset($_SESSION['logged']) && isset($_SESSION['pseudo']) && isset($_SESSION['isAdmin']) && $photo != null //test session set
    && $_SESSION['logged'] == true  // test utilisateur logged
    && ($photo['utilisateur'] == $_SESSION['pseudo'] || $_SESSION['isAdmin'])) // Si propriétaire de la photo ou admin
    $is_legitime = true;

if($is_legitime && $is_edit) {
    if(isset($_POST['new_cachee']))
        hidePhoto($bd, $photo['nomFich']);
    else
        unHidePhoto($bd, $photo['nomFich']);


    $arr_cat = getCategories($bd);
    if(isset($_GET['submission']) && $_GET['submission'] == true) {
        $new_img = null;
        $new_description = null;
        $new_cat = null;
        $new_name = null;
        $ext = null;

        if(isset($_POST['new_cat']) && strlen($_POST['new_cat']) > 0) {
            $new_cat = $_POST['new_cat'];

            if(!in_array($new_cat, $arr_cat)) {
                addCategorie($bd, $new_cat);
                $arr_cat = getCategories($bd);
            }
        }

        if(isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] == 0) {
            $ext = '.'.pathinfo($_FILES['new_photo']['name'], PATHINFO_EXTENSION);
            if(!in_array($ext, AVAIBLE_EXT))
                $invalid_format = true;
            if($_FILES['new_photo']['size'] > MAX_SIZE)
                $invalid_size = true;

            if(!$invalid_size && !$invalid_format) {
                $new_img = $_FILES['new_photo'];
                $new_name = md5(uniqid($new_img['tmp_name']));
                unlink(PATH_IMAGES . $_GET['photo']);
                move_uploaded_file($new_img['tmp_name'], PATH_IMAGES . $new_name . $ext);
            }
        }

        if(isset($_POST['new_description'])) {
            $new_description = $_POST['new_description'];
        }

        modifierPhoto($bd, $_GET['photo'], $new_name . $ext, $new_description, $new_cat);

        if($new_name != null)
            $photo = getPhoto($bd, $new_name . $ext);
        else
            $photo = getPhoto($bd, $_GET['photo']);
    }
    require_once (PATH_VIEWS.'detail_photo_edit'.'.php');
} else
    require_once (PATH_VIEWS.'detail_photo'.'.php');