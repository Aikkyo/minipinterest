<?php
?>
<script>
    $(document).ready(function(){
        $('#autocomplete-cat').autocomplete({
            data: {
                <?php
                foreach ($arr_cat as $cat)
                    echo '"' . $cat . '": null,' . "\n";
                ?>
            }
        });
        $('#autocomplete-pseudo').autocomplete({
            data: {
                <?php
                foreach ($arr_pseudos as $pseudoTemp)
                    echo '"' . $pseudoTemp . '": null,' . "\n";
                ?>
            }
        });
    });
</script>

<div class="row">
    <form action="./" method="get">
        <div class="input-field col s3">
            <input type="text" id="autocomplete-cat" name="categorie_filtre" class="autocomplete" autocomplete="off"
                <?php if(isset($_GET['categorie_filtre'])) echo 'value="' . $_GET['categorie_filtre'] . '"'; ?> >
            <label for="autocomplete-cat">Catégorie</label>
        </div>

        <div class="input-field col s3 ">
            <input type="text" id="autocomplete-pseudo" name="pseudo_filtre" class="autocomplete" autocomplete="off"
                <?php if(isset($_GET['pseudo_filtre'])) echo 'value="' . $_GET['pseudo_filtre'] . '"'; ?>>
            <label for="autocomplete-cat">Pseudo</label>
        </div>

        <div class="col s3">
            <br/>
            <button class="btn waves-effect waves-light" type="submit">Valider
                <i class="material-icons right">filter_list</i>
            </button>
        </div>
    </form>

</div>
<div class="row">
    <?php if ($arr_photos != null)
        foreach ($arr_photos as $photo) {
            echo '
    <div class="col s4">
        <div class="card small">
            <div class="card-image">
                <img class="responsive-img" src="' . PATH_IMAGES . $photo->nom . '">
            </div>
            <div class="card-action">
                <a class="btn" href="?page=detail_photo&photo=' . $photo->nom . '">Details</a>
                ';
            if($is_logged && ($photo->owner === $pseudo || $is_admin))
                echo '
                <div class="right">
                        <a class="btn" href="./?page=detail_photo&photo='. $photo->nom . '&edit=true"><i class="material-icons">edit</i></a>
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




