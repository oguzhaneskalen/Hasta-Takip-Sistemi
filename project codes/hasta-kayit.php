<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Hasta Kayıt</title>
    <link rel="stylesheet" href="styles/style-k.css">
        <script src="sweetalert2.all.min.js"></script>
        <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
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
        <h1>HASTA KAYIT EKRANI</h1>
        <?php 
                if(isset($_GET['error'])==true){
                    echo "<p style='color:red;'>*Lütfen Tüm Alanları Doldurun !</p>";
                }
            ?>
        <form action="islem2.php" method="post">
        <div class="user">
                <input type="text" name="h_adsoyad" placeholder="Ad Soyad">
            </div>
            <div class="user">
                <input type="text" name="h_tc" placeholder="TC Kimlik No">
            </div>
            <div class="user">
                <input type="text" name="hasta_sikayeti" placeholder="Şikayetiniz..">
            </div>
            <div class="pass">
                <input type="password" name="h_password" placeholder="Şifre">
            </div>
            <button type="submit" class="sub1" name="hastakaydet">Kayıt Ol</button>
        </form>
        <form>
            <input type="button" value="Geri" class="sub2" onclick="history.back()">
        </form>
    </div>
</body>
</html>