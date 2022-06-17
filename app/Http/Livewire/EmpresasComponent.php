<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\Parametro;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Livewire\str;

class EmpresasComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    protected $listeners = [
        'confirmed'
    ];

    public $view = 'show', $photo, $rif, $nombre, $moneda, $telefonos, $email, $direccion, $default = 0, $empresaDefault;
    public $empresa_id, $logo, $borrarLogo = false;


    public function mount()
    {
        $empresas = Empresa::all();
        if ($empresas->isEmpty()){
            $this->view = "form";
            $this->default = 1;
        }else{
            $default = Empresa::where('default', 1)->first();
            $this->show($default->id);
            $this->view = "show";
        }
    }
    public function render()
    {
        $empresas = Empresa::all();
        return view('livewire.empresas-component')
            ->with('empresas', $empresas);
    }

    public function limpiar()
    {
        $this->photo = null;
        $this->rif = null;
        $this->nombre = null;
        $this->moneda = null;
        $this->telefonos = null;
        $this->email = null;
        $this->direccion = null;
        $this->default = 0;
        $this->logo = null;
        $this->empresa_id = null;
    }

    public function create()
    {
        $this->limpiar();
        $this->view = 'form';
    }

    public function rules()
    {
        return [
            'photo'     =>  'image|max:1024|nullable',
            'rif'       =>  ['required', 'min:6', Rule::unique('empresas')->ignore($this->empresa_id)],
            'nombre'    =>  'required|min:4',
            'moneda'    =>  'required',
            'telefonos' =>  'required',
            'email'     =>  'required|email',
            'direccion' =>  'required'

        ];
    }

    public function store()
    {
        $this->validate();

        $empresa = new Empresa();
        $empresa->rif = strtoupper($this->rif);
        $empresa->nombre = strtoupper($this->nombre);
        $empresa->direccion = strtoupper($this->direccion);
        $empresa->telefono = $this->telefonos;
        $empresa->email = strtolower($this->email);
        $empresa->moneda = $this->moneda;
        $empresa->default = $this->default;

        if ($this->photo){
            $ruta = $this->photo->store('public/logo');
            $empresa->logo = str_replace('public/', 'storage/', $ruta);
            $this->logo = $empresa->logo;
        }


        $empresa->save();

        $this->show($empresa->id);
        $this->view = 'show';

        $this->alert(
            'success',
            'Datos Guardados'
        );

    }

    public function show($id)
    {
        $empresa = Empresa::find($id);
        $this->empresa_id = $empresa->id;
        $this->nombre = $empresa->nombre;
        $this->rif = $empresa->rif;
        $this->telefonos = $empresa->telefono;
        $this->email = $empresa->email;
        $this->direccion = $empresa->direccion;
        $this->moneda = $empresa->moneda;
        $this->empresaDefault = $empresa->default;

        if ($empresa->logo == null){
            $this->logo = 'img/img_placeholder.png';
            $this->borrarLogo = false;
        }else{
            $this->borrarLogo = true;
            $this->logo = $empresa->logo;
        }

        $this->view = 'show';
    }

    public function edit()
    {
        $this->photo = null;
        $this->view = 'form';
    }

    public function update($id)
    {
        $this->validate();
        $empresa = Empresa::find($id);
        $empresa->rif = strtoupper($this->rif);
        $empresa->nombre = strtoupper($this->nombre);
        $empresa->direccion = strtoupper($this->direccion);
        $empresa->telefono = $this->telefonos;
        $empresa->email = strtolower($this->email);
        $empresa->moneda = $this->moneda;

        if ($this->photo){

            if ($this->borrarLogo){
                if (file_exists($this->logo)){
                    unlink($this->logo);
                }
            }

            $ruta = $this->photo->store('public/logo');
            $empresa->logo = str_replace('public/', 'storage/', $ruta);
            $this->logo = $empresa->logo;
        }

        $empresa->update();

        $this->view = 'show';

        $this->alert(
            'success',
            'Datos Guardados'
        );


    }

    public function convertirDefault($id)
    {
        $buscar = Empresa::where('default', 1)->first();
        $buscar->default = 0;
        $buscar->update();


        $empresa = Empresa::find($id);
        $empresa->default = 1;
        $empresa->update();

        $this->empresaDefault = $empresa->default;
        $this->alert(
            'success',
            'Datos Guardados.'
        );
    }

    public function destroy($id)
    {
        $this->empresa_id = $id;
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
        $parametro = Empresa::find($this->empresa_id);

        if (!is_null($parametro->logo)){
            if (file_exists($parametro->logo)){
                unlink($parametro->logo);
            }
        }

        $parametro->delete();
        $default = Empresa::where('default', 1)->first();
        $this->show($default->id);
        $this->alert(
            'success',
            'Empresa Eliminada'
        );

    }



}
