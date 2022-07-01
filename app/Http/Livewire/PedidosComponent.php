<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Delivery;
use App\Models\Mensajero;
use App\Models\Parametro;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PedidosComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $pedido_id, $numero, $fecha, $precio_dolar, $subtotal, $iva, $delivery, $total, $bs, $users_id, $estatus,
        $cedula, $nombre, $telefono, $direccion_1, $direccion_2, $metodo_pago, $pago_validado,$comprobante_pago, $label_metodo,
        $listarCarrito = [], $zona_envio, $listarMensajeros = [], $mensajero, $delivery_id, $mensajero_nombre, $mensajero_telefono,
        $requerido, $busqueda;

    public function mount(Request $request)
    {
        if (!is_null($request->buscar)){
            $this->busqueda = $request->buscar;
        }
    }

    public function render()
    {
        $listarPedidos = Pedido::buscar($this->busqueda)->where('estatus', '>', 0)
            ->orderBy('id', 'DESC')
            ->paginate(50);
        $listarPedidos->each(function ($pedido){
            $parametro = Parametro::find($pedido->metodo_pago);
            $valor = $parametro->valor;
            $metodo = str_replace('_', ' ', $parametro->valor);
            if ($valor == "efectivo_bs" || $valor == "efectivo_dolares"){
                $pedido->icono_metodo = "efectivo";
                $efectivo = explode('_', $valor);
                $metodo = $efectivo[1];
            }else{
                $pedido->icono_metodo = $valor;
            }
            $pedido->metodo = strtoupper($metodo);
            $carrito = Carrito::where('pedidos_id', $pedido->id)->count();
            $pedido->items = $carrito;
        });

        return view('livewire.pedidos-component')
            ->with('listarPedidos', $listarPedidos);
    }

    public function limpiar()
    {
        $this->numero = null;
        $this->fecha = null;
        $this->precio_dolar = null;
        $this->subtotal = null;
        $this->iva = null;
        $this->delivery = null;
        $this->total = null;
        $this->bs = null;
        $this->users_id = null;
        $this->estatus = null;
        $this->cedula = null;
        $this->nombre = null;
        $this->telefono = null;
        $this->direccion_1 = null;
        $this->direccion_2 = null;
        $this->metodo_pago = null;
        $this->pago_validado = null;
        $this->comprobante_pago = null;
        $this->pedido_id = null;
        $this->label_metodo = null;
        $this->listarCarrito = null;
        $this->zona_envio = null;
        $this->mensajero = null;
    }

    public function verPedido($id)
    {
        $this->limpiar();
        $pedido = Pedido::find($id);
        $this->numero = $pedido->numero;
        $this->fecha = $pedido->fecha;
        $this->precio_dolar = $pedido->precio_dolar;
        $this->subtotal = $pedido->subtotal;
        $this->iva = $pedido->iva;
        $this->delivery = $pedido->delivery;
        $this->total = $pedido->total;
        $this->bs = $pedido->bs;
        $this->users_id = $pedido->users_id;
        $this->estatus = $pedido->estatus;
        $this->cedula = $pedido->cedula;
        $this->nombre = $pedido->nombre;
        $this->telefono = $pedido->telefono;
        $this->direccion_1 = $pedido->direccion_1;
        $this->direccion_2 = $pedido->direccion_2;
        $this->metodo_pago = $pedido->metodo_pago;
        $this->pago_validado = $pedido->pago_validado;
        $this->comprobante_pago = $pedido->comprobante_pago;
        $this->pedido_id = $pedido->id;
        if ($this->delivery > 0){
            $this->delivery_id = $pedido->deliverys->id;
            $this->zona_envio = $pedido->deliverys->nombre;
            $this->mensajero = $pedido->deliverys->mensajeros_id;
            if ($this->mensajero){
                $this->mensajero_nombre = $pedido->deliverys->mensajero->nombre;
                $this->mensajero_telefono = $pedido->deliverys->mensajero->telefono;
            }else{
                $this->mensajero_nombre = null;
                $this->mensajero_telefono = null;
            }
        }else{
            $this->zona_envio = null;
            $this->mensajero = null;
            $this->delivery_id = null;
            $this->mensajero_nombre = null;
            $this->mensajero_telefono = null;
        }


        $parametro = Parametro::find($this->metodo_pago);
        $valor = $parametro->valor;
        $metodo = str_replace('_', ' ', $parametro->valor);
        if ($valor == "efectivo_bs" || $valor == "efectivo_dolares"){
            $pedido->icono_metodo = "efectivo";
            $efectivo = explode('_', $valor);
            $metodo = $efectivo[1];
        }else{
            $pedido->icono_metodo = $valor;
        }
        $this->label_metodo = strtoupper($metodo);

        $carrito = Carrito::where('pedidos_id', $this->pedido_id)->get();
        $this->listarCarrito = $carrito;
        $mensajeros = Mensajero::orderBy('nombre', 'ASC')->get();
        if (!$mensajeros->isEmpty()){
            $this->listarMensajeros = $mensajeros;
        }else{
            $this->listarMensajeros = null;
        }

        $delivery = Delivery::where('pedidos_id', $this->pedido_id)->first();
        if ($delivery){
            $this->requerido = true;
        }else{
            $this->requerido = false;
        }

    }

    public function validarPago($id, $estatus)
    {
        $pedido = Pedido::find($id);

        if ($estatus == 1){
            $pedido->estatus = 2;
        }
        if ($estatus == 2){
            $pedido->estatus = 4;
        }
        if ($estatus == 0){
            $pedido->estatus = 1;
        }

        $pedido->pago_validado = $estatus;
        $pedido->update();

        $this->verPedido($pedido->id);

        $this->alert(
            'success',
            'Datos Guardados.'
        );
    }

    public function procesarDespacho($id, $estatus)
    {
        if ($this->delivery_id && $this->listarMensajeros && $this->requerido){
            $rules =[
                'mensajero' => 'required'
            ];
            $this->validate($rules);
        }

        $pedido = Pedido::find($id);

        $pedido->estatus = $estatus;
        $pedido->update();

        if ($estatus == 2){
            if ($this->delivery_id){
                $delivery = Delivery::find($this->delivery_id);
                $delivery->mensajeros_id = null;
                $delivery->update();
            }
        }

        $this->verPedido($pedido->id);

        $this->alert(
            'success',
            'Datos Guardados.'
        );
    }

    public function updatedMensajero()
    {
        $delivery = Delivery::find($this->delivery_id);
        if ($this->mensajero){
            $delivery->mensajeros_id = $this->mensajero;
            $this->mensajero_telefono = $delivery->mensajero->telefono;
            $type = 'success';
            $mensaje = 'Mensajero Establecido.';
        }else{
            $delivery->mensajeros_id = null;
            $this->mensajero_telefono = null;
            $type = 'info';
            $mensaje = 'Mensajero Eliminado.';
        }
        $delivery->update();

        $this->alert(
            $type,
            $mensaje
        );

    }




}
