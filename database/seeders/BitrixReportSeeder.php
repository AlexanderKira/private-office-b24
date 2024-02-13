<?php

namespace Database\Seeders;

use App\Models\BitrixReport;
use Illuminate\Database\Seeder;

class BitrixReportSeeder extends Seeder
{
    public function run(): void
    {
        BitrixReport::factory()->count(50)->create();
    }

}
