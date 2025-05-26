<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password_raw = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password_raw !== $confirm_password) {
        header("Location: index.php?register=nomatch");
        exit();
    }

    $email_lower = strtolower($email);
    $username_lower = strtolower($username);
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE LOWER(email) = ? OR LOWER(username) = ?");
    $stmt->bind_param("ss", $email_lower, $username_lower);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: index.php?register=exists");
        exit();
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email, firstname, lastname, birthdate, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $email_lower, $firstname, $lastname, $birthdate, $username_lower, $password_hashed);

        if ($stmt->execute()) {
            header("Location: index.php?register=success");
            exit();
        } else {
            echo "Something went wrong. Please try again.";
        }
    }
} else {
    header("Location: index.php");
    exit();
}
