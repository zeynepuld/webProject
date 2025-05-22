<?php
session_start();

if (!isset($_SESSION['email'])) { // daha önce oturum acılmıs mı kontrol eder
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email']; // kullanıcıdan domain olmadan sadece mailin kullanıcı adı alınır
$username = strstr($email, '@', true); // @ işaretine kadar olan kısmı alır ve hoşgeldiniz ... yazar

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Hoşgeldiniz</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1); text-align: center; width: 350px; }
        h1 { color: #333; }
        a { display: inline-block; margin-top: 20px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hoşgeldiniz, <span><?php echo htmlspecialchars($username); ?></span>!</h1>
        <p>Başarıyla giriş yaptınız.</p>
        <a href="logout.php">Çıkış Yap</a>
    </div>
</body>
</html>
