<?php declare(strict_types=1);

namespace Lalaz\Http;

/**
 * trait FlashMessage
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
trait FlashMessage
{
    public const FLASH = 'FLASH_MESSAGES';
    public const FLASH_ERROR = 'error';
    public const FLASH_WARNING = 'warning';
    public const FLASH_INFO = 'info';
    public const FLASH_SUCCESS = 'success';

    function createFlashMessage(string $name, string $message, string $type): void
    {
        if (isset($_SESSION[self::FLASH][$name])) {
            unset($_SESSION[self::FLASH][$name]);
        }

        $_SESSION[self::FLASH][$name] = ['message' => $message, 'type' => $type];
    }

    static function showFlashMessage(string $name): mixed
    {
        if (!isset($_SESSION[self::FLASH][$name])) {
            return false;
        }

        $flash_message = $_SESSION[self::FLASH][$name];

        unset($_SESSION[self::FLASH][$name]);

        return $flash_message;
    }
}
