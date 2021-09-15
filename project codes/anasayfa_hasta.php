<?php include 'header_hasta.php' ?>

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
        <h4><i class="fas fa-user-alt"></i> Hoşgeldin <?php echo $hastacek['hasta_adsoyad'] ?>
        <?php
            if(empty($hastacek['hasta_doktor'])){ ?>
                
                <label class="dsecim">Doktor Seçimi Yapmanız Gerekiyor >>
                <a id="doktorsecimi" href="doktor-secimi.php">[Doktor Seçimi Sayfası]</a><label>
    
            <?php }
        ?>
    </h4>
    </div>

    <div class="orta_div" id="randevu_div">
    <div id="scroll">
        <h2>Randevular</h2>
        <table class="randevu-tablo2">
        <tr>
            <th>Doktor</th>
            <th>Yer</th>
            <th>Açıklama</th>
            <th>Tarih</th>
            <th>Saat</th>
        </tr>
        
        <?php 
            $randevu_sor=$db->prepare("SELECT * FROM randevu
            INNER JOIN hasta ON randevu.randevu_hasta = hasta.hasta_adsoyad and randevu.randevu_doktor_id = hasta.hasta_doktor_id WHERE hasta_tc =:hasta_tc
            ");
            $randevu_sor->execute([
                'hasta_tc' => $_SESSION['userhasta_tc']
            ]);
           
            
            while($randevu_cek=$randevu_sor->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <tr>
            <td><?php echo $randevu_cek['randevu_doktor']; ?></td>
            <td><?php echo $randevu_cek['randevu_yer']; ?></td>
            <td class="i"><?php echo $randevu_cek['randevu_aciklama']; ?></td>
            <td><?php echo $randevu_cek['randevu_tarih']; ?></td>
            <td><?php echo $randevu_cek['randevu_saat']; ?></td>
        </tr>
        
            <?php } ?>
    </table> 
        </div>
    </div>

    <div class="orta_div" id="hastalar">
    <div id="scroll">
        <h2>Tedavilerim</h2>
    
        <table class="randevu-tablo2">
        <tr>
            <th>Doktor</th>
            <th>Şikayet</th>
            <th>Hastalık Tanısı</th>
            <th>Tedavi</th>
        </tr>
        
        <?php 
            $hasta_sor=$db->prepare("SELECT * FROM hasta
            WHERE hasta_tc =:hasta_tc
            ");
            $hasta_sor->execute([
                'hasta_tc' => $_SESSION['userhasta_tc']
            ]);
           
            
            while($hasta_cek=$hasta_sor->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <tr>
            <td><?php echo $hasta_cek['hasta_doktor']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_sikayeti']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tani']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tedavi']; ?></td>
        </tr>
        
            <?php } ?>
    </table>
    </div>  
    </div>
</body>
</html>