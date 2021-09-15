<?php
    ob_start();
    session_start();
    include 'baglan.php';
    
    $hastasor=$db->prepare("SELECT * FROM hasta WHERE hasta_tc=:hasta_tc");
    $hastasor->execute([
        'hasta_tc' => $_SESSION['userhasta_tc']
    ]);
    $say=$hastasor->rowCount();
    $hastacek=$hastasor->fetch(PDO::FETCH_ASSOC);

    if($say==0){
        header('location:index.php?izinsiz');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style123.css">
    <style>
        body{ margin: 0px; }
    </style>
    <script src="https://kit.fontawesome.com/928e75a9b9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="ust-bar">
        <a href="anasayfa_hasta.php"><img src="medya/logo.png" alt="ht-logo"></a> 
        <a href="anasayfa_hasta.php"><h1>Hasta Takip Sistemi</h1></a>
        <div class="menu" style="width: 600px;">
            <a href="randevular_hasta.php"><h5><i class="far fa-calendar-alt"></i> Randevular</h5></a>
            <a href="tedavilerim.php"><h5><i class="fas fa-procedures"></i> Tedavilerim</h5></a>
            <a href="hasta-hesap.php"><h5><i class="fas fa-user-alt"></i> Hesap Bilgilerim</h5></a>
        </div>
    </div>
    <a href="hasta-logout.php"><div class="cikis">
        <b><i class="fas fa-sign-out-alt"></i> Çıkış Yap</b>
    </div></a>
</body>
</html>