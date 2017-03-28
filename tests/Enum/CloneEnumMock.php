<?php
/**
 * @link    http://github.com/myclabs/php-enum
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace GuilleGF\PHPTools\Tests\Enum;

use GuilleGF\PHPTools\Enum\Enum;

/**
 * Class CloneEnumMock
 *
 * @method static CloneEnumMock foo()
 * @method static CloneEnumMock bar()
 * @method static CloneEnumMock number()
 * @method static CloneEnumMock problematicNumber()
 * @method static CloneEnumMock problematicNull()
 * @method static CloneEnumMock problematicEmptyString()
 * @method static CloneEnumMock problematicBooleanFalse()
 *
 * @method bool isFoo()
 * @method bool isBar()
 * @method bool isNumber()
 * @method bool isProblematicNumber()
 * @method bool isProblematicNull()
 * @method bool isProblematicEmptyString()
 * @method bool isProblematicBooleanFalse()
 */
class CloneEnumMock extends Enum
{
    const FOO = "foo";
    const BAR = "bar";
    const NUMBER = 42;

    /**
     * Values that are known to cause problems when used with soft typing
     */
    const PROBLEMATIC_NUMBER = 0;
    const PROBLEMATIC_NULL = null;
    const PROBLEMATIC_EMPTY_STRING = '';
    const PROBLEMATIC_BOOLEAN_FALSE = false;

    /**
     * @param string $value
     * @return \Exception
     */
    public static function customInvalidValueException(string $value): \Exception
    {
        return new CloneEnumMockUnexpectedValueException("Value '$value' is not part of the enum " . get_called_class());
    }

    /**
     * @param string $method
     * @return \Exception
     */
    public static function customUnknownStaticMethodException(string $method): \Exception
    {
        throw new CloneEnumBadMethodCallException("No static method or enum constant '$method' in class " . get_called_class());
    }

    /**
     * @param string $method
     * @return \Exception
     */
    public static function customUnknownMethodException(string $method): \Exception
    {
        throw new CloneEnumBadMethodCallException(sprintf('The method "%s" is not defined.', $method));
    }
}

class CloneEnumMockUnexpectedValueException extends \UnexpectedValueException
{
}

class CloneEnumBadMethodCallException extends \BadMethodCallException
{
}