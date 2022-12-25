
<!-- ----- début viewAll -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>

<table class = "table table-striped table-bordered">
    <caption>Liste des Familles</caption>
    <thead>
        <tr>
            <th scope = "col">id</th>
            <th scope = "col">nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(), $element->getNom());
        }
        ?>
    </tbody>
</table>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewAll -->


