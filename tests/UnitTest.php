<?php

namespace Jackal\BinLocator\test;

use Jackal\BinLocator\BinLocator;
use Jackal\BinLocator\Exception\BinLocatorException;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testWhichCommandNotFound(){

        $wrongCommand = 'which-not-found';

        $this->setExpectedException(BinLocatorException::class, 'Something gone wrong executing: \'' .
            $wrongCommand . '\' \'bash\', returned: sh: 1: exec: ' .
            $wrongCommand . ': not found'
        );

        $binLocator = new BinLocator('bash');

        $refObject = new \ReflectionObject( $binLocator );
        $refProperty = $refObject->getProperty( 'whichCommand' );
        $refProperty->setAccessible( true );
        $refProperty->setValue($binLocator, $wrongCommand);

        $binLocator->locate();

    }
}