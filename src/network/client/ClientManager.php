<?php

namespace src\network\client;

class ClientManager
{
	private $clients = [];

	/**
	 * @return array
	 */
	public function getClients(): array
	{
		return $this->clients;
	}

	public function createNewClient(?array $data): void
	{
		if ($data !== null || $data !== []) {
			$client = new Client($data);
		}
	}

}