<?php

namespace App\Livewire\Forms\Settings;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Form
{
    public ?Permission $objetoForm;

    // Regras de validação.
    #[Validate([
        'name' => ['required', 'string', 'min:3', 'max:50'],
        'description' => ['nullable', 'string', 'max:100'],
    ])]

    // PROPRIEDADES: Campos da tabela.
    public $name;
    public $description;
    public $model;
    public $permission_to_roles = [];

    // Método p/ popular classe 'objetoForm', a partir do BD.
    public function setRegistro(Permission $registro)
    {
        $this->objetoForm = $registro;
        $this->name = $registro->name;
        $this->model = $registro->model;
        $this->description = $registro->description;

        // Obtém as funções relacionadas com a permissão atual.
        $this->permission_to_roles = $registro->roles->pluck('id');
    }

    // Método p/ criar no BD.
    public function store()
    {
        $this->validate();
        $permission = Permission::create([
            'name' => $this->name,
            'model' => $this->model,
            'description' => $this->description,
            'guard_name' => 'web',
        ]);

        // Atribui as funções passadas, à permissão criada.
        if ($this->permission_to_roles) {
            // Está chegando array de strings. Converte em int.
            $role_selected = $this->convertInt($this->permission_to_roles);
            // Persiste no BD. Sincroniza funções na permissão editada.
            $permission->syncRoles($role_selected);
        }
        // Limpa 'objetoForm'.
        $this->reset();
    }

    // Método p/ atualizar no BD.
    public function update()
    {
        $this->validate();
        $this->objetoForm->update(
            $this->only(['name', 'description', 'model'])
        );

        // Atribui as funções passadas, à permissão editada.
        if ($this->permission_to_roles) {
            // Está chegando array de strings. Converte em int.
            $role_selected = $this->convertInt($this->permission_to_roles);
            // Persiste no BD. Sincroniza funções na permissão editada.
            $this->objetoForm->syncRoles($role_selected);
        }
        // Limpa 'objetoForm'.
        $this->reset();
    }

    // Método p/ converter array de string em array de int. 
    private function convertInt($value)
    {
        return collect($value)->map(function (int $item) {
            return (int)$item;
        });
    }
}
