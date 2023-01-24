<?php 

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito_producto extends Model
{
    protected $table = 'carritos_productos';
    public $timestames = false;

    protected $fillable = [
        'idcarritoproducto','fk_idproducto', 'fk_idcarrito', 'cantidad',
    ];
    protected $hidden = [

    ];

    
    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
            fk_idproducto,
            apellido,
            cantidad
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad
        ]);
        return $this->idcarritoproducto = DB::getPdo()->lastInsertId();
    }


    public function guardar()
    {
        $sql = "UPDATE carritos_productos SET
            fk_idproducto= '$this->fk_idproducto',
            fk_idcarrito= '$this->fk_idcarrito',
            cantidad= '$this->cantidad',
            WHERE idcarritoproducto=?";
        $affected = DB::update($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad,
            $this->idcarritoproducto]);
    }


    public function eliminar()
    {
        $sql = "DELETE FROM carritos_productos WHERE 
        idcarritoproducto=?";
        $affected = DB::delete($sql, [$this->idcarritoproducto]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idcarritoproducto
                fk_idproducto,
                fk_idcarrito,
                cantidad
                FROM carritos_productos ORDER BY fk_idproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idcarritoproducto)
    {
        $sql = "SELECT
            idcarritoproducto
            fk_idproducto,
            fk_idcarrito,
            cantidad
            FROM carritos_productos WHERE idcarritoproducto = $idcarritoproducto";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0) {
            $this->idcarritoproducto = $lstRetorno[0]->idcarritoproducto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
            $this->cantidad = $lstRetorno[0]->cantidad;
            return $this;
        }
        return null;
    }


}
