<?php

namespace Database\Seeders;

use App\Models\DocumentoBaixa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoBaixaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        $eventos = DocumentoBaixa::factory(20)->create();
    }
}
