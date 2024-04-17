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
        return [
            // 'dt_baixa','valor_baixa','dt_compensa','refer_baixa','cta_movimento_id','documento_id','documento_baixa_tipo_id'
            /* 'dt_baixa' => $dt_baixa,
            'dt_compensa' => $dt_baixa,
            'valor_baixa' => $doc_items_sum,
            'refer_baixa' => null,
            'cta_movimento_id' => $this->getRandom(CtaMovimento::class),
            'documento_id' => $documento_id,
            'documento_baixa_tipo_id' => $documento_baixa_tipo_id, */
        ];
    }

}
