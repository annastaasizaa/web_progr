<?php
session_start();
include "User.php";

try {
    $pdoUsers = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
    $pdoUsers->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = User::authenticate($pdoUsers, $email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user->id;
            header("Location: edit_books.php");
            exit();
        } else {
            echo "Невірний email або пароль";
        }
    }
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}
?>
