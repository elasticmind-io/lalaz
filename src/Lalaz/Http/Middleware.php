<?php declare(strict_types=1);

namespace Lalaz\Http;

/**
 * Class Middleware
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
abstract class Middleware
{
    public abstract function handle(Request $req, Response $res): void;
}
