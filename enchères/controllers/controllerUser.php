<?php
require_once ('models/modelUser.php');

function addNewUser($pseudo, $firstName, $lastName, $email, $phoneNumber, $adress, $city, $password, $token){
    $resultAddUser = addUser($pseudo, $firstName, $lastName, $email, $phoneNumber, $adress, $city, $password, $token);
    if(!$resultAddUser){
        $message = "Un problème est survenu, l'enregistrement n'a pas été effectué !";
    }else{
        echo "<script type='text/javascript'> alert('Compte bien crée');</script>";
    }
}
function addOneUser(){
    require_once('views/viewAddUser.php');
    if (isset($_POST['enregistrer'])) {
        if (!empty($_POST['pseudo']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['phoneNumber']) && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $message = "Mail non valide";
            } elseif ($_POST['password'] != $_POST['password2']) {
                $message = "Les deux mots de passe ne correspondent pas";
            } else {
                $dataEmail = getUserByMail($_POST['email']);
                $dataPseudo = getUserByPseudo($_POST['pseudo']);
                if ($dataEmail) {
                    $message = "Un compte existe déjà avec cette adresse email";
                } else {
                    if($dataPseudo){
                        $message = "Ce pseudo est déjà utilisé";
                    }else{
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $token = hash('sha256', $password . time());
                        addNewUser($_POST['pseudo'], $_POST['firstName'], $_POST['lastName'], $_POST['email'] , $_POST['phoneNumber'] , $_POST['adress'],
                            $_POST['city'], $password, $token);


                        // IL FAUT UN HEADER
                        require_once ('views/viewConnexion.php');
                        connexion();
                    }
                }
            }
        } else {
            $message = "Tous les champs sont requis !";
        }
    }
    require_once('views/error.php');
}
function connexion(){
    if(isset($_POST['connexion'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data = getUserByMail($email);
        if(!$data){
            $message = "Veuillez rentrer une adresse email valide";
        }else{
            $passwordIsOk = password_verify($password, $data['password']);
            if($passwordIsOk){
                session_start();
                $_SESSION['userId'] = $data['userId'];
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['firstName'] = $data['firstName'];
                $_SESSION['lastName'] = $data['lastName'];
                $_SESSION['email'] = $email;
                $_SESSION['phoneNumber'] = $data['phoneNumber'];
                $_SESSION['adress'] = $data['adress'];
                $_SESSION['city'] = $data['city'];
                $_SESSION['token'] = $data['token'];
                $_SESSION['coin'] = $data['coin'];

                require_once ('controllers/controllerItem.php');
                getAllItems();
            }else {
                $message = "Veuillez rentrer un mot de passe valide";
            }
        }
    }
    if(!isset($_SESSION['pseudo'])){
        require_once ('views/viewConnexion.php');
    }
    require_once ('views/error.php');
}

function getMyProfile(){
    session_start();
    if(!empty($_SESSION['userId'])){
        $dataUserId = getUserByUserID($_SESSION['userId']);
        require_once ('views/viewMyProfile.php');

    }else{
        $message = "Veuillez vous connecter";
        require_once ('views/viewConnexion.php');
    }
    require_once ('views/error.php');
}
function getUserProfile($userId){
    $dataUserId = getUserByUserID($userId);
    if(!$dataUserId){
        $message = "Ce profil n'existe plus ou a été bannis";
    }else{
        require_once ('views/viewUserProfile.php');
    }
    require_once ('views/error.php');
}
function updateUser($userId){
    if(!isset($_SESSION)){
        session_start();
    }
    $dataUser = getUserByUserID($userId);
    if(!$dataUser){
        $message = "Une erreur est survenu";
    }else {
        if($_SESSION['userId'] === $dataUser['userId']){
            require_once ('views/viewUserUpdate.php');
        }else{
            $message = "Vous devez être connecté pour modifier votre profil";
            disconnect();
        }
    }
    require_once('views/error.php');
}
function updatedUser($userId){
    if (isset($_POST['modification'])) {
        $dataUser = getUserByUserID($userId);
        if (!$dataUser) {
            $message = "Une erreur est survenu";
        } else {
            require_once('views/viewUserUpdate.php');

            if (!empty($_POST['pseudo']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['phoneNumber']) && !empty($_POST['adress']) && !empty($_POST['city'])) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $firstName = htmlspecialchars($_POST['firstName']);
                $lastName = htmlspecialchars($_POST['lastName']);
                $email = htmlspecialchars($_POST['email']);
                $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
                $adress = htmlspecialchars($_POST['adress']);
                $city = htmlspecialchars($_POST['city']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message = "Mail non valide";
                } else {
                    $dataEmail = getUserByMail($email);
                    $dataPseudo = getUserByPseudo($pseudo);
                    // Je contôle si l'email n'existe pas déjà en faisant attention que même si l'utilisateur ne veut pas changer son email ça ne bloque pas la fonction
                    if ($dataEmail['email'] && $dataEmail['userId'] != $dataUser['userId']) {
                        $message = "Un compte existe déjà avec cette adresse email";
                    } else {
                        if ($dataPseudo['pseudo'] && $dataPseudo['userId'] != $dataUser['userId']) {
                            $message = "Ce pseudo est déjà utilisé";
                        } else {
                            $resultUpdateInformations = updateInformation($userId, $pseudo, $firstName, $lastName, $email, $phoneNumber, $adress, $city);
                            if (!$resultUpdateInformations) {
                                $message = "Un problème est survenu lors de l'instertion des données";
                            } else {
                                $message = "Vos modifications ont bien était pris en compte";
                            }
                        }
                    }
                }
            } else {
                $message = "Tout les champs sont requis !";
            }
        }
        require_once('views/error.php');
    }
}

function updateNewPassword($userId){
    if (!isset($_SESSION)){
        session_start();
    }
    $dataUser = getUserByUserID($userId);
    if(isset($_POST['modificationPass'])) {
        if (!empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['password3'])) {
            if($_SESSION['userId'] === $dataUser['userId']) {
                $passwordIsOk = password_verify($_POST['password'], $dataUser['password']);
                if ($passwordIsOk) {
                    if ($_POST['password2'] === $_POST['password3']) {
                        $password = password_hash($_POST['password2'], PASSWORD_DEFAULT);
                        $resultUpdatePassword = updatePassword($dataUser['userId'], $password);
                        if ($resultUpdatePassword) {
                            $message = "Le mot de passe a été changé avec succès";
                        } else {
                            $message = "un problème est survenu";
                        }
                    } else {
                        $message = "Les nouveux mots de passes ne sont pas identiques";
                    }
                } else {
                    $message = "Votre ancien mot de passe est incorect";
                }
            }else{
                $message = "Une erreur est survenu";
            }
        }else {
            $message = "Tout les champs sont requis !";
        }
    }
    require_once('views/viewUserUpdate.php');
    require_once ('views/error.php');
}

