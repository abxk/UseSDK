<?php

declare(strict_types=1);

namespace abxk\traits;

use abxk\helper\Str;
use ReflectionClass;
use ReflectionException;

trait Arrayable
{
    /**
     * toArray.
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        $result = [];

        foreach ((new ReflectionClass($this))->getProperties() as $item) {
            $k = $item->getName();
            $method = 'get'.Str::studly($k);

            $result[Str::snake($k)] = method_exists($this, $method) ? $this->{$method}() : $this->{$k};
        }

        return $result;
    }
}
