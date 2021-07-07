<?php
if($resultItemId['categoryNumber'] == 1){
    $category = 'Informatique';
}elseif($resultItemId['categoryNumber'] == 2){
    $category = 'Ameublement';
}elseif($resultItemId['categoryNumber'] == 3){
    $category = 'Vêtement';
}else{
    $category = 'Sport & Loisirs';
}
require_once ('header.php');?>

<table border="1">
    <tr>
        <td>Nom de l'article: </td>
        <td><?= $resultItemId['itemName']?></td>
    </tr>
    <tr>
        <td>Description: </td>
        <td><?= $resultItemId['description']?></td>
    </tr>
    <tr>
        <td>Catégorie: </td>
        <td><?= $category?></td>
    </tr>
    <tr>
        <td>Prix de départ: </td>
        <td><?= $resultItemId['initialPrice']?></td>
    </tr>
    <tr>
        <td>Meilleur offre: </td>
        <td><?=$resultItemId['priceUpdate']?> par <a href="controllerUser/getUserProfile/<?= $resultDataPseudo['userId']?>"><?=$resultItemId['pseudoUpdate']?></a></td>
    </tr>
    <tr>
        <td>Retrait de l'article: </td>
        <td><?= 'Pas fait encore'?></td>
    </tr>
    <tr>
        <td>Vendeur: </td>
        <td><a href="controllerUser/getUserProfile/<?=$resultItemId['userId']?>"><?= $resultItemId['pseudo']?></a></td>
    </tr>
    <?php if(empty($_SESSION)){ ?>
    <tr>
        <td>Ma proposition: </td>
        <td><a href="controllerUser/connexion">Vous devez être connecté pour enchérir</a> </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td>Ma proposition: </td>
        <td>
            <form method="post" action="controllerBid/updatePrice/<?=$resultItemId['itemId']?>">
                <input type="number" name="newRaise">
                <input type="submit" name="submit" value="Enchérir">
            </form>
        </td>
    </tr>
    <?php } ?>

</table>

<?php

require_once ('footer.php');

