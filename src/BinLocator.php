<?php


namespace Jackal\BinLocator;


use Jackal\BinLocator\Exception\BinLocatorException;
use Symfony\Component\Process\Process;

class BinLocator
{
    protected $binToLocate;
    protected $whichCommand = 'which';

    public function __construct($binToLocate)
    {
        $this->binToLocate = $binToLocate;
    }

    public function locate(){
        $process = new Process([$this->whichCommand,$this->binToLocate]);
        $process->run();

        if($process->getErrorOutput()){
            throw BinLocatorException::processFailed($process);
        }

        $path = trim($process->getOutput());

        if(!$path){
            throw BinLocatorException::notFound($this->binToLocate);
        }

        return $path;
    }

    public function getProcess(array $commandLine){
        $bin = $this->locate();
        return new Process(array_merge([$bin],$commandLine));
    }
}