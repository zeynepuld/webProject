<?php
try {
    $db = new PDO('sqlite:login.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // users tablosunu oluşturur
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )");

    echo "Veritabanı ve tablo başarıyla oluşturuldu.";
} catch (PDOException $e) {
    echo " Hata: " . $e->getMessage();
}
?>
