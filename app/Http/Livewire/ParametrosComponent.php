<?php

namespace App\Http\Livewire;

use App\Models\Parametro;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ParametrosComponent extends Component
{
    use LivewireAlert;
    protected $listeners = [
        'confirmed'
    ];

    public $parametro_id, $nombre, $tabla_id, $valor, $busqueda;
    public $view = 'create';

    public function mount(Request $request)
    {
        if (!is_null($request->parametro)){
            $this->busqueda = $request->parametro;
        }
    }

    public function render()
    {
        $parametros = Parametro::buscar($this->busqueda)->orderBy('id', 'DESC')->get();
        return view('livewire.parametros-component')
            ->with('parametros', $parametros);
    }

    public function limpiar()
    {
        $this->parametro_id = null;
        $this->nombre = null;
        $this->tabla_id = null;
        $this->valor = null;
        $this->view = 'create';
    }

    public function store()
    {
        $rules = [
            'nombre' => ['required', 'min:4', 'alpha_dash', Rule::unique('parametros')],
            'tabla_id' => 'nullable|integer'
        ];
        $this->validate($rules);
        $parametro = new Parametro();
        $parametro->nombre = $this->nombre;
        if (!empty($this->tabla_id)){
            $parametro->tabla_id = $this->tabla_id;
        }
        if (!empty($this->valor)) {
            $parametro->valor = $this->valor;
        }
        $parametro->save();
        $this->edit($parametro->id);
        $this->alert(
            'success',
            'Parametro Creado'
        );
    }

    public function edit($id)
    {
        $parametro = Parametro::find($id);
        $this->parametro_id = $parametro->id;
        $this->nombre = $parametro->nombre;
        $this->tabla_id = $parametro->tabla_id;
        $this->valor = $parametro->valor;
        $this->view = 'edit';
    }

    public function update($id)
    {
        $rules = [
            'nombre' => ['required', 'min:4', 'alpha_dash', Rule::unique('parametros', 'nombre')->ignore($id)],
            'tabla_id' => 'nullable|integer'
        ];
        $this->validate($rules);
        $parametro = Parametro::find($id);
        $parametro->nombre = $this->nombre;
        if (!empty($this->tabla_id)){
            $parametro->tabla_id = $this->tabla_id;
        }
        if (!empty($this->valor)) {
            $parametro->valor = $this->valor;
        }
        $parametro->update();

        $this->limpiar();

        $this->alert(
            'success',
            'Parametro Actualizado'
        );
    }

    public function destroy($id)
    {
        $this->parametro_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        // Example code inside confirmed callback
        $parametro = Parametro::find($this->parametro_id);
        $parametro->delete();
        $this->parametro_id = null;
        $this->limpiar();
        $this->alert(
            'success',
            'Parametro Eliminado'
        );

    }


}
