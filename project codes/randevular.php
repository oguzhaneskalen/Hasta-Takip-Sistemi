<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Randevular</title>
    <link rel="stylesheet" href="style123.css">
</head>
<body>
<form action="islem.php" method="post">
<div class="orta_div2" id="randevu2">
        <h1 style="margin-top: 40px;">Randevular</h1> 

        <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:green; margin-bottom:10px'>*Başarıyla Silindi<h4>";
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
            <td><input type="radio" name="randevu_id" value="<?php echo $randevu_cek['randevu_id']; ?>"></td>
            <td><?php echo $randevu_cek['randevu_hasta']; ?></td>
            <td><?php echo $randevu_cek['randevu_yer']; ?></td>
            <td class="i"><?php echo $randevu_cek['randevu_aciklama']; ?></td>
            <td><?php echo $randevu_cek['randevu_tarih']; ?></td>
            <td><?php echo $randevu_cek['randevu_saat']; ?></td>
        </tr>
        
            <?php } ?>
    </table>  
    </div>
    <a><input type="submit" class="buttonsil" name="randevusil" value="Seçilen Randevuyu Sil"></a>
    </form>
    <a href="randevu-olustur.php"><button class="olustur">Randevu Oluştur</button></a>

</body>
</html>