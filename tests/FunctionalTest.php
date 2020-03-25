<?php


namespace Jackal\BinLocator\test;


use Jackal\BinLocator\BinLocator;
use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    public function testLocateExecutable(){

        $binLocator = new BinLocator('bash');
        $this->assertEquals('/bin/bash',$binLocator->locate());
    }
}