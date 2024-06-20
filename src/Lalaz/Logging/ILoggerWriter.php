<?php declare(strict_types=1);

namespace Lalaz\Logging;

use Lalaz\Lalaz;

/**
 * Interface ILoggerWriter
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
interface ILoggerWriter
{
    public function write(string $message): void;
}
