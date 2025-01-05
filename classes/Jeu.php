<?php
 
class Jeu {
    private $connexion;
    private $id_jeu;
    private $titre;
    private $description;
    private $note;
    private $tempsJeu;
    private $image_url;

    public function __construct($db,$titre, $description,$image_url, $note = 0, $tempsJeu = 0) {
        $this->connexion=$db;
        $this->titre = $titre;
        $this->description = $description;
        $this->image_url=$image_url;
        $this->note = $note;
        $this->tempsJeu = $tempsJeu;
    }

    public function getIdJeu() {
        return $this->id_jeu;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getNote() {
        return $this->note;
    }

    public function getTempsJeu() {
        return $this->tempsJeu;
    }

    public function setIdJeu($id_jeu) {
        $this->id_jeu = $id_jeu;
    }

    public function setTitre($titre) {
        if (!empty($titre)) {
            $this->titre = $titre;
        } else {
            throw new Exception("Le titre ne peut pas être vide");
        }
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setNote($note) {
        if ($note >= 0 && $note <= 5) {
            $this->note = $note;
        } else {
            throw new Exception("La note doit être comprise entre 0 et 5");
        }
    }

    public function setTempsJeu($tempsJeu) {
        if ($tempsJeu >= 0) {
            $this->tempsJeu = $tempsJeu;
        } else {
            throw new Exception("Le temps de jeu ne peut pas être négatif");
        }
    }

    public function ajouterJeu(){
        $sql = "INSERT INTO jeux(titre, description, image_url) VALUES (:titre, :description, :image_url)";
        $query = $this->connexion->prepare($sql);
        $query->execute([
            ":titre" => $this->titre,
            ":description" => $this->description,
            ":image_url" =>$this->image_url,
        ]);
    }

    public function getAllJeux() {
        $sql = "SELECT * FROM jeux;";
                
        $query = $this->connexion->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerJeu($id_jeu){
        $sql="DELETE from jeux WHERE id_jeu=:id_jeu";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":id_jeu"=>$id_jeu
        ]);
    }

    public function modifierJeu($Id_jeu){
        $sql="UPDATE jeux SET titre=:titre, description=:description, image_url=:image_url WHERE id_jeu=:id_jeu";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":titre"=>$this->titre,
            ":description"=>$this->description,
            ":image_url"=>$this->image_url,
            ":id_jeu"=>$Id_jeu
        ]);
    }

    public function changerStatuJeu($Id_jeu){

    }

}
?>