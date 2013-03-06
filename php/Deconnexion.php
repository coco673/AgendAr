<?php 
session_start();
session_destroy();
echo "<script type='text/javascript'> alert('Session Deconnect\351');</script>";
echo "<script type='text/javascript'> document.location.href='../index.php';</script>";
?>