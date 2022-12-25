
<!-- ----- debut ControllerEve -->
<?php
require_once '../model/ModelEve.php';
require_once '../model/ModelFamille.php';
require_once '../model/ModelIndividu.php';

class ControllerEve {

    public static function eveReadAll() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $results = ModelEve::getAll($famille_id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/eve/viewAll.php';
        if (DEBUG)
            echo ("ControllerEve : eveReadAll : vue = $vue");
        require ($vue);
    }

    public static function addEve() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $resultsInd = ModelIndividu::getAll($famille_id);
        include 'config.php';
        $vue = $root . '/app/view/eve/viewInsert.php';
        if (DEBUG)
            echo ("ControllerEve : viewInsert : vue = $vue");
        require ($vue);
    }

    public static function eveCreated() {
        // ajouter une validation des informations du formulaire
        $nom = $_SESSION['famille'];
        $famille_id = ModelFamille::getOneId($nom);
        $iid = $_GET['ind_id'];
        $type = @$_GET['type'];
        $date = @$_GET['date'];
        $lieu = @$_GET['lieu'];
        $isExisted = ModelEve::isExisted($famille_id, $iid, $type);
        if ($isExisted) {
            $id = ModelEve::update($famille_id, $iid, $type, $date, $lieu);
        } else {
            $id = ModelEve::insert($famille_id, $iid, $type, $date, $lieu);
        }
        $results = ModelEve::getOne($famille_id, $id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/eve/viewInserted.php';
        if (DEBUG)
            echo ("ControllerEve : viewInserted : vue = $vue");
        require($vue);
    }

}
?>
<!-- ----- fin ControllerEve -->


