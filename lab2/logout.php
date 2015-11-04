<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
$_SESSION = array();
echo "Выход осуществлен.";
?>