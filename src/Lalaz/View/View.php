<?php declare(strict_types=1);

namespace Lalaz\View;

use Lalaz\Lalaz;
use Lalaz\Http\FlashMessage;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Class View
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
class View
{
    use FlashMessage;

	public static function render($view, $data = array()): void
    {
		$loader = new FilesystemLoader(Lalaz::$rootDir . '/Views');
		$twig = new Environment($loader);

        $showFlashMessage = new \Twig\TwigFunction('showFlashMessage', function(string $name) {
            return self::showFlashMessage($name);
        });

        $twig->addFunction($showFlashMessage);

		$viewWithExtension = $view . '.twig';

		header('Content-Type: text/html');
        http_response_code(200);
		echo $twig->render($viewWithExtension, $data);
	}

	public static function renderNotFound($data = array()): void
    {
		static::render('errors/404', $data);
	}

	public static function renderError($data = array()): void
    {
		static::render('errors/500', $data);
	}
}
