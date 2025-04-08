<?php
?>
        <div class="row">
            <div class="col s5">
                <div class="card z-depth-0">
                    <div class="card-image">
                        <img class="responsive-img" src="<?php echo  PATH_IMAGES . $photo['nomFich'] ?>">
                    </div>
<?php if ($is_legitime)
        echo '
                    <div class="card-action">
                        <div clas="right">
                            <a class="btn red" href="./?del_img=' . $photo['nomFich'] . '"><i class="material-icons">delete</i></a>
                            <a class="btn" href="./?page=detail_photo&photo='.$photo['nomFich'].'&edit=true"><i class="material-icons">edit</i></a>
                        </div>
                    </div>';?>
                </div>
            </div>
            <div class="col s7">
                <div class="row card-panel z-depth-0 grey lighten-2">
                    <div class="col s4">
                        <p class="flow-text">Nom du fichier : </p>
                    </div>
                    <div class="">
                        <p class="flow-text"><?php echo $photo['nomFich'] ?></p>
                    </div>
                </div>
                <div class="row card-panel z-depth-0 ">
                    <div class="col s4">
                        <p class="flow-text">Catégorie : </p>
                    </div>
                    <div class="">
                        <p class="flow-text"><?php echo $photo['categorie'] ?></p>
                    </div>
                </div>
                <div class="row card-panel z-depth-0 grey lighten-2"">
                    <div class="col s4">
                        <p class="flow-text">Description : </p>
                    </div>
                    <div class="">
                        <p class="flow-text"><?php echo $photo['description'] ?></p>
                    </div>
                </div>
                <div class="row card-panel z-depth-0 ">
                    <div class="col s4">
                        <p class="flow-text">Utilisateur : </p>
                    </div>
                    <div class="">
                        <p class="flow-text"><?php echo $photo['utilisateur'] ?></p>
                    </div>
                </div>
                <div class="row card-panel z-depth-0 grey lighten-2"">
                    <div class="col s4">
                        <p class="flow-text">Etat : </p>
                    </div>
                    <div class="">
                        <p class="flow-text"><?php echo $photo['cache'] ?></p>
                    </div>
                </div>
            </div>
        </div>