<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AlmacenesComponent extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public $view = 'create', $almacen_id, $count, $busqueda;
    public $nombre;

    public function mount(Request $request)
    {
        if (!is_null($request->buscar)){
            $this->busqueda = $request->buscar;
        }
    }

    public function render()
    {
        $this->count = Almacen::count();
        $almacenes = Almacen::buscar($this->busqueda)->orderBy('nombre', 'ASC')->get();
        return view('livewire.almacenes-component')
            ->with('almacenes', $almacenes);
    }

    public function limpiar()
    {
        $this->view = 'create';
        $this->almacen_id = null;
        $this->nombre = null;
    }

    public function rules()
    {
        return [
            'nombre'      =>  ['required', 'min:4', Rule::unique('almacenes')->ignore($this->almacen_id)],
        ];
    }

    public function store()
    {
        $this->validate();
        $almacen = new Almacen();
        $almacen->nombre = strtoupper($this->nombre);
        $almacen->save();

        $this->edit($almacen->id);

        $this->alert(
            'success',
            'Almacen Creado.'
        );


    }

    public function edit($id)
    {
        $this->limpiar();
        $almacen = Almacen::find($id);
        $this->almacen_id = $almacen->id;
        $this->nombre = $almacen->nombre;
        $this->view = 'edit';
    }

    public function update($id)
    {
        $this->validate();
        $almacen = Almacen::find($id);
        $almacen->nombre = strtoupper($this->nombre);
        $almacen->update();

        $this->edit($almacen->id);

        $this->alert(
            'success',
            'Almacen Creado.'
        );
    }

    public function destroy($id)
    {
        $this->almacen_id = $id;
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
        $parametro = Almacen::find($this->almacen_id);

        $stock = Stock::where('almacenes_id', $parametro->id)->first();

        if ($stock){

            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);

        }else{

            $parametro->delete();
            $this->alert(
                'success',
                'Almacen Eliminado.'
            );

        }


    }

}
