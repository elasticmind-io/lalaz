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
    private $headers;
    private $params;
    private $body;
    private $session;

    public function __construct($pathParams = [])
    {
        $this->initializeSession();
        $this->initializeBody();

        $routeAndGetParams = array_merge($pathParams, $_GET);

        $this->params = $this->sanitize($routeAndGetParams);
        $this->session = $_SESSION;
    }

    public function params($name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }

        return '';
    }

    public function body()
    {
        return $this->body;
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
    }

    private function sanitize($data = array()): mixed
    {
        if (empty($data)) return [];
        return filter_var_array($data, FILTER_SANITIZE_STRING);
    }
}
