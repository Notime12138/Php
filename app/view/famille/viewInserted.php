
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');

if ($results === -1) {
    echo ("<h3>La famille a déja été ajouté !</h3>");
} else {
    echo ("<h3>La nouveau famille a été ajouté </h3>");
    echo("<ul>");
    echo ("<li>id = " . $results . "</li>");
    echo ("<li>famille = " . $_GET['nom'] . "</li>");
    echo("</ul>");
}


include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
?>
<!-- ----- fin viewInserted -->    


