<?php
    // Si on a des posts,
    if (!empty($posts)) {
        foreach ($posts as $post) {
            echo '<div class="post"><h2 class="post-author">'.$post->auteur.'</h2>';
            echo '<p class="post-date">'.$post->created_at.'</p>';
            echo '<p class="post-content">'.$post->contenu.'</p>';
            echo '<a class="post-link_detail" href=?page=showPost&id='.$post->id.'>Voir le post</a><br>';
            echo '<a class="post-link_delete" href=delete_post.php?id='.$post->id.'>supprimer</a><br></div>';
        }
    }
    // Sinon, on affiche un petit texte
    else {
        echo "<p class='post-empty'>Soyez le premier à partager votre vie ! (même si on s'en fout en vrai)<br>Cliquez juste au dessus, sur Nouveau Post</p>";
    }
?>