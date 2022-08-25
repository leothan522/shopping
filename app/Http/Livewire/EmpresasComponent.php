<?php

namespace App\Http\Livewire;

use App\Models\Ajuste;
use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Parametro;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
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

    public $view = 'show', $photo, $rif, $nombre, $moneda, $categoria, $telefonos, $email, $direccion, $default = 0, $empresaDefault;
    public $empresa_id, $logo, $borrarLogo = false, $verCategoria;
    public $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $apertura, $cierre, $horario, $horario_id;
    public $estatusTienda;


    public function mount()
    {
        $empresas = Empresa::all();
        if ($empresas->isEmpty()){
            $this->view = "form";
            $this->default = 1;
        }else{
            $default = Empresa::where('default', 1)->first();
            if ($default){
                $this->show($default->id);
                $this->view = "show";
                $this->default = 0;
            }else{
                $this->view = "form";
                $this->default = 1;
            }
        }
    }
    public function render()
    {
        $categorias = Categoria::where('tipo', 1)->orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $empresas = Empresa::all();
        return view('livewire.empresas-component')
            ->with('empresas', $empresas)
            ->with('categorias', $categorias);
    }

    public function limpiar()
    {
        $this->photo = null;
        $this->rif = null;
        $this->nombre = null;
        $this->moneda = null;
        $this->categoria = null;
        $this->telefonos = null;
        $this->email = null;
        $this->direccion = null;
        //$this->default = 0;
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
            'categoria'    =>  'required',
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
        $empresa->categorias_id = $this->categoria;
        $empresa->default = $this->default;

        if ($this->photo){
            $ruta = $this->photo->store('public/logo');
            $empresa->logo = str_replace('public/', 'storage/', $ruta);
            //miniatura
            $nombre = explode('logo/', $empresa->logo);
            crearMiniaturas($empresa->logo, 'storage/logo/t_'.$nombre[1]);
            crearMiniaturas($empresa->logo, 'storage/logo/b_'.$nombre[1], 570, 270);
            $this->logo = $empresa->logo;
            $empresa->miniatura = 'storage/logo/t_'.$nombre[1];
            $empresa->banner = 'storage/logo/b_'.$nombre[1];
        }

        $empresa->save();

        if ($empresa->default){
            $this->default = 0;
        }

        $categoria = Categoria::where('id', $this->categoria)->first();
        if ($categoria){
            $categoria->num_productos++;
            $categoria->update();
        }

        $this->show($empresa->id);
        $this->view = 'show';

        $this->alert(
            'success',
            'Datos Guardados'
        );

    }

    public function show($id)
    {
        $this->limpiar();
        $empresa = Empresa::find($id);
        $this->empresa_id = $empresa->id;
        $this->nombre = $empresa->nombre;
        $this->rif = $empresa->rif;
        $this->telefonos = $empresa->telefono;
        $this->email = $empresa->email;
        $this->direccion = $empresa->direccion;
        $this->moneda = $empresa->moneda;
        $this->categoria = $empresa->categorias_id;
        if ($empresa->categorias_id){
            $this->verCategoria = $empresa->categoria->nombre;
        }else{
            $this->verCategoria = "NO DEFINIDA";
        }

        $this->empresaDefault = $empresa->default;

        if ($empresa->logo == null){
            $this->logo = 'img/img_placeholder.png';
            $this->borrarLogo = false;
        }else{
            $img = explode('logo/', $empresa->logo);
            $this->borrarLogo = true;
            $this->logo = 'storage/logo/t_'.$img[1];
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
        $categoria_anterior = $empresa->categorias_id;
        $empresa->rif = strtoupper($this->rif);
        $empresa->nombre = strtoupper($this->nombre);
        $empresa->direccion = strtoupper($this->direccion);
        $empresa->telefono = $this->telefonos;
        $empresa->email = strtolower($this->email);
        $empresa->moneda = $this->moneda;
        $empresa->categorias_id = $this->categoria;

        if ($this->photo){
            $img = explode('logo/t_', $this->logo);
            if ($this->borrarLogo){
                $logo = 'storage/logo/'.$img[1];
                $miniatura = 'storage/logo/t_'.$img[1];
                $banner = 'storage/logo/b_'.$img[1];
                if (file_exists($logo)){
                    unlink($logo);
                }
                if (file_exists($miniatura)){
                    unlink($miniatura);
                }
                if (file_exists($banner)){
                    unlink($banner);
                }
            }

            $ruta = $this->photo->store('public/logo');
            $empresa->logo = str_replace('public/', 'storage/', $ruta);
            //miniatura
            $nombre = explode('logo/', $empresa->logo);
            crearMiniaturas($empresa->logo, 'storage/logo/t_'.$nombre[1]);
            crearMiniaturas($empresa->logo, 'storage/logo/b_'.$nombre[1], 570, 270);
            $this->logo = $empresa->logo;
            $empresa->miniatura = 'storage/logo/t_'.$nombre[1];
            $empresa->banner = 'storage/logo/b_'.$nombre[1];
        }

        $empresa->update();

        if ($categoria_anterior != $empresa->categorias_id){
            $categoria = Categoria::find($categoria_anterior);
            if ($categoria){
                $restar = $categoria->num_productos - 1;
                $categoria->num_productos = $restar;
                $categoria->update();
            }
            $categoria = Categoria::find($empresa->categorias_id);
            if ($categoria){
                $sumar = $categoria->num_productos + 1;
                $categoria->num_productos = $sumar;
                $categoria->update();
            }
        }

        $this->show($empresa->id);
        $this->view = 'show';

        $this->alert(
            'success',
            'Datos Guardados'
        );


    }

    public function convertirDefault($id)
    {
        $buscar = Empresa::where('default', 1)->first();
        if ($buscar){
            $buscar->default = 0;
            $buscar->update();
        }

        $empresa = Empresa::find($id);
        $empresa->default = 1;
        $empresa->update();
        $this->default = 0;

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

        $ajustes  = Ajuste::where('empresas_id', $parametro->id)->first();
        $stock = Stock::where('empresas_id', $parametro->id)->first();
        $users = User::where('empresas_id', $parametro->id)->first();

        if ($ajustes || $stock || $users){

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

            if (!is_null($parametro->logo)){
                if (file_exists($parametro->logo)){
                    unlink($parametro->logo);
                }
            }

            if (!is_null($parametro->miniatura)){
                if (file_exists($parametro->miniatura)){
                    unlink($parametro->miniatura);
                }
            }

            if (!is_null($parametro->banner)){
                if (file_exists($parametro->banner)){
                    unlink($parametro->banner);
                }
            }

            $this->borrarParametro('estatus_tienda', $parametro->id);
            $this->borrarParametro('horario', $parametro->id);
            $this->borrarParametro('horario_Mon', $parametro->id);
            $this->borrarParametro('horario_Tue', $parametro->id);
            $this->borrarParametro('horario_Wed', $parametro->id);
            $this->borrarParametro('horario_Thu', $parametro->id);
            $this->borrarParametro('horario_Fri', $parametro->id);
            $this->borrarParametro('horario_Sat', $parametro->id);
            $this->borrarParametro('horario_Sun', $parametro->id);
            $this->borrarParametro('horario_apertura', $parametro->id);
            $this->borrarParametro('horario_cierre', $parametro->id);

            $parametro->delete();
            $default = Empresa::where('default', 1)->first();
            $this->show($default->id);
            $this->alert(
                'success',
                'Empresa Eliminada'
            );
        }

    }

    public function borrarParametro($nombre, $tabla_id)
    {
        $parametro = Parametro::where('nombre', $nombre)->where('tabla_id', $tabla_id)->first();
        if ($parametro){
            $parametro->delete();
        }
    }

    public function dias($dia, $id = false)
    {
        $parametro = Parametro::where('nombre', "horario_$dia")->where('tabla_id', $this->empresa_id)->first();
        if ($parametro){
            if ($id){
                return $parametro->id;
            }else{
                return $parametro->valor;
            }
        }else{
            return 0;
        }
    }

    public function verHorario($id)
    {
        $horario = Parametro::where('nombre', 'horario')->where('tabla_id', $id)->first();
        if ($horario){
            $this->horario_id = $horario->id;
            $this->horario = $horario->valor;
        }else{
            $this->horario_id = 0;
            $this->horario = 0;
        }

        $this->lunes = $this->dias('Mon');
        $this->martes = $this->dias('Tue');
        $this->miercoles = $this->dias('Wed');
        $this->jueves = $this->dias('Thu');
        $this->viernes = $this->dias('Fri');
        $this->sabado = $this->dias('Sat');
        $this->domingo = $this->dias('Sun');

        $apertura = Parametro::where('nombre', 'horario_apertura')->where('tabla_id', $this->empresa_id)->first();
        if ($apertura){
            $this->apertura = $apertura->valor;
        }else{
            $this->apertura = null;
        }

        $cierre = Parametro::where('nombre', 'horario_cierre')->where('tabla_id', $this->empresa_id)->first();
        if ($cierre){
            $this->cierre = $cierre->valor;
        }else{
            $this->cierre = null;
        }

        $this->view = "horario";
    }

    public function botonHorario($id)
    {

        if ($id != 0){
            $parametro = Parametro::find($id);
            if ($parametro->valor == 1){
                $parametro->valor = 0;
                $parametro->update();
                $this->alert(
                    'info',
                    'Horario Apagado'
                );
            }else{
                $parametro->valor = 1;
                $parametro->update();
                $this->alert(
                    'success',
                    'Horario Activo'
                );
            }

        }else{
            $parametro = new Parametro();
            $parametro->nombre = "horario";
            $parametro->tabla_id = $this->empresa_id;
            $parametro->valor = 1;
            $parametro->save();
            $this->horario_id = $parametro->id;
            $this->alert(
                'success',
                'Horario Activo'
            );
        }

        $this->horario = $parametro->valor;

    }

    public function diasActivos($dia, $valor)
    {
        $id = $this->dias($dia, true);
        if ($id != 0){

            $parametro = Parametro::find($id);
            if ($valor == 0){
                $parametro->valor = 1;
                $parametro->update();
                $this->alert(
                    'success',
                    'Dia Abierto'
                );
            }else{
                $parametro->valor = 0;
                $parametro->update();
                $this->alert(
                    'info',
                    'Dia Cerrado'
                );
            }

        }else{

            $parametro = new Parametro();
            $parametro->nombre = "horario_$dia";
            $parametro->tabla_id = $this->empresa_id;
            $parametro->valor = 1;
            $parametro->save();
            $this->alert(
                'success',
                'Dia Abierto'
            );
        }

        $this->lunes = $this->dias('Mon');
        $this->martes = $this->dias('Tue');
        $this->miercoles = $this->dias('Wed');
        $this->jueves = $this->dias('Thu');
        $this->viernes = $this->dias('Fri');
        $this->sabado = $this->dias('Sat');
        $this->domingo = $this->dias('Sun');
    }


    public function storeHoras()
    {
        $rules = [
            'apertura'  =>  'required',
            'cierre'    => 'required_with:apertura|after:apertura'
        ];
        $message = [
            'cierre.after'  =>  'cierre debe ser posterior a apertura. '
        ];

        $this->validate($rules, $message);

        $apertura = Parametro::where('nombre', 'horario_apertura')->where('tabla_id', $this->empresa_id)->first();
        if ($apertura){
            $apertura->valor = $this->apertura;
            $apertura->update();
        }else{
            $parametro = new Parametro();
            $parametro->nombre = "horario_apertura";
            $parametro->tabla_id = $this->empresa_id;
            $parametro->valor = $this->apertura;
            $parametro->save();
        }

        $cierre = Parametro::where('nombre', 'horario_cierre')->where('tabla_id', $this->empresa_id)->first();
        if ($cierre){
            $cierre->valor = $this->cierre;
            $cierre->update();
        }else{
            $parametro = new Parametro();
            $parametro->nombre = "horario_cierre";
            $parametro->tabla_id = $this->empresa_id;
            $parametro->valor = $this->cierre;
            $parametro->save();
        }

        $this->alert(
            'success',
            'Horas Guardadas'
        );

    }

    public function estatusTienda($id)
    {
        $estatus_tienda = Parametro::where('nombre', 'estatus_tienda')->where('tabla_id', $id)->first();
        if ($estatus_tienda){
            $parametro = Parametro::find($estatus_tienda->id);
            if ($parametro->valor == 1){
                $parametro->valor = 0;
                $parametro->update();
                $this->alert(
                    'info',
                    'Tienda Cerrada'
                );
            }else{
                $parametro->valor = 1;
                $parametro->update();
                $this->alert(
                    'success',
                    'Tienda Abierta'
                );
            }

        }else{
            $parametro = new Parametro();
            $parametro->nombre = "estatus_tienda";
            $parametro->tabla_id = $id;
            $parametro->valor = 1;
            $parametro->save();
            $this->alert(
                'success',
                'Tienda Abierta'
            );
        }

    }







}
