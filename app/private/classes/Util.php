<?php

class Util {
	/**
	 * ページにアクセスしたときのログインチェック
	 *
	 * @var mixed $var
	 */
	public static function print_r($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	/**
	 * pdf表示ページへのリンクを表示
	 *
	 * @var string $file_name
	 */
	public static function url_to_pdf($file_name) {
		echo PDF_VIEWER_PAGE . "?file_name={$file_name}";
	}
}