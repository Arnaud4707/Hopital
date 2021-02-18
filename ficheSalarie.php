<?php
session_start();

require_once('modeles/Salarier.php');
require_once('modeles/Conge.php');

if ($_SESSION == null || ($_GET['id'] == null) || ($_GET['service'] == null) ){
    
    header("Location: connexion.php");
    
}

$Salaries = new Salariers();
$Conge = new Conge();
$tabErreur = ["idSalarie" => 0, "message" => ""];

if(isset($_POST['idp']) && isset($_POST['debut']) && isset($_POST['fin'])){
    
    if(is_string($message = $Conge->formConge($_GET['id'],$_GET['service'],$_POST['idp'],$_POST['debut'],$_POST['fin']))){
        
        $tabErreur["idSalarie"] = $_POST["idp"];
        $tabErreur["message"] = "<div class='alert alert-danger'>$message</div>";
        
    }    
}


?>
<html>
    <head>
        <title>Service <?php if(isset($_GET['service'])){
        echo $_GET['service'];}else{header("Location: connexion.php");} ?></title>
        <meta charset="utf8" />
    <?php include 'header.php'; ?>
    </head>
    
    <body style="padding:10px; text-align:center">
        
        <h1>Les salariés du service <?php if(isset($_GET['service'])){
        echo $_GET['service']; }?></h1> 
        <hr>
        <?php if (is_string($Salaries->ficheSalarie($_GET['id']))){
            echo $Salaries->ficheSalarie($_GET['id']);
        }else{
            ?><div class="row"> <?php
            foreach ($Salaries->ficheSalarie($_GET['id'],$_GET['service']) as $value) {
                print "<div class='col-4' style='padding-top:15px'><ul style='height: 400px; overflow-y:auto;' class='list-group'>"
                . "<li class='list-group-item'>$value[0]</li>"
                        . "<li class='list-group-item'>$value[1]</li>"
                        . "<li class='list-group-item'>$value[2]</li>"
                        . "<li class='list-group-item'>$value[3]</li>"
                        . "<li class='list-group-item'>$value[4]</li>";?>
        <li class='list-group-item conge'><?php
            if (is_array($value[6]) || is_object($value[6])) {
                foreach ($value[6] as $valu) {
                    echo "$valu";
            }}
            $idSalarie=$value[5];
        ?></li><li class='list-group-item'><?Php
                print "<form id='conge' autocomplete='off' method='POST' action='ficheSalarie.php?id=$_GET[id]&service=$_GET[service]'>
                            <div class='form-row'>
                                <div style='display:none;' class='col'>
                                    <input type='text' class='form-control' name='idp' value='$value[5]' >
                                </div>
                                <div class='col'>
                                    <input type='date' class='form-control' placeholder='YYYY-MM-DD' name='debut' required>
                                </div>
                                <div class='col'>
                                    <input type='date' class='form-control' placeholder='YYYY-MM-DD' name='fin' required>
                                </div>
                                <div class='col'>
                                    <button style='position: relative; top:10px;' type='submit' class='btn btn-primary'>Enregistrer</button>
                                </div>
                              </div>
                          </form></li>";
                if($tabErreur["idSalarie"] == $value[5]){
                    echo $tabErreur["message"];
                }
                print'</ul></div>';
            }?></div> <?php
        }?>
        <script src="js/js.js"></script>
    </body>
</html>