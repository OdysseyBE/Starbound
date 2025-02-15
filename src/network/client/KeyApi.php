<?php

namespace src\network\client;

class KeyApi
{
	private ?string $key;
	private ?array $data;
	public function __construct(?string $key = null)
	{
		if ($key !== null) {
			$this->key = $key;
		}
	}

	/**
	 * @return string|null
	 */
	public function getKey(): ?string
	{
		return $this->key;
	}

	public function generateApiKey() {}

	public function getKeyData() {}

	public function keyIsAvailable() {}
}