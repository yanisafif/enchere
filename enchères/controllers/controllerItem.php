<?php

require_once ('models/modelItem.php');
if(!isset($_SESSION)){
    session_start();
}

function addOneItem(){
    if (isset($_POST['enregistrer'])){
        if(!empty($_POST['itemName']) && !empty($_POST['description']) && !empty($_POST['categoryNumber']) &&
            !empty($_POST['initialPrice']) && !empty($_POST['dateStartEnchere']) && !empty($_POST['dateEndEnchere'])){
            $itemName = htmlspecialchars($_POST['itemName']);
            $description = htmlspecialchars($_POST['description']);
            $categoryNumber = htmlspecialchars($_POST['categoryNumber']);
            $initialPrice = htmlspecialchars($_POST['initialPrice']);
            $dateStartEnchere = htmlspecialchars($_POST['dateStartEnchere']);
            $dateEndEnchere = htmlspecialchars($_POST['dateEndEnchere']);
            $userId = $_SESSION['userId'];
            $pseudo = $_SESSION['pseudo'];

            if($categoryNumber == 'Informatique'){
                $categoryNumber = '1';
            }elseif($categoryNumber == 'Ameublement'){
                $categoryNumber = '2';
            }elseif($categoryNumber == 'Vetement'){
                $categoryNumber = '3';
            }else{
                $categoryNumber = '4';
            }if ($dateEndEnchere>$dateStartEnchere && $dateStartEnchere >= date('Y-m-d')){

                if(date('Y-m-d') === $dateStartEnchere){
                    $itemVallue = 1;
                }else{
                    $itemVallue = 2;
                }
                addItem($itemName, $description, $dateStartEnchere, $dateEndEnchere, $initialPrice, $userId, $pseudo, $categoryNumber, $itemVallue);
                $message = "L'enregistrement à été effectué avec succès";
                //mettre un require vers l'article
            }else{
                $message = "La date de fin d'enchère doit être supérieur à la date de début enchère ou le jour que vous avez choisis doit être égal au jour d'aujourd'hui";
            }
        }else{
            $message = 'Tous les champs sont requis !';
        }
    }
    require_once ('views/viewAddOneItem.php');
    require_once('views/error.php');
}

function getAllItems(){
    $resultGetItems = getItems();
    if(!$resultGetItems){
        $message = 'La récupération des artiles n\'a pas aboutit !';
    }else{
        $nbItems = $resultGetItems->rowCount();
        if($nbItems == 0){
            $message = "Il n'y a aucun article pour le moment!";
        }else{
            require_once ('views/viewHome.php');
        }
    }
    $resultGetItems->closeCursor();
}


function getItemSell($itemId){
    $resultItemId = getItemByItemId($itemId);
    require_once('models/modelUser.php');
    $resultDataPseudo = getUserByPseudo($resultItemId['pseudoUpdate']);
    if(!$resultItemId){
        $message = "Cette article n'existe pas";
    }else{
        if($resultItemId['categoryNumber'] == 1){
            $category = 'Informatique';
        }elseif($resultItemId['categoryNumber'] == 2){
            $category = 'Ameublement';
        }elseif($resultItemId['categoryNumber'] == 3){
            $category = 'Vêtement';
        }else{
            $category = 'Sport & Loisirs';
        }

        require_once ('views/viewItemSell.php');
    }
    require_once ('views/error.php');
}

function getMyItem(){
    if(!isset($_SESSION)){
        session_start();
    }
    $resultItemId = getItemByUserId($_SESSION['userId']);
    if(!empty($resultItemId)){
        require_once ('views/viewMyItem.php');
    }else{
        $message = "Vous n'avez pas de vente en cours pour le moment";
    }
    require_once ('views/error.php');

}


