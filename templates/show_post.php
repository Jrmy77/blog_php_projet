<a class="button-return" href="index.php">< RETOUR</a>

<?php
echo '<div class="post"><h1 class="post-author">' . $post->auteur . '</h1>';
echo '<p class="post-content">' . $post->contenu . '</p>';
echo '<p class="post-date">' . $post->created_at . '</p>';

echo "<hr>";
if (!empty($commentaires)) {
	foreach ($commentaires as $commentaire) {
		echo "<div class='commentaire'><p class='commentaire-author'>".$commentaire->auteur."<span class='commentaire-date'>".$commentaire->created_at."</span></p>";
		echo "<p class='commentaire-content'>".$commentaire->contenu."</p>";
		echo "<a class='commentaire-delete' href=delete_commentaire?id=" . $commentaire->id . ">Supprimer le commentaire</a></div>";
	}
}
else {
	echo "<p class='commentaire-empty'>Soyez le premier à commenter !</p>";
}

echo "<hr>";
?>