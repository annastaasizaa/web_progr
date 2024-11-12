<?php
$hashedPassword = password_hash('p@assword', PASSWORD_DEFAULT);
echo "Хеш пароля: " . $hashedPassword;
?>
