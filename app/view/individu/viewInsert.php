<!-- ----- début viewInsert -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>

<form role="form" method='get' action='router.php'>
    <div class="form-group">
        <input type="hidden" name='action' value='indCreated'>
        <h2>Ajout d'un individu </h2>
        <label for="Nom">Nom ? </label>
        <input type="text" class="form-control" id="nom" name="nom" value="GONG" style="width: 400px">
        <label for="Prenom">Prenom ? </label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="Ziwei" style="width: 400px">
        <label for="Sexe">Sexe ? </label>
        <div class="form-group">
            <input type="radio" name="sexe" id="male" value="H" checked>Masculin
            <input type="radio" name="sexe" id="female" value="F">Feminin
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewInsert -->
