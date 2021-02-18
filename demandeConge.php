<?php
session_start();


require_once('modeles/DemandeConge.php');
if ($_SESSION == null ){
    header("Location: connexion.php");
}

$DemandeConge = new DemandeConge();
?>
<html>
    <head>
        <title>Salarié de l'hopital</title>
        <meta charset="utf8" />
    <?php include 'header.php'; ?>
    </head>
    
    <body style="padding:10px; text-align:center">
        
        <h1>Les demandes de conge des salariés</h1> 
        <hr>
        
        <script src="js/js.js"></script>
    </body>
</html>