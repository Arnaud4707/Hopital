<?php
session_start();
require_once('modeles/Services.php');
require_once('modeles/Salarier.php');
if ($_SESSION == null){
    header("Location: connexion.php");
}

$Salaries = new Salariers();
$Services = new Services();
?>
<html>
    <head>
        <title>Ajouter un salarié à un service</title>
        <meta charset="utf8" />
        <?php include 'header.php'; ?>
    </head>
    <body style="padding:10px; ">
        <h1 style="text-align:center;">Ajouter un salarié à un service</h1>
        <hr>
        <form autocomplete="off" method="POST" action="formSalarieService.php" >
             <div class="form-group">
                <label >Sécelctionnez le service</label>
                <select class="form-control" id="exampleFormControlSelect2" name="service" required>
                    <?php 
                    foreach ($Services->recupererServices() as $value) {
                        echo "<option value='$value[id]'>$value[category]</option>" ;
                    }
                    ?>
                </select>
              </div>
            <div class="form-group">
                <label >Sécelctionnez le salarié</label>
                <select class="form-control" id="exampleFormControlSelect2" name="salarie" required>
                    <?php 
                    foreach ($Salaries->recupererSalaries() as $value) {
                        echo "<option value='$value[id]'>$value[nom] $value[prenom]</option>" ;
                    }
                    ?>
                </select>
              </div>
            <?php if (isset($_POST['salarie']) && !empty($_POST['salarie']) &&
                    isset($_POST['service']) && !empty($_POST['service'])){
                    if(is_string($message = $Salaries->formSalarieService($_POST['salarie'],$_POST['service']))){
                        echo "<div class='alert alert-danger'>
                                $message
                            </div>";
                        }
                }?>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        <script src="js/js.js"></script>
    </body>
</html>