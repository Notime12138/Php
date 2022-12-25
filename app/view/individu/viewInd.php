<!-- ----- début viewInsertP -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>

<form role="form" method='get' action='router.php'>
    <div class="form-group">
        <input type="hidden" name='action' value='indSelected'>
        <h2>Selection d'un individu </h2>
        <label for="ind">Selectionnez un individu: </label> <select class="form-control" id='ind_id' name='ind_id' style="width: 400px">
            <?php
            foreach ($resultsInd as $ind) {
                $ind_id = $ind->getId();
                printf("<option value = $ind_id>%s : %s</option>", $ind->getNom(), $ind->getPrenom());
            }
            ?>
        </select> 
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewInsertP -->
