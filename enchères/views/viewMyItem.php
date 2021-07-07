<?php
require_once ('header.php'); ?>

<table border="1" class="text-center">
    <h2>Mes enchères</h2>
    <tr>
        <th>Nom de l'article</th>
        <th>Date début enchère</th>
        <th>Date de fin de l'enchère</th>
        <th>Offre la plus haute</th>
        <th>Accéder à la page de l'article</th>

        <?php
        $ligne = $resultItemId;

        echo '<tr>';
        foreach ($ligne as $valeur){
            echo '<td>'.$valeur['itemName'].'</td>';
            echo '<td>'.$valeur['dateStartEnchere'].'</td>';
            echo '<td>'.$valeur['dateEndEnchere'].'</td>';
            if ($valeur['priceUpdate'] === null){
                echo '<td>pas encore d\'offre</td>';
            }else {
                echo '<td>'.$valeur['priceUpdate'].'</td>';
            }
            ?>
            <td><a href="controllerItem/getItemSell/<?=$valeur['itemId']?>">href</a></td>
        <?php
            echo '</tr>';
        }
        echo '</table></center>';
        require_once ('footer.php');?>
