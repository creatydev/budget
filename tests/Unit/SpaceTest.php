<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Earning;
use App\Models\Spending;
use App\Models\Space;

class SpaceTest extends TestCase {
    public function testMonthlyBalance() {
        $space = factory(Space::class)->create();

        factory(Earning::class)->create([
            'space_id' => $space->id,
            'amount' => (int) ('39' * 100),
            'happened_on' => now()
        ]);

        $this->assertEquals('3900', $space->monthlyBalance(now()->year, now()->month));

        factory(Spending::class)->create([
            'space_id' => $space->id,
            'amount' => (int) ('12' * 100),
            'happened_on' => now()
        ]);

        $this->assertEquals('2700', $space->monthlyBalance(now()->year, now()->month));

        factory(Spending::class)->create([
            'space_id' => $space->id,
            'amount' => (int) ('50' * 100),
            'happened_on' => now()
        ]);

        // Monthly balance can be negative
        $this->assertEquals('-2300', $space->monthlyBalance(now()->year, now()->month));

        factory(Earning::class)->create([
            'space_id' => $space->id,
            'amount' => (int) ('10' * 100),
            'happened_on' => date_create_from_format('Y-m-d', '2018-01-01')
        ]);

        // First is same as before, because earning happened on a different month
        $this->assertEquals('-2300', $space->monthlyBalance(now()->year, now()->month));
        $this->assertEquals('1000', $space->monthlyBalance(2018, 01));

        factory(Earning::class)->create([
            'space_id' => 2,
            'amount' => (int) ('10' * 100),
            'happened_on' => date_create_from_format('Y-m-d', '2020-01-01')
        ]);

        // 0 because different space-id
        $this->assertEquals('0', $space->monthlyBalance(2020, 01));
    }
}
