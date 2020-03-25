<?php


namespace Jackal\BinLocator\test;


use Jackal\BinLocator\BinLocator;
use Jackal\BinLocator\Exception\BinLocatorException;
use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    public function testLocateExecutable(){

        $binLocator = new BinLocator('bash');
        $this->assertEquals('/bin/bash',$binLocator->locate());
    }

    public function testRaiseExceptionOnBinNotFound(){

        $this->expectException(BinLocatorException::class);
        $this->expectExceptionMessage('Executable "not-found" has not been found on system');

        $binLocator = new BinLocator('not-found');
        $binLocator->locate();
    }

    public function testGetProcess(){

        $binLocator = new BinLocator('ls');
        $process = $binLocator->getProcess(['-lah']);

        $process->run();

        $this->assertTrue($process->isSuccessful());
        $this->assertEquals('', $process->getErrorOutput());
        $this->assertNotFalse($process->getOutput());
    }
}