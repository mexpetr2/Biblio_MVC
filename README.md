# Projet Gestion de bibliothèque en MVC avec PHP

Dans ce projet, nous allons créer une application de gestion de bibliothèque en utilisant le modèle MVC avec PHP.

# STEP 1

## Frontend

Il s'agit de la partie visible par les utilisateurs. Elle est composée de deux pages :

- Une page d'accueil .
- Une page gestion des livres qui permet de lister, ajouter, modifier et supprimer des livres.

1. Page d'accueil(index.php)

Cette page contient juste une menu qui permet de naviguer vers la page de gestion des livres.

2. Page gestion des livres (gestion.php)

Cette page contient un tableau qui liste les livres. Elle permet aussi d'ajouter, modifier et supprimer des livres.

3. fichier base.php

Ce fichier contient le code HTML commun à toutes les pages du frontend.Elle contient le code HTML de la page d'accueil et de la page de gestion des livres.Ce sera le template de base de notre site dont les pages hériteront.
Afin de surcharger le template base.php, nous allons utiliser la fonction ob_start() et ob_get_clean(). Cette fonction permet de stocker le contenu généré par PHP dans une variable. Ainsi, nous pourrons insérer le contenu de la variable dans le template base.php.

`<?php`
`ob_start();`
`// Contenu de la page`
`$content = ob_get_clean();`

4. Créer un dossier public qui contiendra les fichiers css, js et images.

## Backend

Dans cette partie nous allons faire le traitement des données en utilisant le modèle MVC.

### Mise en place du modèle MVC

### class Livre.php (Model)

1. Créer une class livre.php qui contiendra les propriétés suivantes:

- id
- titre
- auteur
- nombre de pages
- image de couverture
- public static $livres qui contiendra un tableau qui contiendra les livres.

Cette classe contiendra également les méthodes suivantes: un constructeur, un getter et un setter pour chaque propriété.
Le constructeur permet d'initialiser les propriétés de la classe ainsi que le tableau $livres.

2.  Dans le fichier gestion.php , créer 4 instances de la classe livre. Chaque instance représente un livre. Chaque livre aura un id, un titre, un auteur, un nombre de pages et une image de couverture.

3.  Faire une boucle qui parcourt le tableau et affiche les informations de chaque livre dans un tableau HTML en utilisant la class Livre.class.php.

    <?php for($i=0; $i < count(Livre::$livres); $i++): ?>

        <tr>
        <td><img src="public/images/<?= Livre::$livres[$i]->getImage() ?>" alt="" width="100px;" ></td>
        <td><?= Livre::$livres[$i]->getTitre(); ?></td>
        <td><?= Livre::$livres[$i]->getAuteur() ?></td>
        <td><?= Livre::$livres[$i]->getNbPages(); ?></td>
        <td><a href="" class="btn btn-warning">Modifier</a></td>
        <td><a href="" class="btn btn-danger">Supprimer</a></td>

    </tr>

    <?php endfor; ?>

### LivreManager.php (Controller)

Cette permet de gérer les livres.C'est dans cette classe que nous allons faire les opérations CRUD(Ajouter, modifier, supprimer et lister les livres).

1. Dans ce fichier, nous allons créer une classe LivreManager qui la propriété suivante:

- $livres : tableau qui contiendra les instances de la classe Livre.
  et les méthodes suivantes:
  **_ajouterLivre(Livre $livre)_** : méthode qui ajoute un livre dans le tableau $livres.Elle prend en paramètre une instance de la classe Livre.

**_getLivres()_** : méthode qui retourne le tableau $livres. Elle ne prend pas de paramètre.

Puisse que nous avons déjà le tableau $livres dans la classe Livre, nous allons l'utiliser pour initialiser la propriété $livres de la classe LivreManager.Pour cela nous pouvons supprimer l'attribut static de la propriété $livres de la classe Livre.

2. Dans le fichier gestion.php, nous allons instancier la classe LivreManager et appeler la méthode getLivres() pour récupérer le tableau $livres.

3. Utiliser la méthode ajouterLivre() pour ajouter un livre dans le tableau $livres.
`require_once 'LivreManager.class.php';`
`$livreManager = new LivreManager();`
`$livreManager->ajoutLivre($livre1);`

