<?php

namespace App\Http\Livewire;

use App\Models\Ajuste;
use App\Models\Almacen;
use App\Models\Carrito;
use App\Models\Empresa;
use App\Models\Parametro;
use App\Models\Producto;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class StockComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed'
    ];

    public $count_empresas, $count_almacenes, $count_productos, $view = 'create', $busqueda;
    public $empresa_id, $empresa_nombre, $listarEmpresas, $multiple, $empresas,
            $listarProductos, $listarAlmacen;
    public $stock_id, $producto, $almacen_id, $moneda, $existe, $pvp, $estatus;
    public $nombre_show, $categoria_show, $sku_show, $decimales_show, $impuesto_show, $individual_show, $imagen_show,
            $almacen_show, $stock_acual_show, $stock_disponible_show, $stock_comprometido_show, $stock_vendido_show, $estatus_show;
    public $ajuste, $lista, $cantidad, $listarProd = [], $listarAjustes = [], $decimales_ajuste, $icono = 'create',
            $ajuste_id, $max, $step, $min;

    public function mount(Request $request)
    {
        if (!is_null($request->buscar)){
            $this->busqueda = $request->buscar;
        }
        $this->verDefault();
    }

    public function render()
    {
        $this->count_empresas = Empresa::count();
        $this->count_almacenes = Almacen::count();
        $this->count_productos = Producto::count();
        $this->listarEmpresas = Empresa::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $this->listarProductos = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $this->listarAlmacen = Almacen::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $listarStock = Stock::buscar($this->busqueda)->where('empresas_id', $this->empresa_id)->orderBy('id', 'DESC')->paginate(30);
        return view('livewire.stock-component')
            ->with('listarStock', $listarStock);
    }

    public function limpiar()
    {
        $this->stock_id = null;
        $this->producto = null;
        $this->almacen_id = null;
        $this->existe = null;
        $this->pvp = null;
        $this->estatus = null;
        $this->view = 'create';
        $this->lista = null;
        $this->cantidad = null;
        $this->icono = 'create';
    }

    public function verDefault()
    {
        $user = User::find(Auth::id());
        if (!is_null($user->empresas_id) && $user->role != 1 && $user->role != 100){
            $this->empresa_id = $user->empresas_id;
            $this->empresa_nombre = $user->empresa->nombre;
            $this->moneda = $user->empresa->moneda;
            $this->multiple = false;
        }else{
            $empresa = Empresa::where('default', 1)->first();
            if ($empresa){
                $this->empresa_id = $empresa->id;
                $this->empresa_nombre = $empresa->nombre;
                $this->moneda = $empresa->moneda;
                $this->multiple = true;
                $this->empresas = $empresa->id;
            }
        }
    }

    public function updatedEmpresas()
    {
        $empresa = Empresa::find($this->empresas);
        $this->empresa_id = $empresa->id;
        $this->empresa_nombre = $empresa->nombre;
    }

    public function updatedProducto()
    {
        $stock = Stock::where('empresas_id', $this->empresa_id)
                        ->where('productos_id', $this->producto)
                        ->first();
        if ($stock){
            if ($this->stock_id == $stock->id){
                $this->existe = 0;
            }else{
                $this->existe = 1;
            }

        }else{
            $this->existe = 0;
        }
    }

    public function rules()
    {
        return [
//            'producto'      =>  ['required', 'min:4', Rule::unique('almacenes')->ignore($this->almacen_id)],
            'producto'      =>  'required|prohibited_if:existe,1',
            'almacen_id'    =>  'required',
            'pvp'           =>  'required',
        ];
    }

    protected $messages = [
        'producto.prohibited_if' => 'Este producto ya se encuentra en el stock.',
    ];

    public function store()
    {
        $this->validate();
        $stock = new Stock();
        $stock->empresas_id = $this->empresa_id;
        $stock->productos_id = $this->producto;
        $stock->almacenes_id = $this->almacen_id;
        $stock->moneda = $this->moneda;
        $stock->pvp = $this->pvp;
        $stock->estatus = intval($this->estatus);
        $stock->save();

        $this->edit($stock->id);

        $this->alert(
            'success',
            'Stock Cuardado.'
        );
    }

    public function edit($id)
    {
        $this->limpiar();
        $stock = Stock::find($id);
        $this->stock_id = $stock->id;
        $this->producto = $stock->productos_id;
        $this->almacen_id = $stock->almacenes_id;
        $this->moneda = $stock->moneda;
        $this->pvp = $stock->pvp;
        $this->estatus = $stock->estatus;
        $this->view = 'edit';
    }

    public function update($id)
    {
        $this->validate();
        $stock = Stock::find($id);
        $stock->productos_id = $this->producto;
        $stock->almacenes_id = $this->almacen_id;
        $stock->moneda = $this->moneda;
        $stock->pvp = $this->pvp;
        $stock->estatus = intval($this->estatus);
        $stock->update();

        $this->edit($stock->id);

        $this->alert(
            'success',
            'Cambios Cuardados.'
        );
    }

    public function show($id)
    {
        $this->limpiar();
        $stock = Stock::find($id);
        $this->stock_id = $stock->id;
        $this->imagen_show = $stock->producto->miniatura;
        $this->nombre_show = $stock->producto->nombre;
        $this->categoria_show = $stock->producto->categoria->nombre;
        $this->decimales_show = $stock->producto->decimales;
        $this->impuesto_show = $stock->producto->impuesto;
        $this->individual_show = $stock->producto->individual;
        $this->almacen_show = $stock->almacen->nombre;
        $this->stock_acual_show = $stock->stock_disponible + $stock->stock_comprometido;
        $this->stock_disponible_show = $stock->stock_disponible;
        $this->stock_comprometido_show = $stock->stock_comprometido;
        $this->stock_vendido_show = $stock->stock_vendido;
        $this->estatus_show = $stock->estatus;
    }

    public function destroy($id)
    {
        $this->stock_id = $id;
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
        $parametro = Stock::find($this->stock_id);

        $ajustes  = Ajuste::where('stock_id', $parametro->id)->first();
        $carrito = Carrito::where('stock_id', $parametro->id)->first();
        $favoritos = Parametro::where('nombre', 'favoritos')->where('valor', $parametro->id)->first();

        if ($ajustes || $carrito || $favoritos){
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
                'Stock Eliminado.'
            );
        }


    }

    public function verAjuste($tipo)
    {
        $this->limpiar();
        $this->ajuste = $tipo;
        $stock = Stock::where('empresas_id', $this->empresa_id)->orderBy('id', 'DESC')->get();
        $stock->each(function ($stock){
            $stock->nombre = $stock->producto->nombre;
        });
        //dd($stock);
        $this->listarProd = $stock->pluck('nombre', 'id');

        $this->listarAjustes = Ajuste::where('empresas_id', $this->empresa_id)
                    ->where('tipo', $this->ajuste)
                    ->where('band', 0)->get();
    }

    public function updatedLista()
    {
        if ($this->lista){

            $stock = Stock::find($this->lista);

            if ($stock->producto->decimales){
                $this->decimales_ajuste = true;
                $this->step = .01;
            }else{
                $this->decimales_ajuste = false;
                $this->step = 1;
            }
            if ($this->ajuste == 'Salida'){
                $this->max = $stock->stock_disponible;
            }else{
                $this->max = null;
            }

            $this->cantidad = null;

        }

    }

    public function rulesAjustes()
    {
        return [
            'lista'      =>  'required',
            'cantidad'    =>  'required',
        ];
    }

    protected $messagesAjustes = [
        'lista.required' => 'El campo Stock es obligatorio.',
        'cantidad.required' => 'obligatorio.',
    ];

    public function storeAjustes()
    {
        $this->validate($this->rulesAjustes(), $this->messagesAjustes);
        $ajuste = new Ajuste();
        $ajuste->tipo = $this->ajuste;
        $ajuste->empresas_id = $this->empresa_id;
        $ajuste->stock_id = $this->lista;
        if ($this->decimales_ajuste){
            $ajuste->cantidad = $this->cantidad;
        }else{
            $ajuste->cantidad = intval($this->cantidad);
        }
        $ajuste->save();
        $this->verAjuste($this->ajuste);
    }

    public function editAjuste($id)
    {
        $ajuste = Ajuste::find($id);
        $stock = Stock::find($ajuste->stock_id);
        if ($stock->producto->decimales){
            $this->cantidad = $ajuste->cantidad;
            $this->decimales_ajuste = true;
            $this->step = .01;
        }else{
            $this->cantidad = intval($ajuste->cantidad);
            $this->decimales_ajuste = false;
            $this->step = 1;
        }
        if ($this->ajuste == 'Salida'){
            $this->max = $stock->stock_disponible;
        }else{
            $this->max = null;
        }
        $this->lista = $ajuste->stock_id;
        $this->ajuste_id = $ajuste->id;
        $this->icono = 'edit';
    }

    public function updateAjuste($id)
    {
        $ajuste = Ajuste::find($id);
        $ajuste->tipo = $this->ajuste;
        $ajuste->empresas_id = $this->empresa_id;
        $ajuste->stock_id = $this->lista;
        if ($this->decimales_ajuste){
            $ajuste->cantidad = $this->cantidad;
        }else{
            $ajuste->cantidad = intval($this->cantidad);
        }
        $ajuste->update();
        $this->verAjuste($this->ajuste);
    }

    public function destroyAjuste($id)
    {
        $ajuste = Ajuste::find($id);
        $ajuste->delete();
        $this->verAjuste($this->ajuste);
    }

    public function totalizar()
    {
        $ajustes = Ajuste::where('empresas_id', $this->empresa_id)
            ->where('tipo', $this->ajuste)
            ->where('band', 0)->get();

        $ajustes->each(function ($ajuste){
            $stock = Stock::find($ajuste->stock_id);
            $valor = $stock->stock_disponible;
            if ($this->ajuste == 'Entrada'){
                $cant = $stock->stock_disponible + $ajuste->cantidad;
            }else{
                $cant = $stock->stock_disponible - $ajuste->cantidad;
                if ($cant < 0){
                    $cant = 0;
                }
            }

            $stock->stock_disponible = $cant;
            $stock->update();
            $item = Ajuste::find($ajuste->id);
            if ($cant == 0){
                $item->cantidad = $valor;
            }
            $item->band = 1;
            $item->update();
        });

        $this->verAjuste($this->ajuste);

        $this->alert(
            'success',
            'Cargado al Inventario.'
        );
    }


    public function actualizar($id)
    {
        $empresa = Empresa::find($id);
        $this->empresa_id = $empresa->id;
        $this->empresa_nombre = $empresa->nombre;
    }




}
