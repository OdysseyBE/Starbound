<?php

namespace src\data;

use Symfony\Component\Yaml\Yaml;

class Config
{
	private string $file;
	private array $data;
	private string $format;

	public function __construct(string $file, string $format = "yaml")
	{
		$this->file = $file;
		$this->format = strtolower($format);

		if (!file_exists($file)) {
			$this->data = [];
			$this->save();
		} else {
			$this->load();
		}
	}

	private function load(): void
	{
		$content = file_get_contents($this->file);
		if ($this->format === "json") {
			$this->data = json_decode($content, true) ?? [];
		} elseif ($this->format === "yaml") {
			$this->data = Yaml::parse($content) ?? [];
		}
	}

	public function save(): void
	{
		$content = ($this->format === "json")
			? json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
			: Yaml::dump($this->data, 4, 2);

		file_put_contents($this->file, $content);
	}

	public function get(string $key, $default = null)
	{
		$keys = explode('.', $key);
		$value = $this->data;

		foreach ($keys as $k) {
			if (!isset($value[$k])) return $default;
			$value = $value[$k];
		}

		return $value;
	}

	public function set(string $key, $value): void
	{
		$keys = explode('.', $key);
		$data = &$this->data;

		foreach ($keys as $k) {
			if (!isset($data[$k]) || !is_array($data[$k])) {
				$data[$k] = [];
			}
			$data = &$data[$k];
		}

		$data = $value;
		$this->save();
	}

	public function exists(string $key): bool
	{
		$keys = explode('.', $key);
		$value = $this->data;

		foreach ($keys as $k) {
			if (!isset($value[$k])) return false;
			$value = $value[$k];
		}

		return true;
	}

	public function remove(string $key): void
	{
		$keys = explode('.', $key);
		$data = &$this->data;

		foreach ($keys as $k) {
			if (!isset($data[$k])) return;
			$data = &$data[$k];
		}

		unset($data);
		$this->save();
	}

	public function getAll(): array
	{
		return $this->data;
	}

	public function setAll(array $data): void
	{
		$this->data = $data;
		$this->save();
	}
}
