<?php
class Photo {
    // attributs 
    private $_id_photo;
    private $_nom_photo;
    private $_taille_pixelle_x;
    private $_taille_pixelle_y;
    private $_poids;
    private $_nbreDePhoto;
    private $_prix_photo;
    private $_categorie_photo;


      // hydratation 
      public function __construct(array $donnees){
        $this -> hydrate ($donnees);
    }

    public function hydrate (array $donnees){

        foreach($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
			{
				$this->$method($value);
			}

        }

    }
    // getters
    public function getId_photo(){
        return $this -> _id_photo;
    }
    public function getNom_photo(){
        return $this -> _nom_photo;
    }
    public function getTaille_pixels_x(){
        return $this -> _taille_pixelle_x;
    }
    public function getTaille_pixels_y(){
        return $this -> _taille_pixelle_y;
    }
    public function getPoids(){
        return $this -> _poids;
    }
    public function getNbrDePhoto(){
        return $this -> _nbreDePhoto;
    }

    public function getPrixPhoto(){
        return $this -> _prix_photo;
    }
    public function getCategoriePhoto(){
        return $this -> _categorie_photo;
    }
    
    // setters 
    public function setId_photo($id){
        $id = (int) $id;
        if ($id > 0){
         return $this -> _id_photo = $id;
        }
    }
    public function setNom_photo($nomPhoto){
        $this -> _nom_photo = $nomPhoto;
    }

    public function setTaille_pixels_x($taillePix){
        $this -> _taille_pixelle_x = $taillePix;
    }
    public function setTaille_pixels_y($taillePixy){
        $this -> _taille_pixelle_y = $taillePixy;
    }
    public function setPoids($poids){
        $this -> _poids =$poids;
    }
    public function setNbrDePhoto($nbre){
        if($nbre == 1){
            $this -> _nbreDePhoto = $nbre;
        }
        
    }
    public function setPrixPhoto($prix){
        if($nbre = 1){
            $this -> _prix_photo = $prix;
        }
        
    }
    public function setCategoriePhoto($categorie){
        $this -> _categorie_photo = $categorie;
    }
    
}


?>