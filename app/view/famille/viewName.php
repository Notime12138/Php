
<!-- ----- début viewName -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>

<form role="form" method='get' action='router.php'>
    <div class="form-group">
        <input type="hidden" name='action' value='famReadOne'>
        <label for="name">Nom : </label> <select class="form-control" id='name' name='name' style="width: 300px">
            <?php
            foreach ($results as $name) {
                echo ("<option>$name</option>");
            }
            ?>
        </select>
    </div>
    <p/>
    <button class="btn btn-primary" type="submit">Submit form</button>
</form>
<p/>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewName -->