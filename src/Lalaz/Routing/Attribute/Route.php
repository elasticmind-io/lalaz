<?php declare(strict_types=1);

namespace Lalaz\Routing\Attribute;

/**
 * Class Route
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
#[Attribute]
class Route
{
    private string $method = 'GET';
    private string $paht = '/';

    public function __contruct($method = 'GET', $path = '/')
    {
        $this->method = $method;
        $this->path = $path;
    }
}
