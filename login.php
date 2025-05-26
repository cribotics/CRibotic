<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user['email'];

                $redirectTo = $_SESSION['last_page'] ?? 'index.php';
                unset($_SESSION['last_page']);

                $_SESSION['login_success'] = true;

                header("Location: $redirectTo");
                exit;
            }
        }
    }

    header("Location: index.php?login=failed");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
