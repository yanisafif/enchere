<?php
require_once ('header.php');?>

    <table>
        <tr>
            <td>Pseudo :</td>
            <td><?=$dataUserId['pseudo'] ?></td>
        </tr>
        <tr>
            <td>Prenom :</td>
            <td><?=$dataUserId['firstName'] ?></td>
        </tr>
        <tr>
            <td>Nom :</td>
            <td><?= $dataUserId['lastName']?></td>
        </tr>
        <tr>
            <td>Email :</td>
            <td><?=$dataUserId['email'] ?></td>
        </tr>
        <tr>
            <td>Numéro de téléphone :</td>
            <td><?=$dataUserId['phoneNumber'] ?></td>
        </tr>
        <tr>
            <td>Adresse :</td>
            <td><?=$dataUserId['adress'] ?></td>
        </tr>
        <tr>
            <td>Ville :</td>
            <td><?=$dataUserId['city'] ?></td>
        </tr>
    </table>

<?php
require_once ('footer.php');