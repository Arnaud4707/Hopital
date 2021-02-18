<?php
session_start();
require_once('modeles/Services.php');
if ($_SESSION == null){
    header("Location: connexion.php");
}

$Services = new Services();
?>
<html>
    <head>
        <title>Ajouter un service</title>
        <meta charset="utf8" />
        <?php include 'header.php'; ?>
    </head>
    <body style="padding:10px; text-align:center">
        <h1>Ajouter un service</h1>
        <hr>
        <form autocomplete="off" method="POST" action="formService.php">
            <div class="form-group">
              <input type="text" class="form-control" name="service" placeholder="Le service" required>
            </div>
            <?php if(isset($_POST['service'])){
                if(is_string($message = $Services->formService($_POST['service']))){
                            echo"<div class='alert alert-danger'>
                                $message
</div>";}}?>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        <script src="js/js.js"></script>
    </body>
</html>