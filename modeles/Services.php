<?php
//
require_once('modeles/Model.php');


class Services extends Modele{
    
//    private function sansparam(strint $sql, array $param = null) {
//        if($param === null){
//            return $resultat = self::getbdd()->query($sql);
//        }
//    }
    
    public function recupererServices(){
        $RequeteService ="SELECT id,category FROM services";
        $ExecuterService= $this->executerRequete($RequeteService);
        
        return $ExecuterService->fetchAll(PDO::FETCH_ASSOC);
        
    }



    public function formService($service){

        $RequeteService = "SELECT id,category FROM services WHERE category = ?";
        $ExecuterService = $this->executerRequete($RequeteService,[$service]);
        $ResultatService = $ExecuterService->fetch();
        
        if ($ResultatService == null){
            
                $RequeteInsertService = "INSERT INTO services( category ) VALUES(?)";
                $ExecuterInsertService = $this->executerRequete($RequeteInsertService, [$service]);
                header("location:new.php?ajoue=service&service=$service");

        }else{

            return "<div class='alert alert-danger'>Le service existe déjà</div>";

        }
            
    }

}
