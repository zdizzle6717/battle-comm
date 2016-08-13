<?php

namespace lib\core;

class GenericCodePage
{
	private $encoding;
	
	public function __construct($encoding = 'UTF-8') {
		$this->encoding = $encoding;
	}
	
	public function encode($str) {
		if ($this->encoding == 'UTF-8') return $str;
		return self::convertEncoding($str, 'UTF-8', $this->encoding);
	}
	
	public function decode($str) {
		if ($this->encoding == 'UTF-8') return $str;
		return self::convertEncoding($str, $this->encoding, 'UTF-8');
	}
	
	private static function convertEncoding($str, $from, $to) {
		if (function_exists('mb_convert_encoding')) {
			$res = mb_convert_encoding($str, $to, $from);
			
			if (strpos($res, '\x00') !== FALSE) {
				throw new \Exception("Encoding conversion from $from to $to failed: non convertable characters found.");
			}
			
			return $res;
		} elseif (function_exists('iconv')) {
			try {
				$res = iconv($from, $to, $str);
			} catch (\Exception $e) {
				throw new \Exception("Encoding conversion from $from to $to failed: " . $e->getMessage());
			}
			
			if ($res === FALSE) {
				throw new \Exception("Encoding conversion from $from to $to failed.");
			}
			
			return $res;
		} else {
			if (preg_match('/[\x80-\xff]/', $str) === 1) {
				throw new \Exception("Cannot convert from $from to $to: both the iconv and the mbstring extensions are missing in the system.");
			}
			
			return $str;
		}
	}
}