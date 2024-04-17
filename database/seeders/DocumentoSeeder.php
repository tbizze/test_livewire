<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Models\DocumentoItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        $eventos = Documento::factory(100)->create();

        /* $documentos = Documento::factory(1)
        ->create()
        ->each(function ($documentos) {
            //$news = (EventoArea::)->create();
            // $news = EventoArea::pluck('id');
            //dd($news);
            $area = collect(DocumentoItem::pluck('id'));
            $evento->areas()->sync($area->random());
        }); */
    }
}
