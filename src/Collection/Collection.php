<?php
/**
 * Bluz Framework Component
 *
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/framework
 */

declare(strict_types=1);

namespace Bluz\Collection;

use ArgumentCountError;
use InvalidArgumentException;

/**
 * Collection is array :)
 *
 * @package  Bluz\Collection
 * @author   Anton Shevchuk
 */
class Collection
{
    /**
     * Get an element of the array by key(s)
     *   this method created to avoid error `undefined index`
     *
     * <code>
     *   $arr = ['a' => [10, 20], 'b' => [30, 40]];
     *
     *   Collection::get($arr, 'a');    // [10, 20]
     *   Collection::get($arr, 'a', 0); // 10
     *   Collection::get($arr, 'a', 1); // 20
     *   Collection::get($arr, 'a', 3); // null
     *   Collection::get($arr, 'c');    // null
     *   Collection::get($arr, 'c', 0); // null
     *   Collection::get($arr, 'c', 1); // null
     * </code>
     *
     * @param array $array
     * @param array ...$keys
     *
     * @return mixed|null
     */
    public static function get(array $array, ...$keys)
    {
        $key = array_shift($keys);

        if (empty($keys)) {
            return $array[$key] ?? null;
        }

        if (!array_key_exists($key, $array) || !is_array($array[$key])) {
            return null;
        }

        return self::get($array[$key], ...$keys);
    }

    /**
     * Get an element of the array by key(s)
     *   this method created to avoid error `undefined index` with call `array_key_exists`
     *
     * <code>
     *   $arr = ['a' => ['a' => 1, 'b' => null]];
     *
     *   Collection::has($arr, 'a');           // true
     *   Collection::has($arr, 'a', 'a');      // true
     *   Collection::has($arr, 'a', 'b');      // true
     *   Collection::has($arr, 'a', 'c');      // false
     *   Collection::has($arr, 'a', 'c', 'c'); // false
     *
     *   // compare with isset
     *   isset($arr['a']['b'])                  // false
     *   // compare with array_key_exists
     *   array_key_exists('c', $arr['a']['c']); // undefined index
     * </code>
     *
     * @param array $array
     * @param array ...$keys
     *
     * @link https://php.net/manual/function.isset.php
     * @link https://php.net/manual/function.array-key-exists.php
     *
     * @return bool
     */
    public static function has(array $array, ...$keys): bool
    {
        $key = array_shift($keys);
        $exist = array_key_exists($key, $array);

        if (!$exist || empty($keys)) {
            return $exist;
        }

        if (!is_array($array[$key])) {
            return false;
        }

        return self::has($array[$key], ...$keys);
    }

    /**
     * Add an element to the array by key(s)
     *
     *
     * <code>
     *   $arr = ['a' => ['a' => 1, 'b' => null]];
     *
     *   Collection::add($arr, 'b', 1);           // $arr['b'][] = 1
     *   Collection::add($arr, 'b', 'a', 1);      // $arr['b']['a'] = 1
     *   Collection::add($arr, 'b', 'b', 'a', 1); // $arr['b']['b']['a'] = 1
     *
     *   // errors
     *   Collection::add($arr, 'a', 'b', 1); // $arr['a']['b'] already exists, and it is not an array
     * </code>
     *
     * @param array $array
     * @param mixed $key
     * @param array ...$values
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public static function add(array &$array, $key, ...$values): void
    {
        $countValues = count($values);

        if ($countValues === 0) {
            throw new ArgumentCountError(
                'Method `Collection::add()` expected three or more arguments'
            );
        }
        $value = array_pop($values);

        while (true) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = [];
            } elseif (!is_array($array[$key])) {
                throw new InvalidArgumentException(
                    '`Collection` can\'t change element with key `'.$key.'`, is not an array'
                );
            }
            if (count($values)) {
                $array = &$array[$key];
                $key = array_shift($values);
            } else {
                $array[$key][] = $value;
                return;
            }
        }
    }

    /**
     * Set an element of the array by key(s)
     *   this method is equal to native set value
     *
     * @param array $array
     * @param mixed $key
     * @param array ...$values
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public static function set(array &$array, $key, ...$values): void
    {
        if (count($values) === 0) {
            throw new ArgumentCountError(
                'Method `Collection::set()` expected three or more arguments'
            );
        }

        $value = array_pop($values);

        while (true) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = [];
            }
            if (count($values)) {
                $array = &$array[$key];
                $key = array_shift($values);
                if (!is_array($array)) {
                    throw new InvalidArgumentException(
                        '`Collection` can\'t change element with key `'.$key.'`, is not an array'
                    );
                }
            } else {
                $array[$key] = $value;
                return;
            }
        }
    }
}
