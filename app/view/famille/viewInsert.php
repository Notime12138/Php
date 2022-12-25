<!-- ----- début viewInsert -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');
?>

<form role="form" method='get' action='router.php'>
    <div class="form-group">
        <input type="hidden" name='action' value='famCreated'>   
        <label for="nom">Creation d'une famille </label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de Famille ?" value="GONG">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>


<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewInsert -->
