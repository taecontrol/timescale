<?php


namespace Taecontrol\Timescale\Tests\Mocks;

class SchemaBuilderMock
{
    public function __construct(public array $columns)
    {
    }

    public function getColumnListing(?string $table)
    {
        return $this->columns;
    }
}
