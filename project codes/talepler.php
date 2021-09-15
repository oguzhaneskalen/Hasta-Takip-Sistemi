<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Talepler</title>
    <link rel="stylesheet" href="style123.css">
    
</head>
<body>
<div class="orta_div2" id="randevu2">
        <h1 style="margin-top: 40px;">Randevu Talepleri</h1> 

        <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:blue; margin-bottom:10px'>*İşlem Başarılı</h4>";
                }
            ?>
        <table class="randevu-tablo2">
        <tr>
            <th>Hasta</th>
            <th>Nedeni</th>
            <th>Oluşturulma Tarihi</th>
            <th>Durum</th>
            <th style="color:blue">İşlem</th>
        </tr>
        
        <?php 
            $talep_sor=$db->prepare("SELECT * FROM hasta
            INNER JOIN doktor ON hasta.hasta_doktor_id = doktor.doktor_id WHERE doktor_tc =:doktor_tc
            ");
            $talep_sor->execute([
                'doktor_tc' => $_SESSION['userdoktor_tc']
            ]);
           
            
            while($talep_cek=$talep_sor->fetch(PDO::FETCH_ASSOC)){ 
            if($talep_cek['talep_durum'] != '0'){
            ?>
            <form action="islem.php" method="post">
        <tr>
            <td><?php echo $talep_cek['hasta_adsoyad']; ?></td>
            <td><?php echo $talep_cek['randevu_talep']; ?></td>
            <td><?php echo $talep_cek['talep_tarihi']; ?></td>
            <td><?php $talep_durum = $talep_cek['talep_durum'];
                if($talep_durum=='1'){echo 'Onay Bekleniyor';}
                else {echo 'Onaylandı';}
            ?>
            </td>
            <input type="hidden" name="hasta_doktor_id" value="<?php echo $talep_cek['hasta_doktor_id']; ?>">
            <input type="hidden" name="hasta_tc" value="<?php echo $talep_cek['hasta_tc']; ?>">
            <td><button style="width: 250px; background:blue; color:white;" type="submit" name="onayla">Talebi Onaylandı Olarak İşaretle</button></td>
        </tr>
        </form>
            <?php }} ?>
    </table>
    <a href="randevu-olustur.php"><button style="margin-left: 600px; margin-top:50px;" class="olustur">Randevu Oluştur</button></a>

    <h2 style="margin-top: 40px; text-align:center">Randevu İptal Talepleri</h2> 

        <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:blue; margin-bottom:10px'>*İşlem Başarılı</h4>";
                }
            ?>
    <table class="randevu-tablo2">
        <tr>
            <th>Hasta</th>
            <th>Randevu Tarihi</th>
            <th>Durum</th>
            <th colspan="2" style="color:blue;">İşlem</th>
        </tr>
        
        <?php 
            $talep_sor=$db->prepare("SELECT * FROM randevu
            INNER JOIN doktor ON randevu.randevu_doktor_id = doktor.doktor_id WHERE doktor_tc =:doktor_tc
            ");
            $talep_sor->execute([
                'doktor_tc' => $_SESSION['userdoktor_tc']
            ]);
           
            
            while($talep_cek=$talep_sor->fetch(PDO::FETCH_ASSOC)){ 
            if($talep_cek['randevu_iptal'] != '0'){
            ?>
            <form action="islem.php" method="post">
        <tr>
            <td><?php echo $talep_cek['randevu_hasta']; ?></td>
            <td><?php echo $talep_cek['randevu_tarih']; ?></td>
            <td><?php $talep_durum = $talep_cek['randevu_iptal'];
                if($talep_durum=='1'){echo 'Onay Bekleniyor';}
                elseif($talep_durum=='2') {echo 'Onaylandı';}
            ?>
            </td>
            <input type="hidden" name="randevu_id" value="<?php echo $talep_cek['randevu_id']; ?>">
            <td style="width: 270px;"><button style="width: 250px; background:blue; color:white;" type="submit" name="iptal_onayla">Talebi Onaylandı Olarak İşaretle</button></td>
            <td style="width: 180px;"><button style="width: 160px; background:red; color:white;" type="submit" name="randevusil">Randevuyu Sil</button></td>
        </tr>
        </form>
            <?php }} ?>
    </table>
    </div>
</body>
</html>