4. Faire une boucle for qui parcourt le tableau $livres et affiche les informations de chaque livre dans un tableau HTML en utilisant la class LivreManager.class.php.

Ici deux choses à noter:

- Nous avons utilisé la méthode getLivres() pour récupérer le tableau $livres.
- Nous avons utilisé la méthode getTitre() pour récupérer le titre du livre.

    <?php for($i=0; $i < count($livreManager->getLivres()); $i++): ?>

        <tr>
        <td><img src="public/images/<?= $livreManager->getLivres()[$i]->getImage() ?>" alt="" width="100px;" ></td>
        <td><?= $livreManager->getLivres()[$i]->getTitre(); ?></td>
        <td><?= $livreManager->getLivres()[$i]->getAuteur() ?></td>
        <td><?= $livreManager->getLivres()[$i]->getNbPages(); ?></td>
        <td><a href="" class="btn btn-warning">Modifier</a></td>
        <td><a href="" class="btn btn-danger">Supprimer</a></td>

    </tr>

    <?php endfor; ?>

**_OU : récupérer les livres dans une variable qui sera un tableau_**

    <?php foreach($livreManager->getLivres() as $livre): ?>

        <tr>
        <td><img src="public/images/<?= $livre->getImage() ?>" alt="" width="100px;" ></td>
        <td><?= $livre->getTitre(); ?></td>
        <td><?= $livre->getAuteur() ?></td>
        <td><?= $livre->getNbPages(); ?></td>
        <td><a href="" class="btn btn-warning">Modifier</a></td>
        <td><a href="" class="btn btn-danger">Supprimer</a></td>
    </tr>

    <?php endforeach; ?>

    <?php
    $livres = $livreManager->getLivres();
    for($i=0; $i < count($livres); $i++):
    ?>

        <tr>
        <td><img src="public/images/<?= $livres[$i]->getImage() ?>" alt="" width="100px;" ></td>
        <td><?= $livres[$i]->getTitre(); ?></td>
        <td><?= $livres[$i]->getAuteur() ?></td>
        <td><?= $livres[$i]->getNbPages(); ?></td>
        <td><a href="" class="btn btn-warning">Modifier</a></td>
        <td><a href="" class="btn btn-danger">Supprimer</a></td>
    </tr>

    <?php endfor; ?>

## Backend

### Création et connexion à la base de données

1. Créer une base de données nommée `biblio_mvc` ayant une table `book`avec les champs suivants:

- id (int, auto-increment, primary key)
- titre (varchar)
- auteur (varchar)
- nbPages (int)
- image (varchar) // le nom de l'image en dur dans le dossier public/images

2. Insérer 8 livres dans la table `book` depuis phpMyAdmin.

3. Créer une classe abstraite `Model.class.php` qui fera la connexion à la base de données. Cette classe se comportera comme un singleton. Elle aura la propriété suivante:

- private static $pdo : objet PDO qui contiendra la connexion à la base de données.
  Elle aura également la méthode suivante:

- private static function setBdd() méthode qui fera la connexion à la base de données.

- protected function getBdd() méthode qui retourne la connexion à la base de données. Cette méthode sera appelée dans les classes filles.

4. La classe `LivreManager` doit étend la classe `Model` afin d'avoir accès à la connexion à la base de données pour récupérer les livres .

- Faire appel à la class `Livre`
- Faire appel à la class `Model`

