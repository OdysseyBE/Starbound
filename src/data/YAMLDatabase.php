<?php

namespace src\data;

class YAMLDatabase
{
	private $serversConfig;
	private $apiKeysConfig;
	private $accountsConfig;

	private $servers;
	private $apiKeys;
	private $accounts;

	public function __construct()
	{
		$this->serversConfig = new Config("C:\Users\LENOVO\Desktop\SkyRealms\proxy\database\servers.yml");
		$this->apiKeysConfig = new Config("C:\Users\LENOVO\Desktop\SkyRealms\proxy\database\servers.yml");
		$this->accountsConfig = new Config("C:\Users\LENOVO\Desktop\SkyRealms\proxy\database\servers.yml");

		$this->loadServers();
		$this->loadApiKeys();
		$this->loadAccount();
	}

	public function loadServers(): array
	{
		if (!$this->serversConfig) return [];
		return $this->serversConfig->getAll();
	}
	public function loadApiKeys(): array
	{
		if (!$this->apiKeysConfig) return [];
		return $this->apiKeysConfig->getAll();
	}
	public function loadAccount(): array
	{
		if (!$this->accountsConfig) return [];
		return $this->accountsConfig->getAll();
	}

	public function saveServers(): void
	{
		if (!$this->serversConfig) return;
		$this->serversConfig->setAll($this->servers);
	}

	public function saveApiKeys(): void
	{
		if (!$this->serversConfig) return;
		$this->apiKeysConfig->setAll($this->apiKeys);
	}

	public function saveAccount(): void
	{
		if (!$this->serversConfig) return;
		$this->accountsConfig->setAll($this->accounts);
	}
}