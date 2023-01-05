<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/reset.css">
	<link rel="stylesheet" href="styles/fonts.css">
	<link rel="stylesheet" href="styles/main.css">
	<title>LeMondeEstMechant</title>
</head>
<body>

<div class="easter-egg"></div>
	
<?php

	include('templates/header.php');
	require_once('models/orm.php'); // classe mere de l'ORM

	// routing
	if (!isset($_GET['page'])) // index.php
	{
		$page = 'home';
	}
	else
	{
		$page = $_GET['page']; // index.php?page=une_autre_action
	}

	// controller
	if ($page == 'home') // accueil du site
	{
		// On stocke tout les posts dans la variable $posts grâce à la méthode getAll de la classe Post (orm)
		$posts = Post::getAll();
		// On affiche la template home.php
		include('templates/home.php');
	}
	elseif($page == 'createPost') // pour recevoir le formulaire de post
	{
		include('templates/create_post.php');
	}
	elseif($page == 'showPost') // pour recevoir le formulaire de post
	{
		$id = $_GET['id'];
		$post = Post::getById($id);
		$commentaires = Commentaire::getAllForPost($id);
		include('templates/show_post.php');
		include('templates/create_commentaire.php');
		if (isset($_POST['add_commentaire'])) {
			$auteur = $_POST['auteur'];
			$commentaire = $_POST['commentaire'];
			date_default_timezone_set('Europe/Paris');
			$commentaire = new Commentaire(0, $auteur, $commentaire, date('Y-m-d H:i:s'), $post->id);
			$commentaire->save();
			header('Location: ?page=showPost&id='.$post->id.'');
		}
	}
	elseif ($page == 'authorPost') {
		if (!isset($_GET['author']))
		{
			include('templates/author_posts_form.php');
		}
		else
		{
			$auteur = $_GET['author'];
			$posts = Post::getByAuthor($auteur);
			include('templates/author_posts.php');
		}
	}
?>

</body>
</html>