<?php

// minilib MySQL
function my_query($query)
{
	global $link;
	mysqli_report(MYSQLI_REPORT_OFF);

	if (empty($link))
		$link = @mysqli_connect('localhost', 'root', 'root', 'blog');

	if (!$link)
		die("Failed to connect to MySQL: " . mysqli_connect_error());

	$result = @mysqli_query($link, $query);
	if (!$result)
		die("Failed to execute MySQL query: " . mysqli_error($link));

	return $result;
}

function my_fetch_array($query)
{
	$result = my_query($query);
	$data = [];

	while ($line = mysqli_fetch_array($result))
		$data[] = $line;

	return $data;
}

function my_insert_id()
{
	global $link;
	$pk_val = mysqli_insert_id($link);
	return $pk_val;
}

class Commentaire
{
	// Propriétés de la classe
	public $id;
	public $auteur;
	public $contenu;
	public $created_at;
	public $post_id; // Clé étrangère connecter à l'ID du post

	// Constructeur
	public function __construct(int $id, string $auteur, string $contenu, $created_at, int $post_id)
	{
		$this->id = $id;
		$this->auteur = $auteur;
		$this->contenu = $contenu;
		$this->created_at = $created_at;
		$this->post_id = $post_id;
	}

	// Méthode pour add un commentaire à la bdd 
	public function save()
	{
		// protéger les injections SQL
		$link = mysqli_connect('localhost', 'root', 'root', 'blog');
		if (!$link) {
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		$auteur = mysqli_real_escape_string($link, $this->auteur);
		$contenu = mysqli_real_escape_string($link, $this->contenu);

		//La requête

		$query = "INSERT INTO commentaires (auteur, contenu, created_at, post_id) VALUES ('$auteur', '$contenu', '$this->created_at', $this->post_id)";
		my_query($query);
		$this->id = my_insert_id();
	}

	// function pour récupérer un commentaire 
	public static function getById($id)
	{
		$query = "SELECT * FROM commentaires WHERE id = $id";
		$result = my_fetch_array($query);
		return new Commentaire($result[0]['id'], $result[0]['auteur'], $result[0]['contenu'], $result[0]['created_at'], $result[0]['post_id']);
	}

	// function pour récupérer tous les com d'un post
	public static function getAllForPost(int $post_id)
	{
		$query = "SELECT * FROM commentaires WHERE post_id = $post_id";
		$result = my_fetch_array($query);
		$commentaires = [];
		foreach ($result as $row) {
			$commentaires[] = new Commentaire($row['id'], $row['auteur'], $row['contenu'], $row['created_at'], $row['post_id']);
		}
		return $commentaires;
	}

	//function pour supprimer un commentaire
	public function delete()
	{
		$query = "DELETE FROM commentaires WHERE id = $this->id";
		my_query($query);
	}
}


class Post
{
	// Propriétés
	public $id;
	public $auteur;
	public $contenu;
	public $created_at;

	// Constructeur
	public function __construct(int $id, string $auteur, string $contenu, $created_at)
	{
		$this->id = $id;
		$this->auteur = $auteur;
		$this->contenu = $contenu;
		$this->created_at = $created_at;
	}

	// function pour add un nouveau post
	public function save()
	{
		// protéger les injections SQL
		$link = mysqli_connect('localhost', 'root', 'root', 'blog');
		if (!$link) {
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		$auteur = mysqli_real_escape_string($link, $this->auteur);
		$contenu = mysqli_real_escape_string($link, $this->contenu);

		// requête
		$query = "INSERT INTO posts (auteur, contenu, created_at) VALUES ('$auteur', '$contenu', '$this->created_at')";
		my_query($query);
		$this->id = my_insert_id();
	}

	// function pour récupérer un post
	public static function getById($id)
	{
		$query = "SELECT * FROM posts WHERE id = $id";
		$result = my_query($query);
		$row = mysqli_fetch_array($result);
		return new Post($row['id'], $row['auteur'], $row['contenu'], $row['created_at']);
	}

	// function pour récupérer tous les posts
	public static function getAll()
	{
		$query = "SELECT * FROM posts";
		$result = my_fetch_array($query);
		$posts = [];
		foreach ($result as $row) {
			$posts[] = new Post($row['id'], $row['auteur'], $row['contenu'], $row['created_at']);
		}
		return $posts;
	}

	// function pour récupérer tous les posts d'un auteur
	public static function getByAuthor($author)
	{
		// protéger les injections SQL
		$link = mysqli_connect('localhost', 'root', 'root', 'blog');
		if (!$link) {
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		$auteur = mysqli_real_escape_string($link, $author);

		//  requête
		$query = "SELECT * FROM posts WHERE auteur = '$auteur'";
		$result = my_query($query);
		$posts = [];
		while ($row = mysqli_fetch_array($result)) {
			$posts[] = new Post($row['id'], $row['auteur'], $row['contenu'], $row['created_at']);
		}
		return $posts;
	}

	// function pour supprimer un post
	public function delete()
	{
		$query = "DELETE FROM posts WHERE id = $this->id";
		my_query($query);
	}
}
