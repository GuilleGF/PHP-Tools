<?php
/**
 * @link    http://github.com/myclabs/php-enum
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace GuilleGF\PHPTools\Tests\Enum;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * value()
     */
    public function testGetValue()
    {
        $value = new EnumMock(EnumMock::FOO);
        $this->assertEquals(EnumMock::FOO, $value->value());

        $value = new EnumMock(EnumMock::BAR);
        $this->assertEquals(EnumMock::BAR, $value->value());

        $value = new EnumMock(EnumMock::NUMBER);
        $this->assertEquals(EnumMock::NUMBER, $value->value());
    }

    /**
     * key()
     */
    public function testGetKey()
    {
        $value = new EnumMock(EnumMock::FOO);
        $this->assertEquals('FOO', $value->key());
        $this->assertNotEquals('BA', $value->key());
    }

    /**
     * @dataProvider invalidValueProvider
     * @param $value
     */
    public function testCreatingEnumWithInvalidValue($value)
    {
        $this->expectException(
            \UnexpectedValueException::class
        );
        $this->expectExceptionMessage(
            'Value \'' . $value . '\' is not part of the enum GuilleGF\PHPTools\Tests\Enum\EnumMock'
        );

        new EnumMock($value);
    }

    /**
     * Contains values not existing in EnumMock
     * @return array
     */
    public function invalidValueProvider() {
        return array(
            "string" => array('test'),
            "int" => array(1234),
        );
    }

    /**
     * __toString()
     * @dataProvider toStringProvider
     * @param $expected
     * @param $enumObject
     */
    public function testToString($expected, $enumObject)
    {
        $this->assertSame($expected, (string) $enumObject);
    }

    public function toStringProvider() {
        return array(
            array(EnumMock::FOO, new EnumMock(EnumMock::FOO)),
            array(EnumMock::BAR, new EnumMock(EnumMock::BAR)),
            array((string) EnumMock::NUMBER, new EnumMock(EnumMock::NUMBER)),
        );
    }

    /**
     * keys()
     */
    public function testKeys()
    {
        $values = EnumMock::keys();
        $expectedValues = array(
            "FOO",
            "BAR",
            "NUMBER",
            "PROBLEMATIC_NUMBER",
            "PROBLEMATIC_NULL",
            "PROBLEMATIC_EMPTY_STRING",
            "PROBLEMATIC_BOOLEAN_FALSE",
        );

        $this->assertSame($expectedValues, $values);
    }

    /**
     * values()
     */
    public function testValues()
    {
        $values = EnumMock::values();
        $expectedValues = array(
            "FOO"                       => new EnumMock(EnumMock::FOO),
            "BAR"                       => new EnumMock(EnumMock::BAR),
            "NUMBER"                    => new EnumMock(EnumMock::NUMBER),
            "PROBLEMATIC_NUMBER"        => new EnumMock(EnumMock::PROBLEMATIC_NUMBER),
            "PROBLEMATIC_NULL"          => new EnumMock(EnumMock::PROBLEMATIC_NULL),
            "PROBLEMATIC_EMPTY_STRING"  => new EnumMock(EnumMock::PROBLEMATIC_EMPTY_STRING),
            "PROBLEMATIC_BOOLEAN_FALSE" => new EnumMock(EnumMock::PROBLEMATIC_BOOLEAN_FALSE),
        );

        $this->assertEquals($expectedValues, $values);
    }

    /**
     * toArray()
     */
    public function testToArray()
    {
        $values = EnumMock::toArray();
        $expectedValues = array(
            "FOO"                   => EnumMock::FOO,
            "BAR"                   => EnumMock::BAR,
            "NUMBER"                => EnumMock::NUMBER,
            "PROBLEMATIC_NUMBER"    => EnumMock::PROBLEMATIC_NUMBER,
            "PROBLEMATIC_NULL"      => EnumMock::PROBLEMATIC_NULL,
            "PROBLEMATIC_EMPTY_STRING"    => EnumMock::PROBLEMATIC_EMPTY_STRING,
            "PROBLEMATIC_BOOLEAN_FALSE"    => EnumMock::PROBLEMATIC_BOOLEAN_FALSE,
        );

        $this->assertSame($expectedValues, $values);
    }

    /**
     * __callStatic()
     */
    public function testStaticAccess()
    {
        $this->assertEquals(new EnumMock(EnumMock::FOO), EnumMock::foo());
        $this->assertEquals(new EnumMock(EnumMock::BAR), EnumMock::bar());
        $this->assertEquals(new EnumMock(EnumMock::NUMBER), EnumMock::number());
        $this->assertEquals(new EnumMock(EnumMock::PROBLEMATIC_NUMBER), EnumMock::problematicNumber());
        $this->assertEquals(new EnumMock(EnumMock::PROBLEMATIC_NULL), EnumMock::problematicNull());
        $this->assertEquals(new EnumMock(EnumMock::PROBLEMATIC_EMPTY_STRING), EnumMock::problematicEmptyString());
        $this->assertEquals(new EnumMock(EnumMock::PROBLEMATIC_BOOLEAN_FALSE), EnumMock::problematicBooleanFalse());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage No static method or enum constant 'UNKNOWN' in class
     *                           UnitTest\MyCLabs\Enum\Enum\EnumMock
     */
    public function testBadStaticAccess()
    {
        EnumMock::UNKNOWN();
    }

    /**
     * __callStatic()
     */
    public function testIsAccess()
    {
        $this->assertTrue((new EnumMock(EnumMock::FOO))->isFoo());
        $this->assertTrue((new EnumMock(EnumMock::BAR))->isBar());
        $this->assertTrue((new EnumMock(EnumMock::NUMBER))->isNumber());
        $this->assertTrue((new EnumMock(EnumMock::PROBLEMATIC_NUMBER))->isProblematicNumber());
        $this->assertTrue((new EnumMock(EnumMock::PROBLEMATIC_NULL))->isProblematicNull());
        $this->assertTrue((new EnumMock(EnumMock::PROBLEMATIC_EMPTY_STRING))->isProblematicEmptyString());
        $this->assertTrue((new EnumMock(EnumMock::PROBLEMATIC_BOOLEAN_FALSE))->isProblematicBooleanFalse());

        $this->assertFalse((new EnumMock(EnumMock::FOO))->isBar());
        $this->assertFalse((new EnumMock(EnumMock::FOO))->isNumber());
        $this->assertFalse((new EnumMock(EnumMock::FOO))->isProblematicNumber());
        $this->assertFalse((new EnumMock(EnumMock::FOO))->isProblematicNull());
        $this->assertFalse((new EnumMock(EnumMock::FOO))->isProblematicEmptyString());
        $this->assertFalse((new EnumMock(EnumMock::FOO))->isProblematicBooleanFalse());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage The method "isUnknown" is not defined.
     */
    public function testBadIsAccess()
    {
        (new EnumMock(EnumMock::FOO))->isUnknown();
    }

    /**
     * isValid()
     * @dataProvider isValidProvider
     * @param string $value
     * @param bool $isValid
     */
    public function testIsValid($value, $isValid)
    {
        $this->assertSame($isValid, EnumMock::isValid($value));
    }

    public function isValidProvider() {
        return array(
            /**
             * Valid values
             */
            array('foo', true),
            array(42, true),
            array(null, true),
            array(0, true),
            array('', true),
            array(false, true),
            /**
             * Invalid values
             */
            array('baz', false)
        );
    }

    /**
     * isValidKey()
     */
    public function testIsValidKey()
    {
        $this->assertTrue(EnumMock::isValidKey('FOO'));
        $this->assertFalse(EnumMock::isValidKey('BAZ'));
    }

    /**
     * search()
     * @see https://github.com/myclabs/php-enum/issues/13
     * @dataProvider searchProvider
     * @param string $value
     * @param bool $expected
     */
    public function testSearch($value, $expected)
    {
        $this->assertSame($expected, EnumMock::search($value));
    }

    public function searchProvider() {
        return array(
            array('foo', 'FOO'),
            array(0, 'PROBLEMATIC_NUMBER'),
            array(null, 'PROBLEMATIC_NULL'),
            array('', 'PROBLEMATIC_EMPTY_STRING'),
            array(false, 'PROBLEMATIC_BOOLEAN_FALSE'),
            array('bar I do not exist', false),
            array(array(), false),
        );
    }

    /**
     * equals()
     */
    public function testEquals()
    {
        $foo = new EnumMock(EnumMock::FOO);
        $number = new EnumMock(EnumMock::NUMBER);
        $anotherFoo = new EnumMock(EnumMock::FOO);
        $cloneFoo = new CloneEnumMock(EnumMock::FOO);

        $this->assertTrue($foo->equals($foo));
        $this->assertFalse($foo->equals($number));
        $this->assertTrue($foo->equals($anotherFoo));
        $this->assertFalse($foo->equals($cloneFoo));
    }

    /**
     * equals()
     */
    public function testEqualsComparesProblematicValuesProperly()
    {
        $false = new EnumMock(EnumMock::PROBLEMATIC_BOOLEAN_FALSE);
        $emptyString = new EnumMock(EnumMock::PROBLEMATIC_EMPTY_STRING);
        $null = new EnumMock(EnumMock::PROBLEMATIC_NULL);
        $cloneNull = new CloneEnumMock(EnumMock::PROBLEMATIC_NULL);

        $this->assertTrue($false->equals($false));
        $this->assertFalse($false->equals($emptyString));
        $this->assertFalse($emptyString->equals($null));
        $this->assertFalse($null->equals($false));
        $this->assertFalse($null->equals($cloneNull));
    }
}