</br></br>
<h2>Liste des utilisateurs ayant mis en ligne des photos :</h2></br>
<h5><?php echo $nbr_users." utilisateurs inscrits";?></h5>
</br></br>
<?php if ($arr_profil != null)
    foreach ($arr_profil as $profil) {
        echo $profil->pseudo."    ".$profil->nbr." photo(s) ajoutée(s)"."</br>";
    }
?>
<h2>Liste des catégories avec des photos mise en ligne :</h2></br>
<h5><?php echo $nbr_cat." catégories disponibles";?></h5>
<?php
    if ($arr_category != null)
    foreach ($arr_category as $category)
    {
        echo $category->cat."    ".$category->nbr." photo(s) ajoutée(s)"."</br>";
    }
?>
