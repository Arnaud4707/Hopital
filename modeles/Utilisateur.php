<?php

require_once('modeles/Model.php');


class Utilisateur extends Modele{
    

    function connexion($login,$password){
        $RequeteUtilisateurLogin = "SELECT login FROM utilisateur WHERE login = ?";
        $ExecuterUtilisateurLogin = $this->executerRequete($RequeteUtilisateurLogin, [$login]);
        $ResultatUtilisateurLogin = $ExecuterUtilisateurLogin->fetchAll();

        if(sizeof($ResultatUtilisateurLogin) <= 0){
            
            return "<div class='alert alert-danger'>Ce login n'existe pas</div>";
            
        }else{

            $RequeteUtilisateurPassword = "SELECT password FROM utilisateur WHERE login = ?";
            $ExecuterUtilisateurPassword = $this->executerRequete($RequeteUtilisateurPassword, [$password]);
            $ResultatUtilisateurPassword = $ExecuterUtilisateurPassword->fetchAll();

            if(password_verify($password, $ResultatUtilisateurPassword[0]['password'])){
                
                $_SESSION['connection']=true;
                
                return header('location:services.php');

           }else{
               
            return "<div class='alert alert-danger'>Le mot de passe est incorrect</div>";
            
           }
           
        }

    }
    
    
    function inscription($login,$password,$nom,$prenom,$passwordVerif){

        if($password != $passwordVerify){

            return "<div class='alert alert-danger'>Les mots de passe ne correspondent pas</div>";

        }else{

            $RequeteUtilisateurLogin = "SELECT login FROM utilisateur WHERE login = ?";
            $ExecuterUtilisateurLogin = $this->executerRequete($RequeteUtilisateurLogin, [$login]);
            $ResultatUtilisateurLogin = $ExecuterUtilisateurLogin->fetchAll();

            if(sizeof($ResultatUtilisateurLogin) > 0){

                return "<div class='alert alert-danger'>L'utilisateur existe déjà</div>";

            }else{

                $Hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $RequeteInsertUtilisateur = "INSERT INTO utilisateur(nom, prenom, login, password) VALUES(?, ?, ?, ?)";
                $ExecuterUtilisateurLogin = $this->executerRequete($RequeteInsertUtilisateur, [$nom,$login,$Hashpassword]);

                return header('location:connexion.php');

            }

        }
        
    }

}