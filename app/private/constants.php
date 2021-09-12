<?php

const APP_TITLE = "KUNIKATA Jun's Portfolio";

const PAGES_DIR = ROOT . "/pages";
    const DEV_PAGES_DIR = PAGES_DIR . "/dev-pages.php";
    const LOGIN_PAGE = PAGES_DIR . "/login.php";
    const PROFILE_PAGE = PAGES_DIR . "/profile.php";
    const WORKS_PAGE = PAGES_DIR . "/works.php";
    const CERTIFICATES_PAGE = PAGES_DIR . "/certificates.php";
    const PDF_VIEWER_PAGE = PAGES_DIR . "/pdf-viewer.php";

const HOME_PAGE = PROFILE_PAGE;

const PUBLIC_DIR = ROOT . "/public";
    const IMAGES_DIR = PUBLIC_DIR . "/images";
        const FAVICON_ICO = IMAGES_DIR . "/favicon.ico";
        const SAMPLE_IMG = IMAGES_DIR . "/sample.png";
    const COMMON_CSS = PUBLIC_DIR . "/common.css";
    const COMMON_JS = PUBLIC_DIR . "/common.js";

const PRIVATE_DIR = ROOT . "/private";
    const CLASSES_DIR = PRIVATE_DIR . "/classes";
        const Auth = CLASSES_DIR . "/Auth.php";
        const Config = CLASSES_DIR . "/Config.php";
        const DB = CLASSES_DIR . "/DB.php";
        const SQLitePdoWrapper = CLASSES_DIR . "/SQLitePdoWrapper.php";
        const User = CLASSES_DIR . "/User.php";
        const Util = CLASSES_DIR . "/Util.php";
    const CONFIG_FILE_PATH = PRIVATE_DIR . "/config.json";
    const DATA_DIR = PRIVATE_DIR . "/data";
        const SQLITE_DB_FILE_PATH = DATA_DIR . "/database.db";
    const HTML_INCLUDE_DIR = PRIVATE_DIR . "/html-include";
        const HTML_HEAD_INC = HTML_INCLUDE_DIR . "/html_head.php";
        const JS_LIBRARIES_INC = HTML_INCLUDE_DIR . "/js_libraries.php";

const API_DIR = ROOT . "/api";
    const AUTH_API = API_DIR . "/auth.php";

const CONSTANTS_PHP_TO_JS = [
    'LOGIN_PAGE',
    'HOME_PAGE',
    'AUTH_API',
];

function php_constants_to_js_variables() {
    echo "\n<script>\n";
    foreach (CONSTANTS_PHP_TO_JS as $constant_name) {
        $constant_value = constant($constant_name);
        echo "var $constant_name = '$constant_value';\n";
    }
    echo "</script>\n";
}