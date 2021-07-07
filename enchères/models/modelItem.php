<?php
require_once ('models/model.php');


function addItem($itemName, $description, $dateStartEnchere, $dateEndEnchere, $initialPrice, $userId, $pseudo, $categoryNumber, $itemVallue){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare("INSERT INTO items(itemName, description, dateStartEnchere, dateEndEnchere, initialPrice, userId, pseudo, categoryNumber, itemVallue)
    VALUES (:itemName, :description, :dateStartEnchere, :dateEndEnchere, :initialPrice, :userId, :pseudo, :categoryNumber, :itemVallue)");

    $requete->bindValue(':itemName',$itemName);
    $requete->bindValue(':description',$description);
    $requete->bindValue(':dateStartEnchere',$dateStartEnchere);
    $requete->bindValue(':dateEndEnchere',$dateEndEnchere);
    $requete->bindValue(':initialPrice',$initialPrice);
    $requete->bindValue(':userId',$userId);
    $requete->bindValue(':pseudo',$pseudo);
    $requete->bindValue(':categoryNumber',$categoryNumber);
    $requete->bindValue(':itemVallue',$itemVallue);

    $result = $requete->execute();
    return $result;
}
function getItems(){
    $bddPDO = connexionBDD();
    $requete = 'SELECT * FROM items ORDER BY itemId ASC';
    $resultGetItems= $bddPDO->query($requete);
    return $resultGetItems;
}
function getItemByItemId($itemId){
    $bddPDO = connexionBDD();
    $requete = "SELECT * FROM items WHERE itemId = '$itemId'";
    $result = $bddPDO->query($requete);
    $resultItemId = $result->fetch(PDO::FETCH_ASSOC);
    return $resultItemId;
}
function getItemByUserId($userId){
    $bddPDO = connexionBDD();
    $requete = "SELECT * FROM items WHERE userId = '$userId'";
    $result = $bddPDO->query($requete);
    $resultItemUserId = $result->fetchAll(PDO::FETCH_ASSOC);
    return $resultItemUserId;
}
