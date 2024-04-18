<?php

namespace App\Livewire\Previsao;

use App\Models\Documento;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class PrevReceitaIndex extends Component
{
    use Toast;
    use WithPagination;

    public $page_title = 'Previsão Receitas';
    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public string $search = '';
    public $qdeFilter = 0;

    /* Renderiza componente */
    #[Title('Previsão Receitas')]
    public function render()
    {
        return view('livewire.previsao.prev-receita-index',[
            'headers' => $this->headers(),
            'dados' => $this->dados(),
        ]);
    }

    //* Método p/ Cabeçalho da tabela
    public function headers()
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-base-200 w-1'],
            ['key' => 'to_documento_classe_nome', 'label' => 'Classe'],
            ['key' => 'codigo', 'label' => 'Código'],
            ['key' => 'to_pessoa_nome_razao', 'label' => 'Emissor'],
            ['key' => 'data_emissao', 'label' => 'Data emissão'],
            ['key' => 'data_venc', 'label' => 'Data venc.'],
            ['key' => 'has_documento_items_sum_valor', 'label' => 'Total itens'],
            ['key' => 'to_documento_status_nome', 'label' => 'Status'],
            ['key' => 'to_documento_tipo_nome', 'label' => 'Tipo'],
            
        ];
    }

    // Método p/ obter dados da tabela
    public function dados()
    {
        //dd($this->fil_area_ids);

        return Documento::query()
            ->withAggregate('toPessoa', 'nome_razao')
            ->withAggregate('toDocumentoStatus', 'nome')
            ->withAggregate('toDocumentoClasse', 'nome')
            ->withAggregate('toDocumentoTipo', 'nome')
            ->withSum(['hasDocumentoItems'], 'valor')

            ->fillTipo(2) // 3=> Cta. a Receber

            ->orderBy(...array_values($this->sortBy))
            ->paginate(25);
            //dd($test);
    }
}
