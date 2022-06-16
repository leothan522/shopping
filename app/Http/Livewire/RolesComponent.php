<?php

namespace App\Http\Livewire;

use App\Models\Parametro;
use App\Models\User;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RolesComponent extends Component
{
    use LivewireAlert;

    public $rol_id, $nombre, $roles, $roles_permisos, $ocultar_boton = true;

    public function render()
    {
        $roles = Parametro::where('tabla_id', '-1')->pluck('nombre', 'id');
        return view('livewire.roles-component')
            ->with('roles_usuarios', $roles);
    }

    public function limpiar()
    {
        $this->rol_id = null;
        $this->nombre = null;
        $this->roles_permisos =null;
        $this->roles = null;
        $this->ocultar_boton = true;
    }

    public function store()
    {
        $roles = Parametro::where('tabla_id', '-1')->get();
        if ($roles->count() <= 24){
            $rules = [
                'nombre' => ['required', 'min:4', 'alpha_dash', Rule::unique('parametros')],
            ];
            $this->validate($rules);
            $parametro = new Parametro();
            $parametro->nombre = $this->nombre;
            $parametro->tabla_id = -1;
            $parametro->save();

            $this->rol_id = $parametro->id;
            $this->roles = $parametro->id;
            $this->alert(
                'success',
                'Parametro Creado'
            );
        }else{
            $this->alert(
                'error',
                'No se pueden crear mas Roles'
            );
        }

    }

    public function destroy($id)
    {
        $this->rol_id = $id;
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
        $user = User::where('role', $this->rol_id)->first();
        if ($user){
            $this->alert(
                'error',
                'No se puede eliminar Rol'
            );
        }else{
            $parametro = Parametro::find($this->rol_id);
            $parametro->delete();
            $this->limpiar();
            $this->alert(
                'success',
                'Parametro Eliminado'
            );
        }

    }

    public function updatedroles()
    {
        if ($this->roles != null){
            $rol = Parametro::find($this->roles);
            $this->rol_id = $rol->id;
            $this->nombre = $rol->nombre;
            $this->roles_permisos = $rol->valor;

            $user = User::where('role', $rol->id)->first();
            if ($user){
                $this->ocultar_boton = true;
            }else{
                $this->ocultar_boton = false;
            }
        }else{
            $this->limpiar();
        }
    }

    public function update_roles($id, $permiso)
    {
        $permisos = [];
        $user = Parametro::find($id);
        if (!leerJson($user->valor, $permiso)){
            $permisos = json_decode($user->valor, true);
            $permisos[$permiso] = true;
            $permisos = json_encode($permisos);
            $this->alert(
                'success',
                'Permiso Agregado'
            );
        }else{
            $permisos = json_decode($user->valor, true);
            unset($permisos[$permiso]);
            $permisos = json_encode($permisos);
            $this->alert(
                'success',
                'Permiso Eliminado'
            );
        }

        $user->valor = $permisos;
        $user->update();
        $this->roles_permisos = $user->valor;

    }

    public function actualRol()
    {
        $usuarios = User::where('role', $this->rol_id)->get();
        foreach ($usuarios as $user){
            $usuario = User::find($user->id);
            $usuario->permisos = $this->roles_permisos;
            $usuario->update();
        }
        //$this->limpiar();
        $this->updatedroles();
        $this->alert(
            'success',
            'Usuarios Actualizados'
        );
    }


}
