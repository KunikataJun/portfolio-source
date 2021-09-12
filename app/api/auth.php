<?php
const ROOT = '..';
require_once ROOT . "/private/init.php";
require_once Auth;
//api_login_check();

$post = json_decode(file_get_contents('php://input'), true);

// ログイン処理
if ($post['action'] == 'login') {
    $user_id = $post['user_id'];
    $password = $post['password'];

    if (Auth::is_valid_user($user_id, $password)) {
        // ログイン成功
        $_SESSION['user_id'] = $user_id;
        echo 'success';
    } else {
        // ログイン失敗
        echo 'fail';
    }
}

// ログアウト処理
if ($post['action'] == 'logout') {
    // セッション用Cookieの破棄
    setcookie(session_name(), '', 1);

    // セッションファイルの破棄
    session_destroy();

    // response
    echo 'success';
}