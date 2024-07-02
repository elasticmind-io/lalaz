<?php declare(strict_types=1);

namespace Lalaz\Data;

/**
 * Class Model
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
abstract class Model
{
    public static function build($data = array())
    {
        $result = new static();

        foreach ($data as $key => $value) {
            if (property_exists($result, $key)) {
                $result->{$key} = $value;
            }
        }

        return $result;
    }

    public function hide(string ...$props): void
    {
        foreach ($props as $prop) {
            unset($this->{$prop});
        }
    }
}
