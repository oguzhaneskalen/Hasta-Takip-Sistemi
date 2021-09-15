<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Tedavi Düzenleme</title>
    <link rel="stylesheet" href="style123.css">
</head>
<body>
<form action="islem.php" method="post">   
<div class="orta_div2" id="randevu2">
        <h1>Hastalarım</h1>
        <?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:blue; margin-bottom:10px'>*Başarıyla Güncellendi<h4>";
                }
            ?>
            <?php 
                if(isset($_GET['error'])=='no_id'){
                    echo "<h4 style='color:red; margin-bottom:10px'>*Hasta Seçerek İlerleyin !<h4>";
                }
            ?>
        <table class="randevu-tablo2" style="width: 80%;">
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
            <td><input style="width: max-content; font-size: 14px; height:26px; border-radius:0%" type="text" name="hasta_adsoyad" value="<?php echo $hasta_cek['hasta_adsoyad']; ?>"></td>
            <td><input style="width: max-content; font-size: 14px; height:26px; border-radius:0%" type="text" name="hasta_tc" value="<?php echo $hasta_cek['hasta_tc']; ?>"></td>
            <td><input style="width: max-content; font-size: 14px; height:26px; border-radius:0%" type="text" name="hasta_sikayeti" value="<?php echo $hasta_cek['hasta_sikayeti']; ?>"></td>
            <td><input style="width: max-content; font-size: 14px; height:26px; border-radius:0%" type="text" name="hasta_tani" value="<?php echo $hasta_cek['hasta_tani']; ?>"></td>
            <td><select name="hasta_tahlil" style="width: 200px;">
                <option value="<?php echo $hasta_cek['hasta_tahlil']; ?>"><?php echo $hasta_cek['hasta_tahlil']; ?></option>
                <option value="Kan Tahlili">Kan Tahlili</option>
                <option value="İdrar Tahlili">İdrar Tahlili</option>
                <option value="Mikroskopi Tahlili">Mikroskopi Tahlili</option>
                <option value="Radyoloji Tahlili">Radyoloji Tahlili</option>
                <option value="Patoloji Tahlili">Patoloji Tahlili</option>
                <option value="Genetik Tahlili">Genetik Tahlili</option>
                </select>
            </td>
            <td><textarea style="width: max-content; font-size: 14px; height:26px; border-radius:0%" name="hasta_tahlil_sonuc"><?php echo $hasta_cek['hasta_tahlil_sonuc']; ?></textarea></td>
            <td><input style="width: max-content; font-size: 14px; height:26px; border-radius:0%" type="text" name="hasta_tedavi" value="<?php echo $hasta_cek['hasta_tedavi']; ?>"></td>
        </tr>
        
            <?php } ?>
    </table>  
    </div>
    <a><input type="submit" class="buttonsil" style="background-color: #2A7FE0;" name="hasta_guncelle" value="Seçilen Hastayı Kaydet"></a>
    </form>


</body>
</html>