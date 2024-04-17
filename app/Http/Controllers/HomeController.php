<?php

namespace App\Http\Controllers;

use App\Models\DocumentoTipo;
use App\Models\PlanoCtaItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function test()
    {
        $test = $this->getRandom(DocumentoTipo::class);
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
