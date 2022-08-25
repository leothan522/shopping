<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductosComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
        'cambiarSelect'
    ];

    public $view = 'create', $listarCategorias, $count, $busqueda;
    public $photo, $producto_id, $nombre, $categoria, $sku, $imagen, $descripcion, $marca, $modelo, $referencia, $unidad,
            $decimales = 0, $impuesto = 1, $individual = 0, $estatus;
    public $producto_id_show, $nombre_show, $categoria_show, $sku_show, $imagen_show, $descripcion_show, $marca_show,
        $modelo_show, $referencia_show, $unidad_show, $decimales_show = 0, $impuesto_show = 1, $individual_show = 0,
        $estatus_show;
    public $selectItem;

    public function mount(Request $request)
    {
        if (!is_null($request->producto)){
            $this->busqueda = $request->producto;
        }
    }

    public function render()
    {
        $this->count = Producto::count();
        $this->listarCategorias = Categoria::where('tipo', 0)->orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $productos = Producto::buscar($this->busqueda)->orderBy('id', 'DESC')->paginate(30);
        return view('livewire.productos-component')
            ->with('productos', $productos);
    }

    public function limpiar()
    {
        $this->view = 'create';
        $this->photo = null;
        $this->producto_id = null;
        $this->nombre = null;
        $this->categoria = null;
        $this->sku = null;
        $this->imagen = null;
        $this->descripcion = null;
        $this->marca = null;
        $this->modelo = null;
        $this->referencia = null;
        $this->unidad = null;
        $this->decimales = 0;
        $this->impuesto = 1;
        $this->individual = 0;
        $this->estatus = null;
        $this->emit('cambiarSelect');
    }

    public function rules()
    {
        return [
            'photo'     =>  'image|max:1024|nullable',
            'nombre'    =>  ['required', 'min:4', Rule::unique('productos')->ignore($this->producto_id)],
            'categoria' =>  'required',
        ];
    }

    protected $messages = [
        'photo.max' => 'la Imagen no debe ser mayor que 1024 kilobytes.',
    ];

    public function store()
    {
        $this->validate();
        $producto = new Producto();
        $producto->nombre = strtoupper($this->nombre);
        $producto->categorias_id = $this->categoria;

        if ($this->photo){
            $ruta = $this->photo->store('public/productos');
            $producto->imagen = str_replace('public/', 'storage/', $ruta);
            $nombre = explode('productos/', $producto->imagen);
            $miniatura = 'storage/productos/t_'.$nombre[1];
            $detail = 'storage/productos/d_'.$nombre[1];
            $cart = 'storage/productos/c_'.$nombre[1];
            crearMiniaturas($producto->imagen, $miniatura);
            crearMiniaturas($producto->imagen, $detail, 540, 560);
            crearMiniaturas($producto->imagen, $cart, 101, 100);
            $producto->miniatura = $miniatura;
            $producto->detail = $detail;
            $producto->cart = $cart;
        }

        $producto->sku = $this->sku;
        $producto->descripcion = $this->descripcion;
        $producto->marca = $this->marca;
        $producto->modelo = $this->modelo;
        $producto->referencia = $this->referencia;
        $producto->unidad = $this->unidad;
        $producto->decimales = intval($this->decimales);
        $producto->impuesto = intval($this->impuesto);
        $producto->individual = intval($this->individual);

        $producto->save();
        $categoria = Categoria::find($producto->categorias_id);
        $sumar = $categoria->num_productos + 1;
        $categoria->num_productos = $sumar;
        $categoria->update();

        $this->edit($producto->id);
        $this->alert(
            'success',
            'Producto Creado.'
        );

    }

    public function show($id)
    {
        $producto = Producto::find($id);
        $this->limpiar();
        $this->producto_id_show = $producto->id;
        $this->nombre_show = $producto->nombre;
        $this->categoria_show = $producto->categoria->nombre;
        $this->sku_show = $producto->sku;
        $this->imagen_show = $producto->miniatura;
        $this->descripcion_show = $producto->descripcion;
        $this->marca_show = $producto->marca;
        $this->modelo_show = $producto->modelo;
        $this->referencia_show = $producto->referencia;
        $this->unidad_show = $producto->unidad;
        $this->decimales_show = $producto->decimales;
        $this->impuesto_show = $producto->impuesto;
        $this->individual_show = $producto->individual;
        $this->estatus_show = $producto->estatus;

    }

    public function edit($id)
    {
        $this->limpiar();
        $producto = Producto::find($id);
        $this->view = 'edit';
        $this->producto_id = $producto->id;
        $this->nombre = $producto->nombre;
        $this->categoria = $producto->categorias_id;
        $this->sku = $producto->sku;
        $this->imagen = $producto->miniatura;
        $this->descripcion = $producto->descripcion;
        $this->marca = $producto->marca;
        $this->modelo = $producto->modelo;
        $this->referencia = $producto->referencia;
        $this->unidad = $producto->unidad;
        $this->decimales = $producto->decimales;
        $this->impuesto = $producto->impuesto;
        $this->individual = $producto->individual;
        $this->estatus = $producto->estatus;
    }

    public function update($id)
    {
        $this->validate();
        $producto = Producto::find($id);
        $categoria_anterior = $producto->categorias_id;

        $producto->nombre = strtoupper($this->nombre);
        $producto->categorias_id = $this->categoria;

        if ($this->photo){

            if (file_exists($producto->imagen)){
                unlink($producto->imagen);
            }
            if (file_exists($producto->miniatura)){
                unlink($producto->miniatura);
            }
            if (file_exists($producto->detail)){
                unlink($producto->detail);
            }
            if (file_exists($producto->cart)){
                unlink($producto->cart);
            }

            $ruta = $this->photo->store('public/productos');
            $producto->imagen = str_replace('public/', 'storage/', $ruta);
            $nombre = explode('productos/', $producto->imagen);
            $miniatura = 'storage/productos/t_'.$nombre[1];
            $detail = 'storage/productos/d_'.$nombre[1];
            $cart = 'storage/productos/c_'.$nombre[1];
            crearMiniaturas($producto->imagen, $miniatura);
            crearMiniaturas($producto->imagen, $detail, 540, 560);
            crearMiniaturas($producto->imagen, $cart, 101, 100);
            $producto->miniatura = $miniatura;
            $producto->detail = $detail;
            $producto->cart = $cart;
        }

        $producto->sku = $this->sku;
        $producto->descripcion = $this->descripcion;
        $producto->marca = $this->marca;
        $producto->modelo = $this->modelo;
        $producto->referencia = $this->referencia;
        $producto->unidad = $this->unidad;
        $producto->decimales = intval($this->decimales);
        $producto->impuesto = intval($this->impuesto);
        $producto->individual = intval($this->individual);
        $producto->update();

        if ($categoria_anterior != $producto->categorias_id){
            $categoria = Categoria::find($categoria_anterior);
            $restar = $categoria->num_productos - 1;
            $categoria->num_productos = $restar;
            $categoria->update();
            $categoria = Categoria::find($producto->categorias_id);
            $sumar = $categoria->num_productos + 1;
            $categoria->num_productos = $sumar;
            $categoria->update();
        }

        $this->edit($producto->id);
        $this->alert(
            'success',
            'Cambios Guardados.'
        );

    }

    public function destroy($id)
    {
        $this->producto_id = $id;
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
        $parametro = Producto::find($this->producto_id);

        $stock = Stock::where('productos_id', $parametro->id)->first();

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

            $categoria = Categoria::find($parametro->categorias_id);
            $restar = $categoria->num_productos - 1;
            $categoria->num_productos = $restar;
            $categoria->update();
            $parametro->delete();
            $this->alert(
                'success',
                'Producto Eliminado'
            );
            $this->limpiar();

        }
    }

    public function cambiarSelect()
    {
        //$this->selectItem = "hola";
    }





}
