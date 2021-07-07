<?php
require_once ('header.php');
?>
    <form action="controllerItem/addOneItem" method="post">
        <h2 class="text-center">Nouvelle vente</h2>
        <center>
            <table>
                <tr>
                    <td>Article:</td>
                    <td><input type="text" name="itemName" size="50" maxlength="50"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" maxlength="300">

                        </textarea></td>
                </tr>
                <tr>
                    <td>Catégorie de l'objet:</td>
                    <td>
                        <select id="category" name="categoryNumber">
                            <option value="Informatique">Informatique</option>
                            <option value="Ameublement">Ameublement</option>
                            <option value="Vetement">Vêtement</option>
                            <option value="Sport & Loisirs">Sport & loisir</option>
                        </select>
                    </td>
                </tr>
                <!--<tr>
                    <td>Photo de l'article</td>
                    <td><input type="file" name="image"></td>
                </tr>-->
                <tr>
                    <td>Mise à prix:</td>
                    <td><input type="text" name="initialPrice" size="50" maxlength="50"></td>
                </tr>
                <tr>
                    <td>Début de l'enchère:</td>
                    <td><input type="date" name="dateStartEnchere" size="50" maxlength="100"></td>
                </tr>
                <tr>
                    <td>Fin de l'enchère:</td>
                    <td><input type="date" name="dateEndEnchere" size="50" maxlength="100"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="reset" name="effacer" value="Effacer">
                        <input type="submit" name="enregistrer" value="Enregistrer"></td>
                </tr>
            </table>
        </center>
    </form>



<?php
require_once ('footer.php');
