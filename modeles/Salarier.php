<?php

require_once('modeles/Model.php');


class Salariers extends Modele{
    

    function recupererSalaries(){
        
        $RequeteSalarie = "SELECT id,nom,prenom FROM salaries";
        $ExecuterSalarie = $this->executerRequete($RequeteSalarie);
        
        return $ExecuterSalarie->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    
    function ficheSalarie($id){
        
        $RequeteSalarie = "SELECT id,nom,prenom,age,codePostal,adresse FROM salaries WHERE idService = ?";
        $ExecuterSalarie = $this->executerRequete($RequeteSalarie,[$id]);
        $ResultatSalarie = $ExecuterSalarie->fetchAll(PDO::FETCH_ASSOC);
        
        if ($ResultatSalarie == true){
            
            foreach ($ResultatSalarie as $ValueSalarie) {

                $RequeteCongeSalarie = "SELECT id,debut,fin FROM conge WHERE idSalarie = ?";
                $ExecuterCongeSalarie = $this->executerRequete($RequeteCongeSalarie, [$ValueSalarie['id']]);
                $ResultatCongeSalarie = $ExecuterCongeSalarie->fetchAll(PDO::FETCH_ASSOC);
                $conge=false;

                foreach ($ResultatCongeSalarie as $ValueCongeSalarie) {
                    
                    if (date('Y-m-d H:i:s',strtotime("-1 days")) < $ValueCongeSalarie['fin']){
                        
                    $debut= date('d/m/Y', strtotime($ValueCongeSalarie['debut']));
                    $fin= date('d/m/Y', strtotime($ValueCongeSalarie['fin']));
                    $conge[]="<br><div>En congé du ".$debut." au ".$fin."</div>";

                    }else{
                        
                        $RequeteInsertHistoriqueCongeSalarie = "INSERT INTO historique_conge( id,idSalarie, debut, fin) VALUES(? ,? ,?)";
                        $ExecuterInsertHistoriqueCongeSalarie = $this->executerRequete($RequeteInsertHistoriqueCongeSalarie,[$ValueCongeSalarie['id'],$ValueCongeSalarie['idSalarie'],$ValueCongeSalarie['debut'],$ValueCongeSalarie['fin']]);

                        $RequeteDeleteCongeSalarie = "DELETE FROM conge WHERE id = ?";
                        $ExecuterDeleteConge = $this->executerRequete($RequeteDeleteCongeSalarie,[$ValueCongeSalarie['id']]);
                        
                    }
                    
                }
                
                $fichSalarie[]= [$ValueSalarie['nom'],$ValueSalarie['prenom'],$ValueSalarie['age'],$ValueSalarie['codePostal'],$ValueSalarie['adresse'],$ValueSalarie['id'],$conge];
            
            }
            
            return $fichSalarie;
            
        }else{
            
            return 'Il n\'y a pas de salarié dans ce service';
            
        }
        
    }
    
    
    function formSalarie($nom,$prenom,$age,$code,$address,$service){
        
        $RequeteSalarie = "SELECT nom,prenom FROM salaries WHERE nom=? AND prenom= ? AND age=? AND codePostal= ? AND address= ?";
        $ExecuterSalarie = $this->executerRequete($RequeteSalarie, [$nom,$prenom,$age,$code,$address]);
        $ResultatSalarie = $ExecuterSalarie->fetch(PDO::FETCH_ASSOC);
        
        if ($ResultatSalarie === false){

            if ($service != 0){
                
                $RequeteInsertSalarie = "INSERT INTO salaries(nom, prenom, age, codePostal, adresse, idService ) VALUES(?, ?, ?, ?, ?, ?)";
                $ExecuterSalarie = $this->executerRequete($RequeteInsertSalarie, [$nom,$prenom,$age,$code,$address,$service]);

                $RequeteDernierSalarieCategorie = "SELECT nom,prenom,category FROM salaries INNER JOIN services ON salaries.idService=services.id ORDER BY salaries.id DESC LIMIT 1";
                $ExecuterDernierSalarieCategorie = $this->executerRequete($RequeteDernierSalarieCategorie);
                $ResultatDernierSalarieCategorie = $ExecuterDernierSalarieCategorie->fetch(PDO::FETCH_ASSOC);
                header("location:new.php?ajoue=salarié&nom=$nom&prenom=$prenom&age=$age&code=$code&adresse=$address&service=$ResultatDernierSalarieCategorie[category]");

            }else{
                
                $RequeteInsertSalarie = "INSERT INTO salaries(nom, prenom, age, codePostal, adresse, idService ) VALUES(?, ?, ?, ?, ?, ?)";
                $ExecuterSalarie = $this->executerRequete($RequeteInsertSalarie, [$nom,$prenom,$age,$code,$address,0]);
                header("location:new.php?ajoue=salarié&nom=$nom&prenom=$prenom&age=$age&adresse=$address");
                
            }
        }else{
            
            return "<div class='alert alert-danger'>Le salarié existe déjà</div>";
            
        }

    }
    
    
    function formSalarieService($salarie,$service){

        $RequeteActualiserSalarie = "UPDATE salaries SET idService=? WHERE id= ?";
        $ExecuterSalarie = $this->executerRequete($RequeteActualiserSalarie,[$service,$salarie]);
                
        $RequeteSalarieCategorie = "SELECT nom,prenom,category FROM salaries INNER JOIN services ON salaries.idService=services.id WHERE salaries.id = ?";
        $ExecuterSalarieCategorie = $this->executerRequete($RequeteSalarieCategorie, [$salarie]);
        $ResultatSalarieCategorie = $ExecuterSalarieCategorie->fetch(PDO::FETCH_ASSOC);
        
        return header("location:new.php?ajoue=salarié%20en%20$ResultatSalarieCategorie[category]&service=$ResultatSalarieCategorie[category]&nom=$ResultatSalarieCategorie[nom]&prenom=$ResultatSalarieCategorie[prenom]");
    
    }

}