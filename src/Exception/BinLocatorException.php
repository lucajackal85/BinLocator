<?php


namespace Jackal\BinLocator\Exception;


use Symfony\Component\Process\Process;

class BinLocatorException extends \Exception
{
    public static function notFound($bin){
        return new BinLocatorException(sprintf('Executable "%s" has not been found on system',$bin));
    }

    public static function processFailed(Process $process){
        return new BinLocatorException(sprintf('Something gone wrong executing: %s, returned: %s',$process->getCommandLine(),$process->getErrorOutput()));
    }
}