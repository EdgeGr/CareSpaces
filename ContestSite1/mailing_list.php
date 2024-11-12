<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $file = 'subscribers.txt';

        if (file_put_contents($file, $email . PHP_EOL, FILE_APPEND) !== false) {
            echo "Thank you for subscribing!";
        } else {
            echo "There was an error saving your email. Please try again.";
        }
    } else {
        echo "Invalid email address.";
    }
}
?>
