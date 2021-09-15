<?php
    ob_start();
    session_start();
    include 'baglan.php';
    
    $doktorsor=$db->prepare("SELECT * FROM doktor WHERE doktor_tc=:doktor_tc");
    $doktorsor->execute([
        'doktor_tc' => $_SESSION['userdoktor_tc']
    ]);
    $say=$doktorsor->rowCount();
    $doktorcek=$doktorsor->fetch(PDO::FETCH_ASSOC);
    
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
        <a href="anasayfa.php"><img src="medya/logo.png" alt="ht-logo"></a> 
        <a href="anasayfa.php"><h1>Hasta Takip Sistemi</h1></a>
        <div class="menu">
            <a href="talepler.php"><h5 style="color: SteelBlue;"><i class="fas fa-hand-paper"></i> Randevu Talepleri <label style=" background-color:red; color: white; border:solid 2px red; border-radius:20px"><?php 
            $talep_sor=$db->prepare("SELECT * FROM hasta
            INNER JOIN doktor ON hasta.hasta_doktor_id = doktor.doktor_id WHERE doktor_tc =:doktor_tc
            ");
            $talep_sor->execute([
                'doktor_tc' => $_SESSION['userdoktor_tc']
            ]);
            $talep_sayisi = 0;
            while($talep_cek=$talep_sor->fetch(PDO::FETCH_ASSOC)){
                if($talep_cek['talep_durum'] == '1'){
                $talep_sayisi = $talep_sayisi +1;
            }} echo $talep_sayisi; ?></label></h5></a>
            <a href="randevular.php"><h5><i class="far fa-calendar-alt"></i> Randevular</h5></a>
            <a href="hastalarım.php"><h5><i class="fas fa-procedures"></i> Hastalarım</h5></a>
            <a href="doktor-hesap.php"><h5><i class="fas fa-user-md"></i> Hesap Bilgilerim</h5></a>
        </div>
    </div>
    <a href="doktor-logout.php"><div class="cikis">
        <b><i class="fas fa-sign-out-alt"></i> Çıkış Yap</b>
    </div></a>
</body>
</html>