<?php
require_once 'autoload.php';

class LivreManager extends Model{

    public $livres = [];
    public function ajouterLivre(Livre $livre){
        $this->livres[] = $livre;
    }

    public function getLivres(){
        return $this->livres;
    }

    public function chargementLivre(){
        $req = $pdo->prepare("SELECT * FROM book");
        $req->execute();
        $books = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $livre) {
            $this->ajoutLivre(new Livre($livre['id_book'], $livre['titre'], $livre['auteur'], $livre['nbPages'], $livre['image']));
        }
    }
}
?>