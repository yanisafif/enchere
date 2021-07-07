<?php require_once('header.php'); ?>

    <form action="controllerUser/updatedUser/<?= $dataUser['userId'] ?>" method="post">
        <h2 class="text-center">Modification de mon compte</h2>
        <center>
            <table>
                <tr>
                    <td>Pseudo:</td>
                    <td><input type="text" name="pseudo" size="50" maxlength="30" value="<?= $dataUser['pseudo'] ?>"></td>
                </tr>
                <tr>
                    <td>Prénom:</td>
                    <td><input type="text" name="firstName" size="50" maxlength="30" value="<?= $dataUser['firstName'] ?>"></td>
                </tr>
                <tr>
                    <td>Nom:</td>
                    <td><input type="text" name="lastName" size="50" maxlength="30" value="<?= $dataUser['lastName'] ?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" size="50" maxlength="50" value="<?= $dataUser['email'] ?>"></td>
                </tr>
                <tr>
                    <td>Numéro de téléphone:</td>
                    <td><input type="tel" name="phoneNumber" size="50" maxlength="15" pattern="[0-9]{10}" placeholder="Ex : 0680121212" value="<?= $dataUser['phoneNumber'] ?>"></td>
                </tr>
                <tr>
                    <td>Adresse:</td>
                    <td><input type="text" name="adress" size="50" maxlength="100" value="<?= $dataUser['adress'] ?>"></td>
                </tr>
                <tr>
                    <td>Ville:</td>
                    <td><input type="text" name="city" size="50" maxlength="30" value="<?= $dataUser['city'] ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="modification" value="Modifier"></td>
                </tr>
            </table>
        </center>
    </form>

    <form method="post" action="controllerUser/updateNewPassword/<?= $dataUser['userId']?>" >
        <h2 class="text-center">Modifier mon mot de passe</h2>
        <center>
        <table>
            <tr>
                <td>Votre ancien mot de passe:</td>
                <td><input type="password" name="password" size="50" maxlength="50"></td>
            </tr>
            <tr>
                <td>Nouveau mot de passe:</td>
                <td><input type="password" name="password2" size="50" maxlength="50"></td>
            </tr>
            <tr>
                <td>Répetez votre nouveau mot de passe:</td>
                <td><input type="password" name="password3" size="50" maxlength="50"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="reset" name="effacer" value="Effacer">
                    <input type="submit" name="modificationPass" value="Modifier le mot de passe"></td>
            </tr>
        </table>
        </center>
    </form>
    <form method="post" action="controllerUser/deleteALL/<?= $dataUser['userId'] ?>" >
        <center>
            <input type="submit" name="delete" value="Supprimer mon compte" style="background-color: red">
        </center>
    </form>

<?php require_once ('footer.php'); ?>