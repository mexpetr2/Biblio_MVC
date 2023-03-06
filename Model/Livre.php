<?php 
class Livre{
    private $id,$titre,$auteur,$nbpage,$image;
    
    public function __construct($id,$titre,$auteur,$nbpage,$image){

        $this->setId($id);
        $this->setTitre($titre);
        $this->setAuteur($auteur);
        $this->setNbpage($nbpage);
        $this->setImage($image);

    
    }

    public function setId($id){
        $this->id=$id;
    }
    public function setTitre($titre){
        $this->titre=$titre;
    }
    public function setAuteur($auteur){
        $this->auteur=$auteur;
    }
    public function setNbpage($nbpage){
        $this->nbpage=$nbpage;
    }
    public function setImage($image){
        $this->image=$image;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getTitre(){
        return $this->titre;
    }
    public function getAuteur(){
        return $this->auteur;
    }
    public function getNbpage(){
        return $this->nbpage;
    }
    public function getImage(){
        return $this->image;
    }
    
    

}
?>