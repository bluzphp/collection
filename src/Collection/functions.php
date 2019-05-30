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
 * Simple functions of framework
 * be careful with this way
 *
 * @author   Anton Shevchuk
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
     * @param       $array
     * @param array ...$keys
     *
     * @return void
     */
    function array_add(array &$array, ...$keys)
    {
        Collection::add($array, ...$keys);
    }
}

if (!function_exists('array_set')) {
    /**
     * @param       $array
     * @param array ...$keys
     *
     * @return void
     */
    function array_set(array &$array, ...$keys)
    {
        Collection::set($array, ...$keys);
    }
}
