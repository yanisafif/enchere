<?php
if(!isset($_SESSION)){
    session_start();
}
if (!empty($_SESSION)){
    $connected = true;
}else{
    $connected = false;
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <base href="/enchères/">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Enchères</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ENCHERED</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="controllerItem/getAllItems">Home</a>
                        </li>

                        <?php
                            if(!$connected){?>
                        <li class="nav-item">
                            <a class="nav-link" href="controllerUser/connexion">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="controllerUser/addOneUser">S'enregistrer</a>
                        </li>

                        <?php }else{ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="controllerUser/getMyProfile" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bonjour <?= $_SESSION['pseudo']?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="controllerUser/getMyProfile" >Mon profil</a></li>
                                    <li><a class="dropdown-item" href="controllerItem/getMyItem">Mes articles</a></li>
                                    <li><a class="dropdown-item" href="controllerItem/addOneItem">Vendre un article</a></li>
                                    <li><a class="dropdown-item" href="controllerUser/disconnect">Se déconnecter</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>