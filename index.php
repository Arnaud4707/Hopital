<?php
//header('location: connexion.php');

//$space=35;
//$level=0;
//$add=1;
//$block = 3;
//$m=4;
//$porte=8;
//while ($level < 25) {
//    $rblock = 0;
//    while ($rblock <$block){
//        $level++;
//        $spacegauche=0;
//        while ($space > $spacegauche){
//            echo '#';
//            $spacegauche++;
//        }
//        echo'/';
//        $a=0;
//        for ($a ;$a<$add;$a++){
//            echo '*';
//            if ($level > 20){
//                if ($a == $porte){
//                    switch ($level){
//                        case 21: 
//                            echo '| | | |';
//                            $a= $a+3;
//                            break;
//                        case 22: 
//                            echo '| | | |';
//                            $a= $a +3;
//                            break;
//                        case 23: 
//                            echo '| | $|';
//                            $a= $a+3;
//                            break;
//                        case 24: 
//                            echo '| | | |';
//                            $a= $a+3;
//                            break;
//                        case 25: 
//                            echo '| | | |';
//                            $a= $a+3;
//                            break;
//                        default :
//                            echo '';
//                    }
//                }
//            }
//        }
//        echo '\#';
//        $spacedroit=1;
//        while ($space > $spacedroit){
//            echo '#';
//            $spacedroit++;
//        }
//        echo'<br>';
//        $add = $add+ 2;
//        $porte++;
//        $rblock++;
//        $space--;
//    }
//    if ($level == 12){
//        $m = 6;
//    }
//    $add = $add + $m;
//    $space = $space -($m/2);
//    $block++;
//}
//$a=[1,2,4,8,9];
//function len($chaine){
//    $somme=0;
//    foreach ($chaine as $value) {
//        $somme = $somme + $value;
//    }
//    echo $somme/count($chaine);
//}
//len($a);

require_once 'modeles/Model.php';
class test extends Modele{
    public function ftest() {
        $RequeteUtilisateurLogin = "SELECT * FROM salaries";
        $ExecuterUtilisateurLogin = $this->executerRequete($RequeteUtilisateurLogin);
        $ResultatUtilisateurLogin = $ExecuterUtilisateurLogin->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ResultatUtilisateurLogin as $value) {
                $RequeteInsertUtilisateur = "INSERT INTO utilisateur(nom, prenom, age, codePostal,adresse,idService,role) VALUES(?, ?, ?, ?,?,?,?)";
                $ExecuterUtilisateurLogin = $this->executerRequete($RequeteInsertUtilisateur, [$value['nom'],$value['prenom'],$value['age'],$value['codePostal'],$value['adresse'],$value['idService'],2]);
        print 'ok';
        }
    }
    
}

$a = new test();
$a->ftest();
?>
