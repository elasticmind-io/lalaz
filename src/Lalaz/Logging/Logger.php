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


    public function writeTo(ILoggerWriter $writer): void
    {
        $this->writers[] = $writer;
    }

    public function info($message): void
    {
        $this->write($message);
    }

    public function debug($message): void
    {
        $this->write($message);
    }

    public function error($error): void
    {
        $this->write($error);
    }

    private function write(string $message)
    {
        foreach ($this->writers as $writer) {
            $writer->write($message);
        }
    }
}
