<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Hesabım</title>
    <script>
                function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
</head>
<body>
    <form action="islem.php" method="post">
    <div class="d_hesabim-content">
        <div class="label">
            <label>AD SOYAD</label>
            <input type="text" name="d_adsoyad" value="<?php echo $doktorcek['doktor_adsoyad']; ?>">
        </div>
        <div class="label">
            <label>TC Kimlik NO</label>
            <input type="text" name="d_tc" value="<?php echo $doktorcek['doktor_tc']; ?>">
        </div>
        <div class="label">
            <label>Şifre</label>
            <input type="password" name="d_password" id="pass" value="<?php echo $doktorcek['doktor_sifre']; ?>">
        </div>
        <div style="text-align:center" >
            <input type="checkbox" onclick="myFunction()">Şifreyi Göster
        </div>
            <input type="hidden" name="d_id" value="<?php echo $doktorcek['doktor_id']; ?>">
        <div class="gunc-button">
            <button type="submit" name="guncelle">Güncelle</button>
        </div>
        </form>
        <label><?php 
                if(isset($_GET['durum'])==true){
                    echo "<h4 style='color:blue;'>*Başarıyla Güncellendi<h4>";
                }
            ?></label>
    </div>
    
</body>
</html>