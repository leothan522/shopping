<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Empresa;
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
            $almacen_show, $stock_acual_show, $stock_disponible_show, $stock_comprometido_show, $estatus_show;

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
    }

    public function verDefault()
    {
        $user = User::find(Auth::id());
        if (!is_null($user->empresas_id)){
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
        $parametro->delete();
        $this->alert(
            'success',
            'Stock Eliminado.'
        );
    }


}
