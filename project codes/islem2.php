<?php 
    ob_start();
    session_start();
    include 'baglan.php';

    if(isset($_POST['hastakaydet'])){
        $hasta_tc = isset($_POST['h_tc']) ? $_POST['h_tc'] : null;
        $hasta_adsoyad = isset($_POST['h_adsoyad']) ? $_POST['h_adsoyad'] : null;
        $hasta_password = isset($_POST['h_password']) ? $_POST['h_password'] : null;
        $hasta_sikayeti = isset($_POST['hasta_sikayeti']) ? $_POST['hasta_sikayeti'] : null;
        $hastasor = $db->prepare("SELECT * FROM hasta where hasta_tc=:hasta_tc and hasta_sifre=:hasta_sifre");
        $hastasor->execute([
            'hasta_tc' => $hasta_tc,
            'hasta_sifre' => $hasta_password
        ]);

        $say = $hastasor->rowCount();
        
        if($say==0 & $hasta_tc != null & $hasta_adsoyad != null & $hasta_password != null){
                //veritabanı ekleme işlemi
                $sorgu = $db->prepare('INSERT INTO hasta SET
                hasta_tc = ?,
                hasta_adsoyad = ?,
                hasta_sifre = ?,
                hasta_sikayeti = ?
                ');

            $ekle = $sorgu->execute([
                $hasta_tc, $hasta_adsoyad, $hasta_password, $hasta_sikayeti
            ]);
            if($ekle){
                header('location:hasta-login.php?durum=basarili');
            } else{
                $hata = $sorgu->errorInfo();
                echo 'mysql hatası' .$hata[2];
            }

        } else{
            header('Location:hasta-kayit.php?error=1');
        }

        
    }

    if(isset($_POST['giris_yap'])){
        $hasta_tc = $_POST['h_tc'];
        $hasta_password = $_POST['h_password'];

        $hastasor = $db->prepare("SELECT * FROM hasta where hasta_tc=:hasta_tc and hasta_sifre=:hasta_sifre");
        $hastasor->execute([
            'hasta_tc' => $hasta_tc,
            'hasta_sifre' => $hasta_password
        ]);

        $say = $hastasor->rowCount();
        if($say>=1){
            $_SESSION['userhasta_tc']=$hasta_tc;
            header('location:anasayfa_hasta.php?durum=girisbasarili');
            exit;
        } else{
            header('location:hasta-login.php?error=1');
            exit;
        }

    }



if(isset($_POST['guncelle'])) {
      
    $hasta_tc = isset($_POST['h_tc']) ? $_POST['h_tc'] : null;
    $hasta_password = isset($_POST['h_password']) ? $_POST['h_password'] : null;
    $hasta_id = $_POST['h_id'];

    $hesap_guncelleme=$db->prepare("UPDATE hasta SET
        hasta_tc = ?,
        hasta_sifre = ?
        WHERE hasta_id=$hasta_id
    ");
    $guncelle=$hesap_guncelleme->execute([
        $hasta_tc, $hasta_password
    ]);
    
    if($guncelle) {
        header("location:hasta-hesap.php?durum=basarili");
    } else {
        header("location:hasta-hesap.php?error=1");
    }
}

if(isset($_POST['hesapsil'])) {
      
    $hasta_id = $_POST['h_id'];
    
    $hasta_silme=$db->prepare("DELETE FROM hasta WHERE hasta_id=$hasta_id");
    $hastasil=$hasta_silme->execute([
        'hasta_id' => $hasta_id
    ]);
    
    if($hastasil) {
        header("location:index.php?durum=hesapsilindi");
    } else {
        header("location:hasta-hesap.php?error=1");
    }
}

if(isset($_POST['doktorsec'])) {
      
    $doktor_id = $_POST['doktor_id'];

    $doktor_sor=$db->prepare("SELECT * FROM doktor where doktor_id=:doktor_id");
    $doktor_cek=$doktor_sor->execute([
        'doktor_id' => $doktor_id
    ]);
    $doktor_cek=$doktor_sor->fetch(PDO::FETCH_ASSOC);
    $hasta_doktor = $doktor_cek['doktor_adsoyad'];

    $hasta_tc = $_SESSION['userhasta_tc'];
    if(empty($doktor_id)){
        header("location:doktor-secimi.php?error=no_id");
    }
    else{
    $doktor_secme=$db->prepare("UPDATE hasta SET
    hasta_doktor_id = ?, 
    hasta_doktor = ?
    WHERE hasta_tc=$hasta_tc");

    $doktorsec=$doktor_secme->execute([
        $doktor_id, $hasta_doktor
    ]);
    
    if($doktorsec) {
        header("location:hasta-hesap.php?doktorsecimibasarili");
    } else {
        header("location:doktor-secimi.php?error=1");
    }
}
}

if(isset($_POST['talep'])){
    $randevu_nedeni = $_POST['randevutalebi'];
    $talep_tarihi = $_POST['talep_tarihi'];
    $hasta_doktor_id = $_POST['hasta_doktor_id'];
    $hasta_tc = $_POST['hasta_tc'];
    $r_talep=$db->prepare("UPDATE hasta SET
    randevu_talep = ?,
    talep_tarihi = ?,
    talep_durum = '1' 
    WHERE hasta_doktor_id=$hasta_doktor_id and hasta_tc=$hasta_tc");

    $talep_et=$r_talep->execute([
        $randevu_nedeni, $talep_tarihi
    ]);
    
    if($talep_et) {
        header("location:randevular_hasta.php?durum=talepislemibasarili");
    } else {
        header("location:randevular_hasta.php?error=1");
    }
}

if(isset($_POST['r_iptal'])){
    $randevu_id = $_POST['randevu_id'];
    $r_talep=$db->prepare("UPDATE randevu SET
        randevu_iptal = '1'
    WHERE randevu_id=$randevu_id");

    $talep_et=$r_talep->execute([
        'randevu_id' => $randevu_id,

    ]);
    
    if($talep_et) {
        header("location:randevular_hasta.php?durum2=talepislemibasarili");
    } else {
        header("location:randevular_hasta.php?error=1");
    }
}

if(isset($_POST['talep_temizle'])){

    $hasta_tc = $_POST['hasta_tc'];
    $r_talep=$db->prepare("UPDATE hasta SET
    randevu_talep = '',
    talep_durum = '0' 
    WHERE hasta_tc=$hasta_tc");

    $talep_et=$r_talep->execute();
    
    if($talep_et) {
        header("location:randevular_hasta.php?taleplerkaldırıldı");
    } else {
        header("location:doktor-secimi.php?error=1");
    }
}
?>

