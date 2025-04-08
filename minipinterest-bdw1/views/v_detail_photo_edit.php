<?php
?>
<script>
    $(document).ready(function () {
        $('select').formSelect();

        $('input.autocomplete').autocomplete({
            data: {
                <?php
                foreach ($arr_cat as $cat)
                    echo '"' . $cat . '": null,' . "\n";
                ?>
            }
        });

        $('input#input_text, textarea#textarea2').characterCounter();
        M.updateTextFields();
    });
</script>
<div class="row">
    <form method="post" action="./?page=detail_photo&photo=<?php echo $photo['nomFich'] ?>&edit=true&submission=true"
          enctype="multipart/form-data" >
        <div class="row">
            <div class="col s5">
                <div class="card z-depth-0">
                    <div class="card-image">
                        <img class="responsive-img" src="<?php echo PATH_IMAGES . $photo['nomFich'] ?>"/>
                    </div>
                    <div class="card-action">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Photo</span>
                                <input type="file" name="new_photo" accept="<?php echo implode(",", AVAIBLE_EXT); ?>"/>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text"/>
                            </div>
                        </div>
                        <?php if($invalid_format) echo '<span class="red-text">Le format saisie est inavlide il doit apartenir aux formats suivants : ('.implode(",", AVAIBLE_EXT).')</span></br>' ?>
                        <?php if($invalid_size) echo '<span class="red-text">La taille du fichier soumis est suppérieur à ' . MAX_SIZE . ' octets</span>'?>
                    </div>
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
                    <div class="input-field valign-wrapper">
                        <input type="text" id="autocomplete-cat" class="autocomplete"
                               name="new_cat"
                               value="<?php echo $photo['categorie'] ?>"
                               autocomplete="off">
                        <label for="autocomplete-cat">Catégorie</label>
                    </div>
                </div>
                <div class="row card-panel z-depth-0 grey lighten-2">
                    <div class="col s4">
                        <p class="flow-text">Description : </p>
                    </div>
                    <div class="input-field col s7">
                        <input id="new_description" type="text" class="validate" data-length="250"
                               name="new_description"
                               value="<?php echo $photo['description'] ?>">
                        <label class="active" for="new_description">Description</label>
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
                <div class="row card-panel z-depth-0 grey lighten-2">
                    <div class="col s4">
                        <p class="flow-text">Etat : </p>
                    </div>
                    <div class="">
                        <br/>
                        <label class="valign-wrapper">
                            <input name="new_cachee"
                                   type="checkbox" <?php if ($photo['cache'] == 'Caché') echo ' checked="checked" ' ?>/>
                            <span class="flow-text">Cachée</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <button type="submit" class="btn-large orange"
                                href="./?page=detail_photo&photo=<?php echo $photo['nomFich'] ?>&edit=true&submission=true">
                            <i class="material-icons">save</i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>