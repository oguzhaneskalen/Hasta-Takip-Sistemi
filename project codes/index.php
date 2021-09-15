<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HT Sistemi</title>
    <style>
        header img{
    width: 120px;
    height: 120px;
}
html{
    background-image: url("medya/ap1.jpg");
    background-repeat: no-repeat;
    background-size: cover; 
}
header {
    text-align: center;
}
body .TableOuter{
   padding: 30px;
   margin: 0 auto;
   background-color: rgb(181, 206, 228);
   width: 400px;
   text-align: center;
   border-radius: 5px;

}

body {
    font-family: Arial, Helvetica, sans-serif;
}

body .TableOuter div{
   margin: 10px;
}

body .TableOuter button{
    margin: 10px;
}
button.sub1{
    box-sizing: border-box;
    box-shadow: 5px 5px 4px gray;
    font-size: 25px;
    font-weight: bolder;
    color: white;
    border: none;
    border-radius: 5px;
    width: 70%;
    height: 50px;
    background-color: rgb(4, 27, 58);
}
button.sub1:hover{
    background-color: rgb(44, 98, 168);
}
button.sub2{
    box-sizing: border-box;
    box-shadow: 5px 5px 4px gray;
    font-size: 25px;
    font-weight: bolder;
    color: white;
    border: none;
    border-radius: 5%;
    width: 70%;
    height: 50px;
    background-color: rgb(14, 184, 65);
}
button.sub2:hover{
    background-color: rgb(16, 138, 62);
}

    </style>
</head>

<body>
    <header>
        <div class="img-logo">
            <img src="medya/logo.png" alt="ht-logo">
        </div>
        <div class="baslik">
            <h2>HASTA TAKİP SİSTEMİ</h2>
        </div>
    </header>

    <div class="TableOuter">
        <a href="doktor-login.php"><button type="submit" class="sub1">DOKTOR GİRİŞİ</button></a>
        <a href="hasta-login.php"><button type="submit" class="sub2">HASTA GİRİŞİ</button></a>
    </div>
</body>
</html>