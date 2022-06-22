<?php

namespace App\Http\Livewire;

use App\Models\Cuenta;
use App\Models\Parametro;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MetodosComponent extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public $count = true, $view = 'create', $viewMov = 'create', $nombre, $count_tran, $count_mov;
    public $efectivo_bs, $efectivo_dolares, $debito, $transferencia, $movil;
    public $transferencia_id, $banco, $tipo, $numero, $titular, $rif;
    public $movil_id, $codigo, $telefono, $cedula;

    public function render()
    {
        $this->efectivo_bs = $this->verParametro('efectivo_bs');
        $this->efectivo_dolares = $this->verParametro('efectivo_dolares');
        $this->debito = $this->verParametro('debito');
        $this->transferencia = $this->verParametro('transferencia');
        $this->movil = $this->verParametro('movil');
        $this->count_tran = Cuenta::where('tipo', '!=', 'PAGO_MOVIL')->count();
        $this->count_mov = Cuenta::where('tipo', 'PAGO_MOVIL')->count();
        $transferencias = Cuenta::where('tipo', '!=', 'PAGO_MOVIL')->orderBy('numero', 'ASC')->get();
        $pago = Cuenta::where('tipo', 'PAGO_MOVIL')->orderBy('numero', 'ASC')->get();
        return view('livewire.metodos-component')
            ->with('listarTran', $transferencias)
            ->with('listarMov', $pago);
    }

    public function limpiar()
    {
        $this->view = 'create';
        $this->viewMov = 'create';
        $this->transferencia_id = null;
        $this->banco= null;
        $this->tipo= null;
        $this->numero = null;
        $this->titular = null;
        $this->rif = null;
        $this->movil_id = null;
        $this->codigo = null;
        $this->telefono = null;
        $this->cedula = null;
    }

    public function verParametro($valor)
    {
        $existe = Parametro::where('nombre', 'metodo_pago')
            ->where('valor', $valor)
            ->first();
        if ($existe){
            return $existe->tabla_id;
        }else{
            return 0;
        }
    }

    public function parametro($valor)
    {
        $existe = Parametro::where('nombre', 'metodo_pago')
                            ->where('valor', $valor)
                            ->first();
        if ($existe){
            if ($existe->tabla_id == 1){
                $tabla_id = 0;
            }else{
                $tabla_id = 1;
            }
            $parametro = Parametro::find($existe->id);
            $parametro->nombre = "metodo_pago";
            $parametro->tabla_id = $tabla_id;
            $parametro->valor = $valor;
            $parametro->update();
        }else{
            $parametro = new Parametro();
            $parametro->nombre = "metodo_pago";
            $parametro->tabla_id = 1;
            $parametro->valor = $valor;
            $parametro->save();
        }

        $this->alert(
            'success',
            'Parametro Actualizado.'
        );

    }

    public function rules()
    {
        return [
//            'nombre'      =>  ['required', 'min:4', Rule::unique('almacenes')->ignore($this->almacen_id)],
            'banco' =>  'required',
            'tipo' =>  'required',
            'numero' =>  'required',
            'titular' =>  'required',
            'rif' =>  'required',
        ];
    }

    public function storeTran()
    {
        $this->validate();
        $cuenta = new Cuenta();
        $cuenta->banco = strtoupper($this->banco);
        $cuenta->tipo = strtoupper($this->tipo);
        $cuenta->numero = strtoupper($this->numero);
        $cuenta->titular = strtoupper($this->titular);
        $cuenta->rif = strtoupper($this->rif);
        $cuenta->save();

        $this->editTran($cuenta->id);

        $this->alert(
            'success',
            'Cuenta Creada.'
        );
    }

    public function editTran($id)
    {
        $this->limpiar();
        $cuenta = Cuenta::find($id);
        $this->transferencia_id = $cuenta->id;
        $this->banco = $cuenta->banco;
        $this->tipo = $cuenta->tipo;
        $this->numero = $cuenta->numero;
        $this->titular = $cuenta->titular;
        $this->rif = $cuenta->rif;
        $this->view = 'edit';
    }

    public function updateTran($id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->banco = strtoupper($this->banco);
        $cuenta->tipo = strtoupper($this->tipo);
        $cuenta->numero = strtoupper($this->numero);
        $cuenta->titular = strtoupper($this->titular);
        $cuenta->rif = strtoupper($this->rif);
        $cuenta->update();

        $this->editTran($cuenta->id);

        $this->alert(
            'success',
            'Cambios Guardados.'
        );
    }

    public function rulesMovil()
    {
        return [
//            'nombre'      =>  ['required', 'min:4', Rule::unique('almacenes')->ignore($this->almacen_id)],
            'codigo' =>  'required',
            'telefono' =>  'required',
            'cedula' =>  'required',
        ];
    }

    public function storeMov()
    {
        $this->validate($this->rulesMovil());
        $cuenta = new Cuenta();
        $cuenta->banco = strtoupper($this->codigo);
        $cuenta->numero = strtoupper($this->telefono);
        $cuenta->rif = strtoupper($this->cedula);
        $cuenta->save();

        $this->editMov($cuenta->id);

        $this->alert(
            'success',
            'Cuenta Creada.'
        );
    }

    public function editMov($id)
    {
        $this->limpiar();
        $cuenta = Cuenta::find($id);
        $this->movil_id = $cuenta->id;
        $this->codigo = $cuenta->banco;
        $this->telefono = $cuenta->numero;
        $this->cedula = $cuenta->rif;
        $this->viewMov = 'edit';
    }

    public function updateMov($id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->banco = strtoupper($this->codigo);
        $cuenta->numero = strtoupper($this->telefono);
        $cuenta->rif = strtoupper($this->cedula);
        $cuenta->update();

        $this->editMov($cuenta->id);

        $this->alert(
            'success',
            'Cambios Guardados.'
        );
    }

    public function destroy($id)
    {
        $this->transferencia_id = $id;
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
        $parametro = Cuenta::find($this->transferencia_id);
        $parametro->delete();
        $this->limpiar();
        $this->alert(
            'success',
            'Cuenta Eliminada.'
        );
    }


}
