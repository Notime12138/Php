
<!-- ----- début viewInsertedP -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');

if ($results === -1) {
    echo ("<h3>Personne ne peut être ses propres parents</h3>");
} else {
    echo ("<h3>Confirmation de la creation d'un lien parental</h3>");
    echo("<ul>");
    echo ("<li>famille_id = " . $results[0] . "</li>");
    echo ("<li>enfant_id = " . $results[1] . "</li>");
    echo ("<li>parent_id = " . $results[2] . "</li>");
    echo("</ul>");
}


include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
?>
<!-- ----- fin viewInsertedP -->    


