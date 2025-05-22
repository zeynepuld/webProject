<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        die("Lütfen e-posta ve şifreyi doldurun.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Geçerli bir e-posta girin.");
    }

    try {
        $db = new PDO('sqlite:login.db'); // SQLite veritabanına bağlanıyor
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email"); // alınan veriye göre kullanıcıyı çeker
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // şifre doğru mu değil mi kontrolü
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                header("Location: hosgeldiniz.php");
                exit();
            } else {
                echo "Hatalı şifre. <a href='login.html'>Tekrar dene</a>";
            }
        } else {
            echo "Kullanıcı bulunamadı. <a href='signup.html'>Kayıt ol</a>";
        }

    } catch (PDOException $e) {
        die("Veritabanı hatası: " . $e->getMessage());
    }
}
?>
