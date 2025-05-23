<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Mesaj Alındı</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f0f0f0; }
    .box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px gray; }
    .box h2 { color: #333; }
    .info { margin-bottom: 10px; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Mesajınız Alındı</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ad = htmlspecialchars(trim($_POST["ad"] ?? ''));
        $email = htmlspecialchars(trim($_POST["email"] ?? ''));
        $telefon = htmlspecialchars(trim($_POST["telefon"] ?? ''));
        $mesaj = htmlspecialchars(trim($_POST["mesaj"] ?? ''));

        echo "<div class='info'><strong>Ad Soyad:</strong> $ad</div>";
        echo "<div class='info'><strong>Email:</strong> $email</div>";
        echo "<div class='info'><strong>Telefon:</strong> $telefon</div>";
        echo "<div class='info'><strong>Mesaj:</strong> $mesaj</div>";
    }
    else {
        echo "<p>Form gönderilmedi.</p>";
    }
    ?>
  </div>
</body>
</html>
