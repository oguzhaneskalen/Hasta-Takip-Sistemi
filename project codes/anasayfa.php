<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Anasayfa</title>
    <link rel="stylesheet" href="styles/style123.css">
</head>
<body>
    <div class="adsoyad">
        <h4><i class="fas fa-user-md"></i> Hoşgeldin Sn. <?php echo $doktorcek['doktor_adsoyad'] ?></h4>
    </div>

    <div class="orta_div" id="randevu_div">
    <div id="scroll">
        <h2>Randevular</h2>
        <table class="randevu-tablo">
        <tr>
            <th>Hasta</th>
            <th>Yer</th>
            <th>Açıklama</th>
            <th>Tarih</th>
            <th>Saat</th>
        </tr>
        
        <?php 
            $randevu_sor=$db->prepare("SELECT * FROM randevu
            INNER JOIN doktor ON randevu.randevu_doktor_id = doktor.doktor_id WHERE doktor_tc =:doktor_tc
            ");
            $randevu_sor->execute([
                'doktor_tc' => $_SESSION['userdoktor_tc']
            ]);
           
            
            while($randevu_cek=$randevu_sor->fetch(PDO::FETCH_ASSOC)){ ?>
                
        <tr>
            <td><?php echo $randevu_cek['randevu_hasta']; ?></td>
            <td><?php echo $randevu_cek['randevu_yer']; ?></td>
            <td class="i"><?php echo $randevu_cek['randevu_aciklama']; ?></td>
            <td><?php echo $randevu_cek['randevu_tarih']; ?></td>
            <td><?php echo $randevu_cek['randevu_saat']; ?></td>
        </tr>
            <?php } ?>
    </table>
        </div>
        <a href="randevu-olustur.php"><button class="olustur">Randevu Oluştur</button></a>
    </div>

    <div class="orta_div" id="randevu">
        <div id="scroll">
        <h2>Hastalarım</h2>
       
        <table class="randevu-tablo2">
        <tr>
            <th>Adı</th>
            <th>TC Kimlik No</th>
            <th>Şikayet</th>
            <th>Hastalık Tanısı</th>
            <th>Tedavi</th>
        </tr>
        
        <?php 
            $hasta_sor=$db->prepare("SELECT * FROM hasta
            INNER JOIN doktor ON hasta.hasta_doktor_id = doktor.doktor_id WHERE doktor_tc =:doktor_tc
            ");
            $hasta_sor->execute([
                'doktor_tc' => $_SESSION['userdoktor_tc']
            ]);
           
            
            while($hasta_cek=$hasta_sor->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <tr>
            <td><?php echo $hasta_cek['hasta_adsoyad']; ?></td>
            <td><?php echo $hasta_cek['hasta_tc']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_sikayeti']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tani']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tedavi']; ?></td>
        </tr>
        
            <?php } ?>
    </table>  
        </div>
        <a href="hasta-ekle.php"><button class="ekle">Hasta Ekle</button></a>
    </div>
</body>
</html>