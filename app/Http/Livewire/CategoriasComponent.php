<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoriasComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed'
    ];

    public $view = 'create', $nombre, $photo, $tipo = 0, $categoria_id, $imagen, $busqueda, $cont;

    public function mount(Request $request)
    {
        if (!is_null($request->categoria)){
            $this->busqueda = $request->categoria;
        }
    }

    public function render()
    {
        $this->cont = Categoria::count();
        $categorias = Categoria::buscar($this->busqueda)->orderBy('nombre', 'ASC')->paginate(30);
        return view('livewire.categorias-component')
            ->with('categorias', $categorias);
    }

    public function rules()
    {
        return [
            'photo'     =>  'image|max:1024|nullable',
            'nombre'       =>  ['required', 'min:4', Rule::unique('categorias')->ignore($this->categoria_id)],
        ];
    }

    protected $messages = [
        'photo.max' => 'la Imagen no debe ser mayor que 1024 kilobytes.',
    ];

    public function limpiar()
    {
        $this->view = 'create';
        $this->nombre = null;
        $this->photo = null;
        $this->tipo = 0;
        $this->categoria_id = null;
        $this->imagen = null;
    }

    public function store()
    {
        $this->validate();

        $categoria = new Categoria();
        $categoria->nombre = ucfirst($this->nombre);
        $categoria->tipo = $this->tipo;

        if ($this->photo){
            $ruta = $this->photo->store('public/categorias');
            $categoria->imagen = str_replace('public/', 'storage/', $ruta);
            $nombre = explode('categorias/', $categoria->imagen);
            $miniatura = 'storage/categorias/t_'.$nombre[1];
            crearMiniaturas($categoria->imagen, $miniatura);
            $categoria->miniatura = $miniatura;
        }

        $categoria->save();
        $this->limpiar();
        $this->edit($categoria->id);
        $this->alert(
            'success',
            'Categoria Guardada.'
        );

    }

    public function edit($id)
    {
        $categorias = Categoria::find($id);
        $this->categoria_id = $categorias->id;
        $this->nombre = ucfirst($categorias->nombre);
        $this->imagen = $categorias->miniatura;
        $this->tipo = $categorias->tipo;
        $this->view = 'edit';
    }

    public function update($id)
    {
        $categoria = Categoria::find($id);
        $categoria->nombre = $this->nombre;
        if ($this->photo){

            if (file_exists($categoria->imagen)){
                unlink($categoria->imagen);
            }
            if (file_exists($categoria->miniatura)){
                unlink($categoria->miniatura);
            }

            $ruta = $this->photo->store('public/categorias');
            $categoria->imagen = str_replace('public/', 'storage/', $ruta);
            $nombre = explode('categorias/', $categoria->imagen);
            $miniatura = 'storage/categorias/t_'.$nombre[1];
            crearMiniaturas($categoria->imagen, $miniatura);
            $categoria->miniatura = $miniatura;
        }
        $categoria->update();
        $this->limpiar();
        $this->edit($categoria->id);
        $this->alert(
            'success',
            'Cambios Guardados.'
        );

    }

    public function destroy($id)
    {
        $this->categoria_id = $id;
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
        $parametro = Categoria::find($this->categoria_id);

        $productos = Producto::where('categorias_id', $parametro->id)->first();
        $empresas = Empresa::where('categorias_id', $parametro->id)->first();

        if ($productos && $empresas){

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

            if (!is_null($parametro->imagen)){
                if (file_exists($parametro->imagen)){
                    unlink($parametro->imagen);
                }
            }

            if (!is_null($parametro->miniatura)){
                if (file_exists($parametro->miniatura)){
                    unlink($parametro->miniatura);
                }
            }

            $parametro->delete();

            $this->alert(
                'success',
                'Categoria Eliminada'
            );
            $this->limpiar();

        }
    }






}
