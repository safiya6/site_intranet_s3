<?php

class Model
{
    private $bd;

    private static $instance = null;

    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function recuperer_donnee($id){
        $requete = $this->bd->prepare('SELECT * from personne where id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function est_connecte($id, $mdp) {
        $requete = $this->bd->prepare('SELECT * from identifiant where ide = :id and mdp = :mdp');
        $requete->bindValue(':id', $id);
        $requete->bindValue(':mdp', $mdp);
        $requete->execute();
    
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
    }
    public function est_enseignant($id)
    {
        $requete = $this->bd->prepare('SELECT * from enseignant where enseignant.id_personne = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;

    }

    public function est_secretaire($id)
    {
        $requete = $this->bd->prepare('SELECT * from  secretaire where secretaire.id_personne = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;

    }
    public function est_chefdepartement($id){
        $requete = $this->bd->prepare('SELECT * from  departement where departement.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
    } 
    public function est_directeur($id)
    {
        $requete = $this->bd->prepare('SELECT * from  directeur where directeur.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
        
    }


 
    public function getQuotite($id)
{ 
    $requete = $this->bd->prepare('SELECT quotite, sigleDept FROM assigner JOIN departement ON departement.id_departement = assigner.id_departement WHERE assigner.id_personne = :id;');
    $requete->bindValue(':id', $id);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

    $quotites = [];
    foreach ($resultat as $values) {
        // Création d'un tableau associatif avec les clés 'quotite' et 'dept'
        $quotites[] = [
            'label' => $values['sigledept'],
            'data' => (float)$values['quotite']
        ];
    }
  
    return $quotites;
}


   
}