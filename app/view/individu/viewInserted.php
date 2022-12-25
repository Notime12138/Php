
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');

if (!$isExisted) {
    echo ("<h3>Confirmation de la creation d'un individu</h3>");
} else {
    echo ("<h3>Le nom que vous avez renseigné existe déjà, mais il a quand même été créé</h3>");
}
echo("<ul>");
foreach ($results as $key => $value) {
    echo ("<li>$key = $value</li>");
}
echo("</ul>");

include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
?>
<!-- ----- fin viewInserted -->    


