<?php declare(strict_types=1);

namespace Lalaz\Logging;

use Lalaz\Lalaz;

/**
 * Interface Logger
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
final class Logger
{
    private $writers = array();

    public static function create(): Logger
    {
        return new Logger();
    }

    public function writeTo(ILoggerWriter $writer): Logger
    {
        $this->writers[] = $writer;
        return $this;
    }

    public function info($message): void
    {
        $this->write('INFO', $message);
    }

    public function debug($message): void
    {
        $this->write('DEBUG', $message);
    }

    public function error($error): void
    {
        $this->write('ERROR', $error);
    }

    private function write(string $level, string $message)
    {
        $now = date("Y-m-d H:i:s") ;
        $formattedMessage = "[$now] $level: $message";

        foreach ($this->writers as $writer) {
            $writer->write($formattedMessage);
        }
    }
}
