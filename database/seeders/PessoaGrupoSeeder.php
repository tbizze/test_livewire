<?php

namespace Database\Seeders;

use App\Models\PessoaGrupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessoaGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'nome' => 'NFs',
                'notas' => 'Nota fiscal de serviço eletrônica.'
            ],
            [
                'nome' => 'NF danf',
                'notas' => 'Nota fiscal eletrônica.'
            ],
            [
                'nome' => 'NFe',
                'notas' => 'Nota fiscal paulista.'
            ],
            [
                'nome' => 'RPA',
                'notas' => 'Recibo de profissional autônomo.'
            ],
            [
                'nome' => 'RPS',
                'notas' => 'Recibo provisório de serviços.'
            ],
            [
                'nome' => 'Guia receita federal',
                'notas' => 'Abrangência CDP.'
            ],
        ];

        foreach ($items as $item) {
            PessoaGrupo::create($item);
        }
    }
}
