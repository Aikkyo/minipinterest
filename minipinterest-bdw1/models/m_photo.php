<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////                   Objet                                   ////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
class Photo {
    var $nom;
    var $owner;

    public function __construct($nom, $owner)
    {
        $this->nom = $nom;
        $this->owner = $owner;
    }
}




////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////                   Récupérations                           ////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 * Récupère les catégories sous forme de liste ('nomCat')
 *$link est le liens à la bdd
 *
 * retourne un array de string
 */
function getCategories($link) {
    $sql = "select nomCat from categorie";

    $rslt = executeQuery($link, $sql);
    $arr_rslt = array();
    if(is_bool($rslt))
        return null;

    while($res = mysqli_fetch_assoc($rslt))
        $arr_rslt[] = $res['nomCat'];

    return $arr_rslt;
}

/*
 *Récupère toutes les données photos de la bdd sous forme de liste d'objets Photo ('photo')
 *$link est le liens à la bdd
 * $cat est obtionnel (sinon undefined) permet de filtrer par catégorie
 * $pseudo est optionnel (sinon undefined) , il permet de filtrer par pseudo
 *
 * retoure un array d'objet Photo
 */
function getPhotos($link, $cat = null, $pseudo = null) {

    $sql = "select nomFich, pseudo from photo join utilisateur on utilisateurID = userID where is_cacher = false ";

    if ($pseudo != null && $cat != null)
        $sql .= "and "." pseudo like '".$pseudo."'".
            " and "."catID in (select cat_id from  categorie where nomCat like '".$cat."')";
    else if($cat != null)
        $sql .= "and "."catID in (select cat_id from  categorie where nomCat like '".$cat."')";
    else if($pseudo != null)
        $sql .= "and "."pseudo like '".$pseudo."'";

    $rslt = executeQuery($link, $sql);
    $arr_rslt = array();
    if(is_bool($rslt))
        return null;

    while($res = mysqli_fetch_assoc($rslt))
        $arr_rslt[] = new Photo($res['nomFich'], $res['pseudo']);

    return $arr_rslt;
}

/*
 *Récupère toutes les données photos de la bdd sous forme de liste ('nomFich') même les cacher
 *$link est le liens à la bdd
 * $cat est obtionnel (sinon undefined) permet de filtrer par catégorie
 * $pseudo est optionnel (sinon undefined) , il permet de filtrer par pseudo
 *
 * retoure un array de string
 */
function getToutesPhotosAdmin($link, $cat = null, $pseudo = null) {
    $sql = "select nomFich, pseudo from photo join utilisateur on utilisateurID = userID ";

    if ($pseudo != null && $cat != null)
        $sql .= "and "." pseudo like '".$pseudo."'".
            " and "."catID in (select cat_id from  categorie where nomCat like '".$cat."')";
    else if($cat != null)
        $sql .= "and "."catID in (select cat_id from  categorie where nomCat like '".$cat."')";
    else if($pseudo != null)
        $sql .= "and "."pseudo like '".$pseudo."'";


    $rslt = executeQuery($link, $sql);
    $arr_rslt = array();
    if(is_bool($rslt))
        return null;

    while($res = mysqli_fetch_assoc($rslt))
        $arr_rslt[] = new Photo($res['nomFich'], $res['pseudo']);

    return $arr_rslt;
}

/*
 *Récupère toutes les données photos de la bdd sous forme de liste ('nomFich') même les cacher
 *$link est le liens à la bdd
 * $cat est obtionnel (sinon undefined) permet de filtrer par catégorie
 * $pseudo est optionnel (sinon undefined) , il permet de filtrer par pseudo
 *
 * retoure un array de string
 */
function getToutesPhotosUser($link,  $pseudo, $cat = null, $pseudo_filtre = null) {
    $sql = 'select nomFich, pseudo from photo join utilisateur on utilisateurID = userID ' .
            'where (pseudo like \'' . $pseudo . '\' or is_cacher = 0) ';

    if ($pseudo_filtre != null && $cat != null)
        $sql .= "and "." pseudo like '".$pseudo_filtre."'".
            " and "."catID in (select cat_id from  categorie where nomCat like '".$cat."')";
    else if($cat != null)
        $sql .= "and "."catID in (select cat_id from  categorie where nomCat like '".$cat."')";
    else if($pseudo_filtre != null)
        $sql .= "and "."pseudo like '".$pseudo_filtre."'";

    $rslt = executeQuery($link, $sql);
    $arr_rslt = array();
    if(is_bool($rslt))
        return null;

    while($res = mysqli_fetch_assoc($rslt))
        $arr_rslt[] = new Photo($res['nomFich'], $res['pseudo']);

    return $arr_rslt;
}

/*
 *Récupère une photo en particulier sous forme d'une array
 *$link est le liens à la bdd
 * $nomPhoto  est le nom de la photo
 *
 * retoure une liste avec les champs ('nomFich', 'categorie', 'utilisateur', 'description', 'caché')
 */
