<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class DashboardController extends Controller{

    public function index(){
        $user = Auth::user();
        $userRole = strtolower($user->rol->nombre ?? '');
        $dashboardOptions = [];

        if ($userRole === 'rectoria') {
            $dashboardOptions = [
                ['route' => 'usuarios.index', 'label' => 'Empleados UPT'],
                //['route' => 'solicitudes.index', 'label' => 'SOLICITUDES DE COMISIÓN'],
                //['route' => 'solicitudes_viaticos.index', 'label' => 'SOLICITUDES DE VIÁTICOS'],
                //['route' => 'aprobaciones_fiscalizacion.index', 'label' => 'APROBACIONES FISCALIZACIÓN'],
                //['route' => 'aprobaciones_tesoreria.index', 'label' => 'APROBACIONES TESORERÍA'],
                //['route' => 'comprobantes.index', 'label' => 'COMPROBANTES ENTREGADOS'],
            ];
        }if ($userRole === 'fiscalizacion') {
            $dashboardOptions = [
                ['route' => 'aprobaciones_fiscalizacion.index', 'label' => 'APROBACIONES FISCALIZACIÓN'],
                ['route' => 'comprobantes.index', 'label' => 'COMPROBANTES ENTREGADOS'],
            ];
        } elseif ($userRole === 'tesoreria') {
            $dashboardOptions = [
                ['route' => 'aprobaciones_tesoreria.index', 'label' => 'APROBACIONES TESORERÍA'],
                ['route' => 'comprobantes.index', 'label' => 'COMPROBANTES ENTREGADOS'],
            ];
        } elseif ($userRole === 'empleado') {
            $dashboardOptions = [
                ['route' => 'solicitudes.index', 'label' => 'Solicitudes de Salida por Comisión'],
                ['route' => 'solicitudes_viaticos.index', 'label' => 'Solicitudes de Pago de Viáticos'],
                ['route' => 'comprobantes.index', 'label' => 'Comprobantes entregados'],
            ];
        }

        return view('dashboard', compact('dashboardOptions'));
    }

}
