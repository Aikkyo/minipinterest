<?php

class Profil {
    var $pseudo;
    var $nbr;

    public function __construct($pseudo, $nbr)
    {
        $this->pseudo = $pseudo;
        $this->nbr = $nbr;
    }
}
class Categorie {
    var $cat;
    var $nbr;

    public function __construct($cat, $nbr)
    {
        $this->cat = $cat;
        $this->nbr = $nbr;
    }
}

/*Cette fonction prend en entrée un pseudo à ajouter à la relation utilisateur 
et une connexion et retourne vrai si le pseudo est disponible (pas d'occurence 
dans les données existantes), faux sinon*/
function checkAvailability($pseudo, $link)
{
	$req = "SELECT pseudo FROM utilisateur WHERE pseudo = \"$pseudo\"";

    $result=executeQuery($link, $req);
    return (is_bool(executeQuery($link, $req)));
}

/*Cette fonction prend en entrée un pseudo et un mot de passe et enregistre 
le nouvel utilisateur dans la relation utilisateur via la connexion*/
function register($pseudo, $hashPwd, $link)
{
    $req = "INSERT INTO utilisateur (pseudo, hash_mdp) VALUES ('".$pseudo."', '".$hashPwd."')";

    executeUpdate($link, $req);
}


/*Cette fonction prend en entrée un pseudo et mot de passe et renvoie vrai si 
l'utilisateur existe (au moins un tuple dans le résultat), faux sinon*/
function getUser($pseudo, $hashPwd, $link)
{
    $req = "SELECT * FROM utilisateur WHERE pseudo = \"$pseudo\" AND hash_mdp = \"$hashPwd\"";
	$result = executeQuery($link,$req);
    return (!is_bool(executeQuery($link, $req)));
}

/*Cette fonction retourne la liste des utilisateurs sous forme de tableau*/
function getAllUser($link)
{
    $req = "SELECT pseudo FROM utilisateur";
	$result = executeQuery($link,$req);
    $arr_rslt = array();
    if(is_bool($result))
        return null;

    while($res = mysqli_fetch_assoc($result))
    {
        $arr_rslt[] = $res['pseudo'];
    }
    return $arr_rslt;
}

/*Cette fonction retourne le nombre de photo par utilisateur dans un tableau */
function getUserNumberPhoto($link)
{
    $req = "SELECT pseudo, count(*) AS nbr FROM utilisateur as u JOIN photo as p 
    ON u.utilisateurID=p.userID GROUP BY pseudo";
	$result = executeQuery($link,$req);
    $arr_rslt = array();
    if(is_bool($result))
        return null;

    while($res = mysqli_fetch_assoc($result))
    {
        $arr_rslt[] = new Profil($res['pseudo'],$res['nbr']);
    }
    return $arr_rslt;
}

/*Cette fonction retourne le nombre de photo par catégorie dans un tableau */
function getCategoryNumberPhoto($link)
{
    $req = "SELECT nomCat, count(*) AS nbr FROM categorie as c JOIN photo as p 
    ON c.cat_id=p.catID GROUP BY nomCat";
	$result = executeQuery($link,$req);
    $arr_rslt = array();
    if(is_bool($result))
        return null;

    while($res = mysqli_fetch_assoc($result))
    {
        $arr_rslt[] = new Categorie($res['nomCat'],$res['nbr']);
    }
    return $arr_rslt;
}

function getNumberOfCategories($link)
{
    $req = "SELECT COUNT(*) as N FROM categorie";
    $rslt = executeQuery($link, $req);
    $arr_rslt = array();

    $row = mysqli_fetch_assoc($rslt);
    $arr_rslt[0] = $row["N"];

    return $arr_rslt[0];
}

/*retourne vrai si l'utilisateur connecté est un administrateur */
function isAdmin($pseudo,$link)
{
    $req = "SELECT * FROM utilisateur WHERE pseudo = \"$pseudo\" AND is_admin=1";
	$result = executeQuery($link,$req);
    return (!is_bool(executeQuery($link, $req)));   
}

/*Cette fonction renvoie le nombre d'utilisateurs inscrits*/
function getNumberOfUsers($link)
{
	$req = "SELECT COUNT(*) as N FROM utilisateur";
    $rslt = executeQuery($link, $req);
    $arr_rslt = array();

    $row = mysqli_fetch_assoc($rslt);
    $arr_rslt[0] = $row["N"];

    return $arr_rslt[0];
}

/*Cette fonction prend en paramètre le pseudo et le mot de passe actuel ainsi 
que le nouveau de mot de passe et met à jour la base de donnée via la connexion*/
function modifyMdp($pseudo,$hashPwd,$newhashPwd,$link)
{
    $req = "UPDATE utilisateur SET hash_mdp = \"$newhashPwd\" WHERE pseudo = \"$pseudo\" and hash_mdp = \"$hashPwd\"";
    executeUpdate($link,$req);
}

/*Cette fonction prend en paramètre le pseudo et le mot de passe actuel ainsi 
que le nouveau pseudo et met à jour la base de donnée via la connexion*/
function modifyPseudo($pseudo,$newPseudo,$hashPwd,$link)
{
    $req = "UPDATE utilisateur SET pseudo = \"$newPseudo\" WHERE pseudo = \"$pseudo\" and hash_mdp = \"$hashPwd\"";
    executeUpdate($link,$req);
}


?>