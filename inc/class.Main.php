<?php

/**
* Main
*/
class Main
{
	const DEFAULT_PATH 		= "..";
	private static $path 	= self::DEFAULT_PATH;
	private static $files 	= [];
	private static $tree 	= [];

	public static function init() {
		$current = self::checkUri();

		self::render("index", [
			"path" 		=> self::$path,
			"files" 	=> self::$files,
			"tree" 		=> self::$tree,
			"bread" 	=> self::getBread(),
			"breadkeys" => array_keys(self::getBread()),
			"current" 	=> $current,
			"extension" => self::getExtension(),
		]);
	}

	public static function checkUri() {
		$path = preg_replace("/\/h5ai/", "", $_SERVER['REQUEST_URI'], 1);
		if (!is_file(self::DEFAULT_PATH . $path)) {
			self::getFiles();
			self::getTree();
			return 0;
		} else {
			return self::getFile(self::DEFAULT_PATH . $path);
		}
	}

	public static function getBread() {
		$path = preg_replace("/\/h5ai\//", "", $_SERVER['REQUEST_URI'], 1);
		if (!$path) {
			return [];
		}
		$bread = explode("/", $path);
		$new = [];

		foreach ($bread as $key => $value) {
			$new[substr($path, 0, strpos($path, $value) + strlen($value))] = $value;
		}




		// foreach ($bread as $key => $value) {
		// 	if (!isset($bread[$key-1])) {
		// 		$new[$value] = $value;
		// 	} else {
		// 		$new[$bread[$key-1] . "/" . $value] = $value;
		// 	}
		// }
		return $new;
	}

	public static function getFiles() {
		self::$path .= preg_replace("/\/h5ai/", "", $_SERVER['REQUEST_URI'], 1);
		self::$path = strlen(self::$path) > 1 ? self::$path : self::DEFAULT_PATH;
		if (!is_dir(self::$path) && !is_file(self::$path)) {
			return;
		}
		$files = scandir(self::$path);
		foreach ($files as $key => $value) {
			if (is_dir(self::$path . "/" . $value)) {
				self::$files[$value] = 1; 
			} else {
				self::$files[$value] = 0;
			}
		}
		ksort(self::$files);
	}

	public static function getFile($file) {
		return htmlentities(file_get_contents($file));
	}

	public static function getTree($folder = "../Twitter") {
		static $files = [];
		if ($handle = opendir($folder)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && $entry != ".git") {
					if (is_dir($folder ."/". $entry)) {
						self::getTree($folder."/".$entry);
					} else {
						$files[] = $folder . "/" .$entry;
					}
				}
			}
			foreach ($files as $value) {
				if (!is_dir($value)) {
					$result[] = $value;
				}
			}
			closedir($handle);
			self::$tree = array_unique(array_merge($result));
		}
		return 0;
	}

	public static function render($file = "index", $vars = null) {
		extract($vars);
		// var_dump($vars);
		// die;
		require_once "./views/" . $file . ".php";
	}

	public static function getExtension() {
		$path = preg_replace("/\/h5ai/", "", $_SERVER['REQUEST_URI'], 1);
		$path = explode(".", $path);
		return end($path);
	}
}