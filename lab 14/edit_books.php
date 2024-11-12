<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include "Book.php";

try {
    $pdoLibrary = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'root', '');
    $pdoLibrary->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $bookId = $_POST['delete_id'];
        Book::delete($pdoLibrary, $bookId);
    }

    $books = Book::all($pdoLibrary);
    echo "<h1>Редагування каталогу</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Назва</th><th>Рік</th><th>Жанр</th><th>Дії</th></tr>";
    foreach ($books as $book) {
        echo "<tr>";
        echo "<td>{$book->id}</td>";
        echo "<td>{$book->name}</td>";
        echo "<td>{$book->year}</td>";
        echo "<td>{$book->genre}</td>";
        echo "<td><form method='POST'><button name='delete_id' value='{$book->id}'>Видалити</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}
?>
