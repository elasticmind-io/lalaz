<?php declare(strict_types=1);

namespace Lalaz\Http;

/**
 * Class Request
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
class Request
{
    private $method;
    private $headers;
    private $params;
    private $body;
    private $session;
    private $cookes;

    private static $methodsToValidateCsrfToken = ['POST', 'PUT', 'PATCH'];

    public function __construct($pathParams = [])
    {
        $this->initializeSession();
        $this->initializeBody();
        $this->initializeCookies();

        $routeAndGetParams = array_merge($pathParams, $_GET);

        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->params = $this->sanitize($routeAndGetParams);
    }

    public function method(): mixed
    {
        return $this->method;
    }

    public function params($name): mixed
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }

        return '';
    }

    public function body(): mixed
    {
        return $this->body;
    }

    public function cookie($name): mixed
    {
        return $this->cookies[$name];
    }

    public function session($name): mixed
    {
        return $this->session[$name];
    }

    public function validateCsrfToken(): void
    {
        if (!in_array($this->method(), static::$methodsToValidateCsrfToken)) {
            return;
        }

        if ($this->body()['csrfToken'] !== $this->session('csrfToken')) {
            die('Request token is not valid!');
        }
    }

    private function initializeBody(): void
    {
        if (!empty($_POST)) {
            $this->body = $this->sanitize($_POST);
            return;
        }

        $this->body = $this->sanitize(json_decode(file_get_contents('php://input')));
    }

    private function initializeSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->session = $_SESSION;
    }

    private function initializeCookies(): void
    {
        $this->cookies = $_COOKIE;
    }

    private function sanitize($data = array()): mixed
    {
        if (empty($data)) return [];
        return filter_var_array($data, FILTER_SANITIZE_STRING);
    }
}
