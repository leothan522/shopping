<?php

namespace App\Http\Livewire;

use App\Models\Mensajero;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DeliveryComponent extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmedZonas',
        'confirmedMensajeros'
    ];

    public $view_zonas = 'create',$view_mensajeros = 'create', $count_zonas, $count_mensajeros, $busqueda;
    public $zona_id, $zona, $precio;
    public $mensajero_id, $cedula, $mensajero, $telefono;

    public function mount(Request $request)
    {
        if (!is_null($request->buscar)){
            $this->busqueda = $request->buscar;
        }
    }

    public function render()
    {
        $this->count_zonas = Zona::count();
        $this->count_mensajeros = Mensajero::count();
        $zonas = Zona::buscar($this->busqueda)->orderBy('nombre', 'ASC')->get();
        $mensajeros = Mensajero::buscar($this->busqueda)->orderBy('cedula', 'ASC')->get();
        return view('livewire.delivery-component')
            ->with('listarZonas', $zonas)
            ->with('listarMensajeros', $mensajeros);
    }

    public function limpiarZonas()
    {
        $this->view_zonas = 'create';
        $this->zona_id = null;
        $this->zona = null;
        $this->precio = null;
    }

    public function limpiarMensajeros()
    {
        $this->view_mensajeros = 'create';
        $this->mensajero_id = null;
        $this->cedula = null;
        $this->mensajero = null;
        $this->telefono = null;
    }

    public function rules()
    {
        return [
            'zona'      =>  ['required', 'min:4', Rule::unique('zonas', 'nombre')->ignore($this->zona_id)],
            'precio'    =>  'required'
        ];
    }

    public function storeZonas()
    {
        $this->validate();
        $zona = new Zona();
        $zona->nombre = strtoupper($this->zona);
        $zona->precio = $this->precio;
        $zona->save();

        $this->editZonas($zona->id);

        $this->alert(
            'success',
            'Zona Creada.'
        );
    }

    public function editZonas($id)
    {
        $this->limpiarZonas();
        $zona = Zona::find($id);
        $this->zona_id = $zona->id;
        $this->zona = $zona->nombre;
        $this->precio = $zona->precio;
        $this->view_zonas = 'edit';
    }

    public function updateZonas($id)
    {
        $this->validate();
        $zona = Zona::find($id);
        $zona->nombre = strtoupper($this->zona);
        $zona->precio = $this->precio;
        $zona->update();

        $this->editZonas($zona->id);

        $this->alert(
            'success',
            'Cambios Guardados.'
        );
    }

    public function destroy($id)
    {
        $this->zona_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedZonas',
        ]);
    }

    public function confirmedZonas()
    {
        // Example code inside confirmed callback
        $parametro = Zona::find($this->zona_id);
        $parametro->delete();
        $this->alert(
            'success',
            'Zona Eliminada'
        );
    }

    public function rulesMensajeros()
    {
        return [
            'cedula'      =>  ['required', 'min:6', Rule::unique('mensajeros')->ignore($this->mensajero_id)],
            'mensajero'    =>  'required',
            'telefono'    =>  'required'
        ];
    }

    protected $messages = [
        'mensajero.required' => ' El campo nombre es obligatorio.',
    ];

    public function storeMensajeros()
    {
        $this->validate($this->rulesMensajeros());
        $mensajero = new Mensajero();
        $mensajero->cedula = strtoupper($this->cedula);
        $mensajero->nombre = strtoupper($this->mensajero);
        $mensajero->telefono = strtoupper($this->telefono);
        $mensajero->save();

        $this->editMensajeros($mensajero->id);

        $this->alert(
            'success',
            'Mensajero Creado.'
        );

    }

    public function editMensajeros($id)
    {
        $this->limpiarMensajeros();
        $mensajero = Mensajero::find($id);
        $this->mensajero_id = $mensajero->id;
        $this->cedula = $mensajero->cedula;
        $this->mensajero = $mensajero->nombre;
        $this->telefono = $mensajero->telefono;
        $this->view_mensajeros = 'edit';
    }

    public function updateMensajeros($id)
    {
        $this->validate($this->rulesMensajeros());
        $mensajero = Mensajero::find($id);
        $mensajero->cedula = strtoupper($this->cedula);
        $mensajero->nombre = strtoupper($this->mensajero);
        $mensajero->telefono = strtoupper($this->telefono);
        $mensajero->update();

        $this->editMensajeros($mensajero->id);

        $this->alert(
            'success',
            'Cambios Guardados.'
        );

    }

    public function destroyMensajeros($id)
    {
        $this->mensajero_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedMensajeros',
        ]);
    }

    public function confirmedMensajeros()
    {
        // Example code inside confirmed callback
        $parametro = Mensajero::find($this->mensajero_id);
        $parametro->delete();
        $this->alert(
            'success',
            'Mensajero Eliminado.'
        );
    }


}
