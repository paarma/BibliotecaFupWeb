<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/BibliotecaFupWeb/config.ini.php';

session_start();
session_destroy();
header('location:'.BASEURL.'index.php');

?>