<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Hastalarım</title>
    <link rel="stylesheet" href="style123.css">
</head>
<body>
<form action="islem.php" method="post">   
<div class="orta_div2" id="randevu2">
        <h1>Hastalarım</h1>
        <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:green;'>*Başarıyla Silindi<h4>";
                }
            ?>
        <?php 
                if(isset($_GET['error'])=='no_id'){
                    echo "<h4 style='color:red; margin-bottom:10px'>*Hasta Seçerek İlerleyin !<h4>";
                }
            ?>
        <table class="randevu-tablo2">
        <tr>
            <th style="color:blue">Seçilen</th>
            <th>Adı</th>
            <th>TC Kimlik No</th>
            <th>Şikayet</th>
            <th>Hastalık Tanısı</th>
            <th>Tahlil</th>
            <th>Tahlil Sonucu</th>
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
            <td><input type="radio" name="hasta_id" value="<?php echo $hasta_cek['hasta_id']; ?>"></td>
            <td><?php echo $hasta_cek['hasta_adsoyad']; ?></td>
            <td><?php echo $hasta_cek['hasta_tc']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_sikayeti']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tani']; ?></td>
            <td><?php echo $hasta_cek['hasta_tahlil']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tahlil_sonuc']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tedavi']; ?></td>
        </tr>
        
            <?php } ?>
    </table>  
    </div>
    <a><input type="submit" class="buttonsil" name="hastasil" value="Seçilen Hastayı Sil"></a>
    </form>
    <a href="hasta-duzenle.php"><button style="background-color: #2A7FE0;" class="olustur">Tedavi-Tanı-Tahlil</button></a>
    <a href="hasta-ekle.php"><button class="olustur">Hasta Ekle</button></a>

</body>
</html>