<?php
/* Module de PHP
 * Paramètres de configuration du site
 *
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

const DEBUG = true; // production : false; dev : true

// Accès base de données
const BD_HOST = 'localhost';
const BD_DBNAME = 'p1810160';
const BD_USER = 'p1810160';
const BD_PWD = 'fe8a2c';

// Langue du site
const LANG ='FR-fr';

// Paramètres du site : nom de l'auteur ou des auteurs
const AUTEUR = 'JORIS ROSSI P1810160 / AMAURY JOLY P1910892';
const ORGANISATION = 'UCBL LYON 1 - Licence Informatique - BDW1';
const ORGANISATION_LINK = 'http://licence-info.univ-lyon1.fr/';

define('AVAIBLE_EXT', array(
    '.jpg',
    '.gif',
    '.jpeg'
));
define('MAX_SIZE', 100000);

//dossiers racines du site
define('PATH_CONTROLLERS','./controlers/c_');
define('PATH_ASSETS','./assets/');
//define('PATH_LIB','./lib/');
define('PATH_MODELS','./models/m_');
define('PATH_VIEWS','./views/v_');
//define('PATH_TEXTES','./languages/');

//sous dossiers
define('PATH_CSS', './css/');
define('PATH_IMAGES', PATH_ASSETS.'image/');
//define('PATH_SCRIPTS', PATH_ASSETS.'scripts/');
//define("PATH_GALERIE",'galerie/');
//define('PATH_LOG','log/');

//fichiers
//define('LOG_BDD','logbdd.txt');
//define('PATH_LOGO', PATH_IMAGES.'logo.png');
//define('PATH_MENU', PATH_VIEWS.'menu.php');
