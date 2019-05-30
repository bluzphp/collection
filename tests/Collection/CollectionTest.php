<?php
/**
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/framework
 */

namespace Bluz\Tests\Collection;

use Bluz\Collection\Collection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Collection helpers
 *
 * @package  Bluz\Tests\Common
 *
 * @author   Anton Shevchuk
 * @created  21.04.17 12:36
 */
final class CollectionTest extends TestCase
{
    /**
     * @var array
     */
    protected $array;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->array = [
            'hello' => [
                'world',
                'country' => ['Ukraine' => 1, 'Sweden' => 2]
            ],
            'foo' => 'bar',
            1 => 2,
            2 => [1, 2, 3],
            3 => [1, 2, 3 => ['a', 'b', 'c']]
        ];
    }

    /**
     * @return array
     */
    public function dataForCorrectCheck(): array
    {
        return [
            ['hello'],
            ['hello', 'country'],
            ['hello', 'country', 'Ukraine'],
            [1],
            [2],
            [3],
            [3, 3],
        ];
    }

    /**
     * @return array
     */
    public function dataForIncorrectCheck(): array
    {
        return [
            ['hi'],
            ['hello', 'city'],
            ['hello', 'country', 'Russia'],
            ['foo', 'bar'],
            [3, 2],
            [4],
        ];
    }

    /**
     * Test has class
     *
     * @dataProvider dataForCorrectCheck
     *
     * @param array $keys
     */
    public function testHasReturnTrue(...$keys)
    {
        self::assertTrue(Collection::has($this->array, ...$keys));
    }

    /**
     * Test has class
     *
     * @dataProvider dataForIncorrectCheck
     *
     * @param array $keys
     */
    public function testHasReturnFalse(...$keys)
    {
        self::assertFalse(Collection::has($this->array, ...$keys));
    }

    /**
     * Test Get method for return values
     */
    public function testGetValue()
    {
        self::assertEquals(1, Collection::get($this->array, 'hello', 'country', 'Ukraine'));
        self::assertEquals(2, Collection::get($this->array, 1));
        self::assertEquals(3, Collection::get($this->array, 2, 2));
    }

    /**
     * @dataProvider dataForIncorrectCheck
     *
     * @param array $keys
     */
    public function testGetNul(...$keys)
    {
        self::assertNull(Collection::get($this->array, ...$keys));
    }

    /**
     * Test Add method for return values
     */
    public function testAddValue()
    {
        Collection::add($this->array, 'hello', 'city', 'Kyiv');
        Collection::add($this->array, 'hello', 'city', 'Kharkiv');
        Collection::add($this->array, 2, 4);
        Collection::add($this->array, 3, 'd');

        self::assertCount(2, Collection::get($this->array, 'hello', 'city'));
        self::assertCount(4, Collection::get($this->array, 2));
        self::assertCount(3, Collection::get($this->array, 3, 3));
    }

    public function testAddWithoutArguments()
    {
        $this->expectException(InvalidArgumentException::class);
        Collection::add($this->array);
    }

    public function testAddWithoutValue()
    {
        $this->expectException(InvalidArgumentException::class);
        Collection::add($this->array, 'hello');
    }

    /**
     * Test for helper function array_set
     */
    public function testArrayAddFunction()
    {
        array_add($this->array, 'ukraine', 'city', 'Kyiv');
        array_add($this->array, 'ukraine', 'city', 'Kharkiv');

        self::assertCount(2, $this->array['ukraine']['city']);
    }

    /**
     * Test Set method for return values
     */
    public function testSetValue()
    {
        Collection::set($this->array, 'hello', 'city', 'Kharkiv', 'point');
        Collection::set($this->array, 'hello', 'country', 'Ukraine', 'Kyiv');
        Collection::set($this->array, 1, 0);
        Collection::set($this->array, 2, [42]);

        self::assertEquals('point', Collection::get($this->array, 'hello', 'city', 'Kharkiv'));
        self::assertEquals('Kyiv', Collection::get($this->array, 'hello', 'country', 'Ukraine'));
        self::assertEquals(0, Collection::get($this->array, 1));
        self::assertEquals(42, Collection::get($this->array, 2, 0));
    }

    public function testSetWithoutArguments()
    {
        $this->expectException(InvalidArgumentException::class);
        Collection::set($this->array);
    }

    public function testSetWithoutValue()
    {
        $this->expectException(InvalidArgumentException::class);
        Collection::set($this->array, 'hello');
    }

    /**
     * Test for helper function array_set
     */
    public function testArraySetFunction()
    {
        array_set($this->array, 'hello', 'country', 'Ukraine', 'Kyiv', 'Yes!');

        self::assertTrue(isset($this->array['hello']['country']['Ukraine']['Kyiv']));
    }

    /**
     * Test for helper function array_has
     */
    public function testArrayHasFunction()
    {
        self::assertTrue(array_has($this->array, 'hello', 'country', 'Ukraine'));
    }

    /**
     * Test for helper function array_get
     */
    public function testArrayGetFunction()
    {
        self::assertEquals(1, array_get($this->array, 'hello', 'country', 'Ukraine'));
    }
}
