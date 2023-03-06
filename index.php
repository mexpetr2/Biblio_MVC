<?php 
ob_start();
?>

<h1>Bienvenue sur le site</h1>



<?php 
$content = ob_get_clean();
$titre = 'Acceuil';
require_once 'base.php';
?>