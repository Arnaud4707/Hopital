<?php

abstract class Modele
{
    static $BDD;
    
    static protected function getBDD(){
        
        if (self::$BDD === null){
            
            self::$BDD = new PDO('mysql:host=localhost;dbname=hopital;charset=UTF8',"root","");
        }
        
        return self::$BDD;
        
    }
    
    protected function executerRequete(string $sql,array $parametre = null){
        
        if ($parametre===null){
            
            $resultat = self::getBDD()->query($sql);
            
        }else{
            
            $resultat =self::getBDD()->prepare($sql);
            $resultat->execute($parametre);
            
        }
        
        return $resultat;
        
    }
    
}