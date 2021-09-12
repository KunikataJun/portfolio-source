<?php
const ROOT = '..';
require_once ROOT . "/private/init.php";
require_once Auth;
Auth::page_login_check();

$file_name = $_GET['file_name'];
$path = DATA_DIR . "/{$file_name}.pdf";
$mime = 'application/pdf'; // PDFのmimeタイプ

header('Content-Type: ' . $mime);
readfile($path);