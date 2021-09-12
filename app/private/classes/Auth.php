<?php
require_once DB;

class Auth {
    /**
     * ページにアクセスしたときのログインチェック
     *
     * ログイン済みでなければログインページにリダイレクトする
     */
    public static function page_login_check() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . LOGIN_PAGE);
            exit;
        }
    }


    /**
     * APIにアクセスしたときのログインチェック
     *
     * ログインしていなければhttpステータスコード401を返す
     */
    public static function api_login_check() {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            exit;
        }
    }

    /**
     * データベースに登録されているユーザであるかを確認する
     *
     * @var string $user_id
     * @var string $password
     * @return bool
     */
    public static function is_valid_user($user_id, $password) {
        $password_hash = DB::get_password_hash($user_id);

        if ($password_hash === null) {
            return false;
        }

        return password_verify($password, $password_hash);
    }
}