<?php


namespace Jackal\BinLocator\Exception;


class BinLocatorException extends \Exception
{
    public static function notFound($bin){
        return new BinLocatorException(sprintf('Executable "%s" has not been found on system',$bin));
    }
}