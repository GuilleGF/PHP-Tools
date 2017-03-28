<?php

namespace GuilleGF\PHPTools\Tests\Collection;

use GuilleGF\PHPTools\Collection\EntityCollection;

/**
 * Class EwokCollection
 * @package GuilleGF\PHPTools\Tests\Collection
 */
class EwokCollection extends EntityCollection
{
    /**
     * @return string
     */
    public static function entityClass(): string
    {
        return Ewok::class;
    }
}
