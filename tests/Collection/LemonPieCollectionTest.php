<?php

namespace GuilleGF\PHPTools\Tests\Collection;

use GuilleGF\PHPTools\Collection\Helper\EntityCollectionTester;
use PHPUnit\Framework\TestCase;

/**
 * Class LemonPieCollectionTest
 * @package GuilleGF\PHPTools\Tests\Collection
 */
class LemonPieCollectionTest extends TestCase
{
    use EntityCollectionTester;

    /**
     * @return string
     */
    protected function entityCollectionClass(): string
    {
        return LemonPieCollection::class;
    }
}
