
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');

if ($results) {
    echo ("<h3>Confirmation de la creation d'une union</h3>");
    echo("<ul>");
    foreach ($results as $key => $value) {
        echo ("<li>$key : $value</li>");
    }
    echo("</ul>");
}


include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
?>
<!-- ----- fin viewInserted -->    


