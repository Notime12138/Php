
<!-- ----- debut Router -->
<?php
session_start();
require ('../controller/ControllerGenealogie.php');
require ('../controller/ControllerFamille.php');
require ('../controller/ControllerEve.php');
require ('../controller/ControllerLien.php');
require ('../controller/ControllerIndividu.php');

$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $param);
$action = htmlspecialchars($param["action"]);
$action = $param['action'];
//unset($param['action']);
//$args = $param;

//Lorsque la famille n'est pas sélectionnée, seule la page sous la famille est accessible, sinon elle sera redirigée vers un page spécifique
if ($_SESSION['famille'] == null && $action != 'famReadAll' && $action != 'addFamille' && $action != 'famReadName' && $action != 'famCreated' && $action != 'famReadOne' && $action != 'Doc' && $action != 'genealogieAccueil') {
    $action = 'Error';
}

// --- Liste des méthodes autorisées
switch ($action) {
    case "famReadAll" :
    case "addFamille" :
    case "famCreated" :
    case "famReadName" :
    case "famReadOne" :
        ControllerFamille::$action();
        break;
    case "eveReadAll" :
    case "addEve" :
    case "eveCreated" :
        ControllerEve::$action();
        break;
    case "lienReadAll" :
    case "addLienP" :
    case "addLienU" :
    case "lienCreatedP" :
    case "lienCreatedU" :
        ControllerLien::$action();
        break;
    case "indReadAll" :
    case "addInd" :
    case "indCreated" :
    case "pageInd" :
    case "indSelected" :
        ControllerIndividu::$action();
        break;
    case "Doc" :
    case "Error" :
        ControllerGenealogie::$action();
        break;
// Tache par défaut
    default:
        $action = "genealogieAccueil";
        ControllerGenealogie::$action();
}
?>
<!-- ----- Fin Router -->

