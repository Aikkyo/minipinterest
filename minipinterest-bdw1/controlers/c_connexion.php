<?php
require_once(PATH_MODELS.'utilisateur.php');

$couple_ok = true;

if(isset($_POST['connexion']))
  {
    $link=getConnection(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
    $pseudo = $_POST['pseudo'];
    $PWD = md5($_POST['mdp']);
    if (getUser($pseudo,$PWD,$link))
    {
      $_SESSION['pseudo']=$pseudo;
      $_SESSION['logged']=true;
      $_SESSION['timer_connexion']=localtime();
      if(isAdmin($pseudo,$link))
      {
        $_SESSION['isAdmin']=true;
      }
      else
      {
        $_SESSION['isAdmin']=false;
      }
      header('Location: ./');
      exit();
    }
    else
    {
      $couple_ok = false;
      require_once(PATH_VIEWS.'connexion.php');
    }
  }
else
{
  require_once(PATH_VIEWS.'connexion.php');
}