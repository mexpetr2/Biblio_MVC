<?php 
require_once 'Model/Livre.php';
require_once 'Controller/LivreManager.php';

$admin = new LivreManager;


ob_start();

// $alice = new Livre(1,"Les Aventures d'Alice au pays des merveilles",'Lewis Caroll',196,"https://m.media-amazon.com/images/I/91yLiYO7jtL.jpg");
// $spleen = new Livre(36,"Le Spleen de Paris","Charles Baudelaire",253,"https://static.fnac-static.com/multimedia/Images/FR/NR/8e/05/16/1443214/1507-1/tsp20220625090941/Le-Spleen-de-Paris.jpg");
// $charlie = new Livre(64,"Le monde de Charlie",'Stephen Chbosky',256,"https://static.fnac-static.com/multimedia/Images/FR/NR/b5/5e/21/2186933/1507-0/tsp20191020071446/Le-monde-de-charlie.jpg");
// $king = new Livre(667,'King Kong Théorie',"Virginie Despentes", 160,"https://m.media-amazon.com/images/I/81dD2KEoL3S.jpg");

// $admin->ajouterLivre($alice);
// $admin->ajouterLivre($spleen);
// $admin->ajouterLivre($charlie);
// $admin->ajouterLivre($king);

$admin->chargementLivre();


?>


<table class="table table-striped table-hover">
  <thead class="thead-dark bg-dark text-white">
    <tr>
      <th >Image</th>
      <th >Titre</th>
      <th >Auteur</th>
      <th >Nb Page</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php for($i=0; $i < count($admin->livres); $i++): ?>

    <tr>
        <td><img src="<?= $admin->getLivres()[$i]->getImage() ?>" alt="" width="100px;" ></td>
        <td><?= $admin->getLivres()[$i]->getTitre(); ?></td>
        <td><?= $admin->getLivres()[$i]->getAuteur() ?></td>
        <td><?= $admin->getLivres()[$i]->getNbpage(); ?></td>
        <td><a href="" class="btn btn-warning">Modifier</a></td>
        <td><a href="" class="btn btn-danger">Supprimer</a></td>

</tr>

<?php endfor; ?>
  </tbody>
</table>




<?php


$titre = 'Gestion des livres';
$content = ob_get_clean();
require_once 'base.php';
?>

