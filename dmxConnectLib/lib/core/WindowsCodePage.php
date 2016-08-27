<?php

namespace lib\core;

class WindowsCodePage
{
	private $cp_code;
	private $cp_chars;
	private $utf8_chars;
	
	public function __construct($cp_code = '1252') {
		$cp_file = __DIR__ . '/codepages/' . $cp_code . '.php';
		
		if (!file_exists($cp_file)) {
			throw new \Exception('Codepage ' . $cp_code . ' not supported.');
		}
		
		include $cp_file;
		
		$this->cp_code = $cp_code;
		$this->cp_chars = array_map('chr', array_keys($codepage));
		$this->utf8_chars = array_map('utf8_chr', array_values($codepage));
	}
	
	public function encode($str) {
		return str_replace($this->utf8_chars, $this->cp_chars, $str);
	}
	
	public function decode($str) {
		return str_replace($this->cp_chars, $this->utf8_chars, $str);
	}
}