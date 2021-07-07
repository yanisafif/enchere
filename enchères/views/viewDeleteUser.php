<?php
require_once ('header.php'); ?>

<form method="post" action="controllerUser/deleteALL/<?= $dataUser['userId']?>" >
    <h2 class="text-center">Supprimer mon compte</h2>
    <p class="text-center">Toutes vos données seront définitivement perdu</p>
    <center>
        <table>
            <tr>
                <td>Confirmez votre email:</td>
                <td><input type="email" name="email" size="50" maxlength="50"></td>
            </tr>
            <tr>
                <td>Confirmez votre mot de passe:</td>
                <td><input type="password" name="password" size="50" maxlength="50"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="button"><a href="controllerUser/getMyProfile">Annuler</a></button>
                    <input type="submit" name="deleted" value="Supprimer mon compte">

                </td>

            </tr>
        </table>
    </center>
</form>

<?php
require_once ('footer.php'); ?>
