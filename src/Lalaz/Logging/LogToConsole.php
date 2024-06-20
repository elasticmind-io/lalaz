<?php declare(strict_types=1);

namespace Lalaz\Logging;

use Lalaz\Lalaz;

/**
 * Interface LogToConsole
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
final class LogToConsole implements ILoggerWriter
{
    public function write(string $message): void
    {
        $out = fopen('php://stdin', 'w');
        fputs($out, "$message\n");
        fclose($out);
    }
}
