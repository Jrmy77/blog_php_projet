<!-- Method post pour récupérerles valeurs qui sont dans les input -->
<form class="form-commentaire" method="post">
	<label class="form-commentaire_label" for="auteur">Nom</label><br>
	<input class="form-commentaire_input" type="text" id="auteur" name="auteur" required autocomplete='off'><br>
	<label class="form-commentaire_label" for="commentaire">Commentaire</label><br>
	<input class="form-commentaire_input" type="text" id="commentaire" name="commentaire" required autocomplete='off'><br>
	<input class="form-commentaire_button" type="submit" name="add_commentaire" value="Commenter">
</form>