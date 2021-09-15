<?php 
    session_start();
    session_destroy();

    header("location:doktor-login.php")
?>