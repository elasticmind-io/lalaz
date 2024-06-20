<?php declare(strict_types=1);

namespace Lalaz\Http;

/**
 * Class Controller
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
abstract class Controller
{
    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return void
     */
    public function callAction($method, $parameters): void
    {
        $this->{$method}(...array_values($parameters));
    }
}
