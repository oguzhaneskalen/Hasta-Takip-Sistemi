<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Hasta Ekleme</title>
    <link rel="stylesheet" href="styles/style123.css">
</head>

<body>

    <div class="adsoyad">
        <h4>Sn. <?php echo $doktorcek['doktor_adsoyad']; ?></h4>
    </div>

    <div class="orta_div" id="randevu_div">
        <h2>Hasta Ekle</h2>
        <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:blue; text-align:center'>*Başarıyla Eklendi<h4>";
                }
            ?>
        <form action="islem.php" method="post">
            <input type="text" name="hasta_adsoyad" placeholder="HASTA AD SOYAD">
            <input type="text" name="hasta_tc" placeholder="HASTA TC">
            <textarea name="hasta_sikayeti" placeholder="ŞİKAYET GİRİN.." cols="60" rows="3"></textarea>
            <input type="text" name="hasta_tani" placeholder="HASTALIK TANISI GİRİN..">
            <input type="text" name="hasta_tedavi" placeholder="TEDAVİ GİRİN..">
            <input type="hidden" name="doktor_adsoyad" value="<?php echo $doktorcek['doktor_adsoyad']; ?>">
            <input type="hidden" name="doktor_id" value="<?php echo $doktorcek['doktor_id']; ?>">
            <button type="submit" name="hasta_kaydet">Hasta Kaydet</button>
        </form>
    </div>
    <div class="orta_div" id="randevu">
        <div id="scroll">
        <h2>Hastalar</h2>
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
    </div>
</body>

</html>