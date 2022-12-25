<!-- ----- debut ControllerGenealogie -->
<?php

class ControllerGenealogie {

    public static function genealogieAccueil() {
        unset($_SESSION['famille']);
        include 'config.php';
        $vue = $root . '/app/view/viewGenealogieAccueil.php';
        if (DEBUG)
            echo ("ControllerGenealogie : genealogieAccueil : vue = $vue");
        require ($vue);
    }

    public static function Doc() {
        include 'config.php';
        $vue = $root . '/app/view/viewDoc.php';
        if (DEBUG)
            echo ("ControllerGenealogie : viewDoc : vue = $vue");
        require ($vue);
    }
    
        public static function Error() {
        include 'config.php';
        $vue = $root . '/app/view/viewError.php';
        if (DEBUG)
            echo ("ControllerGenealogie : viewError : vue = $vue");
        require ($vue);
    }

}
?>

<!-- ----- fin ControllerGenealogie -->
