<?php

namespace GuilleGF\PHPTools\Tests\Collection;

use GuilleGF\PHPTools\Collection\EntityCollection;

/**
 * Class LemonPieCollection
 * @package GuilleGF\PHPTools\Tests\Collection
 */
class LemonPieCollection extends EntityCollection
{
    /**
     * @return string
     */
    public static function entityClass(): string
    {
        return LemonPie::class;
    }

    /**
     * @return \Exception
     */
    public static function customEmptyException(): \Exception
    {
        return new LemonPieEmptyCollectionException('Collection can not be empty');
    }

    /**
     * @return \Exception
     */
    public static function customInvalidEntityException(): \Exception
    {
        return new LemonPieInvalidElementCollectionException('Element is not valid instance of LemonPie');
    }
}

/**
 * Class LemonPie
 * @package GuilleGF\PHPTools\Tests\Collection
 */
class LemonPie
{
}

/**
 * Class LemonPieEmptyCollectionException
 * @package GuilleGF\PHPTools\Tests\Collection
 */
class LemonPieEmptyCollectionException extends \LengthException
{
}

/**
 * Class LemonPieEmptyCollectionException
 * @package GuilleGF\PHPTools\Tests\Collection
 */
class LemonPieInvalidElementCollectionException extends \UnexpectedValueException
{
}
