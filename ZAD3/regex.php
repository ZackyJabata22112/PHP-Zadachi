<?php
$username = "";
$user_error = "";
$pass_error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (!preg_match('/^[a-zA-Z0-9_]{3,15}$/', $username)) {
        $user_error = "Username must be 3-15 characters (letters, numbers, underscores).";
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $pass_error = "Password must have 8+ characters, 1 uppercase, 1 lowercase, 1 number.";
    }

    if (empty($user_error) && empty($pass_error)) {
        $success = "Validation successful! You are logged in.";
        $username = ""; 
    }
}
?>