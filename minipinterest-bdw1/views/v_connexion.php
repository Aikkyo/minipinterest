<!--<div class="row login">
  <div class="col s12 l4">
    <div class="card">
      <div class="card-action light-blue darken-2 white-text">
        <h1>Connexion</h1>
      </div>
      <div class="card-content">
        <form name="connexion" action="index.php" method="post">
            <label for="c">Entrer votre pseudo :</label></br>
            <input type="text" id="pseudo" name="pseudo" value=""/></br></br>
            <label for="mdp">Entrer votre mot de passe :</label></br>
            <input type="password" id="mdp" name="mdp" value=""/></br></br>
            <div class="button-spe">
              <div class="form-field center-align">
                <input class="btn-large green" type="submit" id="connexion" 
                name="connexion" value="Se connecter"></br></br>
              </div>
            </div>
        </form>
        <a class="btn-small light-blue" href="./index.php?page=inscription">
        Première connexion ?</a>
      </div>
    </div>
  </div>
</div>-->
        <div class="nav-wrapper red lighten-2">
            <form name="connexion" action="./" method="post" style="height: 36px">
                <ul class="left">
                    <li class="">
                        <a>Connexion</a>
                    </li>
                    <li class="valign-wrapper">
                        <div class="row" style="margin-bottom: 0px;">
                            Pseudo :
                            <div class="input-field inline">
                                <input class="white-text" name="pseudo" type="text" style="margin-bottom: 4px">
                            </div>
                        </div>
                    </li>
                    <li class="valign-wrapper" >
                        <div class="row" style="margin-bottom: 0px;">
                            Mot de passe :
                            <div class="input-field inline">
                                <input name="mdp" type="password" style="margin-bottom: 4px">
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="right">
                    <li>
                        <button id="connexion" class="btn-flat" type="submit" name="connexion">
                            <a >Se connecter</a>
                        </button>
                    </li>
                    <li>
                        <a class="" href="./index.php?page=inscription">
                            Première connexion ?</a>
                    </li>
                </ul>
            </form>
        </div>
        <?php if(!$couple_ok) echo '
        <div class="nav-wrapper red lighten-4">
            <ul class="left">
                <li>
                    <h6 class="orange-text">Le couple pseudo/mot de passe n\'existe pas</h6>
                </li>
            </ul>
        </div>'; ?>
    </div>
</header>
