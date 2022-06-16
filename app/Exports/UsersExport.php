<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromView, WithTitle, WithProperties, ShouldAutoSize
{
    public function __construct($busqueda = null)
    {
        $this->busqueda = $busqueda;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        $users = User::buscar($this->busqueda)->orderBy('id', 'DESC')->get();
        return view('dashboard.usuarios.export')
            ->with('users', $users);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return "Usuarios Registrados";
    }

    public function properties(): array
    {
        // TODO: Implement properties() method.
        return [
            'creator'        => 'Sistema Proyecto',
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Usuarios Registrados',
            'company'        => 'Proyecto',
        ];
    }
}
