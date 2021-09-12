<?php

class Config {
	private $attributes;

	public function __construct() {
		$this->attributes = json_decode(file_get_contents(CONFIG_FILE_PATH), true);
	}

	public function get($key) {
		return $this->attributes[$key];
	}

	public function set($key, $value) {
		$this->attributes[$key] = $value;

		file_put_contents(CONFIG_FILE_PATH, json_encode($this->attributes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	}

	public function get_all() {
		return $this->attributes;
	}
}