<?php
function inclusion_automatique($nom_de_la_classe)
{
    require_once 'Model/'.$nom_de_la_classe . '.php';
}

// On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
spl_autoload_register('inclusion_automatique');
?>