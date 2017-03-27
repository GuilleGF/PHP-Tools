<?php

namespace GuilleGF\PHPTools\Collection;

/**
 * An ArrayCollection is a Collection implementation that wraps a regular PHP array.
 *
 * Warning: Using (un-)serialize() on a collection is not a supported use-case
 * and may break when we change the internals in the future. If you need to
 * serialize a collection use {@link toArray()} and reconstruct the collection
 * manually.
 *
 * @author Guillermo Gonzalez <guillermogf@gmail.com>
 */
abstract class Collection implements \Countable, \Iterator, \ArrayAccess
{
    /** @var array */
    private $elements;

    /**
     * Collection constructor.
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        if (empty($elements)) {
            throw new \InvalidArgumentException('Collection can not be empty');
        }

        foreach ($this->elements as $element) {
            $this->add($element);
        }
    }

    /**
     * @param $element
     */
    public function add($element)
    {
        if (!$this->isValid($element)) {
            throw new \UnexpectedValueException('Element is invalid');
        }

        $this->elements[] = $element;
    }

    /**
     * @param $key
     * @param $element
     */
    public function set($key, $element)
    {
        if (!$this->isValid($element)) {
            throw new \UnexpectedValueException('Element is invalid');
        }

        $this->elements[$key] = $element;
    }

    /**
     * @param $element
     * @return bool
     */
    public function isValid($element): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * @return array
     */
    public function keys()
    {
        return array_keys($this->elements);
    }

    /**
     * @return array
     */
    public function values()
    {
        return array_values($this->elements);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->elements);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->elements);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->elements);
    }

    public function next()
    {
        next($this->elements);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return key($this->elements) !== null;
    }

    public function rewind()
    {
        reset($this->elements);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->elements[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->elements[$offset]) ? $this->elements[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (!isset($offset)) {
            $this->add($value);
        }

        $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->elements[$offset]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->elements);
    }
}
