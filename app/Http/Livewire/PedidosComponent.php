<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Delivery;
use App\Models\Parametro;
use App\Models\Pedido;
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
        $listarCarrito = [];

    public function render()
    {
        $listarPedidos = Pedido::where('estatus', '>', 0)
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
    }

    public function verPedido($id)
    {
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
        //dd($this->listarCarrito);
    }


}
