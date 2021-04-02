<?php


namespace Taecontrol\Timescale\Models;


use Illuminate\Database\Eloquent\Model;

class TimescaleModel extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;

    public function usesTimestamps(): bool
    {
        return false;
    }
}