<?php
namespace HttpRouter\Domain;

class Router {

	protected $requestUri;
	protected $routes;

	const GET_PARAMS_DELIMITER = '?';
	const PARAMETER_PATTERN = '/{([^\/]+)}/';
	const PARAMETER_REPLACEMENT = '(?<\1>[^/]+)';

	public function __construct()
	{
		$this->routes = [];
	}

	public function setUri(string $requestUri): void
	{
		if (strpos($requestUri, self::GET_PARAMS_DELIMITER))
		{
			$requestUri = strstr($requestUri, self::GET_PARAMS_DELIMITER, true);
		}
		$this->requestUri = $requestUri;
	}

	public function add(string $uri): void
	{
		array_push($this->routes,$uri);
	}

	public function check(): bool
	{
		$requestUri = $this->getUriPattern();

		foreach ($this->routes as $route)
		{
			if (preg_match($requestUri, $route))
			{
				return true;
			}
		}

		return false;
	}

	public function getUriPattern(): string
	{
		$regexUri = preg_replace(self::PARAMETER_PATTERN, self::PARAMETER_REPLACEMENT, $this->requestUri);
		$regexUri = str_replace('/', '\/', $regexUri);
		$regexUri = '/^' . $regexUri . '\/*$/s';
		return $regexUri;
	}

	
}
