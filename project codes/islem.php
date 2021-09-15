<?php 
    ob_start();
    session_start();
    include 'baglan.php';

    if(isset($_POST['doktorkaydet'])){
        $doktor_tc = isset($_POST['d_tc']) ? $_POST['d_tc'] : null;
        $doktor_adsoyad = isset($_POST['d_adsoyad']) ? $_POST['d_adsoyad'] : null;
        $doktor_password = isset($_POST['d_password']) ? $_POST['d_password'] : null;

        $doktorsor = $db->prepare("SELECT * FROM doktor where doktor_tc=:doktor_tc and doktor_sifre=:doktor_sifre");
        $doktorsor->execute([
            'doktor_tc' => $doktor_tc,
            'doktor_sifre' => $doktor_password
        ]);

        $say = $doktorsor->rowCount();
        
        if($say==0 & $doktor_tc != null & $doktor_adsoyad != null & $doktor_password != null){
                //veritabanı ekleme işlemi
                $sorgu = $db->prepare('INSERT INTO doktor SET
                doktor_tc = ?,
                doktor_adsoyad = ?,
                doktor_sifre = ?
                ');

            $ekle = $sorgu->execute([
                $doktor_tc, $doktor_adsoyad, $doktor_password
            ]);
            if($ekle){
                header('location:doktor-login.php?durum=basarili');
            } else{
                $hata = $sorgu->errorInfo();
                echo 'mysql hatası' .$hata[2];
            }

        } else{
            header('Location:doktor-kayit.php?error=1');
        }

        
    }

    if(isset($_POST['giris_yap'])){
        $doktor_tc = $_POST['d_tc'];
        $doktor_password = $_POST['d_password'];

        $doktorsor = $db->prepare("SELECT * FROM doktor where doktor_tc=:doktor_tc and doktor_sifre=:doktor_sifre");
        $doktorsor->execute([
            'doktor_tc' => $doktor_tc,
            'doktor_sifre' => $doktor_password
        ]);

        $say = $doktorsor->rowCount();
        if($say==1){
            $_SESSION['userdoktor_tc']=$doktor_tc;
            header('location:anasayfa.php?durum=girisbasarili');
            exit;
        } else{
            header('location:doktor-login.php?error=1');
            exit;
        }

    }

if(isset($_POST['randevu_kaydet'])) {
    $randevu_hasta = isset($_POST['r_hasta']) ? $_POST['r_hasta'] : null;
    $randevu_tarih = isset($_POST['tarih']) ? $_POST['tarih'] : null;
    $randevu_saat = isset($_POST['saat']) ? $_POST['saat'] : null;
    $randevu_yer = isset($_POST['yer']) ? $_POST['yer'] : null;
    $randevu_aciklama = isset($_POST['aciklama']) ? $_POST['aciklama'] : null;
    $randevu_doktor_adsoyad = isset($_POST['doktor_adsoyad']) ? $_POST['doktor_adsoyad'] : null;
    $randevu_doktor_id = isset($_POST['doktor_id']) ? $_POST['doktor_id'] : null;

    $kaydet=$db->prepare("INSERT INTO randevu SET
        randevu_hasta = ?,
        randevu_tarih = ?,
        randevu_saat = ?,
        randevu_yer = ?,
        randevu_aciklama = ?,
        randevu_doktor = ?,
        randevu_doktor_id = ?
    ");

    $insert=$kaydet->execute([
        $randevu_hasta, $randevu_tarih, $randevu_saat, $randevu_yer, $randevu_aciklama, $randevu_doktor_adsoyad, $randevu_doktor_id
    ]);
    if($insert) {
        header("location:randevu-olustur.php?durum=basarili");
    } else {
        header("location:randevu-olustur.php?error=1");
    }
}

if(isset($_POST['hasta_kaydet'])) {
    $hasta_adsoyad = isset($_POST['hasta_adsoyad']) ? $_POST['hasta_adsoyad'] : null;
    $hasta_tc = isset($_POST['hasta_tc']) ? $_POST['hasta_tc'] : null;
    $hasta_sikayeti = isset($_POST['hasta_sikayeti']) ? $_POST['hasta_sikayeti'] : null;
    $hasta_tedavi = isset($_POST['hasta_tedavi']) ? $_POST['hasta_tedavi'] : null;
    $hasta_tani = isset($_POST['hasta_tani']) ? $_POST['hasta_tani'] : null;
    $hasta_doktor_adsoyad = isset($_POST['doktor_adsoyad']) ? $_POST['doktor_adsoyad'] : null;
    $hasta_doktor_id = isset($_POST['doktor_id']) ? $_POST['doktor_id'] : null;

    $kaydet=$db->prepare("INSERT INTO hasta SET
        hasta_adsoyad = ?,
        hasta_tc = ?,
        hasta_sikayeti = ?,
        hasta_tedavi = ?,
        hasta_tani = ?,
        hasta_doktor = ?,
        hasta_doktor_id = ?
    ");

    $insert=$kaydet->execute([
        $hasta_adsoyad, $hasta_tc, $hasta_sikayeti, $hasta_tedavi, $hasta_tani, $hasta_doktor_adsoyad, $hasta_doktor_id
    ]);
    if($insert) {
        header("location:hasta-ekle.php?durum=basarili");
    } else {
        header("location:hasta-ekle.php?error=1");
    }
}

if(isset($_POST['randevusil'])) {
      
    $randevu_id = $_POST['randevu_id'];
    if(empty($randevu_id)){
        header("location:randevular.php?error=no_id");
    } else {
    $randevu_silme=$db->prepare("DELETE FROM randevu WHERE randevu_id=:randevu_id");
    $randevusil=$randevu_silme->execute([
        'randevu_id' => $randevu_id
    ]);
    
    if($randevusil) {
        header("location:randevular.php?durum=basarili");
    } else {
        header("location:randevular.php?error=1");
    }
}
}

if(isset($_POST['hastasil'])) {
      
    $hasta_id = $_POST['hasta_id'];
    if(empty($hasta_id)){
        header("location:hastalarım.php?error=no_id");
    }
    else{
    $hasta_silme=$db->prepare("DELETE FROM hasta WHERE hasta_id=$hasta_id");
    $hastasil=$hasta_silme->execute([
        'hasta_id' => $hasta_id
    ]);
    
    if($hastasil) {
        header("location:hastalarım.php?durum=basarili");
    } else {
        header("location:hastalarım.php?error=1");
    }
}
}

if(isset($_POST['guncelle'])) {
      
    $doktor_tc = isset($_POST['d_tc']) ? $_POST['d_tc'] : null;
    $doktor_password = isset($_POST['d_password']) ? $_POST['d_password'] : null;
    $doktor_adsoyad = isset($_POST['d_adsoyad']) ? $_POST['d_adsoyad'] : null;
    $doktor_id = $_POST['d_id'];

    $hesap_guncelleme=$db->prepare("UPDATE doktor SET
        doktor_tc = ?,
        doktor_sifre = ?,
        doktor_adsoyad = ?
        WHERE doktor_id=$doktor_id
    ");
    $guncelle=$hesap_guncelleme->execute([
        $doktor_tc, $doktor_password, $doktor_adsoyad
    ]);
    
    if($guncelle) {
        header("location:doktor-hesap.php?durum=basarili");
    } else {
        header("location:doktor-hesap.php?error=1");
    }
}


if(isset($_POST['hasta_guncelle'])) {
      
    $hasta_adsoyad = isset($_POST['hasta_adsoyad']) ? $_POST['hasta_adsoyad'] : null;
    $hasta_tc = isset($_POST['hasta_tc']) ? $_POST['hasta_tc'] : null;
    $hasta_sikayeti = isset($_POST['hasta_sikayeti']) ? $_POST['hasta_sikayeti'] : null;
    $hasta_tedavi = isset($_POST['hasta_tedavi']) ? $_POST['hasta_tedavi'] : null;
    $hasta_tani = isset($_POST['hasta_tani']) ? $_POST['hasta_tani'] : null;
    $hasta_tahlil = isset($_POST['hasta_tahlil']) ? $_POST['hasta_tahlil'] : null;
    $hasta_tahlil_sonuc = isset($_POST['hasta_tahlil_sonuc']) ? $_POST['hasta_tahlil_sonuc'] : null;
    $hasta_id = $_POST['hasta_id'];
    if(empty($hasta_id)){
        header("location:hasta-duzenle.php?error=no_id");
    }
    else {
    $hasta_guncelleme=$db->prepare("UPDATE hasta SET
        hasta_adsoyad = ?,
        hasta_tc = ?,
        hasta_sikayeti = ?,
        hasta_tedavi = ?,
        hasta_tani = ?,
        hasta_tahlil = ?,
        hasta_tahlil_sonuc = ?

        WHERE hasta_id=$hasta_id
    ");
    $hastaguncelle=$hasta_guncelleme->execute([
        $hasta_adsoyad, $hasta_tc, $hasta_sikayeti, $hasta_tedavi, $hasta_tani, $hasta_tahlil, $hasta_tahlil_sonuc
    ]);
    
    if($hastaguncelle) {
        header("location:hasta-duzenle.php?durum=basarili");
    } else {
        header("location:hasta-duzenle.php?error=1");
    }
}

}
if(isset($_POST['onayla'])){
   
    $hasta_doktor_id = $_POST['hasta_doktor_id'];
    $hasta_tc = $_POST['hasta_tc'];
    $onay_talep=$db->prepare("UPDATE hasta SET
    talep_durum = '2' 
    WHERE hasta_doktor_id=$hasta_doktor_id and hasta_tc=$hasta_tc");

    $onayla=$onay_talep->execute([
        'hasta_doktor_id' => $hasta_doktor_id,
        'hasta_tc' => $hasta_tc
    ]);
    
    if($onayla) {
        header("location:talepler.php?durum=islembasarili");
    } else {
        header("location:talepler.php?error=1");
    }
}

if(isset($_POST['iptal_onayla'])){
    $randevu_id = $_POST['randevu_id'];
    $r_talep=$db->prepare("UPDATE randevu SET
        randevu_iptal = '2'
    WHERE randevu_id=$randevu_id");

    $talep_et=$r_talep->execute([
        'randevu_id' => $randevu_id,
    ]);
    
    if($talep_et) {
        header("location:talepler.php?durum2=onayislemibasarili");
    } else {
        header("location:talepler.php?error=1");
    }
}
?>

