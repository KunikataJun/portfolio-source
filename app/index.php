<?php
const ROOT = '.';
const CONSTANTS_INC = ROOT . "/private/constants.php";
require_once CONSTANTS_INC;

// ログインページへリダイレクト
header("location: " . LOGIN_PAGE);
exit;