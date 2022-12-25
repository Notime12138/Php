
<!-- ----- debut ControllerFamille -->
<?php
require_once '../model/ModelFamille.php';
require_once '../model/ModelIndividu.php';

class ControllerFamille {

    public static function famReadAll() {
        $results = ModelFamille::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewAll.php';
        if (DEBUG)
            echo ("ControllerFamille : famReadAll : vue = $vue");
        require ($vue);
    }

    public static function addFamille() {
        include 'config.php';
        $vue = $root . '/app/view/famille/viewInsert.php';
        if (DEBUG)
            echo ("ControllerFamille : viewInsert : vue = $vue");
        require ($vue);
    }

    public static function famCreated() {
        $_SESSION['famille'] = $_GET['nom'];
        // ajouter une validation des informations du formulaire
        $results = ModelFamille::insert(
                        htmlspecialchars($_GET['nom'])
        );
        ModelIndividu::insert($results);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewInserted.php';
        if (DEBUG)
            echo ("ControllerFamille : viewInserted : vue = $vue");
        require ($vue);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function famReadName() {
        $results = ModelFamille::getAllName();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewName.php';
        if (DEBUG)
            echo ("ControllerFamille : viewName : vue = $vue");
        require ($vue);
    }

    // Affiche un vin particulier (id)
    public static function famReadOne() {
        $nom = $_GET['name'];
        $_SESSION['famille'] = $nom;
        $results = ModelFamille::getOne($nom);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewConfirm.php';
        if (DEBUG)
            echo ("ControllerFamille : viewConfirm : vue = $vue");
        require ($vue);
    }

}
?>
<!-- ----- fin ControllerFamille -->


