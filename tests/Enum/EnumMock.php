<?php
/**
 * @link    http://github.com/myclabs/php-enum
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace GuilleGF\PHPTools\Tests\Enum;

use GuilleGF\PHPTools\Enum\Enum;

/**
 * Class EnumMock
 *
 * @method static EnumMock foo()
 * @method static EnumMock bar()
 * @method static EnumMock number()
 * @method static EnumMock problematicNumber()
 * @method static EnumMock problematicNull()
 * @method static EnumMock problematicEmptyString()
 * @method static EnumMock problematicBooleanFalse()
 *
 * @method bool isFoo()
 * @method bool isBar()
 * @method bool isNumber()
 * @method bool isProblematicNumber()
 * @method bool isProblematicNull()
 * @method bool isProblematicEmptyString()
 * @method bool isProblematicBooleanFalse()
 */
class EnumMock extends Enum
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
}