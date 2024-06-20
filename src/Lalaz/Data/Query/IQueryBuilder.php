<?php declare(strict_types=1);

namespace Lalaz\Data\Query;

/**
 * Interface IQueryBuilder
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
interface IQueryBuilder
{
    public function build(): string;
}
