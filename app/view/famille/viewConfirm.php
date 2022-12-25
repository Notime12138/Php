
<!-- ----- début viewConfirm -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');



if ($results) {
    echo ("<h3>Confirmation de la seleciton d'une famille </h3>");
    foreach ($results as $res) {
        printf("La famille %s (%d) est maintenant selectionnee.", $res->getNom(), $res->getId());
    }
}


include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
?>
<!-- ----- fin viewConfirm -->    


