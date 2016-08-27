<?php

/*
	Special FileSystem class
	required for the differences between windows, linux and osx
	also making filesystem utf-8 aware
	TODO: encode and decode will only work on windows servers with a western europe charset, also charset on linux should be checked but are in most cases utf-8. windows should support multiple code pages (http://www.icosaedro.it/phplint/phplint2/libraries.htm - it\icosaedro\io\FileName, it\icosaedro\io\codepage\WindowsCodePage)
*/

namespace lib\core;

class FileSystem
{
	public static $codepage = NULL;

	private function __construct() {}

	public static function getEncoding() {
		if (self::$codepage === NULL) {
			$ctype = setlocale(LC_CTYPE, 0);

			if ($ctype !== NULL) {
				$dot = strpos($ctype, '.');

				if ($dot !== FALSE) {
					$codeset = substr($ctype, $dot + 1);
					$at = strpos($codeset, '@');

					if ($at !== FALSE) {
						$codeset = substr($codeset, 0, $at);
					}

					//try {
						if (self::isWindows()) {
							self::$codepage = new WindowsCodePage($codeset);
						} else {
							self::$codepage = new GenericCodePage($codeset);
						}
					//} catch (\Exception $e) {
					//	self::$codepage = new GenericCodePage();
					//}
				}
			}

			if (self::$codepage === NULL) {
				self::$codepage = new GenericCodePage();
			}
		}

		return self::$codepage;
	}

	public static function isWindows() {
		return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
	}

	public static function encode($path) {
		$codepage = self::getEncoding();

		try {
			return $codepage->encode($path);
		} catch (\Exception $e) {}

		if (self::isWindows()) {
			// convert from UTF-8 to ISO-8859-1
			//$path = utf8_decode($path);
		}

		return $path;
	}

	public static function decode($path) {
		$codepage = self::getEncoding();

		try {
			return $codepage->decode($path);
		} catch (\Exception $e) {}

		if (self::isWindows()) {
			// convert from ISO-8859-1 to UTF-8
			//$path = utf8_encode($path);
		}

		return $path;
	}

	public static function chmod($path) {
		return chmod(self::encode($path));
	}

	public static function copy($source, $dest, $overwrite = FALSE) {
		$source = self::encode($source);
		$dest = self::encode($dest);

		if (self::exists($dest)) {
			if (!$overwrite) {
				throw new \Exception('Destination file already exists.');
			}

			self::unlink($dest);
		}

		return copy($source, $dest);
	}

	public static function exists($path) {
		return file_exists(self::encode($path));
	}

	public static function isdir($path) {
		return is_dir(self::encode($path));
	}

	public static function isfile($path) {
		return is_file(self::encode($path));
	}

	public static function mkdir($path, $mode = 0777, $recursive = FALSE) {
		return mkdir(self::encode($path), $mode, $recursive);
	}

	public static function readdir($path) {
		$entries = array();

		if ($handle = opendir(self::encode($path))) {
			while (($entry = readdir($handle)) !== FALSE) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}

				if (strpos($entry, '?') !== FALSE) {
					//throw new \Exception('entry ' . $entry . ' contains invalid characters.');
					continue;
				}

				$entries[] = self::decode($entry);
			}

			closedir($handle);
		}

		return $entries;
	}

	public static function readfile($path) {
		return file_get_contents(self::encode($path));
	}

	public static function readjson($path) {
		return json_decode(self::readfile($path));
	}

	public static function realpath($path) {
		return self::decode(realpath(self::encode($path)));
	}

	public static function rename($oldPath, $newPath, $overwrite = FALSE) {
		$oldPath = self::encode($oldPath);
		$newPath = self::encode($newPath);

		if (self::exists($newPath)) {
			if (!$overwrite) {
				throw new \Exception('Destination file already exists.');
			}

			self::unlink($newPath);
		}

		return rename($oldPath, $newPath);
	}

	public static function rmdir($path) {
		return rmdir(self::encode($path));
	}

	public static function stat($path) {
		$encoded_path = self::encode($path);

		$stat = stat($encoded_path);

		if (!$stat) {
			throw new \Exception('stat() call failed.');
		}

		return array(
			'name' => substr($path, strrpos(str_replace('\\', '/', $path), '/') + 1),
			'path' => Path::toAppPath($path),
			'url' => Path::toSiteUrl($path),
			'type' => filetype($encoded_path),
			'size' => $stat['size'],
			'created'  => gmdate('Y-m-d\TH:i:s\Z', $stat['ctime']),
			'accessed' => gmdate('Y-m-d\TH:i:s\Z', $stat['atime']),
			'modified' => gmdate('Y-m-d\TH:i:s\Z', $stat['mtime'])
		);
	}

	public static function unlink($path) {
		return unlink(self::encode($path));
	}

	public static function move_uploaded_file($tmp, $path) {
		$tmp = self::encode($tmp);
		$path = self::encode($path);

		return move_uploaded_file($tmp, $path);
	}
}
