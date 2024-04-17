<?php

namespace Database\Factories;

use App\Models\CtaMovimento;
use App\Models\Documento;
use App\Models\DocumentoBaixaTipo;
use App\Models\DocumentoItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentoBaixa>
 */
class DocumentoBaixaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doc = $this->getDocumento();
        $documento_id = $doc->id;  
        $doc_items_sum = $this->getDocItem($documento_id);
        
        $dt_baixa = $this->faker->dateTimeBetween('-5 month', '+2 month')->format('Y-m-d');

        switch ($doc->documento_tipo_id) {
            case 1:
            case 3:
            case 5:
                $documento_baixa_tipo_id = $this->getBaixaTipo('D');
                break;
            case 2:
            case 4:
                $documento_baixa_tipo_id = $this->getBaixaTipo('C');
                break;
        }
        //dd($documento_id, $doc_items_sum, $documento_baixa_tipo_id);
        

        return [
            // 'dt_baixa','valor_baixa','dt_compensa','refer_baixa','cta_movimento_id','documento_id','documento_baixa_tipo_id'
            'dt_baixa' => $dt_baixa,
            'dt_compensa' => $dt_baixa,
            'valor_baixa' => $doc_items_sum,
            'refer_baixa' => null,
            'cta_movimento_id' => $this->getRandom(CtaMovimento::class),
            'documento_id' => $documento_id,
            'documento_baixa_tipo_id' => $documento_baixa_tipo_id,
        ];
    }

    private function getRandom($model)
    {
        $random = $model::all()->random(1)->pluck('id'); 
        return $random[0];
    }
    private function getDocumento()
    {
        $random = Documento::query()
            ->whereIn('documento_tipo_id', [3,4,5])
            ->whereHas('hasDocumentoItem')
            ->get()
            ->random(1);
        return $random[0];
    }
    private function getDocItem($documento_id)
    {
        $random = DocumentoItem::query()
            ->where('documento_id', $documento_id)
            ->sum('valor');
        return $random;
    }
    private function getBaixaTipo($documento_id)
    {
        $random = DocumentoBaixaTipo::query()
            ->where('natureza', $documento_id)
            ->get()
            ->random(1)
            ->pluck('id');
        return $random[0];
    }
}
