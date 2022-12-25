
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHead.php');

echo ("<h3>" . $ind['nom'] . " " . $ind['prenom'] . "</h3>");
echo("<ul>");
if (!@$eve['0']) {
    echo ("<li>Né le ?</li>");
} else {
    echo ("<li>Né le " . $eve['0']['event_date'] . " à " . $eve['0']['event_lieu'] . "</li>");
}
if (!@$eve['1']) {
    echo ("<li>Décès le ?</li>");
} else {
    echo ("<li>Décès le " . $eve['1']['event_date'] . " à " . $eve['1']['event_lieu'] . "</li>");
}

echo("</ul>");

echo ("<h2>Parents </h2>");
echo("<ul>");
echo ("<li>Pere " . $pere . "</li>");
echo ("<li>Mere " . $mere . "</li>");
echo("</ul>");

//echo ("<pre>");
//print_r(@$union);
//echo ("</pre>");
echo ("<h2>Unions et enfants</h2>");
echo("<ul>");
foreach (@$union as $uni) {
    echo ("<li>Union avec " . $uni[0] . "</li>");
    echo ("<ol>");
    foreach ($uni['1'] as $enfant) {
        echo ("<li>Enfant " . $enfant['0'] . "</li>");
    }
    echo("</ol><br/>");
}
echo("</ul>");

include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
?>
<!-- ----- fin viewInserted -->    


