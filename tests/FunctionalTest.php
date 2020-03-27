<?php

namespace Jackal\BinLocator\test;

use Jackal\BinLocator\BinLocator;
use Jackal\BinLocator\Exception\BinLocatorException;
use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    public function testLocateExecutable(){

        $binLocator = new BinLocator('bash');
        $this->assertEquals('/bin/bash', $binLocator->locate());
    }

    public function testRaiseExceptionOnBinNotFound(){

        $this->setExpectedException(BinLocatorException::class, 'Executable "not-found" has not been found on system');

        $binLocator = new BinLocator('not-found');
        $binLocator->locate();
    }

    public function testGetProcess(){
        $binLocator = new BinLocator('ls');
        $process = $binLocator->getProcess(['-lah']);

        $ls = trim(exec('which ls'));

        $this->assertEquals($ls . ' -lah', $process->getCommandLine());
    }

    public function testExecuteProcess(){

        $binLocator = new BinLocator('ls');
        $process = $binLocator->getProcess(['-lah']);

        $process->run();

        $this->assertTrue($process->isSuccessful());
        $this->assertEquals('', $process->getErrorOutput());
        $this->assertNotFalse($process->getOutput());
    }
}