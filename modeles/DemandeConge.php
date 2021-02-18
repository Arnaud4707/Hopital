<?php

require_once('modeles/Model.php');


class DemandeConge extends Modele{
    

    public function formDemandeConge($idd,$service,$id,$debut,$fin){
        
        if ($debut <= $fin){
            
            if ($debut > date('Y-m-d H:i:s',strtotime("-1 days"))){
                
                $RequeteDemandeCongeSalarieExistant = "SELECT id, debut, fin, idSalarie FROM demandeConge WHERE idSalarie=? AND (debut BETWEEN ? AND ? OR fin BETWEEN ? AND ?)";
                $ExecuterDemandeCongeSalarieExistant = $this->executerRequete($RequeteDemandeCongeSalarieExistant,[$id,$debut,$fin,$debut,$fin]);
                $ResultatDemandeCongeSalarieExistant = $ExecuterDemandeCongeSalarieExistant->fetchAll(PDO::FETCH_ASSOC);
                
                if ($ResultatDemandeCongeSalarieExistant == NULL){
                    
                    $RequeteInsertDemandeConge = "INSERT INTO conge( idSalarie, debut, fin) VALUES(? ,? ,?)";
                    $ExecuterInsertDemandeConge = $this->executerRequete($RequeteInsertDemandeConge,[$id,$debut,$fin]);
                    
                    return header("location:ficheSalarie.php?id=$idd&service=$service");

                }else{
                    
                    return "<div class='alert alert-danger'>Cette période est déjà occupé par un ou plusieurs congé(s)</div>";
                    
                }
            }else{
                
                return "<div class='alert alert-danger'>Cette période est antérieur à aujourd'hui</div>";
            
            }
        }else{
            
            return "<div class='alert alert-danger'>Cette période est impossible</div>";
        
        }
        
    }
    
    public function recupererSalariesServicesDemandeConge(){
        
        $RequeteSalarieCategory="SELECT salaries.id,nom,prenom,age,codePostal,adresse,category FROM salaries INNER JOIN services ON salaries.idService=services.id";
        $ExecuterSalarieCategory = $this->executerRequete($RequeteSalarieCategory);
        $ResultatsSalarieCategory = $ExecuterSalarieCategory->fetchAll(PDO::FETCH_ASSOC);
        
        if ($ResultatsSalarieCategory == true){
            
            foreach ($ResultatsSalarieCategory as $ValueSalarieCategory) {
                
                $RequeteDemandeCongeSalarie = "SELECT debut,fin FROM conge WHERE idSalarie = ? ORDER BY debut";
                $ExecuterDemandeCongeSalarie = $this->executerRequete($RequeteDemandeCongeSalarie,[ $ValueSalarieCategory['id']]);
                $ResultatsDemandeCongeSalarie = $ExecuterDemandeCongeSalarie->fetchAll(PDO::FETCH_ASSOC);
                $conge=false;

                foreach ($ResultatsDemandeCongeSalarie as $ValueDemandeCongeSalarie) {
                        
                    $debutt= date('d/m/Y', strtotime($ValueDemandeCongeSalarie['debut']));
                    $finn= date('d/m/Y', strtotime($ValueDemandeCongeSalarie['fin']));
                    $conge[]="<br><div>En congé du ".$debutt." au ".$finn."</div>";
                     
                }
                
                $fichSalarie[]= [$ValueSalarieCategory['nom'],$ValueSalarieCategory['prenom'],$ValueSalarieCategory['age'],$ValueSalarieCategory['codePostal'],$ValueSalarieCategory['adresse'],$ValueSalarieCategory['category'],$conge];
           
            }
            
            return $fichSalarie;
            
        }else{

            return 'Il n\'y a pas de salarié dans ce service';

        }
        
    }

}
