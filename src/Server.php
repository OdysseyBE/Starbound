<?php

namespace src;

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . "/../config.php";

require_once __DIR__ . "/../vendor/autoload.php";

class Server
{
	private static ?Server $instance;
	private string $path;

	#[NoReturn] public function __construct()
	{
		self::$instance = $this;
		$this->path = dirname(__FILE__, 2) . "/";

	}

	public static function getInstance(): Server
	{
		return self::$instance;
	}

	public function getPath(): string
	{
		return $this->path;
	}
}