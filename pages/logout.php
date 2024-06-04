<?php
session_start();
$lang = $_SESSION['language'] ?? 'EN';

session_destroy();

session_start();
$_SESSION['language'] = $lang;

header('Location: home.php');
?>