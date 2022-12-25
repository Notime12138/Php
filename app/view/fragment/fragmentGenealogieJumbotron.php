
<!-- ----- debut fragmentGenealogieJumbotron -->

<div class="jumbotron">
    <?php
    if (@$_SESSION['famille']) {
        echo ("<h1>Famille " . $_SESSION['famille'] . "</h1>");
    } else {
          echo ("<h1>Pas de Famille selectionnee </h1>");
    }
    ?>

</div>
<p/>
<!-- ----- fin fragmentGenealogieJumbotron -->