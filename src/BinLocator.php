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

        $commandLine = implode(' ',array_merge([$bin],$commandLine));

        //compatibility fix Process >= 5.x
        if(method_exists(Process::class, 'fromShellCommandline')){
            return Process::fromShellCommandline($commandLine);
        }

        //Process < 5.x
        return new Process($commandLine);
    }
}