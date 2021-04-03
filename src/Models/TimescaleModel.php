<?php


namespace Taecontrol\Timescale\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class TimescaleModel extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;

    public string $timeColumn = 'timestamp';
    public string $valueColumn = 'value';

    public function usesTimestamps(): bool
    {
        return false;
    }

    public function scopeSelectTimeBucket(
        Builder $query,
        string $bucketWidth,
        ?string $as = null,
        ?string $timeColumn = null,
    ): Builder {
        $column = $this->allowedColumn($timeColumn, $this->timeColumn);

        return $query->selectRaw("time_bucket(?, {$column}){$this->asAlias($as)}", [$bucketWidth]);
    }

    public function scopeSelectAvg(Builder $query, ?string $as = null, ?string $valueColumn = null): Builder
    {
        $column = $this->allowedColumn($valueColumn, $this->valueColumn);

        return $query->selectRaw("avg({$column}){$this->asAlias($as)}");
    }

    public function scopeSelectMin(Builder $query, ?string $as = null, ?string $valueColumn = null): Builder
    {
        $column = $this->allowedColumn($valueColumn, $this->valueColumn);

        return $query->selectRaw("min({$column}){$this->asAlias($as)}");
    }

    public function scopeSelectMax(Builder $query, ?string $as = null, ?string $valueColumn = null): Builder
    {
        $column = $this->allowedColumn($valueColumn, $this->valueColumn);

        return $query->selectRaw("max({$column}){$this->asAlias($as)}");
    }

    public function scopeSelectFirst(
        Builder $query,
        ?string $as = null,
        ?string $valueColumn = null,
        ?string $timeColumn = null
    ): Builder {
        $valueCol = $this->allowedColumn($valueColumn, $this->valueColumn);
        $timeCol = $this->allowedColumn($timeColumn, $this->timeColumn);

        return $query->selectRaw("first({$valueCol}, {$timeCol}){$this->asAlias($as)}");
    }

    public function scopeSelectLast(
        Builder $query,
        ?string $as = null,
        ?string $valueColumn = null,
        ?string $timeColumn = null,
    ): Builder {
        $valueCol = $this->allowedColumn($valueColumn, $this->valueColumn);
        $timeCol = $this->allowedColumn($timeColumn, $this->timeColumn);

        return $query->selectRaw("last({$valueCol}, {$timeCol}){$this->asAlias($as)}");
    }

    protected function asAlias(?string $alias): string
    {
        return $alias ? " AS {$alias}": '';
    }

    public function allowedColumn(?string $column, string $fallbackColumn): string
    {
        if (! $column) {
            return $fallbackColumn;
        }

        $allowedColumns = Schema::getColumnListing($this->table);

        return in_array($column, $allowedColumns) ? $column : $fallbackColumn;
    }
}
