<a class="button-return" href="index.php">< RETOUR</a>

<?php

foreach ($posts as $post) {
    echo '<div class="post"><h1 class="post-author">' . $post->auteur . '</h1>';
    echo '<p class="post-content">' . $post->contenu . '</p>';
    echo '<p class="post-date">' . $post->created_at . '</p></div>';
}
?>