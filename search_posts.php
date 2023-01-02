<?php

require_once('models/orm.php');

if (isset($_POST['search_posts'])) {
    $auteur = $_POST['auteur'];
    header('Location: index.php?page=authorPost&author='.$auteur);
}