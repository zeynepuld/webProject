<?php

session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        die("Lütfen e-posta ve şifreyi doldurun.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Geçerli bir e-posta girin.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // şifreyi güvenli bir şekilde hashlşyor

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email"); // aynı email varsa zten kayıtlı diye hata verir
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            die("Bu e-posta zaten kayıtlı. <a href='login.html'>Giriş yap</a>");
        }

        $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)"); // yeni kullanıcı ekler
        $stmt->execute([
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        echo "Kayıt başarılı! <a href='login.html'>Giriş yapmak için tıklayın.</a>";

    } catch (PDOException $e) {
        die("Kayıt sırasında hata oluştu: " . $e->getMessage());
    }
}
?>
