<?php
namespace Tutu\WebConfig\Facades;
use Illuminate\Support\Facades\Facade;
class WebConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'webconfigtest';
    }
}
