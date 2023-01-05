<!-- Method post pour récupérer les valeurs qui sont dans les input -->
<a class="button-return" href="index.php">< RETOUR</a>


<form class="form-post" method="post" action="add_post.php">
	<label class="form-post_label" for="auteur">Auteur</label><br>
	<input class="form-post_input" type="text" id="auteur" name="auteur" required autocomplete='off'><br>
	<label class="form-post_label" for="contenu">Contenu</label><br>
	<input class="form-post_input" type="text" id="contenu" name="contenu" required autocomplete='off'><br>
	<input class="form-post_button" type="submit" name="add_post" value="créer le post">
</form>