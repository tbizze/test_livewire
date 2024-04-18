<div>
    {{-- Cabeçalho da página --}}
    <x-mary-header :title="$page_title" subtitle="Últimos registros">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" placeholder="Search..." wire:model.live="search" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-funnel" wire:click="showDrawer = true" class="relative">
                @if ($qdeFilter > 0)
                    <x-mary-badge :value="$qdeFilter" class="badge-error absolute -right-2 -top-2" />
                @endif
            </x-mary-button>
            @can('eventos.create')
                <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModalRegistro()" />
            @endcan

        </x-slot:actions>
    </x-mary-header>

    {{-- Renderiza tabela --}}
    <x-mary-card shadow class=" bg-white">
        <x-mary-table :headers="$headers" :rows="$dados" striped @row-click="$wire.edit($event.detail.id)"
            with-pagination :sort-by="$sortBy">
            {{-- Personaliza / formata células  --}}
            @scope('cell_data_emissao', $dado)
                {{ isset($dado->data_emissao) ? $dado->data_emissao->format('d/m/Y') : '' }}
            @endscope
            @scope('cell_data_venc', $dado)
                {{ isset($dado->data_venc) ? $dado->data_venc->format('d/m/Y') : ''}}
            @endscope
            @scope('cell_to_documento_status_nome', $dado)
                <div class=" flex gap-1">
                    @if ($dado->to_documento_status_nome == 'Vencido')
                        <x-mary-badge :value="$dado->to_documento_status_nome" class="badge-outline badge-error " />        
                    @else
                        <x-mary-badge :value="$dado->to_documento_status_nome" class="badge-outline " />
                    @endif
                </div>
            @endscope
            {{-- Monta coluna de ações  --}}
            @scope('actions', $dado)
                <div class="flex gap-1">
                    @can('eventos.edit')
                        <x-mary-button icon="o-document-duplicate" wire:click="copyRecord({{ $dado->id }})" spinner
                            class="btn-sm btn-outline border-none p-1" />
                    @endcan
                    @can('eventos.delete')
                        <x-mary-button icon="o-trash" wire:click="confirmDelete({{ $dado->id }})" spinner
                            class="btn-sm btn-outline border-none text-error p-1" />
                    @endcan
                </div>
            @endscope
        </x-mary-table>
    </x-mary-card>
</div>
