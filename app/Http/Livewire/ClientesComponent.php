<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ClientesComponent extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $busqueda;

    public function mount(Request $request)
    {
        if (!is_null($request->buscar)){
            $this->busqueda = $request->buscar;
        }
    }

    public function render()
    {
        $clientes = Cliente::buscar($this->busqueda)->orderBy('id', 'DESC')->paginate(50);
        return view('livewire.clientes-component')
            ->with('listarClientes', $clientes);
    }
}
