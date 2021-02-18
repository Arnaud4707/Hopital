<?php
session_start();
require_once('modeles/Services.php');
require_once('modeles/Salarier.php');

if ($_SESSION == null){
    header("Location: connexion.php");
}

$Salaries = new Salariers();
$Services= new Services();
?>
<html>
    <head>
        <title>Ajouté un salarié</title>
        <meta charset="utf8" />
        <?php include 'header.php'; ?>
    </head>
    <body style="padding:10px; text-align: center">
        <h1 style="text-align:center">Ajouter un salarié</h1>
        <hr>
        <form id="ajoueSalarie" autocomplete="off" method="POST" action="formSalarie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="nom" placeholder="Le nom" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="prenom" placeholder="Le prenom" required>
            </div>
            <div class="form-group">
                <input type="number" min="18" max="100" class="form-control" name="age" placeholder="L'age" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="code" placeholder="Le code postal" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="L'adresse" required>
            </div>
            <div class="form-group">
                <i>Facultatif</i>
                <select class="form-control" id="exampleFormControlSelect2" name="service" >
                    <option value="0">services</option>
                    <?php 
                    foreach ($Services->recupererServices() as $value) {
                        echo "<option value='$value[id]'>$value[category]</option>" ;
                    }
                    ?>
                </select>
            </div>
             <?php if(isset($_POST['nom']) && !empty($_POST['nom']) &&
                    isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                    isset($_POST['age']) && !empty($_POST['age']) && 
                    isset($_POST['code']) && !empty($_POST['code']) &&
                    isset($_POST['address']) && !empty($_POST['address']) &&
                    isset($_POST['service'])){
                                if(is_string($message = $Salaries->formSalarie($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['code'], $_POST['address'],$_POST['service']))){
                                    echo "<div class='alert alert-danger'>
                                            $message
                                        </div>";
                                    }
                                }?>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        <script src="js/js.js"></script>
    </body>
    <style>
/*        .container{
            position: relative;
            right: -25%;
            width: 100%;
            border-radius: 20px;
        }

        .form-control{
            height: 50px;
        }

        .formulaireRow{
            margin-top: 50px;
        }*/
    </style>
</html>