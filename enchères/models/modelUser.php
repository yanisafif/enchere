<?php
require_once ('models/model.php');
function addUser($pseudo, $firstName, $lastName, $email, $phoneNumber, $adress, $city, $password, $token){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare('INSERT INTO users(pseudo, firstName, lastName, email, phoneNumber, adress, city, password, token) 
    VALUES(:pseudo, :firstName, :lastName, :email, :phoneNumber, :adress, :city, :password, :token)');

    $requete->bindvalue(':pseudo', $pseudo);
    $requete->bindvalue(':firstName', $firstName);
    $requete->bindvalue(':lastName', $lastName);
    $requete->bindvalue(':email', $email);
    $requete->bindvalue(':phoneNumber', $phoneNumber);
    $requete->bindvalue(':adress', $adress);
    $requete->bindvalue(':city', $city);
    $requete->bindvalue(':password', $password);
    $requete->bindvalue(':token', $token);

    $resultAddUser = $requete->execute();
    return $resultAddUser;
}
function getUserByMail($email) {
    $bddPDO = connexionBDD();
    $requete = "SELECT * FROM users WHERE email = '$email'";
    $result = $bddPDO->query($requete);
    $dataEmail = $result->fetch(PDO::FETCH_ASSOC);
    return $dataEmail;
}
function getUserByPseudo($pseudo) {
    $bddPDO = connexionBDD();
    $requete = "SELECT * FROM users WHERE pseudo = '$pseudo'";
    $result = $bddPDO->query($requete);
    $dataPseudo = $result->fetch(PDO::FETCH_ASSOC);
    return $dataPseudo;
}
function getUserByUserID($userId){
    $bddPDO = connexionBDD();
    $requete = "SELECT * FROM users WHERE userId = '$userId'";
    $result = $bddPDO->query($requete);
    $dataUserId = $result->fetch(PDO::FETCH_ASSOC);
    return $dataUserId;
}
function updateCoin($userId, $newCoin){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare("UPDATE users SET coin = :coin WHERE userId = :userId" );
    $requete->bindvalue(':coin', $newCoin);
    $requete->bindvalue(':userId', $userId);
    $resultUpdateCoin = $requete->execute();
    return $resultUpdateCoin;
}
function updateInformation($userId, $pseudo ,$firstName ,$lastName ,$email ,$phoneNumber ,$adress ,$city ){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare("UPDATE users SET pseudo = :pseudo, firstName = :firstName, lastName = :lastName,
    email = :email, phoneNumber = :phoneNumber, adress = :adress, city = :city
    WHERE userId = :userId");

    $requete->bindValue(':pseudo', $pseudo);
    $requete->bindValue(':firstName', $firstName);
    $requete->bindValue(':lastName', $lastName);
    $requete->bindValue(':email', $email);
    $requete->bindValue(':phoneNumber', $phoneNumber);
    $requete->bindValue(':adress', $adress);
    $requete->bindValue(':city', $city);
    $requete->bindValue(':userId', $userId);
    $resultUpdateInformations = $requete->execute();
    return $resultUpdateInformations;

}
function updatePassword($userId, $password){
    $bddPDO = connexionBDD();
    $requete = $bddPDO->prepare("UPDATE users SET password = :password WHERE userId = :userId");

    $requete->bindValue(':password', $password);
    $requete->bindValue(':userId', $userId);
    $resultUpdatePassword = $requete->execute();
    return $resultUpdatePassword;
}
function deleteUser($userId){
    $bddPDO = connexionBDD();
    $requete = "DELETE FROM users WHERE userId = '$userId'";
    $requete2 = "DELETE FROM items WHERE userId = '$userId'";
    $resultDelete = $bddPDO->exec($requete);
    $resultDelete2 = $bddPDO->exec($requete2);
    return $resultDelete;

}