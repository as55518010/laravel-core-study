<?php

use Illuminate\Container\Container;


class Log
{
    protected $file;

    function __construct(File $file)
    {
        $this->file = $file;
    }
}

class File
{
    protected $sys;

    function __construct(Sys $sys)
    {
        $this->sys = $sys;
    }
}
class Sys
{
}

require __DIR__ . '/../vendor/autoload.php';

$Container = new Container;

$obj = $Container->make(Log::class);


dd($obj);
