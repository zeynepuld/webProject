<?php
// kayit.php

$email = $_POST['email'] ?? ''; // method=POST ile gelen veriler burda
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) { // boşsa uyarı verir
    die("Lütfen e-posta ve şifreyi doldurun.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // mail doğrulama
    die("Geçerli bir e-posta girin.");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // şifreyi hash'le (güvenlik için)

try {

    $db = new PDO('sqlite:login.db'); // SQLite veritabanına bağlanma
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // tablo yoksa oluşturur (bir kere calıscak)
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL
    )");

    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email"); // aynı email varsa kaydetme. hata mesajı göster
    $stmt->execute([':email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        die("Bu e-posta zaten kayıtlı.");
    }

    $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)"); // yeni kullanıcıyı ekler
    $stmt->execute([':email' => $email, ':password' => $hashedPassword]);

    echo "Kayıt başarılı! <a href='login.html'>Giriş yap</a>";

} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}
?>
