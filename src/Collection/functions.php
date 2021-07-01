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
     * @param       $array
     * @param array ...$keys
     *
     * @return mixed|null
     */
    function array_get(array $array, ...$keys)
    {
        return Collection::get($array, ...$keys);
    }
}

if (!function_exists('array_has')) {
    /**
     * @param       $array
     * @param array ...$keys
     *
     * @return bool
     */
    function array_has(array $array, ...$keys)
    {
        return Collection::has($array, ...$keys);
    }
}

if (!function_exists('array_add')) {
    /**
     * @param array $array
     * @param mixed $key
     * @param array ...$values
     *
     * @return void
     */
    function array_add(array &$array, $key, ...$values)
    {
        Collection::add($array, $key, ...$values);
    }
}

if (!function_exists('array_set')) {
    /**
     * @param array $array
     * @param mixed $key
     * @param array ...$values
     *
     * @return void
     */
    function array_set(array &$array, $key, ...$values)
    {
        Collection::set($array, $key, ...$values);
    }
}
