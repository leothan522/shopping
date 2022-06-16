<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard.usuarios.index');
    }

    public function export($busqueda = null)
    {
        return Excel::download(new UsersExport($busqueda), "Usuarios_Registrados".date('d-m-Y').".xlsx");
    }

    public function createPDF()
    {
        $users = User::all();

        $data = [
            'users' => $users,
        ];

        $pdf = Pdf::loadView('dashboard.usuarios.pdf', $data);
        return $pdf->download('Usuarios.pdf');
    }

    public function vistaPDF()
    {
        $users = User::all();
        return view('dashboard.usuarios.pdf')
            ->with('users', $users);
    }

}
