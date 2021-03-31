<?php

namespace Taecontrol\Timescale;

use Illuminate\Support\Facades\DB;

class Timescale
{
    public function createHypertable(string $table, string $partitionedColumn): void
    {
        DB::select("select create_hypertable(?, ?)", [$table, $partitionedColumn]);
    }
}
