<?php
session_start();

if ($_SESSION == null){
    
    header("Location: connexion.php");
    
}

require_once('modeles/Services.php');

$Services = new Services();

?>
<html>
    <head>
        <title>Hopital de Paris</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php include 'header.php'; ?>
    </head>
    
    <body style="padding:10px; text-align:center">
        
        <h1>Services</h1> 
        <hr>
        <div class="list-group">
            <?php
            foreach ($Services->recupererServices() as $value) {
                echo "<a href='ficheSalarie.php?id=$value[id]&service=$value[category]' class='list-group-item list-group-item-action  list-group-item-light'>".$value['category']."</a>";
            } ?>
        </div>
        <script src="js/js.js"></script>
    </body>
</html>