<?php


namespace Taecontrol\Timescale\Tests\Mocks;

class ConnectionMock
{
    public function __construct(public array $columns)
    {
    }

    public function getSchemaBuilder(): SchemaBuilderMock
    {
        return new SchemaBuilderMock($this->columns);
    }
}
