<?php

require_once('models/orm.php');

$id = $_GET['id'];
$commentaire = Commentaire::getById($id);
$commentaire->delete();

header('Location: index.php?page=showPost&id='.$commentaire->post_id);

?>