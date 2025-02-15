<?php

namespace src\network;

use JetBrains\PhpStorm\NoReturn;

class Network
{
	/**
	 * @var resource|\Socket|null
	 */
	private ?\Socket $socket = null;

	#[NoReturn]
	public function __construct()
	{
		$this->initializeSocket();
	}

	#[NoReturn]
	private function initializeSocket(): void
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if (!$this->socket) {
			die("Can't create socket: " . socket_strerror(socket_last_error()) . "\n");
		}

		socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);

		if (!socket_bind($this->socket, SERVER_HOST, SERVER_PORT)) {
			die("Can't bind IP & port: " . socket_strerror(socket_last_error()) . "\n");
		}

		socket_listen($this->socket);
		socket_set_nonblock($this->socket);

		echo " Server started IP:" . SERVER_HOST . " Port: " . SERVER_PORT . "\n";

		$this->run();
	}

	private function run(): void
	{
		while (true) {
			$this->acceptClients();
			usleep(100000);
		}
	}

	private function acceptClients(): void
	{
		$clientSocket = @socket_accept($this->socket);
		if ($clientSocket) {
			socket_getpeername($clientSocket, $clientIp, $clientPort);
			echo "client connected: IP: $clientIp Port: $clientPort\n";
			socket_set_nonblock($clientSocket);

			// client connect
		}
	}

	public function __destruct()
	{
		if ($this->socket) {
			socket_close($this->socket);
		}
		echo "Socket shutdown.\n";
	}
}
