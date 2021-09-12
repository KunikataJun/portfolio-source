<?php
session_start();
const CONSTANTS_INC = ROOT . "/private/constants.php";
require_once CONSTANTS_INC;
require_once Config;

$CONF = new Config();

if ($CONF->get("debug_mode")) {
	ini_set('display_errors', "On");
	ini_set('error_reporting', E_ALL);
}
