<?php

namespace Database\Seeders;

use App\Models\Evidence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evidence::factory(50)->create();
    }
}
