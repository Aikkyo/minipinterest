<?php
?>

<script>
    $(document).ready(function(){
        $('input.autocomplete').autocomplete({
            data: {
                <?php
                    foreach ($arr_cat as $cat)
                        echo '"' . $cat . '": null,' . "\n";
                    ?>
            }
        });
    });
</script>

<div class="row">
    <form action="./?page=ajout_photo" method="post" enctype="multipart/form-data">
        <div class="row ">
            <div class="file-field input-field col s3">
                <div class="btn">
                    <span>Photo</span>
                    <input id="file-input" type="file" name="new_photo" accept="<?php echo implode(",", AVAIBLE_EXT); ?>"/>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                <?php if($invalid_format) echo '<span class="red-text">Le format saisie est inavlide il doit apartenir aux formats suivants : ('.implode(",", AVAIBLE_EXT).')</span></br>'?>
                <?php if($invalid_size) echo '<span class="red-text">La taille du fichier soumis est suppérieur à '.MAX_SIZE.' octets</span>'?>
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <div class="input-field">
                    <input type="text" id="autocomplete-cat" name="categorie" class="autocomplete" autocomplete="off">
                    <label for="autocomplete-cat">Catégorie</label>
                </div>
                <?php if($invalid_cat) echo '<span class="red-text">La catégorie doit être remplit</span>' ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <textarea id="description" name="description" class="materialize-textarea" data-length="250"
                maxlength="250"></textarea>
                <label for="description">Description</label>
                <?php if($invalid_description) echo '<span class="red-text">La description doit être remplit</span>' ?>
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <label>
                    <input name="cachee" type="checkbox" />
                    <span>Cachée</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <button class="btn waves-effect waves-light" type="submit">Envoyer
                    <i class="material-icons right">add_to_photos</i>
                </button>
            </div>
        </div>
    </form>
</div>
