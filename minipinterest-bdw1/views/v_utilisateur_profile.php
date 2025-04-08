</br></br>
<div class="row userProfil">
    <div class="col s12 l4">
        <div class="card">
            <div class="card-action light-blue darken-2 white-text">
                <h2>Modifier mon pseudo</h2></br>
            </div>
            <div class="card-content">
                <form name="modif_pseudo" action="./index.php?page=user_profil" method="post">
                    <div>
                        <label for="new_pseudo">Entrer votre nouveau pseudo</label></br>
                        <input type="text" id="new_pseudo" name="new_pseudo" value=""></br></br>
                    </div>
                    <div>
                        <label for="old_pseudo">Entrer votre pseudo actuel</label></br>
                        <input type="text" id="old_pseudo" name="old_pseudo" value=""></br></br>
                    </div>
                    <div>
                        <label for="password">Entrer votre mot de passe :</label></br>
                        <input type="password" id="password" name="password" value=""></br></br>
                    </div>
                    <div class="button-spe">
                        <div class="form-field center-align">
                            <input class="btn-large green" type="submit" 
                            id="validationPseudo" name="validationPseudo" 
                            value="Changer le  pseudo"></br></br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col s12 l4 offset-l4">
        <div class="card">
            <div class="card-action light-blue darken-2 white-text">
                <h2>Modifier mon mot de passe</h2></br>
            </div>
            <div class="card-content">
                <form name="modif_mdp" action="./index.php?page=user_profil" 
                method="post">
                    <div>
                        <label for="old_pseudo2">Entrer votre pseudo</label></br>
                        <input type="text" id="old_pseudo2" name="old_pseudo2" 
                        value=""></br></br>
                    </div>
                    <div>
                        <label for="OldPassword">Entrer votre mot de passe 
                            actuel :</label></br>
                        <input type="password" id="OldPassword" name="OldPassword" 
                        value=""></br></br>
                    </div>
                    <div>
                        <label for="NewPassword">Entrer votre nouveau 
                            mot de passe :</label></br>
                        <input type="password" id="NewPassword" name="NewPassword" 
                        value=""></br></br>
                    </div>
                    <div class="button-spe">
                        <div class="form-field center-align">
                            <input class="btn-large green" type="submit" 
                            id="validationMdp" name="validationMdp" 
                            value="Changer le mot de passe"></br></br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<h2>Mes Photos</h2></br>
<div class="row">
    <?php if ($arr_photo_user != null)
        foreach ($arr_photo_user as $photo) {
            echo '
    <div class="col s4">
        <div class="card small">
            <div class="card-image">
                <img class="responsive-img" src="' . PATH_IMAGES . $photo->nom . '">
            </div>
            <div class="card-action">
                <a class="btn" href="?page=detail_photo&photo=' . $photo->nom . '">Details</a>
                ';
            if($_SESSION['logged'] && ($photo->owner == $_SESSION['pseudo'] || $_SESSION['isAdmin']))
                echo '
                <div class="right">
                        <a class="btn"><i class="material-icons">edit</i></a>
                        <a class="btn red" href="./?del_img='.$photo->nom.'"><i class="material-icons">delete</i></a>
                 </div>';
            echo '
            </div>
        </div>
    </div>
';
        }
    ?>
</div>
