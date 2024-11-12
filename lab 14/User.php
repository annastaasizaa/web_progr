<?php
class User
{
    private $pdo;
    public $id;
    public $username;
    public $email;
    private $password;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

public static function authenticate(PDO $pdo, $email, $password)
{
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userRow && password_verify($password, $userRow['password'])) {
        $user = new User($pdo);
        $user->id = $userRow['id'];
        $user->username = $userRow['username'];
        $user->email = $userRow['email'];
        $user->password = $userRow['password'];
        return $user;
    }
    return null; // повертаємо null, якщо авторизація неуспішна
}
};
?>
