<?php

namespace App\Https\Controllers;

class ControladorProducto extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo producto"
        return view ("sistema.producto-nuevo", compact("titulo"));
    }
    public function index()
    {
        $titulo = "Listado de productos"
        return view ("sistema.producto-listar", compact("titulo"));
    }
}
?>