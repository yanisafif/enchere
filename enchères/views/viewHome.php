<?php
require_once ('header.php');?>

    <form method="post" action="#">
        <h2 class="text-center">Liste des enchères</h2>
        <table class="text-center">
            <tr>
                <td>Filtres</td>
                <td><input type="text" name="" size="20"></td>

                <td>Catégorie</td>
                <td>
                    <select id="category" name="categoryNumber">
                        <option value="Informatique">Informatique</option>
                        <option value="Ameublement">Ameublement</option>
                        <option value="Vetement">Vêtement</option>
                        <option value="Sport & Loisirs">Sport & loisir</option>
                    </select>
                </td>

                <td></td>
                <td><input type="submit" name="rechercher" value="Rechercher"></td>
            </tr>
        </table>
    </form>

    <table border="2" class="text-center">
        <tr>
            <th>Nom de l'article</th>
            <th>Description</th>
            <th>Date de fin de l'enchère</th>
            <th>Pseudo du vendeur</th>
            <th>Accéder à la page de l'article</th>

            <?php
            $ligne = $resultGetItems->fetchAll(PDO::FETCH_NUM);
            echo '<tr>';
            foreach ($ligne as $valeur){
                echo '<td>'.$valeur[1].'</td>';
                echo '<td>'.$valeur[2].'</td>';
                echo '<td>'.$valeur[4].'</td>';
                ?>
                <td><a href="controllerUser/getUserProfile/<?=$valeur[6]?>"><?= $valeur[7]?></a></td>
                <td><a href="controllerItem/getItemSell/<?=$valeur[0]?>">href</a></td>
            <?php
        echo '</tr>';
            }
            echo '</table></center>';
require_once ('footer.php');?>

