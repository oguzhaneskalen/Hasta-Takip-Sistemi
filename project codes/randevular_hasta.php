<?php include "header_hasta.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Randevular</title>
    <link rel="stylesheet" href="style123.css">
</head>
<body>
<form action="islem2.php" method="post">   
<div class="orta_div2" id="randevu2">
        <h1>Randevular</h1>
        <?php 
                if(isset($_GET['error'])=='no_id'){
                    echo "<h4 style='color:red; margin-bottom:10px'>*Doktor Seçerek İlerleyin !<h4>";
                }
            ?>
        <table class="randevu-tablo2">
        <tr>
            <th>Doktor</th>
            <th>Yer</th>
            <th>Açıklama</th>
            <th>Tarih</th>
            <th>Saat</th>
            <th style="color:maroon;" colspan="2">İptal Talebi</th>
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
            <input type="hidden" name="randevu_id" value="<?php echo $randevu_cek['randevu_id']; ?>">
            <td><?php echo $randevu_cek['randevu_doktor']; ?></td>
            <td><?php echo $randevu_cek['randevu_yer']; ?></td>
            <td class="i"><?php echo $randevu_cek['randevu_aciklama']; ?></td>
            <td><?php echo $randevu_cek['randevu_tarih']; ?></td>
            <td><?php echo $randevu_cek['randevu_saat']; ?></td>
            <td style="width:200px;"><button style="width: 180px; background:red; color:white" type="submit" name="r_iptal">İptal Talep Et</button></td>
            <td style="width:160px;color:<?php $iptal_talebi =$randevu_cek['randevu_iptal']; if($iptal_talebi==1){echo 'blue';} elseif($iptal_talebi==0) {echo 'gray';} else {echo 'seagreen';} ?>"><?php $iptal_talebi = $randevu_cek['randevu_iptal']; 
                if($iptal_talebi==0) {echo 'Talep Oluşturabilirsiniz';} elseif($iptal_talebi==1) {echo 'Talep İletildi';} else{echo 'Randevu İptal Edilmiştir';} 
            ?>
            </td>
        </tr>
        
            <?php } ?>
    </table>  
    </div>
    <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:blue; margin-bottom:10px; text-align:center;'>*Randevu Talebi İletildi<h4>";
                }
            ?>
    <h3 style="margin-top:30px; text-align:center;">Randevu Talebi</h3>
    <input type="hidden" id="current_dateandtime" name="talep_tarihi" value="">
    <input type="text" name="randevutalebi" placeholder="Talep Nedeni(isteğe bağlı)" style="width: 40%; height:30px; margin-left:450px; font-size:16px"><br>
    <input type="hidden" name="hasta_tc" value="<?php echo $_SESSION['userhasta_tc']; ?>">
    <select name="hasta_doktor_id" class="doktor_option">
                    <option value="0">Doktor Seçin</option>
                    <?php
            $hasta_tc = $_SESSION['userhasta_tc'];
            $doktor_sor=$db->prepare("SELECT * FROM hasta WHERE hasta_tc=$hasta_tc
            ");
            $doktor_sor->execute([
                'hasta_tc' => $_SESSION['userhasta_tc']
            ]);
            
            while($doktor_cek=$doktor_sor->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <option value="<?php echo $doktor_cek['hasta_doktor_id']; ?>"><?php echo $doktor_cek['hasta_doktor']; ?></option>
            
            <?php } ?>
                    
            </select>

    <button type="submit" name="talep" class="talep">Randevu Talep Et</button>
    
    <h3 style="margin-top:30px; text-align:center;">Taleplerim</h3>
    <table class="randevu-tablo">
        <tr style="background: lightcoral;">
            <th>Doktor</th>
            <th>Nedeni</th>
            <th>Oluşturma Tarihi</th>
            <th>Durumu</th>
        </tr>
        
        <?php 
            $talep_sor=$db->prepare("SELECT * FROM hasta WHERE hasta_tc =:hasta_tc and talep_durum!='0'
            ");
            $talep_sor->execute([
                'hasta_tc' => $_SESSION['userhasta_tc']
            ]);
           
            
            while($talep_cek=$talep_sor->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <tr>
            <td><?php echo $talep_cek['hasta_doktor']; ?></td>
            <td><?php echo $talep_cek['randevu_talep']; ?></td>
            <td><?php echo $talep_cek['talep_tarihi']; ?></td>
            <td style="color:<?php $talep_durum =$talep_cek['talep_durum']; if($talep_durum==1){echo 'blue';} else {echo 'seagreen';} ?>"><?php  $talep_durum =$talep_cek['talep_durum'];
            if($talep_durum==1) {echo 'Randevu Talebi İletildi';}
            else {echo 'Talebiniz Onaylandı '; ?><i class="fas fa-check-square"></i><?php } 
            ?>
            </td>
        </tr>
        
            <?php } ?>
    </table>
    <button style="background: lightcoral; margin-left:660px; width:200px; color:white;" type="submit" name="talep_temizle" class="sa">Talepleri Kaldır</button>
    </form>
    <script>
    // Date object
  var today = new Date();
// Current Date
  var date =today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
// Current Time
  var time = today.getHours() + ":" + today.getMinutes();
// Current Date and Time
  var dateTime = date+' '+time;
  document.getElementById("current_dateandtime").value = dateTime;
    </script>
</body>
</html>