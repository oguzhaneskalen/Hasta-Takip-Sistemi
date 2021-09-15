<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Randevu Oluşturma</title>
    <link rel="stylesheet" href="styles/style123.css">
</head>

<body>
    <div class="adsoyad">
        <h4>Sn. <?php echo $doktorcek['doktor_adsoyad']; ?></h4>
    </div>

    <div class="orta_div" id="randevu_div">
        <h2>Randevu Oluştur</h2>
        <form action="islem.php" method="post">
            <select name="r_hasta" class="r_hasta">
                    <option value="0">Hasta Seçin</option>
                    <?php 
            $hasta_sor=$db->prepare("SELECT * FROM hasta
            INNER JOIN doktor ON hasta.hasta_doktor_id = doktor.doktor_id WHERE doktor_tc =:doktor_tc
            ");
            $hasta_sor->execute([
                'doktor_tc' => $_SESSION['userdoktor_tc']
            ]);
            
            while($hasta_cek=$hasta_sor->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <option value="<?php echo $hasta_cek['hasta_adsoyad']; ?>"><?php echo $hasta_cek['hasta_adsoyad']; ?></option>
            
            <?php } ?>
                    
            </select>
            <input type="hidden" name="randevu_hasta_id" value="<?php echo $hasta_cek['hasta_id']; ?>">
            <p>Tarih Seçin:</p><input type="date" name="tarih">  
            <p>Saat Seçin:</p><input type="time" name="saat">
            <input type="text" name="yer" placeholder="YER GİRİN..">
            <textarea name="aciklama" placeholder="AÇIKLAMA GİRİN.." cols="60" rows="3"></textarea>
            <input type="hidden" name="doktor_adsoyad" value="<?php echo $doktorcek['doktor_adsoyad']; ?>">
            <input type="hidden" name="doktor_id" value="<?php echo $doktorcek['doktor_id']; ?>">
            <button type="submit" name="randevu_kaydet">Randevu Kaydet</button>
        </form>
    </div>

    <div class="orta_div" id="randevu">
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
    </div>
</body>

</html>