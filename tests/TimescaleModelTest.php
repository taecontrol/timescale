<?php

namespace Taecontrol\Timescale\Tests;

use Illuminate\Support\Facades\DB;
use Taecontrol\Timescale\Models\TimescaleModel;
use Taecontrol\Timescale\Tests\Mocks\ConnectionMock;

class TimescaleModelTest extends TestCase
{
    /** @test */
    public function it_can_select_time_bucket()
    {
        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp) from "test_table"', $sqlOutput);
        $this->assertEquals(['5 minutes'], $query->getBindings());
    }

    /** @test */
    public function it_can_select_time_bucket_with_alias_and_different_time_column()
    {
        DB::shouldReceive('connection')
            ->andReturn(new ConnectionMock(['value', 'time']));

        $query = TimescaleModel::query()
            ->selectTimeBucket(bucketWidth: '5 minutes', as: 'five_min', timeColumn: 'time')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, time) AS five_min from "test_table"', $sqlOutput);
        $this->assertEquals(['5 minutes'], $query->getBindings());
    }

    /** @test */
    public function it_can_select_avg()
    {
        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectAvg()
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), avg(value) from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_avg_with_alias_and_different_value_column()
    {
        DB::shouldReceive('connection')
            ->andReturn(new ConnectionMock(['another_value', 'timestamp']));

        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectAvg(as: 'value', valueColumn: 'another_value')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), avg(another_value) AS value from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_min()
    {
        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectMin()
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), min(value) from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_min_with_alias_and_different_value_column()
    {
        DB::shouldReceive('connection')
            ->andReturn(new ConnectionMock(['another_value', 'timestamp']));

        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectMin(as: 'value', valueColumn: 'another_value')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), min(another_value) AS value from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_max()
    {
        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectMax()
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), max(value) from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_max_with_alias_and_different_value_column()
    {
        DB::shouldReceive('connection')
            ->andReturn(new ConnectionMock(['another_value', 'timestamp']));

        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectMax(as: 'value', valueColumn: 'another_value')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), max(another_value) AS value from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_first()
    {
        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectFirst()
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), first(value, timestamp) from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_first_with_alias_and_different_value_column()
    {
        DB::shouldReceive('connection')
            ->andReturn(new ConnectionMock(['another_value', 'time']));

        $query = TimescaleModel::query()
            ->selectTimeBucket(bucketWidth: '5 minutes', as: null, timeColumn: 'time')
            ->selectFirst(as: 'value', valueColumn: 'another_value', timeColumn: 'time')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, time), first(another_value, time) AS value from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_last()
    {
        $query = TimescaleModel::query()
            ->selectTimeBucket('5 minutes')
            ->selectLast()
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, timestamp), last(value, timestamp) from "test_table"', $sqlOutput);
    }

    /** @test */
    public function it_can_select_last_with_alias_and_different_value_column()
    {
        DB::shouldReceive('connection')
            ->andReturn(new ConnectionMock(['another_value', 'time']));

        $query = TimescaleModel::query()
            ->selectTimeBucket(bucketWidth: '5 minutes', as: null, timeColumn: 'time')
            ->selectLast(as: 'value', valueColumn: 'another_value', timeColumn: 'time')
            ->from('test_table');

        $sqlOutput = $query->toSql();

        $this->assertEquals('select time_bucket(?, time), last(another_value, time) AS value from "test_table"', $sqlOutput);
    }
}
