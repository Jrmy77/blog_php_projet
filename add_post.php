<?php
require_once('models/orm.php');

if (isset($_POST['add_post'])) {
    $auteur = $_POST['auteur'];
    $contenu = $_POST['contenu'];
    date_default_timezone_set('Europe/Paris');
    $post = new Post(0, $auteur, $contenu, date('Y-m-d H:i:s'));
    $post->save();
    header('Location: index.php?page=home');
}

?>