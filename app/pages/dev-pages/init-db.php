<?php

// ----- データベースを新規作成 ----- //

// デフォルトのidとpasswordはURLのクエリ文字列で指定

const ROOT = '../..';
require_once ROOT . "/private/init.php";
require_once DB;
require_once Util;

if (file_exists(SQLITE_DB_FILE_PATH)) {
	echo "Database already exists.";
	exit;
}

$id = $_GET['id'];
$password = $_GET['password'];

$sql = "
CREATE TABLE users (
	id,
	role,
	password_hash
)
";

DB::execute($sql);

$key_values = [
	'id' => $id,
	'role' => "admin",
	'password_hash' => password_hash($password, PASSWORD_DEFAULT)
];

DB::insert('users', $key_values);

$data = DB::select("SELECT * FROM users");

Util::print_r($data);


