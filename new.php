<?php
session_start();

if ($_SESSION == null || $_GET['ajoue']== NULL){
    header("Location: connexion.php");
}
?>
<html>
    <head>
        <title>Nouveau </title>
        <meta charset="utf8" />
    <?php include 'header.php'; ?>
    </head>
    
    <body style="padding:10px; text-align:center">
        
        <h1>Nouveau <?php if (isset($_GET['ajoue'])){
        echo $_GET['ajoue'];
        unset($_GET['ajoue']);}?></h1> 
        <hr>
        <div style="position:absolute; left: 30%;" class='col-4'>
            <ul style='height: 400px; overflow-y:auto;' class='list-group'>
        <?php
        foreach ($_GET as $key => $value ) {
            
            echo "<li class='list-group-item'>".$key .': '. $value.'</li>';
        }
            ?>
            </ul>
        </div>
    </body>
    <style>
        .deconnection:hover{
            background-color:red;
        }
        .deconnection:active{
            background-color:rosybrown;
        }
        .aservices:hover{
            background-color: greenyellow;
        }
        .aservices:active{
            background-color: greenyellow;
        }
        .asalarie:hover{
            background-color: greenyellow;
        }
        .asalarie:active{
            background-color: greenyellow;
        }
    </style>
</html>