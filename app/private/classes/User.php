<?php

class User {
	/**
	 * ログイン状態の確認
	 *
	 * @return bool
	 */
	public static function is_logged_in() {
		return isset($_SESSION['user_id']);
	}

	/**
	 * ユーザが管理者であればtrueを返す
	 *
	 * @return bool
	 */
	public static function is_admin() {
		//return isset($_SESSION['user_id']);
	}
}