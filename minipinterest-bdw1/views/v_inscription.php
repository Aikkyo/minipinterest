
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Premi&egrave;re inscription</title>
  <link rel="stylesheet" href="css/pinterest.css">
</head>
<body>
<div class="row inscription">
    <div class="col s12 l4 offset-l4">
        <div class="card">
            <div class="card-action green white-text">
                <h1>Inscription</h1>
            </div>
            <div class="card-content">
                <form name="inscription" action="./index.php?page=inscription" 
                method="post">
                <div>
                    <label for="pseudo">Choisissez votre pseudonyme :</label>
                </br>
                    <input type="text" id="pseudo" name="pseudo" 
                    required pattern=".*\S.*" value="">
                </br></br>
                </div>
                <div>
                    <label for="password">Choisissez votre mot de passe ultra
                         secret :</label></br>
                    <input type="password" id="password" name="password" 
                    required pattern=".*\S.*" value=""></br></br>
                </div>
                <div>
                    <label for="confirmationPassword">Confirmez votre 
                        mot de passe mega giga secret :</label></br>
                    <input type="password" id="confirmationPassword" 
                    name="confirmationPassword" value=""></br></br>
                </div>
                <div class="button-spe">
                    <input class="btn-large green" type="submit" id="validation"
                     name="validation" value="S'inscrire"></br></br>
                </div>
                </form>
                <a class="btn-small light-blue" href="./index.php?page=accueil">
                Déjà inscrit ?</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>