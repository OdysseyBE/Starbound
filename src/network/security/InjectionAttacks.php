<?php

namespace src\network\security;

class InjectionAttacks
{

	public function sanitizeSQL(string $input): string
	{
		return addslashes(htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8'));
	}

	public function sanitizeXSS(string $input): string
	{
		return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
	}

	public function isMalicious(string $input): bool
	{
		$patterns = [
			'/(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b)/i',
			'/<script\b[^>]*>(.*?)<\/script>/i',
			'/(javascript:|vbscript:|data:)/i'
		];

		foreach ($patterns as $pattern) {
			if (preg_match($pattern, $input)) {
				return true;
			}
		}

		return false;
	}
}