<?php include "header_hasta.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Hesabım</title>
    <link rel="stylesheet" href="style123.css">
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
    <form action="islem2.php" method="post" onsubmit="return confirm('İşlemi Onaylıyor Musun');">
    <div class="d_hesabim-content">
        <div class="label">
            <h4> <?php echo $hastacek['hasta_adsoyad']; ?></h4>
        </div>
        <div class="label">
            <h4 style="color:DarkBlue">Doktor : <?php 
            $hasta_sor=$db->prepare("SELECT * FROM hasta
            WHERE hasta_tc =:hasta_tc
            ");
            $hasta_sor->execute([
                'hasta_tc' => $_SESSION['userhasta_tc']
            ]);
           
            while($hasta_cek=$hasta_sor->fetch(PDO::FETCH_ASSOC)){ ?>
            * <?php echo $hasta_cek['hasta_doktor']; ?> *
            <?php } ?></h4>
        </div>
        <div class="label">
            <label>TC Kimlik NO</label>
            <input type="text" name="h_tc" value="<?php echo $hastacek['hasta_tc']; ?>">
        </div>
        <div class="label">
            <label>Şifre</label>
            <input type="password" name="h_password" id="pass" value="<?php echo $hastacek['hasta_sifre']; ?>">
        </div>
        <div style="text-align:center" >
            <input type="checkbox" onclick="myFunction()">Şifreyi Göster
        </div>
            <input type="hidden" name="h_id" value="<?php echo $hastacek['hasta_id']; ?>">
        <div class="gunc-button">
            <button type="submit" name="guncelle">Güncelle</button>
        </div>
        <div>
            <button class="sil-button" type="submit" name="hesapsil">Hesabı Sil</button>
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