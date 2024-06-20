<?php declare(strict_types=1);

namespace Lalaz\Data\Query;
/**
 * Class QueyrBuilder
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
final class Queries
{
    public static function select(string ...$select): SelectQueryBuilder
    {
        return new SelectQueryBuilder($select);
    }
}
