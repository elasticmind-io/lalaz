<?php declare(strict_types=1);

namespace Lalaz\Data\Query;

/**
 * Class Expressions
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
final class Expressions
{
    public static function create(): Expr
    {
        return new Expr();
    }
}
