<?php
$comments_file = 'comments.json';
if (file_exists($comments_file)) {
    $comments = json_decode(file_get_contents($comments_file), true);
    if (count($comments) > 0) {
        foreach ($comments as $comment) {
            echo "<div class='comment' data-rating='" . $comment['rating'] . "'>";
            echo "<h4>" . $comment['name'] . " (" . $comment['rating'] . " Stars)</h4>";
            echo "<p>" . $comment['comment'] . "</p>";
            echo "<div class='stars'>" . str_repeat('★', $comment['rating']) . str_repeat('☆', 5 - $comment['rating']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "No comments yet.";
    }
} else {
    echo "Error: Comments file not found.";
}
?>
