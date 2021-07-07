<?php
require_once ('models/model.php');
require_once ('models/modelItem.php');

function updateDated($date){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare("UPDATE date SET date = :date WHERE dateId = 1");
    $requete->bindValue(':date', $date);
    $resultUpdateDate = $requete->execute();
    return $resultUpdateDate;
}

function updateNewPrice($itemId, $priceUpdate, $pseudo){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare('UPDATE items 
    SET priceUpdate = :priceUpdate, pseudoUpdate = :pseudoUpdate
    WHERE itemId = :itemId');
    $requete->bindvalue(':priceUpdate', $priceUpdate);
    $requete->bindvalue(':pseudoUpdate', $pseudo);
    $requete->bindvalue(':itemId', $itemId);

    $resultUpdate = $requete->execute();
    return $resultUpdate;
}