<?php

require_once('modeles/Model.php');


class HistoriqueConge extends Modele{
    

    function recupererHistoriqueSalariesServicesConge(){
        
        $RequeteSalarieCategory="SELECT salaries.id,nom,prenom,age,codePostal,adresse,category FROM salaries INNER JOIN services ON salaries.idService=services.id";
        $ExecuterSalarieCategory = $this->executerRequete($RequeteSalarieCategory);
        $ResultatSalarieCategory = $ExecuterSalarieCategory->fetchAll(PDO::FETCH_ASSOC);
        
        if ($ResultatSalarieCategory == true){
            
            foreach ($ResultatSalarieCategory as $ValueSalarieCategory) {
                
                $RequeteCongeSalarie = "SELECT id,debut,fin,idSalarie FROM conge WHERE idSalarie = ?";
                $ExecuterCongeSalarie = $this->executerRequete($RequeteCongeSalarie,[$ValueSalarieCategory['id']]);
                $ResultatsCongeSalarie = $ExecuterCongeSalarie->fetchAll(PDO::FETCH_ASSOC);
                $conge=false;
                
                foreach ($ResultatsCongeSalarie as $ValueCongeSalarie) {
                    
                    if (date('Y-m-d H:i:s',strtotime("-1 days")) > $ValueCongeSalarie['fin']){
                    
                        $RequeteInsertHistoriqueConge = "INSERT INTO historique_conge( id,idSalarie, debut, fin) VALUES(? ,? ,?)";
                        $ResultatInsertHistoriqueConge = $this->executerRequete($RequeteInsertHistoriqueConge,[$ValueCongeSalarie['id'],$ValueCongeSalarie['idSalarie'],$ValueCongeSalarie['debut'],$ValueCongeSalarie['fin']]);
                        
                        $RequeteDeleteConge = "DELETE FROM conge WHERE id = ?";
                        $ResultatDeleteConge = $this->executerRequete($RequeteDeleteConge,[$ValueCongeSalarie['id']]);
                    }
                
                }
                
                $RequeteHistoriqueCongeSalarieDecroissant = "SELECT id,debut,fin FROM historique_conge WHERE idSalarie = ? ORDER BY fin DESC";
                $ExecuterHistoriqueCongeSalarieDecroissant = $this->executerRequete($RequeteHistoriqueCongeSalarieDecroissant,[$ValueSalarieCategory['id']]);
                $ResultatHistoriqueCongeSalarieDecroissant = $ExecuterHistoriqueCongeSalarieDecroissant->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($ResultatHistoriqueCongeSalarieDecroissant as $ValuesHistoriqueCongeSalarieDecroissant) {
                    
                    $debut= date('d/m/Y', strtotime($ValuesHistoriqueCongeSalarieDecroissant['debut']));
                    $fin= date('d/m/Y', strtotime($ValuesHistoriqueCongeSalarieDecroissant['fin']));
                    $conge[]="<br><div>En congé du ".$debut." au ".$fin."</div>";
                    
                }
                    
                $fichSalarie[]= [$ValueSalarieCategory['nom'],$ValueSalarieCategory['prenom'],$ValueSalarieCategory['age'],$ValueSalarieCategory['codePostal'],$ValueSalarieCategory['adresse'],$ValueSalarieCategory['category'],$conge];
                
            }
            
            return $fichSalarie;
            
        }else{
            
            return 'Il n\'y a plus de salarié';
            
        }
        
    }

}