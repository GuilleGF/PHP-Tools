<?php

namespace GuilleGF\PHPTools\Tests\Collection;

use GuilleGF\PHPTools\Collection\EntityCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class BaseEntityCollectionTest
 * @package GuilleGF\PHPTools\Tests\Collection
 */
abstract class BaseEntityCollectionTest extends TestCase
{
    /**
     * @param array $elements
     * @return EntityCollection
     */
    abstract protected function buildCollection(array $elements);

    /**
     * @return array
     */
    abstract public function provideDifferentElements();

    /**
     * @test
     * @expectedException \LengthException
     * @expectedExceptionMessage Collection can not be empty
     */
    public function emptyConstruct()
    {
        $this->buildCollection([]);
    }

    /**
     * @test
     * @expectedException \UnexpectedValueException
     */
    public function invalidElementConstruct()
    {
        $this->buildCollection([new \stdClass()]);
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function toArray($elements)
    {
        $collection = $this->buildCollection($elements);

        $this->assertSame($elements, $collection->toArray());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function first($elements)
    {
        $collection = $this->buildCollection($elements);
        $this->assertSame(reset($elements), $collection->first());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function last($elements)
    {
        $collection = $this->buildCollection($elements);
        $this->assertSame(end($elements), $collection->last());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function key($elements)
    {
        $collection = $this->buildCollection($elements);

        $this->assertSame(key($elements), $collection->key());

        next($elements);
        $collection->next();

        $this->assertSame(key($elements), $collection->key());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function next($elements)
    {
        $collection = $this->buildCollection($elements);

        while (true) {
            $collectionNext = $collection->next();
            $arrayNext = next($elements);

            if (!$collectionNext || !$arrayNext) {
                break;
            }

            $this->assertSame($arrayNext, $collectionNext, 'Returned value of ArrayCollection::next() and next() not match');
            $this->assertSame(key($elements), $collection->key(), 'Keys not match');
            $this->assertSame(current($elements), $collection->current(), 'Current values not match');
        }
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function current($elements)
    {
        $collection = $this->buildCollection($elements);

        $this->assertSame(current($elements), $collection->current());

        next($elements);
        $collection->next();

        $this->assertSame(current($elements), $collection->current());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function getKeys($elements)
    {
        $collection = $this->buildCollection($elements);

        $this->assertSame(array_keys($elements), $collection->keys());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function getValues($elements)
    {
        $collection = $this->buildCollection($elements);

        $this->assertSame(array_values($elements), $collection->values());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function countElements($elements)
    {
        $collection = $this->buildCollection($elements);

        $this->assertSame(count($elements), $collection->count());
    }

    /**
     * @test
     * @dataProvider provideDifferentElements
     */
    public function iterator($elements)
    {
        $collection = $this->buildCollection($elements);

        $iterations = 0;
        foreach ($collection as $key => $item) {
            $this->assertSame($elements[$key], $item, "Item {$key} not match");
            ++$iterations;
        }

        $this->assertEquals(count($elements), $iterations, 'Number of iterations not match');
    }
}
