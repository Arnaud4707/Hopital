<?php

require_once('modeles/Utilisateur.php');

$Utilisateur = new Utilisateur();
?>
<html>
    <head>
        <title>TP Connexion</title>
        <meta charset="utf8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    </head>
    <body style="padding:10px; text-align:center">
        <h1>Inscription</h1>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="background-color:lightblue; height: 127%; border-radius: 20px">
                    <form autocomplete="off" method="POST" id="inscription" action="inscription.php">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2>Formulaire d'inscription</h2>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="text" name="login" class="form-control" placeholder="Nom d'utilisateur"/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe"/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="password" name="passwordVerif" class="form-control" placeholder="Vérification Mot de passe" />
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="text" name="nom" class="form-control" placeholder="Nom"/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="text" name="prenom" class="form-control" placeholder="Prénom"/>
                            </div>
                        </div>
                        <div id="error">
                        <?php if(isset($_POST['login']) && !empty($_POST['login']) &&
                                isset($_POST['password']) && !empty($_POST['password'])&&
                                isset($_POST['nom']) && !empty($_POST['nom'])&&
                                isset($_POST['prenom']) && !empty($_POST['prenom'])&&
                                isset($_POST['passwordVerif']) && !empty($_POST['passwordVerif'])){
                            if(is_string($message = $Utilisateur->inscription($_POST['login'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['passwordVerif']))){
                                    echo $message;
                                    }
                                }?>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" style="width:100%">INSCRIPTION</button>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <a href="connexion.php" class="btn btn-primary" style="width:100%;">CONNEXION</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <script src="js/js.js"></script>
    </body>
    <style>
        .container{
            width: 100%;
            border-radius: 20px;
        }

        .form-control{
            height: 50px;
        }

        .formulaireRow{
            margin-top: 50px;
        }
    </style>
</html>