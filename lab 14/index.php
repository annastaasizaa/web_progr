<?php
session_start();
include "Book.php";

try {
    $pdoLibrary = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'root', '');
    $pdoLibrary->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $books = Book::all($pdoLibrary);

    echo "<h1>Каталог книг</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Назва</th><th>Рік</th><th>Жанр</th></tr>";
    foreach ($books as $book) {
        echo "<tr>";
        echo "<td>{$book->id}</td>";
        echo "<td>{$book->name}</td>";
        echo "<td>{$book->year}</td>";
        echo "<td>{$book->genre}</td>";
        echo "</tr>";
    }
    echo "</table>";

    include "login_form.php";
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}
?>
