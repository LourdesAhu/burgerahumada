<?php

namespace App\Https\Controllers;

class ControladorPostulacion extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva postulación"
        return view ("sistema.postulacion-nuevo", compact("titulo"));
    }
    public function index()
    {
        $titulo = "Listado de postulaciones"
        return view ("sistema.postulacion-listar", compact("titulo"));
    }
}
?>