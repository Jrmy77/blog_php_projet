<?php

    // On appelle l'ORM pour pouvoir utiliser Post et Commentaire
    require_once('models/orm.php');

    $id = $_GET['id']; // On récupère l'id dans les paramètres
    $post = Post::getById($id); // On récupère le post en fonction de son id
    $post->delete(); // On supprime le post (instance de Post)

    //on supprime aussi les commentaires associés
    $commentaires = Commentaire::getAllForPost($id); // On récupère tout les commentaires du Post avec son id
    foreach ($commentaires as $commentaire) {
        $commentaire->delete(); // On supprime tout les commentaires de $commentaires
    }

    header('Location: index.php?page=home'); // redirection pour actualiser la page
?>