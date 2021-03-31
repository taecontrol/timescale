<?php

namespace Taecontrol\Timescale\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Taecontrol\Timescale\Timescale
 *
 * @method static void createHypertable(string $table, string $partitionedColumn)
 */
class Timescale extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'timescale';
    }
}
