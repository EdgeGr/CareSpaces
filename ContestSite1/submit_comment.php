<?php
$name = htmlspecialchars(trim($_POST['name']));
$comment = htmlspecialchars(trim($_POST['comment']));
$rating = intval($_POST['rating']); 

if (empty($name) || empty($comment) || $rating < 1 || $rating > 5) {
    echo json_encode(["status" => "error", "message" => "Invalid input. Please ensure all fields are correctly filled."]);
    exit;
}
$new_comment = array(
    'name' => $name,
    'comment' => $comment,
    'rating' => $rating,
    'created_at' => date('Y-m-d H:i:s')
);
$comments_file = 'comments.json';
if (file_exists($comments_file)) {
    $comments = json_decode(file_get_contents($comments_file), true);
    if (!$comments) {
        $comments = array(); 
    }
} else {
    $comments = array(); 
}
$comments[] = $new_comment;
if (file_put_contents($comments_file, json_encode($comments, JSON_PRETTY_PRINT))) {
    echo json_encode(["status" => "success", "message" => "Comment submitted successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error saving comment. Please try again later."]);
}
?>
