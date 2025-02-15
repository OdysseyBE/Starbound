<?php

namespace src\network\client;

class Client
{
	private array $client;

	public function __construct(?array $data)
	{
		$this->client = [
			"api_key" => $data["api_key"],
			"server_name" => $data["api_key"],
			"server_type" => $data["server_type"],
			"client_ip" => $data["api_key"],
			"client_port" => $data["api_key"],
		];
		$this->analyseApikey();
	}

	/**
	 * @return array
	 */
	public function getClient(): array
	{
		return $this->client;
	}

	public function getApiKey() {}
	public function getServerName() {}
	public function getServerType() {}
	public function getClientIp() {}
	public function getClientPort() {}
	public function analyseApiKey() {}
	public function kickClient() {}
	public function sendRespond() {}
	public function removeClient() {}


}