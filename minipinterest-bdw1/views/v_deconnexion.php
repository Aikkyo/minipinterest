<?php
$timer_sec = $_SESSION['timer_connexion'][0];
$timer_min = $_SESSION['timer_connexion'][1];
$timer_hour = $_SESSION['timer_connexion'][2] + 2;
$timer_day = $_SESSION['timer_connexion'][3];
$timer_month = $_SESSION['timer_connexion'][4];
$timer_year = $_SESSION['timer_connexion'][5] + 1900;
?>
                    <div class="nav-wrapper red lighten-2">
                        <form method="post" action="./" style="height: 36px">
                            <ul class="left">
                                <li class="tab">
                                    <a>Bonjour <?php echo $_SESSION['pseudo'] ?></a>
                                </li>
                                <li class="tab">
                                    <a>
                                    <?php echo '
                                        Session ouverte depuis le <bold>'.$timer_day.'/'.$timer_month.'/'.$timer_year.'</bold>
        à <bold>'.$timer_hour.'h '.$timer_min.'m '.$timer_sec.'s</bold>';?>
                                    </a>
                                </li>
                            </ul>
                            <ul class="right">
                                <li>
                                    <button id="deconnexion" class="btn-flat" type="submit" name="deconnexion">
                                        <a >Se Déconnecter</a>
                                    </button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
