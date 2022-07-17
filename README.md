# Collection Component
## Achievements

[![PHP >= 8.0+](https://img.shields.io/packagist/php-v/bluzphp/collection.svg?style=flat)](https://php.net/)

[![Latest Stable Version](https://img.shields.io/packagist/v/bluzphp/collection.svg?label=version&style=flat)](https://packagist.org/packages/bluzphp/collection)

[![Build Status](https://img.shields.io/travis/bluzphp/collection/master.svg?style=flat)](https://travis-ci.org/bluzphp/collection)

[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/bluzphp/collection.svg?style=flat)](https://scrutinizer-ci.com/g/bluzphp/collection/)

[![Total Downloads](https://img.shields.io/packagist/dt/bluzphp/collection.svg?style=flat)](https://packagist.org/packages/bluzphp/collection)

[![License](https://img.shields.io/packagist/l/bluzphp/collection.svg?style=flat)](https://packagist.org/packages/bluzphp/collection)

## Usage

Example of array:
```php
$arr = [
    'a', 
    'b' => 'boo',
    'c' => [
        'c1',
        'c2',
        'c3'
    ],
    'd' => [
        'd1' => ['d1.1', 'd1.2'],
        'd2' => ['d2.1', 'd2.2'],
        'd3' => ['d3.1', 'd3.2'],
    ],
    'e' => null,
    'f' => false
];
```

### Check element by key(s) 

Usage:
```php
Collection::has(array $array, ...$keys);
array_has($array, ...$keys);
```

Examples:
```php
array_has($array, 0);         // true 
array_has($array, 'b');       // true
array_has($array, 'c', 0);    // true
array_has($array, 'd', 'd1'); // true
array_has($array, 'e');       // true
array_has($array, 'f');       // true
array_has($array, 'g');       // false
```

Compare to `isset()`:
```php
isset($array['e']); // false
```

### Get element by key(s) 

Usage:
```php
Collection::get(array $array, ...$keys);
array_get(array $array, ...$keys);
```

Examples:
```php
array_get($array, 0);         // 'a' 
array_get($array, 'b');       // 'boo'
array_get($array, 'c', 0);    // 'c1'
array_get($array, 'd', 'd1'); // ['d1.1', 'd1.2']
array_get($array, 'e');       // null
array_get($array, 'e', 'e');  // null
```

### Add element to the array by key(s) 

Usage:
```php
Collection::add(array &$array, $key, ...$values);
array_add(array &$array, $key, ...$values);
```

Examples:
```php
array_add($array, 'c', 'c3');           // $array['c'][] = 'c3'
array_add($array, 'd', 'd1', 'd1.3');   // $array['d']['d1'][] = 'd1.3'
array_add($array, 'g', 'g1', 'g1.1');   // $array['g']['g1'][] = 'g1.1'

// but
array_add($array, 'b', 'b1');           // InvalidArgumentException - $array['b'] is not an array
```

### Set element of the array by key(s)

This method is similar to native way.

Usage:
```php
Collection::set(array &$array, $key, ...$values);
array_set(array &$array, $key, ...$values);
```

Examples:
```php
array_set($array, 'g', 'game over');       // $array['g'] = 'game over';
array_set($array, 'h', 'high way', 'e95'); // $array['h']['high way'] = 'e95';
```
