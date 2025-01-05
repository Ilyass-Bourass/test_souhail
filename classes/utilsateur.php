<?php
   
class Utilisateur {
    private $connexion;
    private $id_utilisateur;
    private $nom;
    private $email;
    private $motpass;

    public function __construct($db,$nom = "", $email = "", $motpass = "") {
        $this->nom = $nom;
        $this->email = $email;
        $this->motpass = $motpass;
        $this->connexion=$db;
    }

   
    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotpass() {
        return $this->motpass;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setMotpass($motpass) {
        $this->motpass = password_hash($motpass, PASSWORD_DEFAULT);
    }

    public function inscrire(){

    }

    public function connecter(){

    }

    public function modifierMonProfil(){

    }

    public function getAllutilsateur() {
        $sql = "SELECT * FROM users;";
                
        $query = $this->connexion->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerutilsateur($id_user){
        $sql="DELETE from users WHERE id_user=:id_user";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":id_user"=>$id_user
        ]);
    }

    public function baniUtilsateur($id_user,$raison){
        $sql="INSERT INTO user_banni(id_user,raison) VALUES (:id_user,:raison)";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":id_user"=>$id_user,
            ":raison"=>$raison
        ]);
    }

}
?>