<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Doktor Giriş</title>
    <link rel="stylesheet" href="styles/style123.css">
</head>
<body>
    <header>
        <div class="img-logo">
            <a href="index.php"><img src="medya/logo.png" alt="ht-logo"></a>
        </div>
        <div class="baslik">
            <h2>HASTA TAKİP SİSTEMİ</h2>
        </div>
    </header>

    <div class="TableOuter">
        <h1>DOKTOR GİRİŞİ</h1>
        <?php 
                if(isset($_GET['error'])==true){
                    echo "<p style='color:red;'>*TC veya Şifreniz Hatalı !</p>";
                }
            ?>
        <form action="islem.php" method="post">
            <div class="user">
                <input type="text" name="d_tc" placeholder="TC Kimlik No">
            </div>
            <div class="pass">
                <input type="password" name="d_password" placeholder="Şifre">
            </div>
            <button type="submit" class="sub1" name="giris_yap">Giriş Yap</button>
        </form>
        <a href="doktor-kayit.php"><button type="submit" class="sub2">Kayıt Ol</button></a>
    </div>
</body>
</html>