function getPhoto($link, $nomPhoto) {
    $sql = "select  nomFich, pseudo, nomCat, description, is_cacher from photo 
                join utilisateur u on photo.userID = u.utilisateurID 
                join categorie c on photo.catID = c.cat_id
                where nomFich like '$nomPhoto';";

    //echo $sql;

    $rslt = executeQuery($link, $sql);
    $arr_rslt = array();
    if(is_bool($rslt))
        return null;

    $res = mysqli_fetch_assoc($rslt);
    $arr_rslt['nomFich'] = $res['nomFich'];
    $arr_rslt['categorie'] = $res['nomCat'];
    $arr_rslt['utilisateur'] = $res['pseudo'];
    $arr_rslt['description'] = $res['description'];

    if($res['is_cacher'] == 0)
        $arr_rslt['cache'] = 'Visible';
    else
        $arr_rslt['cache'] = 'Caché';

    return $arr_rslt;
}

/*
 *Récupère le nombre de photos de la bdd sous forme de liste ('nomFich')
 *$link est le liens à la bdd
 * $cat est obtionnel (sinon undefined) permet de filtrer par catégorie
 * $pseudo est optionnel (sinon undefined) , il permet de filtrer par pseudo
 *
 * retourne un entier
 */
function getNumberPhoto($link, $cat, $pseudo) {
    $req = "SELECT COUNT(*) as Nbr FROM photo";
    $rslt = executeQuery($link, $req);
    $arr_rslt = array();

    if(is_bool($rslt))
        return null;

    $row = mysqli_fetch_assoc($rslt);
    $arr_rslt[0] = $row["Nbr"];

    return $arr_rslt[0];
}

/*
 * Récupère le nombre de catégories
*$link est le liens à la bdd
 *
 * retourne un entier
 */
function getNumberCat($link) {
    $req = "SELECT COUNT(*) as Nbr FROM categorie";
    $rslt = executeQuery($link, $req);
    $arr_rslt = array();

    if(is_bool($rslt))
        return null;

    $row = mysqli_fetch_assoc($rslt);
    $arr_rslt[0] = $row["Nbr"];

    return $arr_rslt[0];
}

////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////                   Mise a jour                             ////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/*  /!\TO-DO/!\
*Ajout et upload la photo sur le server et sur la bdd.
 *$link est le liens à la bdd
 * $pseudo est le créateur de la photo
 * $img est les contenue de $_Files['fichier']
 * $description est la description de la photo
 *
 * Retourne true si la modification a été éffectué, sinon false
*/
function addPhoto($link, $pseudo, $img, $description, $cat, $est_cachee) {
    $req = 'insert into photo (nomFich, description, catID, userID, is_cacher)
values (\''. $img .'\', \''.$description.'\', (select cat_id from categorie where nomCat like \''.$cat.'\'),
        (select utilisateurID from utilisateur where pseudo like \''.$pseudo.'\') , \''.$est_cachee.'\');';
    //echo $req;
    executeUpdate($link, $req);
}

/*
*Change l'état de la photo comme "cachée" sur la bdd.
 *$link est le liens à la bdd
 * $nom_img est le nom de l'image a cacher
 *
 * Retourne true si la modification a été éffectué, sinon false
*/
function hidePhoto($link, $nom_img) {
    $req = 'update photo set is_cacher = true where nomFich like \''.$nom_img.'\'';
    executeUpdate($link,$req);
}

/*
*Change l'état de la photo comme "non cachée" sur la bdd.
 *$link est le liens à la bdd
 * $nom_img est le nom de l'image a cacher
 *
 * Retourne true si la modification a été éffectué, sinon false
*/
function unHidePhoto($link, $nom_img) {
    $req = 'update photo set is_cacher = false where nomFich like \''.$nom_img.'\'';
    executeUpdate($link,$req);
}

/*  /!\TO-DO/!\
*Supprime la photo sur le serveur et sur la bdd.
 *$link est le liens à la bdd
 * $img est les contenue de $_Files['fichier']
 *
 * Retourne true si la modification a été éffectué, sinon false
*/
function removePhoto($link, $nom_img) {
    $sql = 'delete from `photo` where `photo`.`nomFich` = \''.$nom_img.'\'';
    executeUpdate($link, $sql);
}

/*  /!\TO-DO/!\
 * Modifier et/ou upload la photo sur le server et sur la bdd.
 *$link est le liens à la bdd
 * $nom_img nom de l'image à modifier
*new_img est les contenue de $_Files['fichier'], optionnel (sinon undefined)
 * $description est la nouvelle description de l'image, optionnel (sinon undefined)
 *
 * Retourne true si la modification a été éffectué, sinon false
*/
function modifierPhoto($link, $nom_img, $new_nom_img, $new_description, $new_cat) {
    $sql = 'UPDATE `photo` SET ';

    if($new_description != null)
        $sql .= ' description = \'' . $new_description . '\',';
    if($new_cat != null) {
        $cat_id = null;
        $sql_cat = 'select cat_id from categorie where nomCat like \'' . $new_cat .'\';';
        $rep_cat = executeQuery($link, $sql_cat);
        if(!is_bool($rep_cat) && mysqli_num_rows($rep_cat) == 1) {
            $cat_id = mysqli_fetch_assoc($rep_cat)['cat_id'];
            $sql .= ' catID = '. $cat_id .',';
        }
    }
    if($new_nom_img != null) {
        $sql .= ' nomFich = \'' . $new_nom_img . '\',';
    }

    $sql = rtrim($sql, ',');
    $sql .=  ' where nomFich like \'' . $nom_img .'\';';
    executeUpdate($link, $sql);
}

function addCategorie($link, $new_cat) {
    $req = 'insert INTO `categorie` (`cat_id`, `nomCat`) VALUES (NULL, \''.$new_cat.'\');';
    executeUpdate($link, $req);
}