<?php include "header_hasta.php" ?>
<?php
            if(!empty($hastacek['hasta_doktor'])){
                header("location:anasayfa_hasta.php?erisim_yok");
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Doktor Seçimi</title>
    <link rel="stylesheet" href="style123.css">
</head>
<body>
<form action="islem2.php" method="post">   
<div class="orta_div2" id="randevu2">
        <h1>Doktor Seçimi</h1>
        <?php 
                if(isset($_GET['error'])=='no_id'){
                    echo "<h4 style='color:red; margin-bottom:10px'>*Doktor Seçerek İlerleyin !<h4>";
                }
            ?>
        <table class="randevu-tablo2">
        <tr>
            <th style="color:blue">Seçim</th>
            <th>Adı Soyadı</th>
            <th>Hasta Sayısı</th>
        </tr>
        
        <?php 
            $doktor_sor=$db->prepare("SELECT * FROM doktor
            ");
            $doktor_sor->execute();

            while($doktor_cek=$doktor_sor->fetch(PDO::FETCH_ASSOC)){ 
            
            $d_id=$doktor_cek['doktor_id'];
            $hastasayisi_sor=$db->prepare("SELECT * FROM hasta
            INNER JOIN doktor ON hasta.hasta_doktor_id = doktor.doktor_id where doktor_id=$d_id
            ");
            $hastasayisi_sor->execute();
            $hastasayisi=0;
            while($hastasayisi_cek=$hastasayisi_sor->fetch(PDO::FETCH_ASSOC)){
                $hastasayisi = $hastasayisi + 1;
            }
            ?>       
        <tr>
            <td><input type="radio" name="doktor_id" value="<?php echo $doktor_cek['doktor_id']; ?>"></td>
            <td><?php echo $doktor_cek['doktor_adsoyad']; ?></td>
            <td><?php echo $hastasayisi; ?></td>
        </tr>
            <?php } ?>
    </table>  
    </div>
    <button type="submit" name="doktorsec" class="olustur">Seçimi Tamamla</button>
    </form>
    

</body>
</html>