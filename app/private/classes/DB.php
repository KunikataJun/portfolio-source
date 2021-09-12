<?php
require_once SQLitePdoWrapper;

class DB extends SQLitePdoWrapper {
    protected static function get_db_file_path() {
        return SQLITE_DB_FILE_PATH;
    }

    /**
     * ユーザIDに対応するパスワードのハッシュ値を取得
     *
     * @var string $user_id   ユーザID
     * @return string/null ハッシュ値（対応するユーザが存在しないときはnull）
     */
    static function get_password_hash($user_id) {
        $sql = "
            SELECT password_hash FROM users
            WHERE id = ?
        ";

        return DB::select_value($sql, $user_id);
    }

    /**
     * 新規ユーザを作成
     *
     * @var string $user_id    ユーザID
     * @var string $role       ユーザの役割
     * @var string $password   パスワード文字列
     * @return bool            登録に成功したらtrue
     */
    static function create_new_user($user_id, $role, $password) {
        // ---- 既にユーザが存在するかどうかを確認 ---- //
        $sql = "
            SELECT * FROM users
            WHERE id = ?
        ";

        if (DB::select_value($sql, $user_id) != null) {
            return false;
        }

        // ---- 新規ユーザをDBに追加 ---- //
        $key_values = [
            'id' => $user_id,
            'role' => $role,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT)
        ];

        DB::insert('users', $key_values);

        return true;
    }

    /**
     * ユーザを削除
     *
     * @var string $user_id    ユーザID
     * @return bool            削除に成功したらtrue
     */
    static function delete_user($user_id) {
        // ---- 既にユーザが存在するかどうかを確認 ---- //
        $sql = "
            SELECT * FROM users
            WHERE id = ?
        ";

        if (DB::select_value($sql, $user_id) == null) {
            return false;
        }

        // ---- DBからユーザを削除 ---- //
        $sql = "
            DELETE FROM users
            WHERE id = ?
        ";

        DB::execute($sql, $user_id);

        return true;
    }
}