<?php

require_once(PATH_MODELS.'bd.php');
require_once(PATH_MODELS.'utilisateur.php');

if(isset($_POST['validation']))
{
  $link=getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
  $pseudo = $_POST['pseudo'];
  $verifMdp =$_POST['password'];
  $PWD= md5($_POST['password']);
  $confirmPWD = md5($_POST['confirmationPassword']);
  if(!(checkAvailability($pseudo,$link)))
  {
    echo '<p style="color:red; text-align:center;">Pseudo non disponible</p>';
  }
  else
  {
    if (!($PWD == $confirmPWD))
    {
      echo '<p style="color:red; text-align:center;">Erreur : 
      les deux mots de passe sont différents</p>';
    }
    else
    {
      register($pseudo,$PWD,$link);
      echo '<p style="color:green; text-align:center;">Inscription 
      réussie !</p>';
    }
  }
}


require_once(PATH_VIEWS.'inscription.php');
