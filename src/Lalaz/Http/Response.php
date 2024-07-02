<?php declare(strict_types=1);

namespace Lalaz\Http;

use Lalaz\View\View;

/**
 * Class Response
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
class Response
{
    use FlashMessage;

    private $session;
    private $viewBag = array();

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    public function addViewBag(string $name, mixed $value): Response
    {
        $this->viewBag[$name] = $value;
        return $this;
    }

    public function addSession(string $key, mixed $value): Response
    {
        $_SESSION[$key] = $value;
        $this->session = $_SESSION;
        return $this;
    }

    public function destroySession(): Response
    {
        session_destroy();
        return $this;
    }

    public function addCookie(
        $key,
        $value,
        $expires,
        $path = "/",
        $domain = "",
        $secure = true,
        $httpOnly = true): Response
    {
        setcookie(
            $cookie_name,
            $cookie_value,
            $expires,
            $path,
            $domain,
            $secure,
            $httpOnly);

        return $this;
    }

    public function deleteCookie(string $key): Response
    {
        setcookie($key, '', time() - 3600);
        return $this;
    }

    function flash(
        string $name = '',
        string $message = '',
        string $type = ''): Response
    {
        if ($name !== '' && $message !== '' && $type !== '') {
            self::createFlashMessage($name, $message, $type);
        }

        return $this;
    }

    public function redirect(string $url): void
    {
        $host = $_SERVER['HTTP_HOST'];
        header("Location: ${url}");
        exit();
    }

    public function render(string $view, $params = []): void
    {
        $csrfToken = static::generateCsrfToken();
        $this->addSession('csrfToken', $csrfToken);

        $data = [
            ...$params,
            ...$this->viewBag,
            'csrfToken' => $csrfToken
        ];

        View::render($view, $data);
        exit();
    }

    public function json($data = [], $statusCode = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }

    public function end(): void
    {
        exit();
    }

    private static function generateCsrfToken()
    {
        return bin2hex(random_bytes(35));
    }
}
