<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comments_file = 'comments.json';
    $new_comment = [
        'name' => htmlspecialchars($_POST['name']),
        'comment' => htmlspecialchars($_POST['comment']),
        'rating' => intval($_POST['rating'])
    ];
    if (!empty($new_comment['name']) && !empty($new_comment['comment']) && $new_comment['rating'] > 0 && $new_comment['rating'] <= 5) {
        if (file_exists($comments_file)) {
            $comments = json_decode(file_get_contents($comments_file), true) ?? [];
        } else {
            $comments = [];
        }
        $comments[] = $new_comment;
        $fp = fopen($comments_file, 'w');
        if (flock($fp, LOCK_EX)) {
            fwrite($fp, json_encode($comments, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            flock($fp, LOCK_UN);
        }
        fclose($fp);

        echo json_encode(['status' => 'success', 'message' => 'Comment saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
	