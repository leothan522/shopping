<?php

namespace App\Http\Livewire;

use App\Models\Parametro;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DolarComponent extends Component
{
    use LivewireAlert;

    public $dollar = null, $edit = false, $parametro_id = null;

    public function render()
    {
        $parametro = Parametro::where('nombre', 'precio_dolar')->first();
        if ($parametro){
            $this->dollar = number_format($parametro->valor, 2);
            $this->parametro_id = $parametro->id;
        }
        return view('livewire.dolar-component');
    }

    public function edit($opcion)
    {
        if ($opcion){
            $this->edit = false;
        }else{
            $this->edit = true;
        }
    }

    public function store()
    {
        if ($this->parametro_id){
            $parametro = Parametro::find($this->parametro_id);
            $parametro->valor = $this->dollar;
            $parametro->update();
        }else{
            $parametro = new Parametro();
            $parametro->nombre = "precio_dolar";
            $parametro->tabla_id = auth()->id();
            $parametro->valor = $this->dollar;
            $parametro->save();
        }

        $this->edit = false;

        $this->alert(
            'success',
            'Dolar Actualizado'
        );
    }

}
