<?php
session_start();


require_once('modeles/Conge.php');
if ($_SESSION == null ){
    header("Location: connexion.php");
}

$Conge = new Conge();
?>
<html>
    <head>
        <title>Salarié de l'hopital</title>
        <meta charset="utf8" />
    <?php include 'header.php'; ?>
    </head>
    
    <body style="padding:10px; text-align:center">
        
        <h1>Salariés de l'hôpital</h1> 
        <hr>
        <?php if (is_string($message = $Conge->recupererSalariesServicesConge())){
            echo $message ;
        }else{
            ?><div class="row"> <?php
            foreach ($Conge->recupererSalariesServicesConge() as $value) {
                print "<div class='col-4' style='padding-top:15px'><ul style='height: 400px; overflow-y:auto;' class='list-group'>"
                . "<li class='list-group-item'>$value[0]</li>"
                        . "<li class='list-group-item'>$value[1]</li>"
                        . "<li class='list-group-item'>$value[2]</li>"
                        . "<li class='list-group-item'>$value[3]</li>"
                        . "<li class='list-group-item'>$value[4]</li>"
                        . "<li class='list-group-item'>$value[5]</li>";?>
        <li class='list-group-item conge'><?php
            if (is_array($value[6]) || is_object($value[6])) {
                foreach ($value[6] as $valu) {
                    echo "$valu";
            }}
        ?></li>
            <?php echo '</ul></div>';
            }?></div> <?php
        }?>
        <script src="js/js.js"></script>
    </body>
</html>