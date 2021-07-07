<?php
require_once ('models/modelBid.php');


function updatePrice($itemId){
    if(!isset($_SESSION)){
        session_start();
    }
    $resultItemId = getItemByItemId($itemId);
    if($resultItemId['userId'] != $_SESSION['userId']){
        if(isset($_POST['submit'])){
            if (!empty($_POST['newRaise'])){
                if($_POST['newRaise'] > $resultItemId['initialPrice'] ){
                    if($resultItemId['priceUpdate'] === null || $_POST['newRaise'] > $resultItemId['priceUpdate']){
                        require_once ('models/modelUser.php');
                        $coinToRemove = getUserByPseudo($_SESSION['pseudo']);

                        if($coinToRemove['coin'] < $_POST['newRaise']){
                            $message = "Vous n'avez pas les fonds nécessaires pour effectuer cette transaction";
                        }else{

                            if($resultItemId['pseudoUpdate'] != null){
                                $coinToAdd = getUserByPseudo($resultItemId['pseudoUpdate']);
                                $resultNewCoinUp = $coinToAdd['coin'] + $resultItemId['priceUpdate'];
                                updateCoin($coinToAdd['userId'], $resultNewCoinUp);
                            }
                            $resultNewCoinDown = $coinToRemove['coin'] - $_POST['newRaise'];
                            updateCoin($_SESSION['userId'], $resultNewCoinDown);
                            updateNewPrice($itemId, $_POST['newRaise'], $_SESSION['pseudo']);
                            $message = "Felicitation vous êtes la nouvelle meilleure offre";
                        }

                    }else{
                        $message = "Votre prix doit être supérieur au prix de la meilleure offre";
                    }
                }else{
                    $message = "Votre prix doit être supérieur au prix de départ";
                }
            }else{
                $message = "Vous avez rentré aucune valeur";
            }
        }
    }else{
        $message = "Vous ne pouvez pas enchérir sur votre article";
    }
    require_once ('views/viewItemSell.php');
    require_once('views/error.php');
}

function updateVallue(){

}