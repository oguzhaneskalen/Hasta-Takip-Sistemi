<?php include "header_hasta.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Tedaviler</title>
    <link rel="stylesheet" href="style123.css">
</head>
<body>
<form action="islem2.php" method="post">   
<div class="orta_div2" id="randevu2">
        <h1>Tedavilerim</h1>
        <table class="randevu-tablo2">
        <tr>
            <th>Doktor</th>
            <th>Şikayet</th>
            <th>Hastalık Tanısı</th>
            <th>Tahlil</th>
            <th>Tahlil Sonucu</th>
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
            <td><?php echo $hasta_cek['hasta_tahlil']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tahlil_sonuc']; ?></td>
            <td class="i"><?php echo $hasta_cek['hasta_tedavi']; ?></td>
        </tr>
        
            <?php } ?>
    </table>
    </div>
    </form>

</body>
</html>