<?php

/**
 * Bluz Framework Component
 *
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/framework
 */

declare(strict_types=1);

use Bluz\Collection\Collection;

/**
 * Functions for Collection component
 */
if (!function_exists('array_get')) {
    /**
     * Get value of array by keys
     *
     * @param array $array
     * @param array $keys
     *
     * @return mixed|null
     */
    function array_get(array $array, ...$keys): mixed
    {
        return Collection::get($array, ...$keys);
    }
}

if (!function_exists('array_has')) {
    /**
     * @param array $array
     * @param array $keys
     *
     * @return bool
     */
    function array_has(array $array, ...$keys): bool
    {
        return Collection::has($array, ...$keys);
    }
}

if (!function_exists('array_add')) {
    /**
     * @param array $array
     * @param mixed $key
     * @param array $values
     *
     * @return void
     */
    function array_add(array &$array, mixed $key, ...$values): void
    {
        Collection::add($array, $key, ...$values);
    }
}

if (!function_exists('array_set')) {
    /**
     * @param array $array
     * @param mixed $key
     * @param array $values
     *
     * @return void
     */
    function array_set(array &$array, mixed $key, ...$values): void
    {
        Collection::set($array, $key, ...$values);
    }
}
