# Collection Component

## Usage

Array example:
```php
// Example of array
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
];
```

### Get element by key(s) 

```php
Collection(array $array, ...$keys);
```

Examples:
```php
Collection::get($array, 0);         // 'a' 
Collection::get($array, 'b');       // 'boo'
Collection::get($array, 'c', 0);    // 'c1'
Collection::get($array, 'd', 'd1'); // ['d1.1', 'd1.2']
Collection::get($array, 'e');       // null
Collection::get($array, 'e', 'e');  // null
```

