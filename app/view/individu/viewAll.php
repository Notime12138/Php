
<!-- ----- début viewAll -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>
<table class = "table table-striped table-bordered">
    <thead>
        <tr>
            <?php
            $cols = $results[0];
            foreach ($cols as $col) {
                echo ("<th scope = 'col'>$col</th>");
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results[1] as $element) {
            echo ("<tr>");
            foreach ($element as $key => $value) {
                echo ("<td>$value</td>");
            }
            echo ("</tr>");
        }
        ?>
    </tbody>
</table>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewAll -->