function disconnect(){
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['userId'])){
        session_unset();
        session_destroy();
        $message = "Vous êtes bien déconnecté";
        require_once ('views/viewConnexion.php');
        connexion();
    }else{
        $message = "Vous n'etes pas connectés";
        require_once ('views/viewConnexion.php');
        connexion();
    }
    require_once ('views/error.php');
}
function deleteALL($userId){
    if (!isset($_SESSION)) {
        session_start();
    }
        $dataUser = getUserByUserID($userId);
    if (isset($_POST['deleted'])) {
        if ($_SESSION['userId'] === $dataUser['userId'])  {

                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordIsOk = password_verify($password, $dataUser['password']);
                if ($dataUser['email'] === $email) {
                    if ($passwordIsOk) {
                        require_once('models/modelItem.php');
                        $resultItemUserId = getItemByUserId($dataUser['userId']);
                        if($resultItemUserId){
                            foreach ($resultItemUserId as $ligne){
                                $dataPseudo = getUserByPseudo($ligne['pseudoUpdate']);
                                if($dataPseudo){
                                    $resultNewCoinUp = $dataPseudo['coin'] + $ligne['priceUpdate'];
                                    updateCoin($dataPseudo['userId'], $resultNewCoinUp);
                                }
                            }
                        }
                        deleteUser($userId);
                        $message = "Votre compte a bien été supprimer, à bientot";
                        disconnect();


                    } else {
                        $message = "Mot de passe invalide";
                    }
                } else {
                    $message = "Email invalide";
                }
        } else {
                $message = "Une erreur est survenued";
        }
    }
    require_once('views/viewDeleteUser.php');
    require_once('views/error.php');
}