Elle aura une méthode `chargementLivres()` qui retournera tous les livres de la table `book` de la base de données.(Utiliser la méthode `prepare` de l'objet PDO pour récupérer les livres)

Ensuite dans cette méthode, parcourir le résultat de la requête SQL et créer une instance de la classe `Livre` pour chaque livre. Ajouter chaque instance de la classe `Livre` dans le tableau `$livres` de la classe `LivreManager` avec la méthode `ajouterLivre()`.
foreach ($meslivres as $livre) {
            $this->ajoutLivre(new Livre($livre['id'], $livre['title'], $livre['author'], $livre['nbPages'], $livre['image']));
}

- Dans le fichier `gestion.php`, instancier la classe `LivreManager` et appeler la méthode `chargementLivres()` pour récupérer tous les livres de la base de données.Tous les livres de la bdd sont affichés dans le tableau HTML.(Vous pouvez maintant commenter les instructions de la partie précédente instnacez et ajout)

### Mise en place du MVC

Le modèle MVC est composé de 3 parties:

- Le modèle (Model): c'est la partie qui gère les données. Elle est composée de la classe Livre et de la classe LivreManager.

- La vue (View): c'est la partie qui gère l'affichage. Elle est composée de la page gestion.php.

- Le contrôleur (Controller): c'est la partie qui gère les interactions entre le modèle et la vue. Elle est composée de la classe LivreController.

  1.Notion de routeur(VIEW)

Le routeur est un fichier qui va gérer les différentes routes de notre application. Il va rediriger vers le bon contrôleur en fonction de la route.

- Créons 3 dossiers: `views`, `controllers` et `models`.

`controllers` contiendra les contrôleurs de notre application c'est à dire les classes qui vont gérer les interactions entre le modèle et la vue. Donc tous les fichiers de pilote de notre application.

`models` contiendra les classes qui vont gérer les données de notre application. Donc tous les fichiers qui vont gérer les données de notre application.

`views` contiendra les fichiers qui vont gérer l'affichage de notre application. Donc tous les fichiers qui vont gérer l'affichage de notre application.

- Créer un fichier `accueil.php` dans le dossier views. Ce fichier contiendra le contenu de la page d'accueil.(donc tout le contenu de index.php)

- Déplacer le fichier `gestion.php` dans le dossier views.

- Deplacer le fichier `base.php` dans le dossier views.

- Ajouter view devant les require dans le fichier `base.php` et `gestion.php` pour indiquer que les fichiers sont dans le dossier views.

2. Mise en place du routeur

- Dans le fichier `index.php` nous allons mettre en place le routeur. Le routeur va gérer les différentes routes de notre application. Il va rediriger vers le bon contrôleur en fonction de la route.

mettre en place une structure conditionnelle qui va vérifier si la variable `$_GET['page']` existe. Si elle existe, on va stocker sa valeur dans une variable `$page` et si elle n'existe pas, on va stocker la valeur `accueil` dans la variable `$page`.

- Dans le fichier de template `base.php`, ajouter un le chemin vers les fichier dans les href des liens.(`accueil` pour la page d'accueil et `livres` pour la page gestion.php)

3. Création du contrôleur(LIVRECONTROLLER)

- Créer un fichier `LivreController.php` dans le dossier `controllers` qui va gérer les interactions entre le modèle et la vue. Cette classe va gérer les livres.

- Crer une classe `LivreController` qui aura une propriété `$livreManager` qui sera un objet de la classe `LivreManager`. Cette propriété sera initialisée dans le constructeur de la classe `LivreController` et sera utilisée pour appeler la méthode `chargementLivres()` afin de récupérer tous les livres de la base de données.

- Créer une méthode `afficherLivre()` qui récupère tous les livres grace à la méthode `getLivres()` de la classe `LivreManager` et qui affiche la vue `gestion.php` en utilisant la méthode `require_once` de php.
  // On récupère les livres de la base de données
  $livres = $this->livreManager->getLivres();
grâce à cette ligne de code, on récupère tous les livres de la base de données et on les stocke dans la variable `$livres`. donc on aura plus besoin de faire `$livres = $livreManager->getLivres();`avant la boucle for dans le fichier`gestion.php`.

- Dans le fichier `index.php`, instancier la classe `LivreController` et appeler la méthode `afficherLivre()` pour afficher la page gestion.php dans le switch case.

4. Création du modèle

- Dans le dossieer models, déplacer la classe `Livre` ,la classe `LivreManager` et la classe `Model` dans le dossier `models`.

5. Finalisation du routeur

Ici nous allons passer plusieurs paramètres en GET dans l'url pour gérer les différentes routes de notre application.Cela va nous permettre de gérer les différentes routes de notre application.

- Dans le fichier `index.php` définir une constante URL qui contiendra l'url de notre application en utilisant la superglobale `$_SERVER`. Pour cela utiliser la fonction str_replace() qui va remplacer le dernier caractère d'une chaîne de caractères par un autre caractère. Cette fonction prend 3 paramètres: le premier est la chaîne de caractères à modifier, le deuxième est le caractère à remplacer et le troisième est le caractère qui va remplacer le deuxième caractère. Cette fonction va retourner la chaîne de caractères modifiée.
  vérifier si nous sommes en http ou en https et concaténer le nom de domaine et le chemin vers le dossier de notre application. Cette chaîne de caractères sera stockée dans la constante URL.
  // $_SERVER['PHP_SELF'] contient le chemin du fichier index.php.
// $_SERVER['HTTP_HOST'] contient le nom de domaine du site. 
//$\_SERVER['HTTPS'] contient le protocole utilisé (http ou https).

define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$\_SERVER[HTTP_HOST]$\_SERVER[PHP_SELF]"));

- Récupérer la valeur de la variable page dans une une variable `$url` , la nettoyée avec la fonction filter_var() et FILTER_SANITIZE_URL; La découpée en plusieurs éléments grâce à la fonction explode().

$url = explode('/', filter_var($\_GET['page'], FILTER_SANITIZE_URL));

- Dans le switch case, vérifier si la variable `$url[0]` qui est le premier élément de la variable `$url` est égale à `accueil` et renvoyer la page d'accueil. Sinon si c'est égale à `livres` vérifier s'il y a d'autres paramètres dans la variable `$url` et si oui, vérifier si le deuxième élément de la variable `$url` est égale à `ajouter` et renvoyer la page d'ajout de livre.Sinon si le deuxième élément de la variable `$url` est égale à `show` et afficher les infos d'un livre en particulier. Sinon si le deuxième élément de la variable `$url` est égale à `modifier` et renvoyer la page de modification de livre. Sinon si le deuxième élément de la variable `$url` est égale à `supprimer` et renvoyer la page de suppression de livre.Sinon renvoyer une exception avec throw new Exception("La page n'existe pas");

- Dans le default du switch case, renvoyer une exception avec throw new Exception("La page n'existe pas");

- Mettez tout votre code dans un bloc try/catch. Dans le bloc catch, afficher l'erreur avec echo $e->getMessage();

- Ajouter la constante URL devant les href des liens dans le fichier `base.php`

### CRUD

1. Afficher un livre grâce à son id

- Dans le manager `LivreManager.php`, créer une méthode `getLivreById()` qui va récupérer un livre grâce à son id.Cette méthode vérifie si l'id existe et si oui, elle va récupérer le livre grâce à son id et le retourner.

- Dans le fichier `LivreController.php`, créer une méthode `afficherLivreById()` qui va récupérer un livre grâce à son id et qui va afficher la vue `afficherLivre.php` en utilisant la méthode `require_once` de php.

- Dans le fichier `afficherLivre.php` faire le traitement pour afficher les informations du livre dans un template minimaliste.

- Dans le fichier `gestion.php`, ajouter un lien vers la page d'affichage d'un livre en particulier en utilisant la constante URL et le paramètre id du livre.Pour cela utiliser utiliser la méthode `getId()` de la classe `Livre` pour récupérer l'id du livre dans une balise `<a>`
<td><a href="<?=URL ?>livres/show/<?= $livres[$i]->getId(); ?>"><?= $livres[$i]->getTitre(); ?></a></td>

2. Ajouter un livre

- Dans le bouton `ajouter` du fichier `gestion.php`, ajouter un lien vers la page d'ajout de livre en utilisant la constante URL.

- Dans le fichier `LivreController.php`, créer une méthode `ajouterLivre()` qui va afficher la vue `ajouterLivre.php` en utilisant la méthode `require_once` de php.

- Dans le fichier `ajouterLivre.php`, créer un formulaire qui va permettre d'ajouter un livre. Pour cela utiliser la méthode `post` et l'action sera la constante URL et le paramètre `livres` et le paramètre `validate`.

- Dans le fichier `index.php`, vérifier si la route est égale à `validate` et si oui, appeler la méthode `validationLivre()` de la classe `LivreController` pour valider le formulaire d'ajout de livre.

- Dans le fichier `LivreController.php`, créer une méthode `uploadFiles()` qui va permettre d'uploader un fichier. Cette méthode va prendre en paramètre le fichier à uploader et le dossier de destination.

- Dans le fichier `LivreController.php`, créer une méthode `validationLivre()` qui va valider le formulaire d'ajout de livre. Cette méthode va vérifier si le formulaire a été soumis et si oui, vérifier si les champs sont remplis et si oui, appeler la méthode `uploadFiles()` pour uploader le fichier et ajouter le livre dans la base de données. Sinon afficher un message d'erreur.Rediriger vers la page de gestion des livres en utilisant la constante URL.

- Dans le fichier `LivreManager.php`, créer une méthode `addLivreData()` qui va ajouter un livre dans la base de données. Cette méthode va prendre en paramètre les données du formulaire et va ajouter le livre dans la base de données.Si l'ajout s'est bien passé, récupérer l'id du livre ajouté puis créer un objet `Livre` avec les données du formulaire puis faire appel à la méthode `ajouterLivre()` de la classe `LivreManager` pour ajouter le livre dans la base de données.

3. Supprimer un livre

- Dans le fichier `gestion.php`, mettez le bouton `supprimer` dans un formulaire qui va permettre de supprimer un livre. Pour cela utiliser la méthode `post` et l'action sera la constante URL et le paramètre `livres` et le paramètre `supprimer`.

- Dans le fichier `livreManager.php`, créer une méthode `deleteLivre()` qui va supprimer un livre grâce à son id. Cette méthode va vérifier si l'id du livre existe et si oui, supprimer le livre de la base de données et supprime aussi le livre de la table `livre`.

- Dans le controller `LivreController.php`, créer une méthode `supprimerLivre()` qui va supprimer un livre. Cette méthode va vérifier si le formulaire a été soumis et si oui, vérifier si l'id du livre existe et si oui, supprimer le livre de la base de données. Sinon afficher un message d'erreur.Rediriger vers la page de gestion des livres en utilisant la constante URL.

4. Modifier un livre

- Dans le fichier `gestion.php`, ajouter un lien vers la page de modification de livre en utilisant la constante URL et le paramètre id du livre.Pour cela utiliser utiliser la méthode `getId()` de la classe `Livre` pour récupérer l'id du livre dans une balise `<a>`

- Dans le fichier `LivreController.php`, créer une méthode `modifierLivre()` qui va afficher la vue `modifierLivre.php` en utilisant la méthode `require_once` de php.

- Dans le fichier `modifierLivre.php`, créer un formulaire qui va permettre de modifier un livre. Pour cela utiliser la méthode `post` et l'action sera la constante URL et le paramètre `livres` et le paramètre `validateModification` qui sera la route de validation de la modification du livre.Ce formulaire devra être pré-rempli avec les données du livre à modifier.

- Dans le fichier `index.php`, vérifier si la route est égale à `validateModification` et si oui, appeler la méthode `validationModificationLivre()` de la classe `LivreController` pour valider le formulaire de modification de livre.

- Dans le fichier `LivreController.php`, créer une méthode `validationModificationLivre()` qui va valider le formulaire de modification de livre. Cette méthode va vérifier si le formulaire a été soumis.Vérifier si l'utilisateur à changer l'image . Si oui supprimer l'ancienne image et uploader la nouvelle image. Sinon ne pas uploader d'image.

- Dans le fichier `LivreManager.php`, créer une méthode `updateLivre()` qui va modifier un livre dans la base de données. Cette méthode va prendre en paramètre les données du formulaire et va modifier le livre dans la base de données.Si la modification s'est bien passée, récupérer l'id du livre modifié puis créer un objet `Livre` avec les données du formulaire puis faire appel à la méthode `modifierLivre()` de la classe `LivreManager` pour modifier le livre dans la base de données.

### Bonus

1. Afficher des messages d'alretes grâce à la session

- Dans le fichier `index.php`, démarrez une session en utilisant la fonction `session_start()`.

2. Créer les messages d'alertes dans le fichier `livreController.php` en fonction des actions effectuées avant de rediriger.Le message sera dans un tableau avec le type et le message.Le type peut être `success` ou `danger`.
   $\_SESSION['alert'] = [
   'type' => 'success',
   'message' => 'Le livre a bien été ajouté'
   ];

3. Afficher les messages d'alertes dans le fichier `gestion.php` en utilisant la session.

4. Créer une page `404.php` dans views qui va afficher un message d'erreur si la page n'existe pas.
