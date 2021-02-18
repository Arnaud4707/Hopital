<?php

require_once('modeles/Model.php');


class Conge extends Modele{
    

    public function formConge($idd,$service,$id,$debut,$fin){
        
        if ($debut <= $fin){
            
            if ($debut > date('Y-m-d H:i:s',strtotime("-1 days"))){
                
                $RequeteCongeSalarieExistant = "SELECT id, debut, fin, idSalarie FROM conge WHERE idSalarie=? AND (debut BETWEEN ? AND ? OR fin BETWEEN ? AND ?)";
                $ExecuterCongeSalarieExistant = $this->executerRequete($RequeteCongeSalarieExistant,[$id,$debut,$fin,$debut,$fin]);
                $ResultatCongeSalarieExistant = $ExecuterCongeSalarieExistant->fetchAll(PDO::FETCH_ASSOC);
                
                if ($ResultatCongeSalarieExistant == NULL){
                    
                    $RequeteInsertConge = "INSERT INTO conge( idSalarie, debut, fin) VALUES(? ,? ,?)";
                    $ExecuterInsertConge = $this->executerRequete($RequeteInsertConge,[$id,$debut,$fin]);
                    
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
    
    public function recupererSalariesServicesConge(){
        
        $RequeteSalarieCategory="SELECT salaries.id,nom,prenom,age,codePostal,adresse,category FROM salaries INNER JOIN services ON salaries.idService=services.id";
        $ExecuterSalarieCategory = $this->executerRequete($RequeteSalarieCategory);
        $ResultatsSalarieCategory = $ExecuterSalarieCategory->fetchAll(PDO::FETCH_ASSOC);
        
        if ($ResultatsSalarieCategory == true){
            
            foreach ($ResultatsSalarieCategory as $ValueSalarieCategory) {
                
                $RequeteCongeSalarie = "SELECT debut,fin FROM conge WHERE idSalarie = ? ORDER BY debut";
                $ExecuterCongeSalarie = $this->executerRequete($RequeteCongeSalarie,[ $ValueSalarieCategory['id']]);
                $ResultatsCongeSalarie = $ExecuterCongeSalarie->fetchAll(PDO::FETCH_ASSOC);
                $conge=false;

                foreach ($ResultatsCongeSalarie as $ValueCongeSalarie) {
                    
                    if (date('Y-m-d H:i:s',strtotime("-1 days")) < $ValueCongeSalarie['fin']){
                        
                        $debutt= date('d/m/Y', strtotime($ValueCongeSalarie['debut']));
                        $finn= date('d/m/Y', strtotime($ValueCongeSalarie['fin']));
                        $conge[]="<br><div>En congé du ".$debutt." au ".$finn."</div>";
                        
                    }else{
                        
                        $RequeteInsertHistoriqueConge = "INSERT INTO historique_conge( id,idSalarie, debut, fin) VALUES(? ,? ,?)";
                        $ResultatInsertHistoriqueConge = $this->executerRequete($RequeteInsertHistoriqueConge,[$ValueCongeSalarie['id'],$ValueCongeSalarie['idSalarie'],$ValueCongeSalarie['debut'],$ValueCongeSalarie['fin']]);

                        $RequeteDeleteConge = "DELETE FROM conge WHERE id = ?";
                        $ResultatDeleteConge = $this->executerRequete($RequeteDeleteConge,[$ValueCongeSalarie['id']]);
                        
                    }
                    
                }
                
                $fichSalarie[]= [$ValueSalarieCategory['nom'],$ValueSalarieCategory['prenom'],$ValueSalarieCategory['age'],$ValueSalarieCategory['codePostal'],$ValueSalarieCategory['adresse'],$ValueSalarieCategory['category'],$conge];
           
            }
            
            return $fichSalarie;
            
        }else{

            return 'Il n\'y a pas de salarié dans ce service';

        }
        
    }

}
