<?php 
Class Menu{
    // attributs 
    private $_idMenu;
    private $_nomMenu;
    private $_lien;
    private $_habilisation;

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
public function getIdMenu (){
    return $this -> _idMenu;
}
public function getNomMenu(){
    return $this -> _nomMenu;
}
public function getLien(){
    return $this -> _lien;
}
public function getHabilisation(){
    return $this -> _habilisation;
}
//seterrs 
public function setIdMenu (){
    return $this -> _idMenu;
}
public function setNomMenu(){
    return $this -> _nomMenu;
}
public function setLien(){
    return $this -> _lien;
}
public function setHabilisation(){
    return $this -> _habilisation;
}
}
?>