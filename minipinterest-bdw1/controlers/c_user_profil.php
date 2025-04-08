<?php
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
    header('Location: ./');
    exit();
}
$link=getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
require_once(PATH_MODELS.'utilisateur.php');
require_once(PATH_MODELS.'photo.php');
if(isset($_POST['validationPseudo']))
  {
    $NewPseudo = $_POST['new_pseudo'];
    $pseudo = $_POST['old_pseudo'];
    $PWD= md5($_POST['password']);
    if(!(getUser($pseudo,$PWD,$link)))
    {
        echo '<p style="color:red;">Erreur dans le couple mot de passe/pseudo</p>';
    }
    else
    {
        modifyPseudo($pseudo,$NewPseudo,$PWD,$link);
        $_SESSION['pseudo'] = $NewPseudo;
        echo '<p style="color:green;">Modification du pseudo réussie !</p>';
    }
  }
  if(isset($_POST['validationMdp']))
  {
    $pseudo2 = $_POST['old_pseudo2'];
    $OldPWD= md5($_POST['OldPassword']);
    $newPwd = md5($_POST['NewPassword']);
    if(!(getUser($pseudo2,$OldPWD,$link)))
    {
      echo '<p style="color:red;">Erreur dans le couple mot de passe/pseudo</p>';
    }
    else
    {
        modifyMdp($pseudo2,$OldPWD,$newPwd,$link);
        echo '<p style="color:green;">Modification du mot de passe réussie !</p>';
    }
  }
  $arr_photo_user = getPhotos($link,null,$_SESSION['pseudo']);
require_once(PATH_VIEWS.'utilisateur_profile'.'.php');