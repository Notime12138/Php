<!-- ----- début viewInsert -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>

<form role="form" method='get' action='router.php'>
    <div class="form-group">
        <input type="hidden" name='action' value='eveCreated'>
        <h2>Ajout d'un evenment </h2>
        <label for="ind">Selectionnez un individu: </label> <select class="form-control" id='ind_id' name='ind_id' style="width: 400px">
            <?php
            foreach ($resultsInd as $ind) {
                $ind_id = $ind->getId();
                printf("<option value = $ind_id>%s : %s</option>", $ind->getNom(), $ind->getPrenom());
            }
            ?>
        </select> 
        <label for="type">Selectionnez un type evenement: </label> <select class="form-control" id='type' name='type' style="width: 400px">
            <option>DECES</option>
            <option>NAISSANCE</option>
        </select> 
        <label for="date">Date (AAAA-MM-JJ) ? </label>
        <input type="date" class="form-control" id="date" name="date" value="2051-04-01" style="width: 400px">
        <label for="lieu">Lieu ? </label>
        <input type="text" class="form-control" id="lieu" name="lieu" value="Troyes" style="width: 400px">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewInsert -->
