<?php


namespace Jackal\BinLocator;


use Jackal\BinLocator\Exception\BinLocatorException;
use Symfony\Component\Process\Process;

class BinLocator
{
    protected $binToLocate;

    public function __construct($binToLocate)
    {
        $this->binToLocate = $binToLocate;
    }

    public function locate(){
        $process = new Process(['which',$this->binToLocate]);
        $process->run();

        if($process->getErrorOutput()){
            throw new \Exception('Something gone wrong!');
        }

        $path = trim($process->getOutput());

        if(!$path){
            throw BinLocatorException::notFound($this->binToLocate);
        }

        return $path;
    }
}