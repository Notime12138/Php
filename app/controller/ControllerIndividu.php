
<!-- ----- debut ControllerIndividu -->
<?php
require_once '../model/ModelIndividu.php';
require_once '../model/ModelEve.php';
require_once '../model/ModelLien.php';

class ControllerIndividu {

    public static function indReadAll() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $results = ModelIndividu::getList($famille_id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewAll.php';
        if (DEBUG)
            echo ("ControllerIndividu : indReadAll : vue = $vue");
        require ($vue);
    }

    public static function addInd() {
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInsert.php';
        if (DEBUG)
            echo ("ControllerIndividu : viewInsert : vue = $vue");
        require ($vue);
    }

    public static function indCreated() {
        // ajouter une validation des informations du formulaire
        $nom = $_SESSION['famille'];
        $famille_id = ModelFamille::getOneId($nom);
        $isExisted = ModelIndividu::isExisted($famille_id, @$_GET['nom'], @$_GET['prenom'], @$_GET['sexe']);
        $id = ModelIndividu::insert(
                        $famille_id, @$_GET['nom'], @$_GET['prenom'], @$_GET['sexe'], 0, 0
        );
        $results = ModelIndividu::getInd($famille_id, $id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInserted.php';
        if (DEBUG)
            echo ("ControllerIndividu : viewInserted : vue = $vue");
        require($vue);
    }

    public static function pageInd() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $resultsInd = ModelIndividu::getAll($famille_id);
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInd.php';
        if (DEBUG)
            echo ("ControllerIndividu : viewInd : vue = $vue");
        require ($vue);
    }

    public static function indSelected() {
        $famille_id = ModelFamille::getOneId($_SESSION['famille']);
        $ind_id = @$_GET['ind_id'];
        $ind = ModelIndividu::getInd($famille_id, $ind_id);
        $eve = ModelEve::getEve($famille_id, $ind_id);
        $pere_id = $ind['pere'];
        $mere_id = $ind['mere'];
        $pere = ModelIndividu::getNP($famille_id, $pere_id);
        $mere = ModelIndividu::getNP($famille_id, $mere_id);
        $couple_id = ModelLien::getCouple($famille_id, $ind_id);
        $union = ModelIndividu::getUnion($famille_id, $ind_id, $couple_id);
        include 'config.php';
        $vue = $root . '/app/view/individu/viewPage.php';
        if (DEBUG)
            echo ("ControllerIndividu : viewPage : vue = $vue");
        require ($vue);
    }

}
?>
<!-- ----- fin ControllerIndividu -->


