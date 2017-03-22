<?php
/**
 * @author Guillermo Gonzalez <matthieu@mnapoli.fr>
 *
 * @link    http://github.com/myclabs/php-enum
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace GuilleGF\PHPTools\Enum;

/**
 * Base Enum class
 *
 * Create an enum by implementing this class and adding class constants.
 */
abstract class Enum
{
    /**
     * Enum value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Store existing constants in a static cache per object.
     *
     * @var array
     */
    protected static $cache = array();

    /**
     * Creates a new value of some type
     *
     * @param mixed $value
     *
     * @throws \UnexpectedValueException if incompatible type is given.
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new \UnexpectedValueException("Value '$value' is not part of the enum " . get_called_class());
        }

        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Returns the enum key (i.e. the constant name).
     *
     * @return mixed
     */
    public function key()
    {
        return static::search($this->value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * Compares one Enum with another.
     *
     * @param Enum $enum
     *
     * @return bool True if Enums are equal, false if not equal
     */
    final public function equals(Enum $enum): bool
    {
        return $this->value() === $enum->value() && static::class === get_class($enum);
    }

    /**
     * Returns the names (keys) of all constants in the Enum class
     *
     * @return array
     */
    public static function keys(): array
    {
        return array_keys(static::toArray());
    }

    /**
     * Returns instances of the Enum class of all Enum constants
     *
     * @return static[] Constant name in key, Enum instance in value
     */
    public static function values(): array
    {
        $values = array();

        foreach (static::toArray() as $key => $value) {
            $values[$key] = new static($value);
        }

        return $values;
    }

    /**
     * Returns all possible values as an array
     *
     * @return array Constant name in key, constant value in value
     */
    public static function toArray(): array
    {
        $class = get_called_class();
        if (!array_key_exists($class, static::$cache)) {
            $reflection            = new \ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }

        return static::$cache[$class];
    }

    /**
     * Check if is valid enum value
     *
     * @param $value
     *
     * @return bool
     */
    public static function isValid($value): bool
    {
        return in_array($value, static::toArray(), true);
    }

    /**
     * Check if is valid enum key
     *
     * @param $key
     *
     * @return bool
     */
    public static function isValidKey($key): bool
    {
        $array = static::toArray();

        return isset($array[$key]);
    }

    /**
     * Return key for value
     *
     * @param $value
     *
     * @return mixed
     */
    public static function search($value)
    {
        return array_search($value, static::toArray(), true);
    }

    /**
     * Returns a value when called statically like so: MyEnum::SomeValue() given SOME_VALUE is a class constant
     * @example MyEnum::SomeValue()
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     * @throws \BadMethodCallException
     */
    public static function __callStatic($name, $arguments)
    {
        $key = self::toSnakeCase($name);
        $array = static::toArray();
        if (array_key_exists($key, $array)) {
            return new static($array[$key]);
        }

        throw new \BadMethodCallException("No static method or enum constant '$name' in class " . get_called_class());
    }


    /**
     * Check if a given key is selected using the "isKey" syntax.
     * @example $myEnum->isSomeValue()
     *
     * @param string $method
     * @param $arguments
     * @return bool
     */
    public function __call($method, $arguments): bool
    {
        if (substr($method, 0, 2) === 'is')  {
            $key = $this->toSnakeCase(substr($method, 2));
            $array = static::toArray();
            if (array_key_exists($key, $array)) {
                return $this->value() === $array[$key];
            }
        }

        throw new \BadMethodCallException(sprintf('The method "%s" is not defined.', $method));
    }

    /**
     * Convert a string to snake case.
     *
     * @param string $string
     * @return string
     */
    private static function toSnakeCase(string $string): string
    {
        return strtoupper(preg_replace(
            '/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/',
            '_',
            $string
        ));
    }
}