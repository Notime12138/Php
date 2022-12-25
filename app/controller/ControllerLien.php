
<!-- ----- debut ControllerLien -->
<?php
require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';

class ControllerLien {

    public static function lienReadAll() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $results = ModelLien::getAll($famille_id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewAll.php';
        if (DEBUG)
            echo ("ControllerLien : eveReadAll : vue = $vue");
        require ($vue);
    }

    public static function addLienP() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $resultsInd = ModelIndividu::getAll($famille_id);
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertP.php';
        if (DEBUG)
            echo ("ControllerLien : viewInsertP : vue = $vue");
        require ($vue);
    }

    public static function lienCreatedP() {
        // ajouter une validation des informations du formulaire
        $nom = $_SESSION['famille'];
        $famille_id = ModelFamille::getOneId($nom);
        $iid_e = @$_GET['ind_enfant'];
        $iid_p = @$_GET['ind_parent'];
        $results = ModelIndividu::update(
                        $famille_id, $iid_p, $iid_e
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertedP.php';
        if (DEBUG)
            echo ("ControllerLien : viewInsertedP : vue = $vue");
        require($vue);
    }

    public static function addLienU() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $resultsInd = ModelIndividu::getAllSexe($famille_id);
        $resultsH = $resultsInd[0];
        $resultsF = $resultsInd[1];
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertU.php';
        if (DEBUG)
            echo ("ControllerLien : viewInsertU : vue = $vue");
        require ($vue);
    }

    public static function lienCreatedU() {
        // ajouter une validation des informations du formulaire
        $nom = $_SESSION['famille'];
        $famille_id = ModelFamille::getOneId($nom);
        $iid_h = @$_GET['ind_h'];
        $iid_f = @$_GET['ind_f'];
        $id = ModelLien::insert(
                        $famille_id, $iid_h, $iid_f, @$_GET['type'], @$_GET['date'], @$_GET['lieu']
        );
        $results = ModelLien::getOne($famille_id, $id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertedU.php';
        if (DEBUG)
            echo ("ControllerLien : viewInsertedU : vue = $vue");
        require($vue);
    }

}
?>
<!-- ----- fin ControllerLien -->


