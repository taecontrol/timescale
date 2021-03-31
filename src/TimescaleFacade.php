<?php

namespace Taecontrol\Timescale;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Taecontrol\Timescale\Timescale
 */
class TimescaleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'timescale';
    }
}
