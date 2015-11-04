<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
echo "Привет, <h4>".$_SESSION['login']."</h4>";
?>