<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\DocumentoTipo;
use App\Models\PlanoCtaItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function test()
    {
        $test = Documento::query()
        ->with('hasDocumentoBaixa','hasDocumentoBaixas')
        ->withAggregate('toPessoa', 'nome_razao')
        ->withAggregate('toDocumentoStatus', 'nome')
        ->withAggregate('toDocumentoClasse', 'nome')
        ->withAggregate('toDocumentoTipo', 'nome')
        ->withSum(['hasDocumentoItems'], 'valor')
        ->withCount(['hasDocumentoItems'], 'id')
        ->withCount(['hasDocumentoBaixa'], 'id')

        //->has('hasDocumentoBaixa')

        ->get()
        ;

        $i=0;
        $j = '';
        foreach ($test as $item) {
            if ($item->has_documento_baixa_count > 0) {
                //$item['documento_status_id'] = 10;
                //dd($item->documento_status_id);
                //$item->update(['documento_status_id' => 1]);
                $i++;
                $j = $j . ', ' . $item->id;
                //dd($item->id, 'test');
            }
        }

        dd($i, $j, $test->toArray());
        /* $now = $this->faker->date();

        if ($data_emissao >= $now) {
            $data_emissao = $now;
        } */
    }

    private function getRandom($model)
    {
        $random = $model::all()->random(1)->pluck('id'); 
        return $random[0];
    }
}
