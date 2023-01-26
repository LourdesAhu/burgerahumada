<?php

namespace App\Https\Controllers;

class ControladorCategoria extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva categoria"
        return view ("sistema.categoria-nuevo", compact("titulo"));
    }
    public function index()
    {
        $titulo = "Categorias"
        return view ("sistema.categoria-listar", compact("titulo"));
    }
}
?>