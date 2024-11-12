<?php
class Book
{
    private $pdo;
    public $id;
    public $name;
    public $year;
    public $genre;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function all(PDO $pdo)
    {
        $stmt = $pdo->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find(PDO $pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function delete(PDO $pdo, $id)
    {
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
